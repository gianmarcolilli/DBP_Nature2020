<?php 
require_once("header.php");
require_once("navbar.php");
?>
<body>
<?php
  /*$operazione="visualizza pagina profilo utente: ".$_SESSION['nomeUtente'];
  require("mongo.php");*/
?>
<h2 class="text-secondary">ELENCO DI TUTTE LE SPECIE</h2>
<?php
	include('connection.php');
/*$sql="select nomeLatino, tipo, nomeItaliano, classe, annoClassif, vulnerabilita, wikiLink, cmAltezza, cmDiametro, peso, mediaProle, specie.nomeHabitat from specie left join habitat on specie.nomeHabitat=habitat.nome";*/

$sql="select nomeLatino, 
tipo,
nomeItaliano,
classe,
annoClassif,
vulnerabilita,
wikiLink,
cmAltezza,
cmDiametro,
peso,
mediaProle,
nomeHabitat from specie";

try {
  $stmt = $conn->prepare($sql);
  $stmt->execute();
} catch (PDOException $e) {
    print $e;
    exit();
}
$result = $stmt->fetchAll();
?>
	
<table class="table table-striped" id="table-specie">
	<thead class="thead-inverse">
		<tr>
			
			<th>Nome Latino</th>
			<th>Tipo</th>
			<th>Nome Italiano</th>
			<th>Classe</th>
			<th>Anno di classificazione</th>
			<th>Vulnerabilità</th>
			<th>Link di Wikipedia</th>
			<th>Altezza (cm)</th>
			<th>Diametro (cm)</th>
			<th>Peso (kg)</th>
			<th>Media Prole </th>
			<th>Habitat </th>
		</tr>
		</thead>
	
	<?php
foreach ($result as $row) : 
	$f1=$row['nomeLatino'];
	$f2=$row['tipo'];
	$f3=$row['nomeItaliano'];
	$f4=$row['classe'];
	$f5=$row['annoClassif'];
	$f6=$row['vulnerabilita'];
	$f7=$row['wikiLink'];
	$f8=$row['cmAltezza'];
	$f9=$row['cmDiametro'];
	$f10=$row['peso'];
	$f11=$row['mediaProle'];
	$f12=$row['nomeHabitat'];
	
?>
	<tbody>
  <tr>
	  <td><?= $f1?></td>
	  <td><?= $f2?></td>
	  <td><?= $f3?></td>
	  <td><?= $f4?></td>
	  <td><?= $f5?></td>
	  <td><?= $f6?></td>
	  <td><?= $f7?></td>
	  <td><?= $f8?></td>
	  <td><?= $f9?></td>
	  <td><?= $f10?></td>
	  <td><?= $f11?></td>
	  <td><?= $f12?></td>

	  <td><form action="modificaSpecie.php?nomeLatino=<?=$f1?>">
	<div class="form-group"  >
			<div class="row">
				<div class="col-12">
					<button onclick="" class="btn btn-success"  >
						<i class="fa fa-edit" aria-hidden="true"> Modifica</i>
					</button>
				</div>
			</div>	
			</div>
		</form>
	  </td>
	  
	</tr>
	</tbody>
	<?php
endforeach; ?>

		
	</table>
  

	</body>
</html>
