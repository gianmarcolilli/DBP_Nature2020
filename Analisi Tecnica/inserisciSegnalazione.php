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
        <form action="inserisciSegnalazione_do.php" method="post" id="formSegnalazione">
          <div class="form-row">
			  
            <!--<div class="form-group col-4">
              
				<?php
				/* SERVE PER MOSTRARE L'ID DELLA SEGNALAZIONE CHE SI ANDRA' AD INSERIRE
				include('connection.php');
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
							$id=$f1+1; */
				?>
            -->
			  <div class="form-group col-6">
              <label for=""> Latitudine GPS</label>
              <input type="text" class="form-control" name="latitudine" placeholder="Inserire la latitudine in formato numerico classico">
            </div>
			  <div class="form-group col-6">
              <label for=""> Longitudine GPS</label>
              <input type="text" class="form-control" name="longitudine" placeholder="Inserire la longitudine in formato numerico classico">
            </div>
			  
			  <div class="form-group col-6">
              <label for=""> Habitat </label>
              
				<!--SELECT-->      
	<?php
	
      $sql=$conn->query("SELECT nome FROM HABITAT");
					?>
     <select class="form-control"  name="nomeHabitat">
      <option value="0">-- Seleziona una opzione --</option>
      <?php
		 //fetch_assoc() è un metodo che mi ritorna TRUE finchè ci sono delle righe nel DB
		 
      while($row = $sql->fetch_assoc()) {
        unset($nome);
        $nome = $row['nome'];
        ?>
        <option value="<?=$nome?>"> Habitat: <?=$nome?>  </option>
		 <?php
      }
		 ?>
     </select>
	<!-- FINE SELECT-->
			</div>
			 </form>
			<div class="form-group col-12">
				  <label for=""> Foto della segnalazione</label>
				  <form action="upload.php" method="post" enctype="multipart/form-data">
					  Seleziona l'immagine da caricare:
					  	<input type="file" name="fileToUpload" id="fileToUpload">
  						<input type="submit" value="Upload Image" name="submit">
				  </form>
              
              
            </div>

	<div class="form-group col-12">
                    <button type="submit" class="btn btn-success btn-block" form="formSegnalazione"><i class="fa fa-arrow-right"></i> Inserisci nuova segnalazione  </button>
                  </div>
			  </div>
		
		
	  </div>
	  </div>
</body>
</html>