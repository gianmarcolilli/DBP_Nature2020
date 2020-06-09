<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Nature HomePage</title>
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
include ("userLevel.php"); //Che livello di utente sei
?>

<body>

  <!-- NAVBAR BOOTSTRAP -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <b><a class="navbar-brand" href="/index.php" style="color: MediumSeaGreen;">Nature </a></b>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="./">Home<span class="sr-only">(current)</span></a>
          </li>
          <?php
          if (!isset($_SESSION['email']) && (empty($_SESSION['email']))) {
            ?>
            <li class="nav-item">
              <a class="nav-link" href="./login.html">Accedi</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./register.html">Registrati</a>
            </li>
            <?php
          }
          ?>
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
    <div class="container">



      <?php

      /* define variables and set to empty values */
      $emailErr = $pswErr = $rpswErr = $nomeErr = $dataErr = "";
      $email = $psw = $rpsw = $name = $bithdate = $professione =  "";

      $username = $_POST["username"];
      $email = $_POST["email"];
      $psw = $_POST["psw"];
      $rpsw = $_POST["rpsw"];
      $birthdate = $_POST["birthdate"];
      $professione = $_POST["professione"];
      $contConvalida = 0;


        if (empty($username) || $nome == "username") {
          $nomeErr = "Name is required";
        } else {
          $contConvalida++;
        }

        if (empty($email) || $email == "email") {
          $emailErr = "Email is required";
        } else {
          $contConvalida++;
        }

        if (empty($professione) || $professione == "professione") {
          $professionErr = "Profession is required";
        } else {
          $contConvalida++;
        }

        if (empty($birthdate)) {
          $dataErr = "Data is required";
        } else {
          $contConvalida++;
        }

        if (empty($_POST["psw"]) || $_POST["psw"] == "psw") {
          $pswErr = "Password is required";
        } else {
          if($psw === $rpsw){
            $psw = $_POST["psw"];
            $contConvalida++;
          } else {
            $pswErr = "Passwords don't match";
          }
        }

        if (empty($rpsw) || $rpsw == "rpsw") {
          $rpswErr = "Password is required";
        } else {
          $contConvalida++;
        }

        if(!($psw === $rpsw)){
          $pswMatchErr = "Passwords don't match";

        }


      if($contConvalida == 6){
          echo "\n Benvenuto sarai registrato come utente semplice";
          $sql = "CALL AggiungiUtente('$username', '$psw', '$email', '$birthdate', '$professione')";
        if ($conn->query($sql) === TRUE) {
          echo "<br>New record created successfully.";
          require 'mongoDBconn.php';
          $_SESSION['email']=$email;
          $_SESSION['psw']=$psw; 
        } else {
          echo "\nError: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
        header("refresh:3;url=./index.php");
      } else {
        echo "Try again, list of errors:";
        if(!empty($emailErr))
        echo "<br>" . $emailErr;
        if(!empty($pswErr))
        echo "<br>" . $pswErr;
        if(!empty($rpswErr))
        echo "<br>" . $rpswErr;
        if(!empty($nomeErr))
        echo "<br>" . $nomeErr;
        if(!empty($dataErr))
        echo "<br>" . $dataErr;
        if(!empty($professionErr))
        echo "<br>" . $professionErr;
        header("refresh:3;url=./register.html");
      }
      ?>


    </div>
    <br><br>


  </body>
  </html>
