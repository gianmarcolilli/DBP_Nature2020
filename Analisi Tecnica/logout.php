<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>E-Pool HomePage</title>
  <!-- CDN Bootstrap e style.css personalizzato -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <script src="js/bootstrap.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.bundle.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <!-- meta per dispositivi -->
  <meta name='viewport' content='width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no'>
</head>

<?php
session_start();
include ("mysql.php");
include ("userLevel.php");
?>

<body>

  <!-- NAVBAR BOOTSTRAP -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <b><a class="navbar-brand" href="/index.php" style="color: MediumSeaGreen;">E-Pool </a></b>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="./">Home<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./login.html">Accedi</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./register.html">Registrati</a>
          </li>
        </ul>


        <form class="form-inline">
          <ul class="navbar-nav mr-auto">

            <?php
            if (isset($_SESSION['email']) && (!empty($_SESSION['email']))) {
              ?>

              <li class="nav-item">
                <span class="nav-link" style="color: rgba(255, 255, 255, 0.5);">Benvenuto,
                  <?php
                  $nome = "";
                  $sql=$conn->query("
                  SELECT nome
                  FROM UTENTE
                  WHERE email = '{$_SESSION['email']}'
                  ");
                  unset($nome);
                  while ($row = $sql->fetch_assoc()) {
                    $nome = $row['nome'];
                  }
                  echo $nome."!";
                  ?>
                </span>
              </li>
              <li class="nav-item">
                <a href="logout.php" class="nav-link" style="color: rgba(255, 255, 255, 0.5);">Logout<a>
                  <?php
                }
                ?>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="myarea.php">Area Utente</a>
              </li>
            </ul>
          </form>
        </div>
      </div>
    </nav>
    <!-- FINE NAVBAR BOOTSTRAP -->




    <br><br><br>


    <?php
    $_SESSION['datiMongo'] = "Logout effettuato: ".$_SESSION['email'];
    require 'mongoDBconn.php';
    session_destroy();
    echo "<div class=\"container\">Logout effettuato correttamente.";
    header("refresh:2;url=./index.php");
    ?>

  </div>
  <br><br>




  <article class="bg-secondary mb-3">
    <div class="card-body text-center">
      <h3 class="text-white mt-3">Alma Mater Studiorum Università di Bologna</h3>
      <p class="h5 text-white">Progetto di Basi di Dati 2019  <br> Alberto Zini 802289 </p>   <br>
      <!-- <p><a class="btn btn-warning" target="_blank" href="http://bootstrap-ecommerce.com/"> Bootstrap-ecommerce.com
      <i class="fa fa-window-restore "></i></a></p> -->
    </div>
  </article>

</body>
</html>
