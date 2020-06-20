<?php
	require_once('header.php');
?>
  <body>
<div class="container">
   <?php
	  include('navbar.php');
	
	  /* define variables and set to empty values */
      $f1Err = $f2Err =  "";
      $f1 = $f2 =  "";
	$t1 = $t2 =  "";
	  
	$f1=$_POST['nome'];					$t1='nome';
	$f2=$_POST['descrizione'];			$t2='descrizione';		
	
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
          echo "\n I campi sono stati compilati correttamente";
          $sql = "CALL inserisciHabitat('$f1', '$f2')";
        if ($conn->query($sql) === TRUE) {
          echo "<br>L'habitat è stato inserito correttamente.";
          //require 'mongoDBconn.php';
          
        } else {
          echo "\nError: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
			
		header("refresh:4;url=./inserisciSpecie.php");
      } else {
        echo "Try again, list of errors:";
        if(!empty($f1Err))
        echo "<br>" . $f1Err;
        if(!empty($f2Err))
        echo "<br>" . $f2Err;
       
        header("refresh:3;url=./inserisciHabitat.php");
      }
	  ?>
	
	  </div>   
	
</body>
</html>