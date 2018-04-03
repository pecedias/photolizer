<html lang="pt-br">
<head>
  <!DOCTYPE html>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Google authentication - Exemplo 2</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    #customBtn {
    display: inline-block;
    background: #4285f4;
    color: white;
    width: 250px;
    border-radius: 5px;
    white-space: nowrap;
  }
  #customBtn:hover {
    cursor: pointer;
  }
  span.label {
    font-weight: bold;
  }
  span.icon {
    background: url('https://google-developers.appspot.com/identity/sign-in/g-normal.png') transparent 5px 50% no-repeat;
    display: inline-block;
    vertical-align: middle;
    width: 42px;
    height: 42px;
    border-right: #2265d4 1px solid;
  }
  span.buttonText {
    display: inline-block;
    vertical-align: middle;
    padding-left: 42px;
    padding-right: 42px;
    font-size: 14px;
    font-weight: bold;
    /* Use the Roboto font that is loaded in the <head> */
    font-family: 'Roboto', sans-serif;
  }
    </style>
  <!-- Fonte Roboto do Google -->
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap-theme.min.css">
</head>
<body>
  <div class="container body-content">
    <div class="box-login">
      <h2>Login</h2>

      <!-- Código html do botão de login -->
      <div id="gSignInWrapper">
        <div id="customBtn" class="customGPlusSignIn">
          <span class="icon"></span>
          <span class="buttonText">Logar com o Google</span>
        </div>
      </div>
      <div id="name"></div>

      <hr/>
      <a href="javascript:void(0);" onclick="signOut();">Sign out</a>
    </div>

    <hr />
    <footer>
      <p>&copy; Fábrica de Código</p>
    </footer>
  </div>

  <script src="scripts/example2.js"></script>

  <!-- Google api -->
  <script src="https://apis.google.com/js/api:client.js"></script>

  <!--JQuery e Bootstrap - Não são obrigatórios para ao autenticação -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>

  <!-- função para iniciar o app -->
  <script>startApp();</script>
</body>
</html>