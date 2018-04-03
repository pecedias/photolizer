<?php
  $id_image = 1;

    $dbhost = "localhost";
    $dbname = "bd_projeto";
    $dbusername = "jhonny";
    $dbpassword = "astronauta21";
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    require __DIR__ . '/vendor/autoload.php';
use Google\Cloud\Vision\VisionClient;
$vision = new VisionClient([
    'keyFilePath' => '/var/www/ads/html/key.json'
]);
$fileName = 'resources/logos.png';
$image = $vision->image(fopen($fileName, 'r'), [
    'FACE_DETECTION',
    'LANDMARK_DETECTION',
    'LOGO_DETECTION',
    'LABEL_DETECTION',
    'TEXT_DETECTION',
    'DOCUMENT_TEXT_DETECTION',
    'SAFE_SEARCH_DETECTION',
    'IMAGE_PROPERTIES',
    'CROP_HINTS',
    'WEB_DETECTION'
]);
//Tags
$result = $vision->annotate($image);
$insert_labels = array();
print("<br><b>Tags:</b>\n");
foreach ($result->labels() as $label) {
    //Insere dados
    $sql = "INSERT INTO label (fk_id_image, label_name) VALUES (".$id_image.",'".$label->description()."')";
    $conn->exec($sql);
    $insert_labels[] = array($id_image,$label->description()); 
    print($label->description() . PHP_EOL);
}
//Logotipos
print("<br><b>Logotipos:</b>\n");
    foreach ((array) $result->logos() as $logo) {
    //Insere dados
    $sql = "INSERT INTO logo (fk_id_image, logo) VALUES (".$id_image.",'".$logo->description()."')";
    $conn->exec($sql);
    print($logo->description() . PHP_EOL);
}
//Pontos Turisticos
print("<br><b>Pontos Turisticos:</b>\n");
foreach ((array) $result->landmarks() as $landmark) {
    print($landmark->description() . PHP_EOL);
}
//Textos
print("<br><b>Textos:</b>\n");
foreach ((array) $result->text() as $text) {
    $sql = "INSERT INTO text (fk_id_image, text) VALUES (".$id_image.",'".$text->description()."')";
    $conn->exec($sql);
    print($text->description() . PHP_EOL);
}
//Cores
print("<br><b>Cores:</b>\n");
foreach ($result->imageProperties()->colors() as $color) {
    $rgb = $color['color'];
    $hex = sprintf("#%02x%02x%02x", $rgb['red'], $rgb['green'],$rgb['blue']);
    $sql = "INSERT INTO propriert (fk_id_image, cod_color) VALUES (".$id_image.",'".$hex."')";
    $conn->exec($sql);
    printf("<br>%s\n", $hex);
}
//Pesquisa Segura
    $safe = $result->safeSearch();
    $adult = $safe->isAdult() ? 'yes' : 'no';
    $spoof = $safe->isSpoof() ? 'yes' : 'no';
    $medical = $safe->isMedical() ? 'yes' : 'no';
    $violence = $safe->isViolent() ? 'yes' : 'no';
    $sql = "INSERT INTO safe (fk_id_image, adult,spoof,medical,violence) 
    VALUES (".$id_image.",'".$adult."','".$spoof."','".$medical."','".$violence."')";
    $conn->exec($sql);

    $web = $result->web();

    if ($web->pages()) {
        printf('<br><b>%d Pages with matching images found:</b>' . PHP_EOL, count($web->pages()));
        foreach ($web->pages() as $page) {
            printf('<br>URL: %s' . PHP_EOL, $page->url());
        }
        print(PHP_EOL);
    }

    if ($web->matchingImages()) {
        printf('<br>%d Full Matching Images found:' . PHP_EOL, count($web->matchingImages()));
        foreach ($web->matchingImages() as $matchingImage) {
            printf('<br>URL: %s' . PHP_EOL, $matchingImage->url());
        }
        print(PHP_EOL);
    }

    if ($web->partialMatchingImages()) {
        printf('<br>%d Partial Matching Images found:' . PHP_EOL, count($web->partialMatchingImages()));
        foreach ($web->partialMatchingImages() as $partialMatchingImage) {
            printf('<br>URL: %s' . PHP_EOL, $partialMatchingImage->url());
        }
        print(PHP_EOL);
    }

    if ($web->entities()) {
        printf('<br>%d Web Entities found:' . PHP_EOL, count($web->entities()));
        foreach ($web->entities() as $entity) {
            printf('<br>Score: %f' . PHP_EOL, $entity->score());
            if (isset($entity->info()['description'])) {
                printf('<br>Description: %s' . PHP_EOL, $entity->description());
            }
            printf(PHP_EOL);
        }
    }
    //var_dump($insert_labels);