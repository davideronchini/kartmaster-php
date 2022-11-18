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
      <div class="popup" id="new-race-popup-style">
        <h1 id="current-user-username"></h1>
        <input id="starting_position" class="new-race-input" type="number" min="0" placeholder="Posizione di partenza">
        <input id="arrival_position" class="new-race-input" type="number" min="0" placeholder="Posizione di arrivo">
        <input id="best_time" class="new-race-input" type="text" placeholder="Miglior tempo (es. 1.25.34)">
        <input id="points" class="new-race-input" type="number" min="0" placeholder="Punti ottenuti">
        <div id="popup-buttons">
          <button onclick="addResult()" class="confirm-btn">Conferma</button>
          <button onclick="javascript:history.back()" class="back-btn">Annulla</button>
        </div>
      </div>
    </div>

    <!-- Header -->
    <div class="header" id="header">
      <a id="header-control-left" style="visibility: hidden; cursor: default;" onclick="javascript:history.back()"><img src="./static/resources/back.svg"></a>
      <img id="header-logo" src="./static/resources/logo.webp" alt="Kart Master, the best platform to manage your kart races">
      <a id="header-control-right"><img src="./static/resources/menu.svg"></a>
    </div>

    <!-- Menu -->
    <div class="menu">
      <a id="menu-close"><img src="./static/resources/close.svg"></a>
      <a href="#"><h4 class="hover-underline-animation">Contattaci</h4></a>
      <a href="./api/logout.php"><h4 class="hover-underline-animation">Logout</h4></a>
      <a href="#" id="mobile"><h4 class="hover-underline-animation">Privacy</h4></a>
      <a href="#" id="mobile"><h4 class="hover-underline-animation">Termini e condizioni</h4></a>
      <a href="#" id="mobile"><h4 class="hover-underline-animation">Cookies</h4></a>
      <a href="#" id="mobile"><h4 class="hover-underline-animation">Disclaimer</h4></a>
      <a onclick="deleteUser()"><h4 class="hover-underline-animation"><span>Elimina account</span></h4></a>
    </div>

    <!-- Content -->
    <div class="content2">
      <div class="form">
        <div class="form-card">
          <h1>Nuova gara</h1>
          <h2>Campionato “Italian Formula”</h2>
          <form>
            <select id="new-race-input" style="width: 100%; height: 6vh; border-radius: 5px; border: 2px solid #F6F6F6">
              <!-- The options tags will be loaded from javascript -->
            </select>
          </form>
        </div>
        <button onclick="discardChanges()" type="button" name="button">Annulla</button>
        <button onclick="createNewRace()" class="red-btn" type="button" name="button">Conferma</button>
      </div>
      <div class="new">
        <div class="new-top">
          <h2>Posizioni d'arrivo</h2>
        </div>
        <div class="table">
          <table id ="results-table">
            <!-- The data will be loaded from javascript -->
          </table>
        </div>
      </div>
      <div style="height: 11vw;"></div>
    </div>
    <div class="fixed-bottom-buttons">
      <button onclick="createNewRace()" class="red-btn" type="button" name="button">Conferma</button>
      <button onclick="discardChanges()" class="black-btn" type="button" name="button">Annulla</button>
    </div>


    <!-- Footer  -->
    <div class="footer">
      <div class="footer-links">
        <a href="#">Privacy</a>
        <a href="#">Cookies</a>
        <a href="#">Termini e condizioni</a>
        <a href="#">Disclaimer</a>
      </div>
    </div>


    <!-- Link to js file -->
    <script src="./static/js/script.js"></script>
    <script src="./static/js/requests.js"></script>

</body>
</html>
