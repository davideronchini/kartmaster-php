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
    <link rel="stylesheet" href="./static/css/style-android.css">
    <link rel="shortcut icon" href="./static/resources/favicon.webp">

  </head>
  <body>

    <img class="logo" src="./static/resources/kart-logo.webp">
    <h1>Accedi</h1>
    <form action="./api/login.php" method="POST">
      <input id="email" name="email" class="input" type="email" placeholder="Email">
      <input id="password" name="password" class="input" type="password" placeholder="Password">
      <div class="checkbox" style="visibility: hidden;">
        <label class="container">
          <input type="checkbox">
          <span class="checkmark"></span>
        </label><h4>Ricordami</h4>
      </div>
      <button type="submit" class="log-btn">Continua</button>
      <p>Non hai un account? <a href="./app-registration.php">Registrati</a></p>
    </form>


    <!-- Link to js file -->
    <script src="./static/js/script.js"></script>
    <script type="text/javascript">

      //Android settings
      var ua = navigator.userAgent.toLowerCase();
      var isAndroid = ua.indexOf("android") > -1 && ua.indexOf("mobile");

      if(isAndroid) {
        $("body").attr("display","none");
      }
      else {
        window.location.href = "./index.php#login-popup";
      }

    </script>

</body>
</html>
