<?php
$fb = new Facebook\Facebook([
  'app_id' => '1634965423265207', // Replace {app-id} with your app id
  'app_secret' => '7746728c3784ddba0e74ee20ea21d0a0',
  'default_graph_version' => 'v2.2',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('https://ads.deskbr.com/login/fb-callback.php', $permissions);

echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';