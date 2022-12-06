<?php 

session_start();
if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true){
  header("location: index.php");
  exit;
}

?>

<!DOCTYPE html>
<html lang="it">
  <head>

    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, width=device-width, height=device-height">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css" integrity="sha512-NmLkDIU1C/C88wi324HBc+S2kLhi08PN5GDeUVVVC/BVt/9Izdsc9SVeVfA1UZbY3sHUlDSyRXhCzHfr6hmPPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Fonts (Oswald + Montserrat) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,300;1,600&family=Oswald:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- AOS animations library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Altre impostazioni del sito -->
    <title>KART MASTER | Organizza il tuo campionato</title>
    <link rel="stylesheet" href="./static/css/style-home.css">
    <link rel="shortcut icon" href="./static/resources/favicon.webp">

  </head>
  <body>

    <!-- Popup -->
    <div id="change-name-popup" class="overlay">
      <div class="popup">
        <h1>Cambia nome</h1>
        <input id="new-username" type="text" placeholder="Nuovo nome">
        <div>
          <button onclick="changeUsername()" class="confirm-btn">Conferma</button>
          <button onclick="javascript:history.back()" class="back-btn">Annulla</button>
        </div>
      </div>
    </div>


    <!-- Header -->
    <div class="header" id="header">
      <a id="header-control-left" style="visibility: hidden;"><img src="./static/resources/back.svg"></a>
      <img id="header-logo" src="./static/resources/logo.webp" alt="Kart Master, the best platform to manage your kart races">
      <a id="header-control-right"><img src="./static/resources/menu.svg"></a>
    </div>

    <!-- Menu -->
    <div class="menu">
      <a id="menu-close"><img src="./static/resources/close.svg"></a>
      <a href="mailto:hap.kartmaster@gmail.com"><h4 class="hover-underline-animation">Contattaci</h4></a>
      <a href="./api/logout.php"><h4 class="hover-underline-animation">Logout</h4></a>
      <a target="blank" href="https://davideronchini.github.io/kart-master/privacy-policy" id="mobile"><h4 class="hover-underline-animation">Privacy</h4></a>
      <a target="blank" href="https://davideronchini.github.io/kart-master/terms-and-conditions" id="mobile"><h4 class="hover-underline-animation">Termini e condizioni</h4></a>
      <a target="blank" href="https://davideronchini.github.io/kart-master/cookies-policy"><h4 class="hover-underline-animation">Cookies</h4></a>
      <a target="blank" href="https://davideronchini.github.io/kart-master/disclaimer" id="mobile"><h4 class="hover-underline-animation">Disclaimer</h4></a>
      <a onclick="deleteUser()"><h4 class="hover-underline-animation"><span>Elimina account</span></h4></a>
    </div>

    <!-- Content -->
    <div class="content">
      <div class="user-info">
        <div class="user-info-top">
          <div class="informations">
            <h1 id="set_username">Username</h1>
            <p id="set_email">email@gmail.com</p>
          </div>
          <a href="#change-name-popup"><img id="change-icon" src="./static/resources/change-name.svg"></a>
        </div>
        <div class="user-info-bottom">
          <div class="informations">
            <h2>Vittorie</h2>
            <p id="set_wins">0</p>
          </div>
          <div class="informations">
            <h2>Pole positions</h2>
            <p id="set_pole_positions">0</p>
          </div>
          <div class="informations">
            <h2>Podi</h2>
            <p id="set_podiums">0</p>
          </div>
        </div>
      </div>
      <div class="championship">
        <div class="new" style="display:none;">
          <h2>Crea un nuovo campionato</h2>
          <h3>+</h3>
        </div>
        <div class="championship-top">
          <h2>Campionato recente</h2>
          <h3 id="championship-name">Nessun campionato trovato</h3>
        </div>
        <div class="table">
          <table id="championship-users">
            <!-- The data will be loaded from javascript -->
          </table>
        </div>
        <button type="button" class="championship-btn" onclick="window.location.href = './championships.php'">TUTTI I CAMPIONATI</button>
      </div>
    </div>


    <!-- Footer  -->
    <div class="footer">
      <div class="footer-links">
        <a target="blank" href="https://davideronchini.github.io/kart-master/privacy-policy">Privacy</a>
        <a target="blank" href="https://davideronchini.github.io/kart-master/cookies-policy">Cookies</a>
        <a target="blank" href="https://davideronchini.github.io/kart-master/terms-and-conditions">Termini e condizioni</a>
        <a target="blank" href="https://davideronchini.github.io/kart-master/disclaimer">Disclaimer</a>
      </div>
    </div>


    <!-- Link to js file -->
    <script src="./static/js/script.js"></script>
    <script src="./static/js/requests.js"></script>

</body>
</html>
