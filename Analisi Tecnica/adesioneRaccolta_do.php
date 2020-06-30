<!DOCTYPE html>
<html lang="en" dir="ltr">

<!-- import scripts, css, user session -->
<?php include('header.php'); ?>

  <body>
   <?php
		  require_once('navbar.php');
			require_once('mostraNomeUtenteSessione.php');
		?>
<div class="container">
   <?php
		$idRF = "";
              $sql=$conn->query("SELECT id
                                  FROM RACCOLTAFONDI

                                ");
              unset($idRF);
              while ($row = $sql->fetch_assoc()) {
                $idRF = $row['id'];
              }
	  /* define variables and set to empty values */
      $f1Err = $f2Err = $f3Err = $f4Err =  "";
       $f1 = $f2 = $f3 = $f4 =  "";
		$t1 = $t2 = $t3 = $t4 =  "";

	$f1=$idRF;					$t1='ID raccolta fondi';
	$f2=$nome;				$t2='Utente ';
	$f3=$_POST['importo'];	$t3='Importo';
	$f4=$_POST['note'];		$t4='Note';

	$contConvalida = 0;


	if (empty($f1) || $f1 == "$t1" ) {
          $f1Err = "$t1" ." is required";
        } else {
          $contConvalida++;
        }

        if (empty($f2)  || $f2 == "$t2" ) {
          $f2Err = "$t2" ." is required";
        } else {
          $contConvalida++;
        }
		if (empty($f3)  || $f3 == "$t3" ) {
          $f3Err = "$t3" ." is required";
        } else {
          $contConvalida++;
        }
		if (empty($f4)  || $f4 == "$t4" ) {
          $f4Err = "$t4" ." is required";
        } else {
          $contConvalida++;
        }



        if($contConvalida == 4){
          echo "<div class=\"text-success\">\n L'operazione è andata a buon fine.</div>";
          $sql = "CALL adesioneRF('$f1', '$f2', '$f3', '$f4')";
        if ($conn->query($sql) === TRUE) {
          echo "<div class=\"text-success\"><br> Grazie <p class=\"text-uppercase\">$f2</p> per aver inserito correttamente la tua donazione alla raccolta $f1.</div>";
          //require 'mongoDBconn.php';
          header("refresh:4;url=./myarea.php");
        } else {
          echo "<div class=\"text-danger\">\nError: " . $sql . "<br></div>" . $conn->error;
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
		if(!empty($f4Err))
        echo "<br>" . $f4Err;

        header("refresh:3;url=./elencoRaccoltaFondi.php");
      }
	  ?>

	  </div>

</body>
</html>
