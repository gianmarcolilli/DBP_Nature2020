<!DOCTYPE html>
<html lang="en" dir="ltr">

<!-- import scripts, css, user session -->
<?php include('header.php'); ?>

	<body>
		<?php require_once('navbar.php'); ?>
		<div class="container">
			<?php

			// define variables and set to empty values
			$idEscursioneErr = $emailErr = $testoEmail = $testoIDescursione =	$email= "";

			$testoEmail='Email utente';
			$testoIDescursione='Escursione n°';

			$email=$_SESSION['email'];
			$idEscursione=$_POST['idEscursione'];

			$contConvalida = 0;

			if (empty($email) ) {
				$emailErr = "$testoIDescursione is required";
			} else {
				$contConvalida++;
			}

			if ( empty($idEscursione) ) {
				$idEscursioneErr = "$testoEmail is required";
			} else {
				$contConvalida++;
			}

			if($contConvalida == 2){
				echo "\n Valori inseriti correttamente. Status: ";
				$sql = "CALL partecipaEscursione('$email', '$idEscursione')";
				if ($conn->query($sql) === TRUE) {
					echo "<br>Caro $testoEmail $email ti sei iscritto con successo all'escursione n° $idEscursione.";
					//require 'mongoDBconn.php';
					header("refresh:4;url=./myarea.php");
				} else {
					echo "\nError: " . $sql . "<br>" . $conn->error;
				}
				$conn->close();

			} else {
				echo "Try again, list of errors:";
				if(!empty($idEscursioneErr))
				echo "<br>" . $idEscursioneErr;
				if(!empty($emailErr))
				echo "<br>" . $emailErr;

				header("refresh:3;url=./elencoEscursioni.php");
			}

			?>
		</div>

	</body>
	</html>
