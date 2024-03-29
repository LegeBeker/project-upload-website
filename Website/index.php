<html lang='nl'>

<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>Summa College - Projecten</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
      <img src="img/logo.png" height="30" class="d-inline-block align-top" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <?php

          if (isset($_GET["inlog"]) && $_GET["inlog"] == "mislukt") {
              echo '<script>alert("Verkeerde wachtwoord of gebruikersnaam!")</script>';
          }

          if (isset($_GET["uitlog"]) && $_GET["uitlog"] == "gelukt") {
            echo '<script>alert("U bent uitgelogd, u keert nu terug naar de hoofdpagina.")</script>';
          }
          
          session_start();
          if (isset($_SESSION['user'])) {
          $userid = $_SESSION['user'];
          $connection = mysqli_connect("localhost", "root", "", "summaprojecten");
          $query = "SELECT * FROM lid where `lidid` = '$userid';";
          $resultaat = mysqli_query($connection, $query);
          }

          if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
            echo '<li class="nav-item"><a class="nav-link" href="Projecten/index.php">Bekijk projecten</a></li>';
            echo '<li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>';
            echo '<li class="nav-item"><a class="nav-link" href="uitloggen.php">Uitloggen</a></li>';
            echo '</ul>';
            $stmt = $connection->prepare("SELECT * FROM lid WHERE lidid = ?");
            $stmt->bind_param("s", $userid);
            $stmt->execute();
            $result = $stmt->get_result();
            echo "<span class='navbar-text'>Welkom, " . $result->fetch_object()->lidnaam . "!</span>";
          }
          else {
            echo '<li class="nav-item"><a class="nav-link disabled" href="#">Bekijk projecten</a></li>';
            echo '<li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>';
            echo '<li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>';
            echo '</ul>';
            echo '<span class="navbar-text">Website voor het Summa College</span>';
          }
        ?>
    </div>
  </nav>

  <main role="main">

    <div class="jumbotron">
      <div class="container">
        <h1 class="display-3">Welkom</h1>
        <p>
          Welkom op onze nieuwe website. We hebben deze website besloten te maken, omdat op de oude site geen goed systeem was voor de projecten. <br>
          Op deze site zijn dus wat functies die handig zullen zijn. Zoals dat je nu je projecten in groepen kan maken. <br>
          Dus maak meteen je account aan en begin!
        </p>
        <p>
          Het is dus mogelijk om je projecten voor het Summa College op te leveren via deze website. 
          Deze kunnen dan door u of de opdrachtgever/docent bekeken worden en beoordeerd.
        </p>
        <?php
          if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
            echo '<p><a class="btn btn-primary btn-lg" href="Projecten/index.php" role="button">Zie Projecten »</a></p>';
          }
          else {
            echo '<p><a class="btn btn-primary btn-lg" href="login.php" role="button">Login »</a></p>';
          }
        ?>
      </div>
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>