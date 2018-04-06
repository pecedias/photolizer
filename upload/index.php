<?php
require_once('../config.php');
require_once('Compress.php');
// Check if image file is a actual image or fake image
if(isset($_POST["base"])){
	require_once('../api/load.php');
	$img = $_POST['base64'];
	$uploadOk = 1;
	function getFileSizeInKb($base64string){
		$bytes = strlen(base64_decode($base64string));
		$roughsize = (((int)$bytes) / 1024.0)* 0.67;
		return round($roughsize,2);
	}
	if(getFileSizeInKb($img) >=3071){
		echo "Tamanho maximo é 3MB.";
		$uploadOk = 0;
	}
	define('UPLOAD_DIR', 'files_input/');
	$ext = explode('/',$img);
	$ext = explode(';',$ext[1]);
	$imageFileType = $ext[0];
	$exclude = 'data:image/'.$imageFileType.';base64,';
	$img = str_replace($exclude, '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$file = UPLOAD_DIR . uniqid() . '.'.$imageFileType;
	$target_name = str_replace(UPLOAD_DIR,'',$file);
	// Check if file already exists
	if (file_exists($file)) {
	    echo "O Arquivo já existe.";
	    $uploadOk = 0;
	}
	$success = file_put_contents($file, $data);
	//print $success ? $file : 'Unable to save the file.';
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    echo "Desculpe somente extensões JPG, JPEG, PNG & GIF são aceitas.";
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    echo "Desculpe, não foi possivel fazer upload.";
	// if everything is ok, try to upload file
	} else {
	    if (file_exists($file)) {
				$new_name_file = 'file_'.$target_name;
				$quality = 60;
				$destination = 'files_input/';
				$image_compress = new Compress($file, $new_name_file, $quality, $destination);
				//echo $image_compress->compress_image();
				//unlink($file);
				//var_dump($image_compress);
				$id = new_id();
				$datetime = date("Y-m-d H:i:s");
				$sql = "INSERT INTO image (id_image,image_name) VALUES (".$id.",'".$target_name."')";
				$conn->exec($sql);
				$url = 'https://ads.deskbr.com/api/detection.php?id='.base64_encode($id).'&img='.base64_encode($target_name);
				echo '<script type="text/javascript">
          			  window.location = "'.$url.'"
     				 </script>';
	    } else {
	        echo "Desculpe, houve um erro ao tentar fazer upload do arquivo.";
	    }
	}

}else{

?>
<!DOCTYPE html>
<html lang="pt-br" >
<head>
  <meta charset="UTF-8">
  <title>PhotoLizer - Upload</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<style>
    @import url(//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css);
		@import url(https://fonts.googleapis.com/css?family=Source+Code+Pro:400,500);
		@import url('https://fonts.googleapis.com/css?family=Anton');
		@import url('https://fonts.googleapis.com/css?family=Roboto');
		@-webkit-keyframes roll {
		0% {
			opacity: 0;
		}
		50% {
			opacity: 0;
			-webkit-transform: translate(-150%, -50%) rotate(-90deg) scale(0.3);
					transform: translate(-150%, -50%) rotate(-90deg) scale(0.3);
			-webkit-box-shadow: none;
					box-shadow: none;
		}
		100% {
			opacity: 1;
			-webkit-transform: translate(-50%, -50%) rotate(0deg) scale(1);
					transform: translate(-50%, -50%) rotate(0deg) scale(1);
			-webkit-box-shadow: 0 3px 5px rgba(0, 0, 0, 0.3);
					box-shadow: 0 3px 5px rgba(0, 0, 0, 0.3);
		}
		}
		@keyframes roll {
		0% {
			opacity: 0;
		}
		50% {
			opacity: 0;
			-webkit-transform: translate(-150%, -50%) rotate(-90deg) scale(0.3);
					transform: translate(-150%, -50%) rotate(-90deg) scale(0.3);
			-webkit-box-shadow: none;
					box-shadow: none;
		}
		100% {
			opacity: 1;
			-webkit-transform: translate(-50%, -50%) rotate(0deg) scale(1);
					transform: translate(-50%, -50%) rotate(0deg) scale(1);
			-webkit-box-shadow: 0 3px 5px rgba(0, 0, 0, 0.3);
					box-shadow: 0 3px 5px rgba(0, 0, 0, 0.3);
		}
		}
		body {
		background: #222;
		}
		* {
		-webkit-box-sizing: border-box;
				box-sizing: border-box;
		}
		.wrapper {
		-webkit-animation: roll 1.5s;
				animation: roll 1.5s;
		position: fixed;
		left: 50%;
		top: 50%;
		-webkit-transform: translate(-50%, -50%);
				transform: translate(-50%, -50%);
		padding: 25px;
		background: #0674a3;
		border-radius: 50%;
		-webkit-box-shadow: 0 3px 5px rgba(0, 0, 0, 0.3);
				box-shadow: 0 3px 5px rgba(0, 0, 0, 0.3);
		}
		.wrapper:active #img-result {
		margin-top: 2px;
		-webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
				box-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
		}
		.wrapper #img-result {
		cursor: pointer;
		margin: 0;
		position: relative;
		background: #0082BA;
		background-size: cover;
		background-position: center;
		display: block;
		width: 150px;
		height: 150px;
		border-radius: 50%;
		-webkit-box-shadow: 0 3px 5px rgba(0, 0, 0, 0.3);
				box-shadow: 0 3px 5px rgba(0, 0, 0, 0.3);
		color: rgba(0, 0, 0, 0);
		-webkit-transition: margin 0.3s, background-image 1.5s, -webkit-box-shadow 0.3s;
		transition: margin 0.3s, background-image 1.5s, -webkit-box-shadow 0.3s;
		transition: box-shadow 0.3s, margin 0.3s, background-image 1.5s;
		transition: box-shadow 0.3s, margin 0.3s, background-image 1.5s, -webkit-box-shadow 0.3s;
		}
		.wrapper #img-result.no-image:before {
		font-family: 'FontAwesome';
		content: "\f030";
		position: absolute;
		left: 50%;
		top: 50%;
		color: #fff;
		font-size: 48px;
		opacity: .8;
		-webkit-transform: translate(-50%, -50%);
				transform: translate(-50%, -50%);
		text-shadow: 0 0px 5px rgba(0, 0, 0, 0.4);
		}
		.wrapper button {
		margin-top: 20px;
		display: block;
		font-family: 'Open Sans Condensed', sans-serif;
		background: #0082BA;
		width: 100%;
		border: none;
		color: #fff;
		padding: 10px;
		letter-spacing: 1.3px;
		font-size: 1.05em;
		border-radius: 5px;
		-webkit-box-shadow: 0 4px 5px rgba(0, 0, 0, 0.3);
				box-shadow: 0 4px 5px rgba(0, 0, 0, 0.3);
		outline: 0;
		-webkit-transition: margin-top 0.3s, padding 0.3s, -webkit-box-shadow 0.3s;
		transition: margin-top 0.3s, padding 0.3s, -webkit-box-shadow 0.3s;
		transition: box-shadow 0.3s, margin-top 0.3s, padding 0.3s;
		transition: box-shadow 0.3s, margin-top 0.3s, padding 0.3s, -webkit-box-shadow 0.3s;
		}
		.wrapper button:active {
		-webkit-box-shadow: none;
				box-shadow: none;
		margin-top: 24px;
		padding: 8px;
		}
		.show-button {
		background: #264974;
		border: none;
		color: #fff;
		padding: 10px 20px;
		float: right;
		display: none;
		}
		.upload-result {
		display: none;
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background: #fff;
		overflow-y: auto;
		}
		.upload-result__content {
		word-break: break-all;
		font-family: 'Source Code Pro';
		overflow-wrap: break-word;
		}
		.playme {
		margin-top: 20px;
		left: 50%;
		top: 50%;
		align:center;
		background: #007fed;
		text-transform: uppercase;
		font-weight: 300;
		border: none;
		color: white;
		padding: 10px 15px;
		display: inline-block;
		font-size: 14px;
		margin: 0;
		bottom: 0px;
		visibility: hidden;
		}
		footer {
		position: absolute;
		background-color:#222;
		height: 50px;
		width: 99%;
		z-index: 1;
		}
		footer {
			bottom: 10%;
		}
		header {
			position:absolute;
			top:10%;
			left:0px;
			height:200px;
			right:0px;overflow:hidden;
		}
		h1{
			color:#fff;
			font-size:30px;
			text-align: center;
		}

		.span-logo {
			padding-left: 10px;
		}

		.img-logo {
			font-family: 'Anton', Arial, sans-serif;
			font-size: 30px;
			position: absolute;
			left: 50%;
			transform: translate(-50%,-50%);
			color: #fff;
			padding-top: 20px;
		}

		.navbar span {
			color: #FFFFFF;
		}

		.texto-upload {
			font-family: 'Roboto', Arial, sans-serif;
			text-align: center;
			color: #ffffff;
			padding-top: 20px;
			font-size: 25px;
		}

		.botao-enviar {
			font-family: 'Roboto', Arial, sans-serif;
			margin-left: 20px;
		}

		.botao-enviar-centro {
			text-align: center;
		}

    </style>

</head>
<body translate="no" onload="start();">
<header>
	<h2 class="texto-upload">Faça o upload da imagem!</h2>
</header>

	<div class="container">

		<div class="navbar-header">

			<a href="https://ads.deskbr.com" class="navbar-brand">
				<span class="img-logo">PHOTOLIZER<span class="span-logo glyphicon glyphicon-eye-open"</span></span>
			</a>

		</div>

</div>

  <div class="wrapper">
  <button class="no-image" id="img-result">Upload Image</button>
  </div>
    <script >
      (function () {
			var uploader = document.createElement('input'),
				image = document.getElementById('img-result');

			uploader.type = 'file';
			uploader.accept = 'image/*';

			image.onclick = function() {
				uploader.click();

			}
			uploader.onchange = function() {
				var reader = new FileReader();
				console.log(reader);
				reader.onload = function(evt) {
				image.classList.remove('no-image');
				image.style.backgroundImage = 'url(' + evt.target.result + ')';
				var request = {
					images: [{
					data: evt.target.result
					}]
				};
				document.getElementById("base64").value = evt.target.result;
				var loading = document.getElementById ("base") ;
				loading.style.visibility = "visible";
				//window.location('https://ads.deskbr.com/upload?d='+evt.target.result);
				//document.getElementById("fileToUpload").value = uploader;
				document.querySelector('.show-button').style.display = 'block';
				document.querySelector('.upload-result__content').innerHTML = JSON.stringify(request, null, '  ');
				}
				reader.readAsDataURL(uploader.files[0]);
			}

			document.querySelector('.hide-button').onclick = function () {
				document.querySelector('.upload-result').style.display = 'none';
			};

			document.querySelector('.show-button').onclick = function () {
				document.querySelector('.playme').style.display = 'block';
			};
			})();
	</script>

	<footer class="botao-enviar-centro">
	<form action="#" method="post" enctype="multipart/form-data">
		<input name="base64" type="hidden" id="base64">
		<button type="submit" name="base" id="base" class="playme botao-enviar">ENVIAR IMAGEM</button>
	</form>
	</footer>
</body>
</html>
<?php } ?>
