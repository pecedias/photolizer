<?php
session_start();
require_once 'facebook/vendor/autoload.php';
$fb = new Facebook\Facebook([
    'app_id' => '1634965423265207', // Replace {app-id} with your app id
    'app_secret' => '7746728c3784ddba0e74ee20ea21d0a0',
    'default_graph_version' => 'v2.2',
  ]);

$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (! isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}

// Logged in
//echo '<h3>Access Token</h3>';
//var_dump($accessToken->getValue());

// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);
//echo '<h3>Metadata</h3>';
//var_dump($tokenMetadata);

// Validation (these will throw FacebookSDKException's when they fail)
$tokenMetadata->validateAppId('1634965423265207'); // Replace {app-id} with your app id
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
$tokenMetadata->validateExpiration();

if (! $accessToken->isLongLived()) {
  // Exchanges a short-lived access token for a long-lived one
  try {
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  } catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
    exit;
  }

  //echo '<h3>Long-lived</h3>';
  //var_dump($accessToken->getValue());
}

$_SESSION['fb_access_token'] = (string) $accessToken;

try {
    // Returns a `Facebook\FacebookResponse` object
    $responseUser = $fb->get('/me?fields=id,name,cover,first_name,last_name,age_range,link,gender,locale,picture,timezone,verified', $accessToken);
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }
  $user = $responseUser->getGraphUser();
  echo '<br>id: ' . $user['id'];
  //echo '<br>id: ' . $friends['id'];
  echo '<br>name: ' . $user['name'];
  echo '<br>cover: ' . $user['cover'];
  echo '<br>first_name: ' . $user['first_name'];
  echo '<br>last_name: ' . $user['last_name'];
  echo '<br>age_range: ' . $user['age_range'];
  echo '<br>link: ' . $user['link'];
  echo '<br>gender: ' . $user['gender'];
  echo '<br>locale: ' . $user['locale'];
  echo '<br>picture: ' . $user['picture'];
  echo '<br>timezone: ' . $user['timezone'];
  echo '<br>verified: ' . $user['verified'];
// User is logged in with a long-lived access token.
// You can redirect them to a members-only page.
//header('Location: https://example.com/members.php');

try {
    // Returns a `Facebook\FacebookResponse` object
    $response = $fb->get(
      '/'.$user['id'].'/friends',
      $accessToken
    );
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
  }
  $graphNode = $response->getBody();
  echo '<pre>';
print_r($graphNode);
echo '</pre>';
  