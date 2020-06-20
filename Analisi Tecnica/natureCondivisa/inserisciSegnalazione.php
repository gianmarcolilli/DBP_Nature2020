   <?php
     require_once('header.php');
    ?>
  
  <body>

   <?php
	  include('navbar.php');
	  
	  
	  ?>
	  
	<!-- Visualizzazione profilo personale -->
    <div class="alert alert-info alert-dismissable" role="alert">
      <strong>Pagina di inserimento delle segnalazioni d'avvistamento.</strong> Qui l'utente può inserire una nuova segnalazione d'avvistamento caricando anche una foto della stessa.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <br>
    <h3 align="center">Inserisci nuova segnalazione d'avvistamento</h3>
    <div class ="row">
      <div class = "container">
        <form>
          <div class="form-row">
            <div class="form-group col-4">
              <label for="insert">Numero segnalazione</label>
				<?php
				require_once('connection.php');
						$sql= "select id from segnalazione";
						try {
						  $stmt = $conn->prepare($sql);
						  $stmt->execute();
						} catch (PDOException $e) {
							print $e;
							exit();
						}
						$result = $stmt->fetchAll();
							  foreach ($result as $row) :
							$f1=$row['id'];

							endforeach;
							$id=$f1+1;
				?>
              <input type="text" class="form-control" name="id" value="<?= $id ?>" readonly>
            </div>
			   <div class="form-group col-8">
              <label for="insert">Nome utente</label>
				   <?php// require_once('mostraNomeUtenteSessione.php');?>
              <input type="text" class="form-control" name="nomeUtente" value="" readonly>
            </div>
			  
            <div class="form-group col-4">
              <label for="insert">Data </label>
				<input type="text" class="form-control" name="dataSegnalazione" placeholder="Inserisci la data ">
            </div>
			  <div class="form-group col-4">
              <label for=""> Latitudine GPS</label>
              <input type="text" class="form-control" name="latitudineGPS" placeholder="*">
            </div>
			  <div class="form-group col-4">
              <label for=""> Longitudine GPS</label>
              <input type="text" class="form-control" name="longitudineGPS" placeholder="*">
            </div>
			  <div class="form-group col-12">
              <label for=""> Foto della segnalazione</label>
              <input type="text" class="form-control" name="foto" placeholder="*">
            </div>
			 
			  </div>
			  </form>
			
			
		  
<form action="inserisciSegnalazione_do.php">
	<div class="form-group"  >
			<div class="row">
				<div class="col-12">
					<button onclick="" class="btn btn-success"  >
						<i class="fa fa-arrow-right" aria-hidden="true"> Inserisci la nuova segnalazione d'avvistamento</i>
					</button>
				</div>
			</div>	
			</div>
		</form>
		
	  </div>
	  </div>
</body>
</html>