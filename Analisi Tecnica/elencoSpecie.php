<?php 
require_once("header.php");
require_once("navbar.php");
?>
<body>
<?php
  /*$operazione="visualizza pagina profilo utente: ".$_SESSION['nomeUtente'];
  require("mongoDBconn.php");*/
?>
<h2 class="text-dark">Elenco di tutte le specie</h2>
	<div class ="row">
      <div class = "container">
		<a href="classificaSpecie.php"><p class="lead mb-0 text-left"><i class="fa fa-address-book"></i> Classifica specie con più segnalazioni</p></a>
		</div>
	</div>
<?php
	include('connection.php');

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
	  <td><a href="https://it.wikipedia.org/wiki/<?= $f3?>" target="_blank"><?= $f7?></a></td>
	  <td><?= $f8?></td>
	  <td><?= $f9?></td>
	  <td><?= $f10?></td>
	  <td><?= $f11?></td>
	  <td><?= $f12?></td>

	  <td>
		  <?php

          if($tipoUtente == 'amministratore'){  ?>
		  
	<div class="form-group"  >
		<div class="row">
			<div class="col-6">
				<form action="modificaSpecie.php" method="post">
					<input type="hidden" name="nomeLatinospecie" value="<?= $f1 ?>" >
					<button  class="btn btn-success"  >
						<i class="fa fa-edit" aria-hidden="true">Modifica </i>
					</button>
				</form>
			</div>
				<div class="col-6">
		  		<form action="eliminaSpecie.php">
					<button onclick="" class="btn btn-danger"  >
						<i class="fa fa-trash" aria-hidden="true">Elimina </i>
					</button>
			  	</form>
			</div>
		</div>	
	</div>
		  <?php } ?>
	  </td>
	  
	</tr>
	</tbody>
	<?php
endforeach; ?>

		
	</table>
  

	</body>
</html>
