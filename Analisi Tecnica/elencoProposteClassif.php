<?php
require_once('header.php');
require_once('navbar.php');
?>

<body>
<?php
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
<h2 class="text-dark"> Elenco delle proposte di classificazione inserite</h2>
	<div class ="row">
      <div class = "container">
		<a href="classificaSpecie.php"><p class="lead mb-0 text-left"><i class="fa fa-clipboard-list"></i> Classifica specie con più segnalazioni</p></a>
		</div>
	</div>
	<div class="table-responsive">
		<table class="table table-striped" id="table-specie">
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
		</div>
</body>
</html>