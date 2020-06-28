<?php

$servername = "localhost";
$username = "root";
$password = "root";

$orderByColumns = ['nomeLatino', 'tipo', 'nomeItaliano', 'classe', 'annoClassif', 'vulnerabilita', 'wikiLink', 'cmAltezza', 'cmDiametro', 'peso', 'mediaProle',];
try {
  $conn = new PDO("mysql:host=$servername;dbname=nature", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully"; 
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>

<?php
	$azioniAmmesse = array('lista', 'dettaglio', 'form', 'salva', 'elimina');
$azione='';
if(isset($_REQUEST['azione'])) {
	$azione = $_REQUEST['azione'];
	if(!in_array($azione, $azioniAmmesse)){
		$azione='';
	}
}
//SWITCH 1 PER TENER CONTO DI SALVA=(PER INSERT E UPDATE) E ELIMINA (PER ELIMINAZIONE DEL RECORD)
switch ($azione) {
	case "salva":
		salva();
		$azione = 'lista';
		break;
	case "elimina":
		elimina();
		$azione = 'lista';
		break;
	}
function salva(){}
function elimina(){}
	?>
<?php
	//SWITCH 2 PER RESTITUZIONE OUTPUT
	switch ($azione) {
	case 'lista':
		$contenuto = lista();
		break;
	case 'form':
		$contenuto = form();
		break;
	case 'dettaglio':
		$contenuto = dettaglio();
		break;
	default:
		$contenuto = lista();
		break;
	}
function lista(){}
function dettaglio(){}
function form(){}
?>