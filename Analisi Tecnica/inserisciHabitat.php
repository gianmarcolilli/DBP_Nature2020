   <?php
     require_once('header.php');
    ?>
  
  <body>

   <?php
	  include('navbar.php');
	  ?>
	<!-- Visualizzazione profilo personale -->
    <div class="alert alert-info alert-dismissable" role="alert">
      <strong>Pagina di aggiornamento della specie.</strong> Qui puoi aggiungere il nuovo habitat.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <br>
    <h3 align="center">Inserisci nuovo habitat</h3>
    <div class ="row">
      <div class = "container">
		  <!--INIZIO FORM -->
        <form action="inserisciHabitat_do.php" method="post">
          <div class="form-row">
            <div class="form-group col-4">
              <label >Nome habitat</label>
              <input type="text" class="form-control" name="nome" placeholder="Inserisci il nome dell'habitat">
            </div>
			   <div class="form-group col-8">
              <label>Descrizione</label>
              <input type="text" class="form-control" name="descrizione" placeholder="Inserisci la descrizione dell'habitat">
            </div>	     
		  </div>
			<div class="form-group col-3">
                    <button name="inserimento" type="submit" class="btn btn-success btn-block"><i class="fa fa-arrow-right"></i> Inserisci habitat  </button>
                  </div>
		</form>
		</div>
	  </div>
</body>
