<?php
if(!isset($_GET['id'])){
    echo '<script type="text/javascript">
          			  window.location = "https://ads.deskbr.com/upload/"
     				 </script>';
}
require_once('config.php');
$id = $_GET['id'];
    $id = base64_decode($id);
    $imageC = $conn->query("SELECT * FROM image WHERE id_image = '".$id."'");
    $image = $imageC->fetch(PDO::FETCH_ASSOC);
    $imageName = $image['image_name'];
    $tagC = $conn->query("SELECT DISTINCT * FROM label WHERE fk_id_image = '".$id."' LIMIT 5");
    $tags = $tagC->fetchAll();
    $logoC = $conn->query("SELECT DISTINCT * FROM logo WHERE fk_id_image = '".$id."' LIMIT 5");
    $logos = $logoC->fetchAll();
    $landmarkC = $conn->query("SELECT DISTINCT * FROM landmark WHERE fk_id_image = '".$id."' LIMIT 5");
    $landmarks = $landmarkC->fetchAll();
    $textC = $conn->query("SELECT DISTINCT * FROM text WHERE fk_id_image = '".$id."' LIMIT 5");
    $texts = $textC->fetchAll();
    $propertC = $conn->query("SELECT DISTINCT * FROM propert WHERE fk_id_image = '".$id."' LIMIT 5");
    $properties = $propertC->fetchAll();
    $matchingC = $conn->query("SELECT DISTINCT * FROM matching WHERE fk_id_image = '".$id."' LIMIT 4");
    $matchings = $matchingC->fetchAll();
    $faceC = $conn->query("SELECT DISTINCT * FROM face WHERE fk_id_image = '".$id."' and level = 'VERY_LIKELY' LIMIT 5");
    $faces = $faceC->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PhotoLizer</title>

    <!-- Bootstrap -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/custom.css" rel="stylesheet">
    <link href="<?php echo "https://" . $_SERVER['HTTP_HOST']; ?>/assets/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <!-- BARRA DE NAVEGAÇÃO-->
      <nav class="navbar navbar-inverse navbar-bg">
        <div class="container">

          <!-- HEADER -->
          <div class="navbar-header">

            <a href="index.html" class="navbar-brand">
              <span class="img-logo">PHOTOLIZER <span class="span-logo glyphicon glyphicon-eye-open"</span></span>
            </a>

          </div>

        </div>
      </nav>

    <!-- ELEMENTOS 1 -->
    <section id="elementos1">
      <div class="container">
        <div class="row">

         <div class="col-md-2">
              <ul class="nav collapse navbar-collapse" align="center">
                <li><a href="#">List item <span class="glyphicon glyphicon-arrow-up item"</span></a></li>
                <li><a href="#">List item <span class="glyphicon glyphicon-arrow-up item"</span></a></li>
                <li><a href="#">List item <span class="glyphicon glyphicon-arrow-up item"</span></a></li>
                <li><a href="#">List item <span class="glyphicon glyphicon-arrow-up item"</span></a></li>
                <li><a href="#">List item <span class="glyphicon glyphicon-arrow-up item"</span></a></li>
              </ul>
          </div>

          <div class="col-md-8">
            <a href="#">
              <img src='upload/files_input/<?php echo $imageName;?>' class="img-responsive img-centro"/>
            </a>
          </div>

          <div class="col-md-2">
              <ul class="nav" align="center">
                <li><a href="#">List item <span class="glyphicon glyphicon-arrow-up item"</span></a></li>
                <li><a href="#">List item <span class="glyphicon glyphicon-arrow-up item"</span></a></li>
                <li><a href="#">List item <span class="glyphicon glyphicon-arrow-up item"</span></a></li>
                <li><a href="#">List item <span class="glyphicon glyphicon-arrow-up item"</span></a></li>
                <li><a href="#">List item <span class="glyphicon glyphicon-arrow-up item"</span></a></li>
              </ul>
          </div>

        </div>
      </div>
    </section>

    <!-- ELEMENTOS 2 -->
    <section id="elementos2">
      <div class="container">
        <div class="row">

          <div class="col-md-2">
            <h2 align="center">Rosto <span class="glyphicon glyphicon-user"</span></h2>
              <ul class="nav borda-esquerda borda-direita" align="center">
                <?php
                  if($faceC->rowCount() > 0) {
                    foreach ($faces as $face) {
                      echo "<li><a href=\"#\">".$face['face_name']."</a></li>";
                    }
                  } else {
                    echo "<ul class=\"nav borda-esquerda borda-direita\" align=\"center\">
                            <li><a href=\"#\"><span class=\"glyphicon glyphicon-remove\"</span></a></li>
                          </ul>";
                  }
                ?>
              </ul>
          </div>

          <div class="col-md-2">
            <h2 align="center">Logos <span class="glyphicon glyphicon-picture"</span></h2>
              <ul class="nav borda-esquerda borda-direita" align="center">
                <?php
                  if($logoC->rowCount() > 0) {
                    foreach ($logos as $logo) {
                      echo "<li><a href=\"#\">".$logo['logo']."</a></li>";
                    }
                  } else {
                    echo "<ul class=\"nav borda-esquerda borda-direita\" align=\"center\">
                            <li><a href=\"#\"><span class=\"glyphicon glyphicon-remove\"</span></a></li>
                          </ul>";
                  }
                ?>
              </ul>
          </div>

          <div class="col-md-2">
            <h2 align="center">Cores <span class="glyphicon glyphicon-tint"</span></h2>
              <ul class="nav borda-esquerda borda-direita nav-custom" align="center">
                <?php
                  if($propertC->rowCount() > 0) {
                    foreach ($properties as $propert) {
                      echo "<li class=\"espaco\" data-toggle=\"tooltip\" data-placement=\"right\" title=".$propert['cod_color']."><a style=\"color: " .$propert['cod_color']."; font-size: 30px;\" href=\"#\">&#9632;&#9632;&#9632;&#9632;&#9632;</a></li>";
                    }
                  } else {
                    echo "<ul class=\"nav borda-esquerda borda-direita\" align=\"center\">
                            <li><a href=\"#\"><span class=\"glyphicon glyphicon-remove\"</span></a></li>
                          </ul>";
                  }
                ?>
              </ul>
          </div>

          <div class="col-md-2">
            <h2 align="center">Texto <span class="glyphicon glyphicon-font"</span></h2>
              <ul class="nav borda-esquerda borda-direita" align="center">
                <?php
                  if($textC->rowCount() > 0) {
                    foreach ($texts as $text) {
                      echo "<li><a href=\"#\">".$text['text']."</a></li>";
                    }
                  } else {
                    echo "<ul class=\"nav borda-esquerda borda-direita\" align=\"center\">
                            <li><a href=\"#\"><span class=\"glyphicon glyphicon-remove\"</span></a></li>
                          </ul>";
                  }
                ?>
              </ul>
          </div>

          <div class="col-md-2">
            <h2 align="center">Turismo <span class="glyphicon glyphicon-globe"</span></h2>
              <ul class="nav borda-esquerda borda-direita" align="center">
                <?php
                  if($landmarkC->rowCount() > 0) {
                    foreach ($landmarks as $landmark) {
                      echo "<li><a href=\"#\">".$landmark['landmark_name']."</a></li>";
                    }
                  } else {
                    echo "<ul class=\"nav borda-esquerda borda-direita\" align=\"center\">
                            <li><a href=\"#\"><span class=\"glyphicon glyphicon-remove\"</span></a></li>
                          </ul>";
                  }
                ?>
              </ul>
          </div>

          <div class="col-md-2">
            <h2 align="center">Tags <span class="glyphicon glyphicon-tags"</span></h2>
              <ul class="nav borda-esquerda borda-direita" align="center">
                <?php
                  if($tagC->rowCount() > 0) {
                    foreach ($tags as $tag) {
                      echo "<li><a href=\"#\">".$tag['label_name']."</a></li>";
                    }
                  } else {
                    echo "<ul class=\"nav borda-esquerda borda-direita\" align=\"center\">
                            <li><a href=\"#\"><span class=\"glyphicon glyphicon-remove\"</span></a></li>
                          </ul>";
                  }
                ?>
              </ul>
          </div>

        </div>
      </div>
    </section>

    <!-- ELEMENTOS 3 -->
    <section id="elementos3">
    	<div class="container">
        <h2>Imagens Similares</h2>
    		<div class="row">
          <?php
            if($matchingC->rowCount() > 0) {
              foreach ($matchings as $matching) {
              echo "<div class=\"col-md-3\">
                  <img src=\"".$matching['matching_url']."\"width=\"260px;\" class=\"img-responsive-similar\"/>
                </div>";
              }
            } else {
              echo "<div class=\"col-md-3 no-image\">
                  <img src=\"assets/img/no-image.jpg\"width=\"260px;\" class=\"img-responsive-similar\"/>
                </div>";
            }
          ?>

    		</div>
    	</div>
    </section>

    <div class="container">
      <footer id="rodape">

        <div class="row">

          <div class="col-md-12">
            <h6 align="center">&copy; Todos os direitos reservados.</h6>
          </div>

        </div>

      </footer>
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script type="text/javascript">
    $(function () {
    $('[data-toggle="tooltip"]').tooltip()
    } )
    </script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
