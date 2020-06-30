<?php
require_once('header.php');
?>
<body>
	<div class="container">
		<?php
		require_once('navbar.php');

		/* $idRF = "";
		if(isset($_GET['id'])){
		$id=htmlspecialchars($_GET['id']);
		//fai la query
		$query=mysql_query("SELECT id FROM raccoltafondi WHERE id='$id'");
		//e estrai
		$riga=mysql_fetch_array($query);
		//puoi uscire da php per fare il form
		$idRF=$id;
	}  */
	require_once('mostraNomeUtenteSessione.php');
	/* define variables and set to empty values */
	$f1Err = $f2Err = $f3Err = $f4Err =  "";
	$f1 = $f2 = $f3 = $f4 =  "";
	$t1 = $t2 = $t3 = $t4 =  "";

	$f1=$_POST['idRaccoltaF'];				$t1='ID raccolta fondi';
	$f2=$nome;				$t2='Utente ';
	$f3=$_POST['importo'];	$t3='Importo';
	$f4=$_POST['note'];		$t4='Note';
	$contConvalida = 0;

	if (empty($f1)) {
		$f1Err = "$t1" ." is required";
	} else {
		$contConvalida++;
	}

	if (empty($f2)) {
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
		$sql = "CALL adesioneRF('$f2', '$f1', '$f3', '$f4')";
		if ($conn->query($sql) === TRUE) {
			echo "<br>Caro $t1 $f1 ti sei iscritto con successo all'escursione n° $f1.";
			//require 'mongoDBconn.php';
		} else {
			echo "\nError: " . $sql . "<br>" . $conn->error;
		}
		//require 'mongoDBconn.php';
		header("refresh:4;url=./myarea.php");
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
