<?php
include('header.php');
  ?>
<body>

<?php
	include('navbar.php');
	//include('connection.php');
	include('mostraNomeUtenteSessione.php');
	?>
<section style="min-height: 700px; background-color: grey; " >
	<div class="container-fluid" >
		<div class=" ">
		<!--<a href="invioMessaggio.php" style="color: white; font-size: 20px;"><i class="fa fa-plus"></i> Invia un nuovo messaggio</a><br>-->
		<a href="elencoMessRicevuti.php" style="color: white; font-size: 16px;"><i class="fa fa-angle-left"></i>Indietro</a>
			</div>
	<?php 
		$nomeUtenteOK= $_GET['nomeUtenteMess'];
		$_SESSION['nomeok'] = $nomeUtenteOK;
		//query per lettura messaggi ricevuti
		$sql=$conn->query("(select id, nomeUtenteMittente,
			nomeUtenteDestinatario,
			titolo,
			testo,
			tstamp from messaggio where nomeUtenteDestinatario='$nome' and  nomeUtenteMittente='$nomeUtenteOK' order by tstamp)
			union
			(select id as idM, nomeUtenteMittente as nm,
			nomeUtenteDestinatario as nd,
			titolo as titoloM,
			testo as testoM,
			tstamp as tstampM from messaggio where nomeUtenteDestinatario='$nomeUtenteOK' and nomeUtenteMittente='$nome' order by tstamp)");
		?> 
		
		<p class="text-center" style="color: darkslategrey; font-size: 30px" >Chat con <?=$nomeUtenteOK ?>  </p> 
		<?php
	//nomeUtenteDestinatario='$nome' and
	//nomeUtenteDestinatario='$nomeUtenteOK' and
	while ($row = $sql->fetch_assoc()) {
        unset($id,$nomeUt, $nomeDest, $title, $text, $tstamp, $idM, $nm, $nd, $titoloM, $testoM, $tstampM);
		$id = $row['id'];
        $nomeUt = $row['nomeUtenteMittente'];
        $nomeDest = $row['nomeUtenteDestinatario'];
		$title = $row['titolo'];
		$text = $row['testo'];
		$tstamp = $row['tstamp'];
		$idM = $row['id'];
        $nm = $row['nomeUtenteMittente'];
        $nd = $row['nomeUtenteDestinatario'];
		$titoloM = $row['titolo'];
		$testoM = $row['testo'];
		$tstampM = $row['tstamp']; 
	
	?>
			<div class="row col-6 offset-3"> 
				<div class="col " style="background-color: cadetblue; border-radius: 8px; margin: 5px">
					<p style="font-size: 0.8em; font-style: italic; color: antiquewhite">Messaggio di <?= $nomeUt?></p>
					<p> Titolo: <?= $title ?></p><br>
					<p height="auto"> Testo: 
						<?= $text ?></p><br>
					<p class="text-right" style="font-size: 0.8em; font-style: italic; color: antiquewhite">
						<?= $tstamp ?></p>
				</div>	
			</div>
			<div class="row" style="height: 1.5rem;"></div>
		
		
			<?php			 
				}
			?>
		
		</div>
				<form action="rispondiaMessaggio_do.php" method="post" id="inviaMess">
				<div class="row col-6 offset-3" >
					<input type="hidden " name="destinatario" value="<?= $nomeUtenteOK ?>" hidden>
					<p class="text-white">Titolo:</p>
						<input type="text" class="form-control alert-dark" name="titoloMess"> 
					<p class="text-white">Testo:</p>
						<textarea type="text" class="form-control alert-dark" style="min-height: 100px" name="testoMess"></textarea> 
				</div>
				</form>
				<br>
				<div class="row col-3 offset-6"  >
					<button type="submit" class="btn btn-success btn-block" style="margin-bottom: 15px" form="inviaMess"><i class="fa fa-arrow-right"></i> Rispondi</button>
				</div>
	</section>
	<?php require_once('footer.php'); ?>
</body>
</html>