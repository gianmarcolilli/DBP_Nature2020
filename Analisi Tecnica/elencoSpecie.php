<!DOCTYPE html>
<html lang="en" dir="ltr">

<!-- import scripts, css, user session -->
<?php include('header.php'); ?>

<body>
  <?php
	require_once('navbar.php');
	include('connection.php');

$sql="SELECT nomeLatino, tipo, nomeItaliano, classe, annoClassif, vulnerabilita, wikiLink, cmAltezza, cmDiametro, peso, mediaProle, nomeHabitat
			FROM specie";

try {
  $stmt = $conn->prepare($sql);
  $stmt->execute();
} catch (PDOException $e) {
    print $e;
    exit();
}
$result = $stmt->fetchAll();
?>
<div class="container-fluid">
	<p><h2 class="text-dark">Elenco di tutte le specie</h2></p>
	<a href="classificaSpecie.php"><p class="lead mb-0 text-left"><i class="fa fa-address-book"></i> Classifica specie con più segnalazioni</p></a>
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
					<?php if($tipoUtente == 'amministratore') {  ?>	<th>Effettua operazione </th> <?php } ?>
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

			<?php if($tipoUtente == 'amministratore') {  ?>
		  <td>
				<div class="row">

					<div class="col-6 vertical-center text-center">
						<form action="modificaSpecie.php" method="post">
							<input type="hidden" name="updateNomeLatino" value="<?php echo $f1; ?>" />
							<input type="hidden" name="updateTipo" value="<?php echo $f2; ?>" />
							<input type="hidden" name="updateNomeItaliano" value="<?php echo $f3; ?>" />
							<input type="hidden" name="updateClasse" value="<?php echo $f4; ?>" />
							<input type="hidden" name="updateAnnoClassif" value="<?php echo $f5; ?>" />
							<input type="hidden" name="updateVulnerabilita" value="<?php echo $f6; ?>" />
							<input type="hidden" name="updateWikiLink" value="<?php echo $f7; ?>" />
							<input type="hidden" name="updateAltezza" value="<?php echo $f8; ?>" />
							<input type="hidden" name="updateDiametro" value="<?php echo $f9; ?>" />
							<input type="hidden" name="updatePeso" value="<?php echo $f10; ?>" />
							<input type="hidden" name="updateMediaProle" value="<?php echo $f11; ?>" />
							<input type="hidden" name="updateHabitat" value="<?php echo $f12; ?>" />

								<button onclick="" class="btn btn-success" >
									<i class="fa fa-edit" aria-hidden="true">Modifica </i>
								</button>
						</form>
					</div>
					<div class="col-6 vertical-center text-center">
			  		<form action="eliminaSpecie_do.php" method="post">
							<input type="hidden" name="nomeLatino" value="<?php echo $f1; ?>" />
							<button onclick="" class="btn btn-danger">
								<i class="fa fa-trash" aria-hidden="true">Elimina </i>
							</button>
				  	</form>
					</div>
				</div>
	  	</td>
	<?php } ?>

		</tr>
	</tbody>
	<?php	endforeach; ?>
	</table>

	</div>
</div>

  <?php require_once('footer.php'); ?>

	</body>
</html>
