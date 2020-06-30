<?php
include('header.php');
  ?>
<body>

<?php
	include('navbar.php');
	//include('connection.php');?>
	
	<section style="min-height: 700px; background-color: grey" >
		<div class="container-fluid" >
			<div class="container">
				<form action="inviaMessaggio_do.php" method="post" id="inviaMess">
				<div class="row">
					<p class="text-white">Invia a:</p>
				<div class="col-4">
					<!--SELECT-->      
	<?php
      $sql=$conn->query("SELECT nomeUtente, email FROM UTENTE");
					?>
			 <select class="form-control alert-dark"  name="destinatarioMess">
			  <option value="0">-- Seleziona un utente --</option>
			  <?php
				 //fetch_assoc() è un metodo che mi ritorna TRUE finchè ci sono delle righe nel DB

			  while($row = $sql->fetch_assoc()) {
				unset($nomeUtente, $email);
				$nomeUtente = $row['nomeUtente'];
				$email = $row['email'];
				?>
				<option value="<?=$nomeUtente?>"> Utente: <?=$nomeUtente?>  </option>
				 <?php
			  }
				 ?>
			 </select>
	<!-- FINE SELECT-->
					</div>
				</div>
				<br>
				<div class="row">
					<p class="text-white">Titolo:</p>
					<div class="col-6">
						<input type="text" class="form-control alert-dark" name="titoloMess"> 
					</div>
				</div>
				<br>
				<div class="row">
					<p class="text-white">Testo:</p>
					<div class="col-8">
						<textarea type="text" class="form-control alert-dark" style="min-height: 400px" name="testoMess"></textarea> 
					</div>
				</div>
				</form>
				<div class="row col-3">
					<button type="submit" class="btn-success btn-block" form="inviaMess"><i class="fa fa-arrow-right"></i> Invia Messaggio</button>
				</div>
			</div>
		</div>
	</section>
</body>
</html>