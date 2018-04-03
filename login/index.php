<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8">
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="965193543260-uub9npqecu3mk5p9epa0sheg1obkvbeg.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>

  </head>   
  <body>
  <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark" data-width="370" data-height="50" data-longtitle="true" data-lang="pt-BR"></div>
 

<script>
      function onSignIn(response) {
            // Conseguindo as informações do seu usuário:
            var perfil = response.getBasicProfile();
 
            // Conseguindo o ID do Usuário
            var userID = perfil.getId();
 
            // Conseguindo o Nome do Usuário
            var userName = perfil.getName();
                
            // Conseguindo o E-mail do Usuário
            var userEmail = perfil.getEmail();
 
            // Conseguindo a URL da Foto do Perfil
            var userPicture = perfil.getImageUrl();
 
            document.getElementById('user-photo').src = userPicture;
            document.getElementById('user-name').innerText = userName;
            document.getElementById('user-email').innerText = userEmail;
            if(userName <> null){
                alert("google.com");
            }
            // Recebendo o TOKEN que você usará nas demais requisições à API:
            var LoR = response.getAuthResponse().id_token;
            
            console.log("~ le Tolkien: " + LoR);
        };
    </script>