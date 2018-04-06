<?php
  //require_once('load.php');
  $id_image = base64_decode($_GET['id']);
  $img = base64_decode($_GET['img']);
   require_once('../config.php');
   require __DIR__ . '/vendor/autoload.php';
use Google\Cloud\Vision\VisionClient;
use Google\Cloud\Translate\TranslateClient;
$vision = new VisionClient([
    'keyFilePath' => '/var/www/ads/html/key.json'
]);
$redirect = true;

$fileName = '../upload/files_input/'.$img;
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
//Faces
//print("<br><b>Faces:</b>\n");
if(isset($result->info()['faceAnnotations'] )){

foreach ($result->info()['faceAnnotations'] as $annotation) {
    //Insere dados
    $sql = "INSERT INTO face (fk_id_image, face_name, level) VALUES (".$id_image.",'Alegre','".$annotation['joyLikelihood']."')";
    $conn->exec($sql);
    $sql = "INSERT INTO face (fk_id_image, face_name, level) VALUES (".$id_image.",'Triste','".$annotation['angerLikelihood']."')";
    $conn->exec($sql);
    $sql = "INSERT INTO face (fk_id_image, face_name, level) VALUES (".$id_image.",'Surpreso','".$annotation['surpriseLikelihood']."')";
    $conn->exec($sql);
    $sql = "INSERT INTO face (fk_id_image, face_name, level) VALUES (".$id_image.",'Exposto','".$annotation['underExposedLikelihood']."')";
    $conn->exec($sql);
    $sql = "INSERT INTO face (fk_id_image, face_name, level) VALUES (".$id_image.",'Borrado','".$annotation['blurredLikelihood']."')";
    $conn->exec($sql);
    $sql = "INSERT INTO face (fk_id_image, face_name, level) VALUES (".$id_image.",'Chapéu','".$annotation['headwearLikelihood']."')";
    $conn->exec($sql);
    //print('<br>'.$annotation['joyLikelihood'] . PHP_EOL);
    //print('<br>'.$annotation['angerLikelihood'] . PHP_EOL);
    //print('<br>'.$annotation['surpriseLikelihood'] . PHP_EOL);
    //print('<br>'.$annotation['underExposedLikelihood'] . PHP_EOL);
    //print('<br>'.$annotation['blurredLikelihood'] . PHP_EOL);
    //print('<br>'.$annotation['headwearLikelihood'] . PHP_EOL);
}

	//var_dump($img);
$outputImage="../upload/files_input/".$img;
//var_dump($outputImage);
//echo '<img src="'.$outputImage.'">';
foreach ($result->info()['faceAnnotations'] as $annotation) {
    if (isset($annotation['boundingPoly'])) {
			  $bg = $outputImage;
	$overlay = '../upload/files_output/02.jpg';
	//$image = new PHPImage();
	//$image->setDimensionsFromImage($bg);
	//$image->draw($bg);
        $verticies = $annotation['boundingPoly']['vertices'];
        $x1 = isset($verticies[0]['x']) ? $verticies[0]['x'] : 0;
        $y1 = isset($verticies[0]['y']) ? $verticies[0]['y'] : 0;
        $x2 = isset($verticies[2]['x']) ? $verticies[2]['x'] : 0;
        $y2 = isset($verticies[2]['y']) ? $verticies[2]['y'] : 0;
      	//$image->rectangle($x1, $y1, $x2, $y2, array(0, 0, 0), 0.5);  
				//$image->show();
			$ext = explode('.',$img);
			$ext = $img[1];
			if($ext == 'jpeg' || $ext == 'jpg'){
				$dest = imagecreatefromjpeg($outputImage);
				imagerectangle($dest, $x1, $y1, $x2, $y2, 0x00ff00);
				imagejpeg($dest, $outputImage); 
			}elseif($ext == 'png'){
				$dest = imagecreatefrompng($outputImage);
				imagerectangle($dest, $x1, $y1, $x2, $y2, 0x00ff00);
				imagepng($dest, $outputImage); 
			}elseif($ext == 'gif'){
				$dest = imagecreatefromgif($outputImage);
				imagerectangle($dest, $x1, $y1, $x2, $y2, 0x00ff00);
				imagegif($dest, $outputImage); 
			}
		}
		}
}
//echo '<img src="'.$outputImage.'">';
//print("<br><b>Tags:</b>\n");
if($result->labels() != null){
foreach ($result->labels() as $label) {
    //Insere dados
    $text = $label->description();
    $targetLanguage = 'pt';
    $translate = new TranslateClient([
        'keyFilePath' => '/var/www/ads/html/key.json'
    ]);
    $resultLang = $translate->translate($text, [
        'target' => $targetLanguage,
    ]);
    $sql = "INSERT INTO label (fk_id_image, label_name) VALUES (".$id_image.",'".$resultLang['text']."')";
    $conn->exec($sql);
    //print($resultLang['text'].PHP_EOL);
}
}
//Logotipos
//print("<br><b>Logotipos:</b>\n");
foreach ((array) $result->logos() as $logo) {
    //Insere dados
    $sql = "INSERT INTO logo (fk_id_image, logo) VALUES (".$id_image.",'".$logo->description()."')";
    $conn->exec($sql);
    //print($logo->description() . PHP_EOL);
}
//Pontos Turisticos
//print("<br><b>Pontos Turisticos:</b>\n");
foreach ((array) $result->landmarks() as $landmark) {
    $sql = "INSERT INTO landmark (fk_id_image, landmark_name) VALUES (".$id_image.",'".$landmark->description()."')";
    $conn->exec($sql);
    //print($landmark->description() . PHP_EOL);
}
//Textos
//print("<br><b>Textos:</b>\n");
foreach ((array) $result->text() as $text) {
    $sql = "INSERT INTO text (fk_id_image, text) VALUES (".$id_image.",'".$text->description()."')";
    $conn->exec($sql);
    //print($text->description() . PHP_EOL);
}
//Cores
//print("<br><b>Cores:</b>\n");
if($result->imageProperties() != null){
foreach ($result->imageProperties()->colors() as $color) {
    $rgb = $color['color'];
    $hex = sprintf("#%02x%02x%02x", $rgb['red'], $rgb['green'],$rgb['blue']);
    $sql = "INSERT INTO propert (fk_id_image, cod_color) VALUES (".$id_image.",'".$hex."')";
    $conn->exec($sql);
    //printf("<br>%s\n", $hex);
}
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
		if($adult == 'yes'){
			 $sql = "UPDATE image SET safe = 'yes' WHERE id_image = '".$id_image."' ";
       $conn->exec($sql);
		}
    $web = $result->web();

    if ($web->pages()) {
        //printf('<br><b>%d Pages with matching images found:</b>' . PHP_EOL, count($web->pages()));
        foreach ($web->pages() as $page) {
            //printf('<br>URL: %s' . PHP_EOL, $page->url());
        }
        print(PHP_EOL);
    }

    if ($web->matchingImages()) {
        //printf('<br>%d Full Matching Images found:' . PHP_EOL, count($web->matchingImages()));
        foreach ($web->matchingImages() as $matchingImage) {
            //printf('<br>URL: %s' . PHP_EOL, $matchingImage->url());
        }
        print(PHP_EOL);
    }

    if ($web->partialMatchingImages()) {
        //printf('<br>%d Partial Matching Images found:' . PHP_EOL, count($web->partialMatchingImages()));
        foreach ($web->partialMatchingImages() as $partialMatchingImage) {
          $sql = "INSERT INTO matching (fk_id_image, matching_url) VALUES (".$id_image.",'".$partialMatchingImage->url()."')";
          $conn->exec($sql);
            //printf('<br>URL: %s' . PHP_EOL, $partialMatchingImage->url());
        }
        print(PHP_EOL);
    }

    if ($web->entities()) {
        //printf('<br>%d Web Entities found:' . PHP_EOL, count($web->entities()));
        foreach ($web->entities() as $entity) {
            //printf('<br>Score: %f' . PHP_EOL, $entity->score());
            if (isset($entity->info()['description'])) {
                //printf('<br>Description: %s' . PHP_EOL, $entity->description());
            }
            printf(PHP_EOL);
        }
    }
			$sql = "UPDATE image SET active = 1 WHERE id_image = '".$id_image."' ";
       $conn->exec($sql);
	
    $url = 'https://ads.deskbr.com/?id='.base64_encode($id_image);
		if($redirect == true){
				echo '<script type="text/javascript">
        			  window.location = "'.$url.'"
     				 </script>';
		}		

    //var_dump($insert_labels);
