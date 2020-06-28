<?php
	require_once('header.php');
?>
  <body>
<div class="container">
   <?php
	  include('navbar.php');
		require_once('mostraNomeUtenteSessione.php');
	//DEFINISCO VARIABILI PER RIEMPIMENTO AUTOMATICO TABELLA GESTIONE H CHE TIENE CONTO DELL'UTENTE
		//AMMINISTRATORE CHE INSERISCE UN NUOVO HABITAT
	$g1Err = $g2Err = $g3Err =  "";
    $g1 = $g2 = $g3 =  "";
	$s1 = $s2 = $s3 =  "";
	  
	$g1=$nome;					$s1='nome Utente';
	$g2=$_POST['nome'];			$s2='nome Habitat';
	$g3=inserimento;			$s3='tipo operazione';
	
	  $f1Err = $f2Err =  "";
      $f1 = $f2 =  "";
	$t1 = $t2 =  "";
	
	$f1=$_POST['nome'];					$t1='nome';
	$f2=$_POST['descrizione'];			$t2='descrizione';		
	
	  
	  $contGestioneH = 0;
	
	
	if (empty($g1) || $g1 == "$s1") {
          $g1Err = "$s1" ." is required";
        } else {
          $contGestioneH++;
        }
 
     if (empty($g2)  || $g2 == "$s2" ) {
          $g2Err = "$s2" ." is required";
        } else {
          $contGestioneH++;
        } 
	
	if($contGestioneH == 2){
          echo "<div class=\"text-success\">\n I campi sono stati compilati correttamente.</div>";
          $sqlH = "CALL inserisciGestioneH('$g2', '$g1', '$g3')";
        if ($conn->query($sqlH) == TRUE) {
          echo "<div class=\"text-success\"><br>L'operazione di inserimento è stata registrata.</div>";
          //require 'mongoDBconn.php';
          
        } else {
          echo "<div class=\"text-danger\">\nError: " . $sqlH . "<br></div>" . $conn->error;
        }
        //$conn->close();
		} else {
        echo "Try again, list of errors:";
        if(!empty($g1Err))
        echo "<br>" . $g1Err;
        if(!empty($g2Err))
        echo "<br>" . $g2Err;
			
		
       
        header("refresh:3;url=./inserisciHabitat.php");
      } 
		//////////////////////////////////////////////////////////////////////////////////
	/* define variables and set to empty values */
    
	
	$contConvalida = 0;
	
	
	if (empty($f1) || $f1 == "nome") {
          $f1Err = "$t1" ." is required";
        } else {
          $contConvalida++;
        }

        if (empty($f2)  || $f2 == "descrizione" ) {
          $f2Err = "$t2" ." is required";
        } else {
          $contConvalida++;
        }

        

        if($contConvalida == 2){
          echo "<div class=\"text-success\">\n I campi sono stati compilati correttamente.";
          $sql = "CALL inserisciHabitat('$f1', '$f2')";
			/* $sqlH = "CALL inserisciGestioneH('$f1', '$g1', '$g3')";
        if ($conn->query($sqlH) == TRUE) {
          echo "<br>L'operazione di inserimento è stata registrata.";
          //require 'mongoDBconn.php';
          
        }else {
          echo "\nError: " . $sqlH . "<br>" . $conn->error;
        } */
        if ($conn->query($sql) == TRUE) {
          echo "<div class=\"text-success\"><br>L'habitat è stato inserito correttamente.</div>";
          //require 'mongoDBconn.php';
          header("refresh:10;url=./elencoSpecie.php");
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
       
        header("refresh:10;url=./inserisciHabitat.php");
      }
		
		
	  ?>
	
	  </div>   
	
</body>
</html>