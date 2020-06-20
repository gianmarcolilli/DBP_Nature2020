   <?php
     require_once('header.php');
    ?>
  
  <body>

   <?php
	  include('navbar.php');
	  ?>
	<!-- Visualizzazione profilo personale -->
    <div class="alert alert-info alert-dismissable" role="alert">
      <strong>Pagina di aggiornamento della specie.</strong> Qui puoi visualizzare/modificare la specie selezionata.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <br>
    <h3 align="center">Inserisci nuova specie</h3>
    <div class ="row">
      <div class = "container">
        <form>
          <div class="form-row">
            <div class="form-group col-6">
              <label for="updateNomeLatino">Nome Latino</label>
              <input type="text" class="form-control" name="nomeLatino" placeholder="Inserisci il nome in latino">
            </div>
			   <div class="form-group col-6">
              <label for="updateNomeItaliano">Nome Italiano</label>
              <input type="text" class="form-control" name="nomeItaliano" placeholder="Inserisci il nome in italiano">
            </div>
			  
            <div class="form-group col-3">
              <label for="updateTipo">Tipo</label>
				<br>
				<input type="radio" id="tipoV" name="tipo" value="Vegetale">Vegetale
				</input> 
			  
				<input type="radio" id="tipoA" name="tipo" value="Animale">Animale
			  	</input> 
			
            </div>
			  <div class="form-group col-9">
              <label for="updateClasse"> Classe</label>
              <input type="text" class="form-control" name="classe" placeholder="Inserisci classe">
            </div>
			  
            <div class="form-group col-4">
              <label for="updateAnnoClassif">Anno classificazione</label>
              <input type="text" pattern="(?=.*\d).{4,4}" maxlength="4" class="form-control" name="annoClassif" placeholder="Anno di classificazione">
              <span class="error"><?php echo $dataErr;?></span>
            </div>
              <div class="form-group col-8">
              <label for="updateWikiLink"> Link di wikipedia</label>
              <input type="text" class="form-control" name="wikiLink"  placeholder="Inserisci link di wikipedia">
            </div>
			  
			  <div class="form-group col-3">
              <label for="updateVulnerabilita">Vulnerabilità</label>
              <input type="text" pattern="(?=.*\d).{3,3}" maxlength="3" class="form-control" name="vulnerabilita" placeholder="Vulnerabilità">
            </div>
			</div>
			<div class="form-row">
              <div class="form-group col-3">
              <label for="updateAltezza"> Altezza (cm)</label>
              <input type="text" class="form-control" name="cmAltezza" placeholder="Altezza in centimetri">
				</div>
			  <div class="form-group col-3">
              <label for="updateDiametro"> Diametro (cm)</label>
              <input type="text" class="form-control" name="cmDiametro" placeholder="Diametro in centimetri">
            </div>
				<div class="form-group col-3">
              <label for="updatePeso"> Peso (kg)</label>
              <input type="text" class="form-control" name="peso" placeholder="Peso in kg">
            </div>
			<div class="form-group col-3">
              <label for="updateMediaProle"> Media Prole </label>
              <input type="text" class="form-control" name="mediaProle" placeholder="Media prole">
            </div>
			</div>
				<div class="form-row">
			<div class="form-group col-6">
              <label for="updateHabitat"> Habitat </label>
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
		</form>
		<div class="form-group col-5">
			<form action="inserisciHabitat.php">Se non è presente l'habitat di tuo interesse, aggiungine uno
					<button onclick="location.href='inserisciHabitat.php"  class="btn btn-info"  >
						<i class="fa fa-plus" aria-hidden="true"> Aggiungi</i>
					</button>
			</form>
		</div>
				     
		  </div>
			
			
		  
<form action="inserisciSpecie_do.php">
	<div class="form-group"  >
			<div class="row">
				<div class="col-12">
					<button onclick="" class="btn btn-success"  >
						<i class="fa fa-arrow-right" aria-hidden="true"> Inserisci la nuova specie</i>
					</button>
				</div>
			</div>	
			</div>
		</form>
		</div>
	  </div>
</body>
</html>