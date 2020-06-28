   <?php
     require_once('header.php');
    ?>
  
  <body>

   <?php
	  include('navbar.php');
	  ?>
	<!-- Visualizzazione profilo personale -->
    <div class="alert alert-info alert-dismissable" role="alert">
      <strong>Pagina di adesione ad una raccolta fondi.</strong> Qui puoi donare ad una raccolta.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <br>
    <h3 align="center">Effettua la tua donazione</h3>
    <div class ="row">
      <div class = "container">
		  <!--INIZIO FORM -->
        <form action="adesioneRaccolta_do.php" method="post">
          <div class="form-row">
			  <input type="hidden"  class="form-control" name="id" 
					 value=" <?php $idRF = "";
						if(isset($_GET['id'])){ 
						$id=htmlspecialchars($_GET['id']); 
						//fai la query
						$query=mysql_query("SELECT id FROM raccoltafondi WHERE id='$id'");
						//e estrai
						$riga=mysql_fetch_array($query);
						//puoi uscire da php per fare il form
						$idRF=$id;
						}  ?>"  >
			 
            <div class="form-group col-3">
              <label >Importo da donare:</label>
              <i class="fa fa-euro-sign"></i><input type="text" pattern="(?=.*\d).{2,6}" class="form-control" name="importo" placeholder="Inserisci l'importo da donare">
            </div>
			   <div class="form-group col-9">
              <label>Note donazione: </label>
              <textarea type="text" class="form-control" name="note" placeholder="Se desideri lascia un messaggio con la tua donazione"></textarea>
            </div>	     
		  </div>
			<div class="form-group col-3">
                    <button type="submit"  class="btn btn-success btn-block"><i class="fa fa-arrow-right"></i> Inserisci donazione  </button>
                  </div>
		</form>
		</div>
	  </div>
</body>
