<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Progetto Basi di Dati 2020</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="css/landing-page.min.css" rel="stylesheet">

  <?php
    session_start();
    include("mysql.php");
    include("userLevel.php");
  ?>
</head>

<body>

  <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand" href="#">Nature</a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

          <?php
          if (isset($_SESSION['email']) && (!empty($_SESSION['email']))) {
          ?>

            <li class="nav-item">
              <span class="nav-link">Benvenuto,
                <?php
                $nome = "";
                $sql=$conn->query("SELECT nomeUtente
                                    FROM UTENTE
                                    WHERE email = '{$_SESSION['email']}'
                                  ");
                unset($nome);
                while ($row = $sql->fetch_assoc()) {
                  $nome = $row['nomeUtente'];
                }
                echo $nome."!";
                ?>
              </span>
            </li>
            <?php } ?>
            <li class="nav-item">
              <?php
              if (isset($_SESSION['email']) && (!empty($_SESSION['email']))) {
                ?>
                <a class="nav-link" href="./logout.php">Logout</a>
              <?php } ?>
            </li>
            <?php
            if (!isset($_SESSION['email']) && (empty($_SESSION['email']))) {
              ?>
              <li class="nav-item">
                <a class="nav-link" href="./login.html">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./register.html">Sign In</a>
              </li>
            <?php } ?>
          </ul>
        </form>
      </div>
    </nav> <!-- FINE NAVBAR -->


    <br>
    <div class="container">
      <?php

      $email = $psw = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST["email"]) || $_POST["email"] == "email") {
          $emailErr = "Email is required";
        } else {
          $email = mysqli_real_escape_String($conn, $_POST["email"]);
          //echo $email;
        }

        if (empty($_POST["psw"]) || $_POST["psw"] == "psw") {
          $pswErr = "Psw is required";
        } else {
          $psw = mysqli_real_escape_String($conn, $_POST["psw"]);
          //echo $psw;
        }

        $sql=$conn->query("SELECT email, psw FROM UTENTE WHERE email='$email' AND psw='$psw'");
        $count = mysqli_num_rows($sql);
        if($count == 1){
          $_SESSION['datiMongo'] = "Login effettuato: ".$email;
          //require 'mongoDBconn.php';
          $_SESSION['email']=$email;
          $_SESSION['psw']=$psw;
          echo "\nLogin effettuato, benvenuto ".$email.".<br>Sarai rindirizzato alla home..";
          $conn->close();
          header("refresh:2;url=./index.php");
        } else {
          $_SESSION['datiMongo'] = "Login negato: ".$email;
          //require 'mongoDBconn.php';
          echo "\n\nYour Login Name or Password is invalid";
          header("refresh:2;url=./login.html");
        }
      }
      ?>

    </div>

  </body>
  </html>
