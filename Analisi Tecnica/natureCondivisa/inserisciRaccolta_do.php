   <?php
     require_once('header.php');
    ?>
  
  <body>
<div class="container">
   <?php
	  include('navbar.php');
	include('connection.php');
	
	if (isset($_SESSION['email']) && (!empty($_SESSION['email']))) {
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
      	$f1Err = $f2Err = $f3Err = $f4Err = $f5Err =  "";
      	$f1 = $f2 = $f3 = $f4 = $f5 = "";
		$t1 = $t2 = $t3 = $t4 = $t5 =  "";
	  	
	$f1=$_POST['stato'];						$t1='Stato della raccolta';
	$f2=$_POST['descrizione'];					$t2='Descrizione';	
	$f3=$_POST['inizio'];						$t3='Data inizio';
	$f4=$_POST['maxImporto'];					$t4='Importo massimo';
	$f5=$nome;									$t5='Creatore della raccolta';
	
	
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
		if (empty($f5) || $f5 == "$t5") {
          $f5Err = "$t5"." is required";
        } else {
          $contConvalida++;
        }
	
		
	
		
        if($contConvalida == 5){
          echo "\n I campi sono stati compilati correttamente";
          $sql = "CALL inserisciRF('$f1', '$f5', '$f2', '$f3', '$f4' )";
        if ($conn->query($sql) === TRUE) {
          echo "<br>L'escursione è stata inserita correttamente.";
          //require 'mongoDBconn.php';
          
        } else {
          echo "\nError: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
			
		header("refresh:3;url=./elencoRaccoltaFondi.php");
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
        
		
        header("refresh:3;url=./inserisciRaccolta.php");
      }
	  ?>
	
	  </div>  
	
</body>
