<?php
require_once('header.php');
?>

<body>
  <div class="container">
    <?php
    include('navbar.php');
    include('connection.php');


    /* define variables and set to empty values */
    $f1Err = $f2Err = $f3Err =  "";
    $f1 = $f2 = $f3 =  "";
    $t1 = $t2 = $t3 =   "";

    $f1=$_POST['idPRicerca'];				$t1='ID del progetto ricerca';
    $f2=$_POST['descrizione'];				$t2='Descrizione';
    $f3=$_POST['maxImporto'];				$t3='Importo massimo';



    $contConvalida = 0;


    if (empty($f1) || $f1 == "$t1") {
      $f1Err = "$t1" ." is required";
    } else {
      $contConvalida++;
    }

    if (empty($f2) || $f2 == "$t2") {
      $f2Err = "$t2" ." is required";
    } else {
      $contConvalida++;
    }

    if (empty($f3) || $f3 == "$t3") {
      $f3Err = "$t3" ." is required";
    } else {
      $contConvalida++;
    }



    if($contConvalida == 3){
      echo "<div class=\"text-success\">\n I campi sono stati compilati correttamente.</div>";
      $sql = "CALL inserisciRF('$f1', '$f2', CURDATE(), '$f3' )";
      if ($conn->query($sql) == TRUE) {
        echo "<div class=\"text-success\"><br>La raccolta fondi è stata inserita correttamente.</div>";
        header("refresh:3;url=./elencoRaccoltaFondi.php");
        //require 'mongoDBconn.php';
      } else {
        echo "<div class=\"text-danger\">\nError: " . $sql . "<br></div>" . $conn->error;
        header("refresh:3;url=./inserisciRaccolta.php");
      }
      $conn->close();

    } else {
      echo "Try again, list of errors:";
      if(!empty($f1Err))
      echo "<br>" . $f1Err;
      if(!empty($f2Err))
      echo "<br>" . $f2Err;
      if(!empty($f3Err))
      echo "<br>" . $f3Err;



      header("refresh:3;url=./inserisciRaccolta.php");
    }
    ?>

  </div>

</body>
