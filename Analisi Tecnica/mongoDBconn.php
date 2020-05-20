<?php

$datiMongo = $_SESSION['datiMongo'];

if(isset($datiMongo)){

	try{
		// Connessione a MongoDB
		$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

		// Inizializzo var Bulk
		$bulk = new MongoDB\Driver\BulkWrite;

		// Inserimento
		$bulk->insert(['inserimento' => $datiMongo]);

		// Esegue il comando sul db Log, che se non esiste viene creato
		$manager->executeBulkWrite('epool.log', $bulk);
	} catch(MongoDB\Driver\Exception\Exception $e) {
		echo "<br><br><br>".$e -> getMessage(), "\n";
		exit;
	}
}
?>
