   <?php
     require('header.php');
    ?>
  
  <body>
<div class="container">
   <?php
	  include('navbar.php');
		//include('connection.php');
	require_once('mostraNomeUtenteSessione.php');
	
	  /* define variables and set to empty values */
      $f1Err = $f2Err = $f3Err = $f4Err = $f5Err = $f6Err = "";
      $f1 = $f2 = $f3 = $f4 = $f5 = $f6 = $foto=  "";
	$t1 = $t2 = $t3 = $t4 = $t5 = $t6 =   "";
	  
	$f1=$nome;							$t1='nome utente';
	$f2=$_POST['latitudine'];			$t2='Latitudine GPS';		
	$f3=$_POST['longitudine'];			$t3='Longitudine GPS';
	$f4=$_POST['nomeHabitat'];			$t4='Habitat';
	$foto=$nomefoto;
	//$foto=$_POST['fileToUpload'];
	//$f5=$_POST['annoClassif'];		$t5='annoClassif'; DATA è IN CURDATE
	//$f6=$_POST['vulnerabilita'];		$t6='vulnerabilita'; PER FOTO

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

        if (empty($f4) || $f4 == "$t4") {
          $f4Err = "$t4"." is required";
        } else {
          $contConvalida++;
        }
	
		/* if (empty($f5) || $f5 == "$t5") {
          $f5Err = "$t5"." is required";
        } else {
          $contConvalida++;
        }

		if (empty($f6) || $f6 == "$t6") {
          $f6Err = "$t6"." is required";
        } else {
          $contConvalida++;
        } */
	
		

        if($contConvalida == 4){
          echo "<div class=\"text-success\">\n I campi sono stati compilati correttamente.</div>";
          $sql = "CALL aggiungiSegnalazioneU('$f1', '$f2', '$f3', '$foto', '$f4')";
			echo $sql;
        if ($conn->query($sql) == TRUE) {
          echo "<div class=\"text-success\"><br>La segnalazione d'avvistamento è stata inserita correttamente.</div>";
          //require 'mongoDBconn.php';
          header("refresh:3;url=./elencoSegnalazioni.php");
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
       /*  if(!empty($f5Err))
        echo "<br>" . $f5Err;
        if(!empty($f6Err))
        echo "<br>" . $f6Err;
		 */
        header("refresh:3;url=./inserisciSegnalazione.php");
      }
	  ?>
	
	  </div>      
	
</body>
