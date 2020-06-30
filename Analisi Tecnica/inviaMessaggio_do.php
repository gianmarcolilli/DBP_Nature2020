<?php
require_once('header.php');
?>

<body>
  <div class="container">
    <?php
    include('navbar.php');
    //include('connection.php');
	require_once('mostraNomeUtenteSessione.php');

    /* define variables and set to empty values */
    $f1Err = $f2Err = $f3Err = $f4Err =  "";
    $f1 = $f2 = $f3 = $f4 =  "";
    $t1 = $t2 = $t3 = $t4 =  "";

    $f1=$_POST['destinatarioMess'];			$t1='Utente destinatario';
    $f2=$_POST['titoloMess'];				$t2='Titolo';
    $f3=$_POST['testoMess'];				$t3='Testo';
	$f4=$nome;								$t4='utente';


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
      $f4Err = "$t4" ." is required";
    } else {
      $contConvalida++;
    }



    if($contConvalida == 4){
      echo "<div class=\"text-success\">\n I campi sono stati compilati correttamente.</div>";
      $sql = "CALL condividiMessaggio('$f4', '$f1', '$f2', '$f3', TIMESTAMP(CURTIME()))";
      if ($conn->query($sql) == TRUE) {
        echo "<div class=\"text-success\"><br>Il messaggio è stato inviato!!</div>";
        header("refresh:1;url=./elencoMessRicevuti.php");
        //require 'mongoDBconn.php';
      } else {
        echo "<div class=\"text-danger\">\nError: " . $sql . "<br></div>" . $conn->error;
        header("refresh:3;url=./invioMessaggio.php");
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



      header("refresh:3;url=./invioMessaggio.php");
    }
    ?>

  </div>

</body>
</html>
