<?php 
require_once('header.php');
?>
  </head>
  <body>

   <?php
	  include('navbar.php');
	  include('connection.php');
?>
	 
	<!-- Visualizzazione profilo personale -->
    <div class="alert alert-info alert-dismissable" role="alert">
      <strong>Pagina di inserimento delle escursioni.</strong> Qui l'utente premium può aggiungere e creare una nuova escursione a cui poi gli altri utenti si potranno iscrivere.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <br>
    <h3 align="center">Inserisci nuova escursione</h3>

    <div class ="row">
      <div class = "container">
        <form action="inserisciEscursione_do.php" method="post">
          <div class="form-row">
            <div class="form-group col-4">
              <label for="insert">Numero escursione</label>
				<?php
						$sql= "select id from escursione";
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
				<input type="text" class="form-control-plaintext" name="id" value="<?=$id ?>" readonly >
            </div>

		    <div class="form-group col-8">
              <label for="insert">Titolo escursione</label>
              <input type="text" class="form-control" name="titolo" placeholder="Inserisci il titolo dell'escursione">
            </div>
			  <!--DATA-->
			  <div class="form-group col-12">
            <label for="">Data</label>
					  <input type="date" class="form-control" name="data">
          </div>
			  <!-- FINE DATA-->
			  <div class="form-group col-6">
          <label for=""> Ora di partenza</label>
          <input type="time" class="form-control" placeholder="" name="oraPartenza">            
        </div>
			  <div class="form-group col-6">
          <label for=""> Ora di ritorno</label>
          <input type="time" class="form-control" placeholder="" name="oraRitorno">
        </div>
			  <div class="form-group col-12">
              <label for=""> Descrizione</label>
              <textarea class="form-control" name="descrizione" placeholder="Inserisci la descrizione dell'escursione"></textarea>
            </div>
			  <div class="form-group col-5">
              <label for=""> Numero massimo di partecipanti</label>
              <input type="text" class="form-control" name="maxPartecipanti" placeholder="*">
            </div>
		  </div>

	<div class="form-group"  >
			<div class="row">
				<div class="col-12">
					 <button type="submit" class="btn btn-success btn-block"><i class="fa fa-arrow-right"></i>
						 Inserisci la nuova escursione
					</button>
				</div>
			</div>
			</div>
		</form>

	  </div>
	  </div>
</body>
</html>
