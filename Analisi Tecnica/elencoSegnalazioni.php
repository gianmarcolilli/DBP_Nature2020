<?php
require_once('header.php');
require_once('navbar.php');
?>

<body>
<?php
include('connection.php');
$sql= "select id,
nomeUtente,
dataSegnalazione,
latitudineGPS,
longitudineGPS,
foto,
nomeHabitat from segnalazione";
try {
  $stmt = $conn->prepare($sql);
  $stmt->execute();
} catch (PDOException $e) {
    print $e;
    exit();
}
$result = $stmt->fetchAll();

?>
<h2 class="text-dark"> Elenco delle segnalazioni</h2>
		  <?php
foreach ($result as $row) :
	$f1=$row['nomeUtente'];
	$f2=$row['dataSegnalazione'];
	$f3=$row['latitudineGPS'];
	$f4=$row['longitudineGPS'];
	$f5=$row['foto'];
	$f6=$row['nomeHabitat'];

	//intestazione di ogni riga della tabella
	$t1='Utente: ';
	$t2='Data segnalazione: ';
	$t3='Latitudine: ';
	$t4='Longitudine: ';
	$t5='Foto';
	$t6='Habitat ';

	?>
<section class="showcase">
    <div class="container-fluid p-0">
      <div class="row no-gutters">


		<form class="col-6" action="inserisciProposta.php" method="post">
		  <div class="col-lg-6">

		 <table>
		 <tbody>
			 <tr><td> <h2 class="text-secondary"><?=$t1?> <?= $f1?></h2></td></tr>

			 <tr>
				<td><p class="lead mb-0"> <?=$t2?></p><p style="font-style: italic"><?= $f2?> </p>
				 </td>
			 </tr>
			<tr>
				<td><p class="lead mb-0"> <?=$t3?></p><p style="font-style: italic"><?= $f3?> </p>
				</td>
			 </tr>
		 	<tr>
				<td><p class="lead mb-0"> <?=$t4?></p><p style="font-style: italic"><?= $f4?> </p>
				</td>
			 </tr>
			 <tr>
				<td><p class="lead mb-0"> <?=$t5?></p><p style="font-style: italic">
					<img src="uploads/<?= $f5?>" </p>
				</td>
			 </tr>
			 <tr>
				<td><p class="lead mb-0"> <?=$t6?></p><p style="font-style: italic"><?= $f6?> </p>
				</td>
			 </tr>
			 <br>
		</tbody>
		</table>
			<div class="form-group"  >
			<div class="row">
				<div class="col-6">
					 <button type="submit" class="btn btn-success btn-block" onClick=""><i class="fa fa-arrow-right"></i>
						 Inserisci proposta di classificazione
					</button>
				</div>
			</div>
			</div>
		</div>
			</form>
			<div class="col-lg-6 order-lg-2  showcase-img" ><img src="img/bg-showcase-2.jpg" /></div>

      </div>
    </div>
  </section>
 <?php
endforeach; ?>
</body>
</html>
