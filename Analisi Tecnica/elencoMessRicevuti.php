<?php
include('header.php');
  ?>
<body>

<?php
	include('navbar.php');
	//include('connection.php');
	include('mostraNomeUtenteSessione.php');
	?>
<section style="min-height: 700px; background-color: grey" >
	<div class="container-fluid"  >
		<a href="invioMessaggio.php" style="color: white; font-size: 20px;"><i class="fa fa-plus"></i> Invia un nuovo messaggio</a>
		<p class="text-center" style="color: darkslategrey; font-size: 28px" >Messaggi ricevuti</p>
		<p class="text-left" style="color: darkslategrey; font-size: 28px" >Elenco conversazioni</p>
	<?php 
		
		$sql=$conn->query("select id, nomeUtenteMittente,
			nomeUtenteDestinatario,
			titolo,
			testo,
			tstamp from messaggio where nomeUtenteDestinatario='$nome'");
	while ($row = $sql->fetch_assoc()) {
        unset($id,$nomeUt, $nomeDest, $title, $text, $tstamp);
		$id = $row['id'];
        $nomeUt = $row['nomeUtenteMittente'];
        $nomeDest = $row['nomeUtenteDestinatario'];
		$title = $row['titolo'];
		$text = $row['testo'];
		$tstamp = $row['tstamp'];
	
	?><button class="btn btn-success" style="margin: 10px; border-radius: 8px">
			<form action="messaggiRicevuti.php" method="get">
				<input type="submit" name="nomeUtenteMess"  value="<?= $nomeUt ?>">
			</form></button><br>
		<?php
	}
	?>
		</div>
	</section>
	
</body>
</html>