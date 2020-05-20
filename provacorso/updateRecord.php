<?php
require_once 'function.php';

$action = getFromGet('action');
$nomeLatino = getFromGet('nomeLatino', 0, 'string');

$arrParams = $_GET;

unset($arrParams['action']);
$qString = http_build_query($arrParams,'', '&amp;');

$url = "index.php?success=$result=".urlencode($message).'&' .$qString;

switch ($action){
		case 'delete':
			$result = deleteRecord($nomeLatino);
			$message = $result? 'RECORD CANCELLATO CORRETTAMENTE' : 'PROBLEMI CON LA CANCELLAZIONE DEL RECORD';
			$url = "index.php?success=$result=".urlencode($message).'&' .$qString;
		header("Location : $url");
			break;
		
		case 'update':
			$row = getUnaSpecie($nomeLatino);
			if($row){
				require_once 'header.php';
				$search = getFromGet('search', '');
				require_once 'navbar.php';
				require_once'formUpdate.php';
				require_once 'footer.php';
			}
			break;
		case 'updateRecord':
			$result = updateSpecie($_POST);
			break;
}


