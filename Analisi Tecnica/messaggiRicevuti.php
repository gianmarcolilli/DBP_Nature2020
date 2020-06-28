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
		
	<?php 
		$nomeUtenteOK= $_GET['nomeUtenteMess'];
		$_SESSION['nomeok'] = $nomeUtenteOK;
		//query per lettura messaggi ricevuti
		$sql=$conn->query("select id, nomeUtenteMittente,
			nomeUtenteDestinatario,
			titolo,
			testo,
			tstamp from messaggio where nomeUtenteDestinatario='$nome' and nomeUtenteMittente='$nomeUtenteOK'order by tstamp");
		?> 
		<p class="text-center" style="color: darkslategrey; font-size: 30px" >Chat con <?=$nomeUtenteOK ?>  </p> 
		<?php
	while ($row = $sql->fetch_assoc()) {
        unset($id,$nomeUt, $nomeDest, $title, $text, $tstamp);
		$id = $row['id'];
        $nomeUt = $row['nomeUtenteMittente'];
        $nomeDest = $row['nomeUtenteDestinatario'];
		$title = $row['titolo'];
		$text = $row['testo'];
		$tstamp = $row['tstamp'];
	
	?>
	

		
			<table class="table table-dark table-borderless text-white col-5 " style="border-radius: 8px" >
				
				<tbody  >
			
			<!--<tr><td>Messaggio inviato da: 
				 <?//= $nomeUt ?></td></tr>-->
			<tr><td>Titolo: 
				 <?= $title ?></td></tr>
			<tr height="auto"><td>Testo: 
				 <?= $text ?></td></tr>
			<tr><td class="text-right" style="font-size:0.8em">
				 <?= $tstamp ?></td></tr> 
			<tr class="bg-transparent"><td></td></tr>
			</tbody>
				
			</table>
		
			<?php
	}
			
	$sql=$conn->query("select id, nomeUtenteMittente,
			nomeUtenteDestinatario,
			titolo,
			testo,
			tstamp from messaggio where nomeUtenteDestinatario='$nomeUtenteOK' and nomeUtenteMittente='$nome' order by tstamp ");
		
	while ($row = $sql->fetch_assoc()) {
        unset($id,$nomeUt, $nomeDest, $title, $text, $tstamp);
		$id = $row['id'];
        $nomeUt = $row['nomeUtenteMittente'];
        $nomeDest = $row['nomeUtenteDestinatario'];
		$title = $row['titolo'];
		$text = $row['testo'];
		$tstamp = $row['tstamp'];?>
			
		
			<table class="table table-dark table-borderless text-white col-5 offset-7" style="border-radius: 8px" >
				
				<tbody  >
			
			<!--<tr><td>Messaggio da: 
				 <?//= $nomeUt ?></td></tr>-->
			<tr><td>Titolo: 
				 <?= $title ?></td></tr>
			<tr height="auto"><td>Testo: 
				 <?= $text ?></td></tr>
			<tr><td class="text-right" style="font-size:0.8em">
				 <?= $tstamp ?></td></tr> 
			<tr class="bg-transparent"><td></td></tr>
					
			</tbody>
				
			</table>
			<?php } ?>
		
	
	
		
		</div>
	</section>
	
</body>
</html>