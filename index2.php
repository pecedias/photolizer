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

    <!-- Fontawesome -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>

    <!-- Bootstrap -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/custom2.css" rel="stylesheet">
    <link href="<?php echo "https://" . $_SERVER['HTTP_HOST']; ?>/assets/css/style2.css" rel="stylesheet">

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

            <a href="index.php" class="navbar-brand">
              <span class="img-logo">PHOTOLIZER<span class="span-logo glyphicon glyphicon-eye-open"</span></span>
            </a>

          </div>

        </div>
      </nav>

    <!-- ELEMENTOS 1 -->
    <section id="elementos1">
      <div class="container">
        <div class="row">

         <div class="col-md-2">
              <ul class="nav center" align="center">
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
              <ul class="nav center" align="center">
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
            <h2 align="center">Rosto <i class="far fa-smile rosto-hover"></i></h2>
              <ul class="nav borda-esquerda borda-direita center" align="center">
                <?php
                  if($faceC->rowCount() > 0) {
                    foreach ($faces as $face) {
                      echo "<li><a href=\"#\">".$face['face_name']."</a></li>";
                    }
                  } else {
                    echo "<ul class=\"nav\">
                            <li data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Nada relacionado a rosto encontrado.\"><a href=\"#\"><i class=\"fas fa-info-circle\"></i></a></li>
                          </ul>";
                  }
                ?>
              </ul>
          </div>

          <div class="col-md-2">
            <h2 align="center">Logos <i class="far fa-lightbulb logos-hover"></i></h2>
              <ul class="nav borda-esquerda borda-direita center" align="center">
                <?php
                  if($logoC->rowCount() > 0) {
                    foreach ($logos as $logo) {
                      echo "<li><a href=\"#\">".$logo['logo']."</a></li>";
                    }
                  } else {
                    echo "<ul class=\"nav\" align=\"center\">
                            <li data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Nada relacionado a logos encontrado.\"><a href=\"#\"> <i class=\"fas fa-info-circle\"></i></a></li>
                          </ul>";
                  }
                ?>
              </ul>
          </div>

          <div class="col-md-2">
            <h2 align="center">Cores <i class="fa fa-tint cores-hover"></i></h2>
              <ul class="nav borda-esquerda borda-direita nav-custom center" align="center">
                <?php
                  if($propertC->rowCount() > 0) {
                    foreach ($properties as $propert) {
                      echo "<li class=\"espaco\" data-toggle=\"tooltip\" data-placement=\"right\" title=".$propert['cod_color']."><a style=\"color: ".$propert['cod_color']."; font-size: 30px;\" href=\"#\">&#9632;&#9632;&#9632;&#9632;&#9632;</a></li>";
                    }
                  } else {
                    echo "<ul class=\"nav\" align=\"center\">
                            <li data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Nada relacionado a cores encontrado.\"><a href=\"#\"><i class=\"fas fa-info-circle\"></i></a></li>
                          </ul>";
                  }
                ?>
              </ul>
          </div>

          <div class="col-md-2">
            <h2 align="center">Texto <i class="fas fa-font texto-hover"></i></h2>
              <ul class="nav borda-esquerda borda-direita center" align="center">
                <?php
                  if($textC->rowCount() > 0) {
                    foreach ($texts as $text) {
                      echo "<li><a href=\"#\">".$text['text']."</a></li>";
                    }
                  } else {
                    echo "<ul class=\"nav\" align=\"center\">
                            <li data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Nada relacionado a texto encontrado.\"><a href=\"#\"><i class=\"fas fa-info-circle\"></i></a></li>
                          </ul>";
                  }
                ?>
              </ul>
          </div>

          <div class="col-md-2">
            <h2 align="center">Turismo <i class="fas fa-globe turismo-hover"></i></h2>
              <ul class="nav borda-esquerda borda-direita center" align="center">
                <?php
                  if($landmarkC->rowCount() > 0) {
                    foreach ($landmarks as $landmark) {
                      echo "<li><a href=\"#\">".$landmark['landmark_name']."</a></li>";
                    }
                  } else {
                    echo "<ul class=\"nav\" align=\"center\">
                            <li data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Nada relacionado a turismo encontrado.\"><a href=\"#\"><i class=\"fas fa-info-circle\"></i></a></li>
                          </ul>";
                  }
                ?>
              </ul>
          </div>

          <div class="col-md-2">
            <h2 align="center">Tags <i class="fas fa-tags tags-hover"></i></h2>
              <ul class="nav borda-esquerda borda-direita center" align="center">
                <?php
                  if($tagC->rowCount() > 0) {
                    foreach ($tags as $tag) {
                      echo "<li><a href=\"#\">".$tag['label_name']."</a></li>";
                    }
                  } else {
                    echo "<ul class=\"nav\" align=\"center\">
                            <li data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"Nada relacionado a tags encontrado.\"><a href=\"#\"><i class=\"fas fa-info-circle\"></i></a></li>
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
              echo "<div class=\"col-md-3 espaco-bottom\">
                  <img src=\"".$matching['matching_url']."\"width=\"260px;\" class=\"img-responsive-similar center-responsive img-borda\"/>
                </div>";
              }
            } else {
              echo "<div class=\"col-md-3 no-image espaco-bottom\">
                  <img src=\"assets/img/no-image.jpg\"width=\"260px;\" class=\"img-responsive-similar center-responsive\"/>
                </div>";
            }
          ?>

    		</div>
    	</div>
    </section>

    <div class="container fundo-container-azul">
      <footer id="rodape-azul">
        <div class="row">

          <div class="col-md-3">
            <h4 class="texto-desenvolvimento">Desenvolvimento <i class="fas fa-code tam-code"></i></h4>
          </div>

          <div class="col-md-2">
            <h4>Front-end</h4>
            <ul class="nav">
              <li><a href="https://github.com/pecedias" target="_blank">Paulo Dias</a></li>
            </ul>
          </div>

          <div class="col-md-2">
            <h4>Back-end</h4>
            <ul class="nav">
              <li><a href="https://github.com/victorcezario" target="_blank">Victor Cezario</a></li>
            </ul>
          </div>

          <div class="col-md-2">
            <h4>Full-stack</h4>
            <ul class="nav">
              <li><a href="https://github.com/saulonunes" target="_blank">Saulo Nunes</a></li>
            </ul>
          </div>

          <div class="col-md-2">
            <h4>Banco de dados</h4>
            <ul class="nav">
              <li><a href="https://github.com/jhonnyulisilva" target="_blank">Jhonny Ulisses</a></li>
            </ul>
          </div>

        </div>
      </footer>
    </div>

    <div class="container fundo-container-preto">
      <footer id="rodape-preto">

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
