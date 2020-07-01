   <?php
     require_once('header.php');
    ?>

  <body>
<div class="container">
   <?php
	  include('navbar.php');


  require_once('mostraNomeUtenteSessione.php');
	  /* define variables and set to empty values */
      	$f1Err = $f2Err = $f3Err = $f4Err =  "";
      	$f1 = $f2 = $f3 = $f4 =  "";
		$t1 = $t2 = $t3 = $t4 =  "";

	$f1=$_POST['idS'];						$t1='ID segnalazione di riferimento';
	$f2=$nome;								$t2='Utente';
	$f3=$_POST['commento'];					$t3='Commento';
	$f4=$_POST['nomeSpecie'];				$t4='Nome specie';


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



        if($contConvalida == 4){
          echo "<div class=\"text-success\">\n I campi sono stati compilati correttamente.</div>";
          $sql = "CALL AggiungiPropostaS('$f1', '$f2', '$f3', '$f4')";
        if ($conn->query($sql) == TRUE) {
          echo "<div class=\"text-success\"><br>La proposta è stata inserita correttamente.</div>";
          //require 'mongoDBconn.php';
          header("refresh:3;url=./elencoSegnalazioni.php");
        } else {
          echo "<div class=\"text-danger\">\nError: " . $sql . "<br></div>" . $conn->error;
			header("refresh:3;url=./elencoSegnalazioni.php");
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

        header("refresh:3;url=./elencoSegnalazioni.php");
      }
	  ?>

	  </div>

</body>
</html>
