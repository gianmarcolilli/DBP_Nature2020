<?php
	require_once('header.php');
?>
  <body>
<div class="container">
   <?php
	  require_once('navbar.php');
	if (isset($_SESSION['email']) && (!empty($_SESSION['email']))){
		$nome = "";
              $sql=$conn->query("SELECT nomeUtente
                                  FROM UTENTE
                                  WHERE email = '{$_SESSION['email']}'
                                ");
              unset($nome);
              while ($row = $sql->fetch_assoc()) {
                $nome = $row['nomeUtente'];
              }
		
	} 
	  /* define variables and set to empty values */
      $f1Err = $f2Err =  "";
       
	$t1 = $t2 =  "";
	  
	$f2=					$t2='Escursione n°';
	$f1=$nome;			$t1='Utente ';		
	
	$contConvalida = 0;
	
	
	if (empty($f1) || $f1 == $nome) {
          $f1Err = "$t1" ." is required";
        } else {
          $contConvalida++;
        }

        if (empty($f2)  || $f2 == "id" ) {
          $f2Err = "$t2" ." is required";
        } else {
          $contConvalida++;
        }

        

        if($contConvalida == 2){
          echo "\n L'operazione è andata a buon fine.";
          $sql = "CALL adesioneEscursione('$f1', '$f2')";
        if ($conn->query($sql) === TRUE) {
          echo "<br>Caro $t1 $f1 ti sei iscritto con successo all'escursione n° $f2.";
          //require 'mongoDBconn.php';
          
        } else {
          echo "\nError: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
			
		header("refresh:4;url=./myarea.php");
      } else {
        echo "Try again, list of errors:";
        if(!empty($f1Err))
        echo "<br>" . $f1Err;
        if(!empty($f2Err))
        echo "<br>" . $f2Err;
       
        header("refresh:3;url=./elencoEscursioni.php");
      }
	  ?>
	
	  </div>   
	
</body>
</html>