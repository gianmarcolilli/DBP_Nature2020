<?php
include('header.php');
  ?>
<body>

<?php
	include('navbar.php');
	//include('connection.php');
	include('mostraNomeUtenteSessione.php');
	?>
<section style="min-height: 900px; background-color: grey" >
	<div class="container-fluid"  >
		<a href="invioMessaggio.php" style="color: white; font-size: 20px;"><i class="fa fa-plus"></i> Invia un nuovo messaggio</a>
		<p class="text-center" style="color: darkslategrey; font-size: 28px" >Messaggi ricevuti</p>
		<p class="text-left" style="color: darkslategrey; font-size: 28px" >Elenco conversazioni</p>
	<?php 
		
		$sql=$conn->query("(select distinct  
			nomeUtenteMittente,
			nomeUtenteDestinatario
			from messaggio where nomeUtenteDestinatario='$nome' || nomeUtenteMittente='$nome' )
			 ");
		unset($conv);
		
		while ($row = $sql->fetch_assoc()) {
        unset($nomeUt, $nomeDest);
        $nomeUt = $row['nomeUtenteMittente'];
        $nomeDest = $row['nomeUtenteDestinatario'];
		
		$conv = ($nomeUt == $nome) ? $nomeDest : $nomeUt;
		
	?>
			<form action="messaggiRicevuti.php" method="get">
				<input type="submit" class="text-white btn" name="nomeUtenteMess"  value="<?= $conv?> " style="background-color: green;min-width: 90px; min-height: 50px"> 
			</form><br>
		<?php
		}
	?>
		</div>
	</section>
	<?php require_once('footer.php'); ?>
	
</body>
</html>