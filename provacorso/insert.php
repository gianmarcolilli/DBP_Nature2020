<?php

	$nomeUtente = $_POST['nomeUtente'];
	$password = $_POST['psw'];
	$email = $_POST['email'];
	$annoNascita = $_POST['annoNascita'];
	$professione = $_POST['professione'];

	if (!empty($nomeUtente) || !empty($psw) || !empty($email) || !empty($annoNascita) || !empty($professione)) {

		$host = "localhost";
		$dbuser = "root";
		$dbpsw = "root";
		$dbname = "nature";

		//creo connessione
		$conn = new mysqli($host, $dbuser, $dbpsw, $dbname);
		if (mysqli_connect_error()){
			die('Errore di connessione('. mysqli_connect_errno().')'. mysqli_connect_error());
		} else {
			$SELECT = "SELECT email FROM register WHERE email = ? LIMIT 1";
			$INSERT = "INSERT into register (nomeUtente, psw, email, annoNascita, professione)values (?, ?, ?, ?, ?)";

			//preparo il rilevamento dati dal form
			$stmt = $conn->prepare($SELECT);
			$stmt->bind_param("s", $email);
			$stmt->execute();
			$stmt->bind_result($email);
			$stmt->store_result();
			$rnum = $stmt->num_rows;

			if ($rnum==0){
				$stmt->close();

				$stmt = $conn->prepare($INSERT);
				$stmt->bind_param("ssssii", $nomeUtente, $psw, $email, $annoNascita, $professione);
				$stmt->execute();
				echo "Nuovo utente inserito correttamente";
				} else {
					echo "Qualcuno si è registrato con la stessa email";
				}
				$stmt->close();
				$conn->close();

			}

		}else {
			echo "Tutti i campi sono richiesti";
			die();
		}


	} else {
		echo "Tutti i campi devono esse compilati";
		die();
	}
?>