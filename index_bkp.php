<?php
if(!isset($_GET['id'])){
    echo '<script type="text/javascript">
          			  window.location = "https://ads.deskbr.com/upload/"
     				 </script>';
}
require_once('config.php');
$id = $_GET['id'];
$id = base64_decode($id);
    $select = $conn->query("SELECT * FROM label WHERE fk_id_image = '".$id."' LIMIT 6");
    $tags = $select->fetchAll();
    $select = $conn->query("SELECT * FROM image WHERE id_image = '".$id."'");
    $image = $select->fetch(PDO::FETCH_ASSOC);
?>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Reconhecimento de Imagem</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        #elementos1 .img-centro {
        display: block;
        background: url('upload/files_input/<?php echo $image['image_name']; ?>') no-repeat;
        height: 400px;
        width: 550px;
        margin-left: auto;
        margin-right: auto;
        color: transparent;
    }
    </style>
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
              <span class="img-logo">LOGO <?php echo $id;?></span>
            </a>

          </div>

        </div>
      </nav>

    <!-- ELEMENTOS 1 -->
    <section id="elementos1">
      <div class="container">
        <div class="row">

          <div class="col-md-2">
            <h2 align="center">Rosto</h2>
              <ul class="nav" align="center">
                <li><a href="#">Feliz</a></li>
                <li><a href="#">Extrovertido</a></li>
                <li><a href="#">Chorando</a></li>
                <li><a href="#">Rindo</a></li>
                <li><a href="#">Triste</a></li>
              </ul>
          </div>

          <div class="col-md-6">
            <a href="#">
              <span class="img-centro">Imagem do meio</span>
            </a>
          </div>

          <div class="col-md-2">
            <h2 align="center">Tags</h2>
              <ul class="nav" align="center">
              <?php
              foreach($tags as $row)
              {
                echo '<li><a href="#">'.$row['label_name'].'</a></li>';
              }
              ?>
              </ul>
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
            <h2 align="center">Logos</h2>
              <ul class="nav borda-direita" align="center">
                  <li><a href="#">Positivo</a></li>
                  <li><a href="#">FAAT</a></li>
                  <li><a href="#">Positivo</a></li>
                  <li><a href="#">FAAT</a></li>
                  <li><a href="#">Positivo</a></li>
              </ul>
          </div>

          <div class="col-md-3">
            <h2 align="center">Web</h2>
              <ul class="nav" align="center">
                <li><a href="#">Palestra na Positivo</a></li>
                <li><a href="#">Formatura de ADS</a></li>
                <li><a href="#">Palestra na Positivo</a></li>
                <li><a href="#">Formatura de ADS</a></li>
                <li><a href="#">Formatura de ADS</a></li>
              </ul>
          </div>

          <div class="col-md-3">
            <h2 align="center">Cores</h2>
              <ul class="nav borda-esquerda" align="center">
                <li><a href="#">Azul</a></li>
                <li><a href="#">Verde</a></li>
                <li><a href="#">Vermelho</a></li>
                <li><a href="#">Amarelo</a></li>
                <li><a href="#">Azul</a></li>
              </ul>
          </div>

          <div class="col-md-2">
            <h2 align="center">Texto</h2>
              <ul class="nav borda-esquerda" align="center">
                <li><a href="#">Sadia</a></li>
                <li><a href="#">Rua</a></li>
                <li><a href="#">Computador</a></li>
                <li><a href="#">Mesa</a></li>
                <li><a href="#">Pessoa</a></li>
              </ul>
          </div>

          <div class="col-md-2">
            <ul class="nav" align="center">
              <li><a href="#">List item <span class="glyphicon glyphicon-arrow-up item"</span></a></li>
              <li><a href="#">List item <span class="glyphicon glyphicon-arrow-up item"</span></a></li>
              <li><a href="#">List item <span class="glyphicon glyphicon-arrow-up item"</span></a></li>
              <li><a href="#">List item <span class="glyphicon glyphicon-arrow-up item"</span></a></li>
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

    			<div class="col-md-3">
    				<img src="img/img.png" height="100px" width="260px;" class="img-responsive"/>
    			</div>

    			<div class="col-md-3">
    				<img src="img/img.png" height="100px" width="260px;" class="img-responsive"/>
    			</div>

    			<div class="col-md-3">
    				<img src="img/img.png" height="100px" width="260px;" class="img-responsive"/>
    			</div>

    			<div class="col-md-3">
    				<img src="img/img.png" height="100px" width="260px;" class="img-responsive"/>
    			</div>

    		</div>
    	</div>
    </section>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>
