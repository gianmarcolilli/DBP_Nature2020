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
        <form action="inserisciSegnalazione_do.php" method="post">
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
              <input type="hidden" class="form-control" name="id" value="<?//= $id ?>" readonly>
            </div>-->
			  <!--<div class="form-group col-4">
			  </div>
			   <div class="form-group col-8">
              <label for="insert">Nome utente</label>
				  
              <input type="text" class="form-control" name="nomeUtente" value="" readonly>
            </div>
			  
            <div class="form-group col-4">
              <label for="insert">Data </label>
				<input type="date" class="form-control" name="dataSegnalazione" placeholder="Inserisci la data ">
            </div>-->
			  <div class="form-group col-6">
              <label for=""> Latitudine GPS</label>
              <input type="text" class="form-control" name="latitudine" placeholder="Inserire la latitudine in formato numerico classico">
            </div>
			  <div class="form-group col-6">
              <label for=""> Longitudine GPS</label>
              <input type="text" class="form-control" name="longitudine" placeholder="Inserire la longitudine in formato numerico classico">
            </div>
			  <!--<div class="form-group col-12">
              <label for=""> Foto della segnalazione</label>
              <input type="text" class="form-control" name="foto" placeholder="*">
            </div>-->
			  <div class="form-group col-6">
              <label for=""> Habitat </label>
              <!--<input type="text" class="form-control" id="updateHabitat" placeholder="Habitat"> -->
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
			 

	<div class="form-group col-12">
                    <button type="submit" class="btn btn-success btn-block"><i class="fa fa-arrow-right"></i> Inserisci nuova segnalazione  </button>
                  </div>
			  </div>
		</form>
		
	  </div>
	  </div>
</body>
</html>