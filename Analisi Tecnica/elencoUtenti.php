<?php 
require_once("header.php");
require_once("navbar.php");
?>
<body>
<?php
  /*$operazione="visualizza pagina profilo utente: ".$_SESSION['nomeUtente'];
  require("mongo.php");*/
?>
<h2 class="text-dark">Elenco di tutti gli utenti iscritti alla piattaforma Nature</h2>
	<div class="row">
		
			<a href="statistichePremium.php"><p class="lead mb-0 col-12 "><i class="fa fa-clipboard-list"></i> Classifica affidabilità utenti premium</p></a>
			<a href="statisticheAttivi.php"><p class="lead mb-0 col-12"><i class="fa fa-clipboard-list"></i> Classifica utenti più attivi</p></a>
		
	</div>	
		
<?php
	include('connection.php');
/*$sql="select nomeLatino, tipo, nomeItaliano, classe, annoClassif, vulnerabilita, wikiLink, cmAltezza, cmDiametro, peso, mediaProle, specie.nomeHabitat from specie left join habitat on specie.nomeHabitat=habitat.nome";*/

$sql="select nomeUtente, 
tipo,
email,
annoNascita,
dataRegistrazione,
professione,
affidabilita,
classifCorrette,
classifNonCorrette,
classifTotali,
contatore from utente order by tipo desc";

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
			
			<th>Nome Utente</th>
			<th>Tipo</th>
			<th>Email</th>
			<th>Anno di nascita</th>
			<th>Data di registrazione</th>
			<th>Professione</th>
			<th>Affidabilità</th>
			<th>Classificazioni Corrette</th>
			<th>Classificazioni non Corrette</th>
			<th>Classificazioni totali</th>
			<th>Contatore segnalazioni</th>
			
		</tr>
		</thead>
	
	
	<?php
foreach ($result as $row) : 
	$f1=$row['nomeUtente'];
	$f2=$row['tipo'];
	$f3=$row['email'];
	$f4=$row['annoNascita'];
	$f5=$row['dataRegistrazione'];
	$f6=$row['professione'];
	$f7=$row['affidabilita'];
	$f8=$row['classifCorrette'];
	$f9=$row['classifNonCorrette'];
	$f10=$row['classifTotali'];
	$f11=$row['contatore'];
	
	
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
	  

	  <td><form action="">
	<div class="form-group"  >
			<div class="row">
				<div class="col-12">
					<button onclick="" class="btn btn-info"  >
						<i class="fa fa-edit" aria-hidden="true"> Invia messaggio</i>
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
