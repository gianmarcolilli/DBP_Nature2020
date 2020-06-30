<!DOCTYPE html>
<html lang="en" dir="ltr">

<!-- import scripts, css, user session -->
<?php include('header.php'); ?>

  <body>
    <?php
    require_once('navbar.php');
    include('mysql.php');
    ?>
    <div class="container">
      <?php
      $nomeLatino=$_POST['nomeLatino'];

  	  $sql = "CALL eliminaSpecie('$nomeLatino')";
  	  if ($conn->query($sql) == TRUE) {
          echo "<br>La specie e' stata eliminata correttamente.";
          //require 'mongoDBconn.php';
      } else {
        echo "\nError: " . $sql . "<br>" . $conn->error;
      }
      header("refresh:3;url=./elencoSpecie.php");
      $conn->close();
  	  ?>
  	</div>

  </body>
</html>
