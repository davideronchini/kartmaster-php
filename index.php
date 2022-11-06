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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;1,300;1,600&family=Oswald:wght@500;600&display=swap" rel="stylesheet">
    <!-- AOS animations library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Altre impostazioni del sito -->
    <title>KART MASTER | Organizza il tuo campionato</title>
    <link rel="stylesheet" href="./static/css/style-index.css">
    <link rel="shortcut icon" href="./static/resources/favicon.webp">

  </head>
  <body>

    <style>

      .hero{ background-image: url('./static/resources/hero-bg.webp'); }

      .footer{ background-image: url('./static/resources/footer-bg.webp'); }

      @media (max-width: 1025px) {
        .hero{ background-image: url('./static/resources/hero-bg-mobile.webp'); }
      }
    </style>

    <!-- Popup -->
    <div id="login-popup" class="overlay">
      <div class="popup">
        <a class="close" href="##">&times;</a>
        <h1>Accedi</h1>
        <form action="./php/login.php" method="POST">
          <input name="email" id="email" type="text" placeholder="Email" required>
          <input name="password" id="password" type="password" placeholder="Password" required>
          <p>Non hai un account? <a href="index.php#register-popup">Registrati ora</a></p>
          <div>
            <button type="submit" style="border: none;" class="log-btn">Inizia</button>
          </div>
        </form>
      </div>
    </div>

    <div id="register-popup" class="overlay">
      <div class="popup">
        <a class="close" href="##">&times;</a>
        <h1>Registrati</h1>
        <form action="./php/register.php" method="POST">
          <input id="username"  name="username" type="text" placeholder="Nome utente" required>
          <input id="email" name="email" type="text" placeholder="Email" required>
          <input id="password" name="password" type="password" placeholder="Password" required>
          <p>Cliccando “inizia” accetti i <a href="#">Termini di Servizio</a> e l’<a href="#">informativa sulla privacy</a></p>
          <div>
            <button type="submit" style="border: none;" class="log-btn">Inizia</button>
          </div>
        </form>
      </div>
    </div>

    <!-- Header -->
    <div class="header" id="header">
      <h1>KART <span>MASTER</span></h1>
      <h2>RECORD THE RESULTS OF YOUR RACES</h2>
    </div>

    <!-- Hero -->
    <div class="hero">
      <h2>Crea il tuo campionato <br>in pochi minuti</h2>
      <h3>Usa la nostra piattaforma totalmente gratuita <br>per gestire le tue gare con i tuoi amici.</h3>
      <div class="buttons">
        <a href="#login-popup" class="hero-btn-1">Accedi</a>
        <a href="#register-popup" class="hero-btn-2">Registrati</a>
      </div>
    </div>

    <!-- Quote -->
    <div class="quote">
      <h3>“Non esiste una curva dove non <br>si possa sorpassare.”</h3>
      <p>(Ayrton Senna)</p>
      <img src="./static/resources/decoration.svg" alt="Gestisci le gare con i tuoi amici!">
    </div>

    <!-- Presentation -->
    <div class="card">
      <img id="mobile" src="./static/resources/card-img-1-mobile.webp" alt="Crea il tuo campionato con Kart Master">
      <img id="desktop" src="./static/resources/card-img-1.webp" alt="Crea il tuo campionato con Kart Master">
      <div class="card__content">
        <h2>Invita i tuoi amici a partecipare <br>al tuo campionato</h2>
        <p>Così facendo, tutti avranno a disposizione le statistiche delle singole gare che organizzate assieme</p>
        <div class="login-link">
          <a href="#login-popup">Accedi</a>
        </div>
      </div>
    </div>
    <div class="card">
      <img id="mobile" src="./static/resources/card-img-2-mobile.webp" alt="Controlla la classifica quando vuoi">
      <div class="card__content" style="text-align: left;">
        <h2>Controlla la classifica delle tue <br>gare in ogni momento</h2>
        <p>Controlla l’andamento del campionato <br>in tempo reale</p>
        <div class="login-link" style="margin-left: 0;">
          <a href="#login-popup">Accedi</a>
        </div>
      </div>
      <img id="desktop" src="./static/resources/card-img-2.webp" alt="Controlla la classifica quando vuoi">
    </div>
    <div class="card">
      <img id="mobile" src="./static/resources/card-img-3-mobile.webp" alt="Gareggia sui tuoi circuiti preferiti">
      <img id="desktop" src="./static/resources/card-img-3.webp" alt="Gareggia sui tuoi circuiti preferiti">
      <div class="card__content">
        <h2>Scegli fra decine di circuiti <br>in tutta Italia</h2>
        <p>Non ne trovi uno? Nessun problema, <br>contattaci e lo inseriremo prima possibile!</p>
        <div class="login-link">
          <a href="#login-popup">Accedi</a>
        </div>
      </div>
    </div>

    <!-- Footer  -->
    <div class="footer">
      <a id="ciao" href="#header" class="footer-image-link">
        <img src="./static/resources/logo.webp" alt="Kart Master, the best platform to manage your kart races">
        <h2>RECORD THE RESULTS OF YOUR RACES</h2>
      </a>
      <div class="footer-links">
        <a href="#">Privacy</a>
        <a href="#">Cookies</a>
        <a href="#">Termini e condizioni</a>
        <a href="#">Disclaimer</a>
      </div>
    </div>

    <!-- Link to js file -->
    <script src="./static/js/script.js"></script>

</body>
</html>
