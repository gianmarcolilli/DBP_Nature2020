<!DOCTYPE html>
<html lang="en" dir="ltr">

<!-- import scripts, css, user session -->
<?php include('header.php'); ?>

<body>
<?php
require_once('navbar.php');
include('connection.php');
$sql= "select id,
id2,
nomeUtente,
commento,
dataProposta,
specie from proposta";
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
  <p><h2 class="text-dark">Elenco delle proposte di classificazione inserite</h2></p>
  <a href="classificaSpecie.php"><p class="lead mb-0 text-left"><i class="fa fa-address-book"></i> Classifica specie con più segnalazioni</p></a>
  <div class ="row">
      <div class = "container">
		</div>
	</div>
  <div class="container-fluid table">
		<table class="table table-striped table-sm table-bordered table-hover" id="table-specie">
			<thead class="thead-inverse ">
				<tr>
					<th >N° proposta </th>
					<th >ID segnalazione</th>
					<th >Utente</th>
					<th >Commento</th>
					<th >Data inserimento</th>
					<th >Specie di riferimento</th>
				</tr>
			</thead>
		  <?php
foreach ($result as $row) :
	$f1=$row['id'];
	$f2=$row['id2'];
	$f3=$row['nomeUtente'];
	$f4=$row['commento'];
	$f5=$row['dataProposta'];
	$f6=$row['specie'];


	//intestazione di ogni riga della tabella
	$t1='Proposta N°: ';
	$t2='ID segnalazione: ';
	$t3='Nome utente: ';
	$t4='Commento: ';
	$t5='Data: ';
	$t6='Specie: ';
	?>
<tbody>
  <tr>
	  <td ><?= $f1?></td>
	  <td ><?= $f2?></td>
	  <td ><?= $f3?></td>
	  <td ><?= $f4?></td>
	  <td ><?= $f5?></td>
	  <td ><?= $f6?></td>


	  <td><form action="">
	<div class="form-group"  >
			<div class="row">
				<div class="col-12">
					<button onclick="" class="btn btn-success">
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
		</div>
  		</div>

      <?php require_once('footer.php'); ?>

</body>
</html>
