   <?php
     require_once('header.php');
    ?>
  
  <body>

   <?php
	  include('navbar.php');
	  
	  
	  ?>
	  
	<!-- Visualizzazione profilo personale -->
    <div class="alert alert-info alert-dismissable" role="alert">
      <strong>Pagina di aggiornamento delle campagne di raccolta fondi.</strong> Qui puoi aggiungere una nuova campagna di raccolta fondi.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <br>
    <h3 align="center">Inserisci nuova campagna di raccolta fondi</h3>
    <div class ="row">
      <div class = "container">
        <form action="inserisciRaccolta_do.php" method="post">
          <div class="form-row">
            <div class="form-group col-4">
              <label for="insert">Stato</label>
              <input type="text" class="form-control" name="stato" value="APERTA" readonly>
            </div>
			   
			   <div class="form-group col-8">
              <label for="insert">Descrizione</label>
              <input type="text" class="form-control" name="descrizione" placeholder="Inserisci la descrizione della raccolta fondi">
            </div>
			  
            <div class="form-group col-5">
              <label for="insert">Inizio della campagna</label>
				<input type="text" class="form-control" name="inizio" value="<?= date("d/m/y")?>" readonly>
			
            </div>
			  <div class="form-group col-7">
              <label for="updateClasse"> Importo massimo della raccolta</label>
              <input type="text" class="form-control" name="maxImporto" placeholder="Inserisci l'importo massimo">
            </div>
			  
<div class="form-group"  >
			<div class="row">
				<div class="col-12">
					 <button type="submit" class="btn btn-success btn-block"><i class="fa fa-arrow-right"></i>
						 Inserisci la nuova campagna
					</button>
				</div>
			</div>
			</div>
		</form>
		
		</div>
	  </div>
	  
</body>
</html>