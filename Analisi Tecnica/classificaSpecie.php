<!DOCTYPE html>
<html lang="en" dir="ltr">

<!-- import scripts, css, user session -->
<?php include('header.php'); ?>

<body>
  <?php require_once('navbar.php'); ?>
  <div class="container-fluid">
    <p><h2 class="text-dark"> Classifica delle specie con più segnalazioni</h2></p>
		<a href="elencoSpecie.php"><p class="lead mb-0 text-left"><i class="fa fa-address-book"></i> Elenco specie</p></a>
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
nomeHabitat,
count(specie) as segnalazioni from specie left join proposta on specie.nomeLatino=proposta.specie group by specie.nomeLatino; order by segnalazioni asc ";

try {
  $stmt = $conn->prepare($sql);
  $stmt->execute();
} catch (PDOException $e) {
    print $e;
    exit();
}
$result = $stmt->fetchAll();
?>
<div class="container-fluid table">
	<table class="table table-striped table-sm table-bordered table-hover" id="table-specie">
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
			<th class="dark">Numero proposte </th>

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
	$f13=$row['segnalazioni']
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
	  <td><?= $f13?></td>

	</tr>
	</tbody>
	<?php
endforeach; ?>


</div>
	</table>

	</div>

    <?php require_once('footer.php'); ?>

	</body>
</html>
