   <?php
     require_once('header.php');
    ?>

  <body>

   <?php
	  include('navbar.php');
	  //include('connection.php');

	  $nomeLat=$_POST['updateNomeLatino'];

	  $sql=$conn->query("select nomeLatino,
			tipo,
			nomeItaliano,
			classe,
			annoClassif,
			vulnerabilita,
			wikiLink,
			cmAltezza,
			cmDiametro,
			peso,
			mediaProle,
			nomeHabitat from specie where nomeLatino='$nomeLat' ");

	  while ($row = $sql->fetch_assoc()) {

	$f1=$row['nomeLatino'];
	$f2=$row['tipo'];
	$f3=$row['nomeItaliano'];
	$f4=$row['classe'];
	$f5=$row['annoClassif'];
	$f6=$row['vulnerabilita'];
	$f7=$row['wikiLink'];
	$f8=$row['cmAltezza'];
	$f9=$row['cmDiametro'];
	$f10=$row['peso'];
	$f11=$row['mediaProle'];
	$f12=$row['nomeHabitat'];
	  }
	  ?>
	<!-- Visualizzazione profilo personale -->
    <div class="alert alert-info alert-dismissable" role="alert">
      <strong>Pagina di aggiornamento della specie.</strong> Qui puoi visualizzare/modificare la specie selezionata.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <br>
    <h3 align="center">Aggiorna specie</h3>
    <div class ="row">
      <div class = "container">
        <form action="modificaSpecie_do.php" method="post" id="modificaSpecie">
          <div class="form-row">
            <div class="form-group col-6">
              <label for="updateNomeLatino">Nome Latino</label>
              <input type="text" class="form-control" name="updateNomeLatino" value="<?=$f1?>">
            </div>
			   <div class="form-group col-6">
              <label for="updateNomeItaliano">Nome Italiano</label>
              <input type="text" class="form-control" name="updateNomeItaliano" value="<?=$f3?>">
            </div>

            <div class="form-group col-4">
              <label for="updateTipo">Tipo</label>
              <input type="text" class="form-control" name="updateTipo" value="<?=$f2?>">
            </div>
			  <div class="form-group col-8">
              <label for="updateClasse"> Classe</label>
              <input type="text" class="form-control" name="updateClasse" value="<?=$f4?>">
            </div>

            <div class="form-group col-4">
              <label for="updateAnnoClassif">Anno classificazione</label>
              <input type="text" pattern="(?=.*\d).{4,4}" maxlength="4" class="form-control" name="updateAnnoClassif" value="<?=$f5?>">
              <span class="error"><?php //echo $dataErr;?></span>
            </div>
              <div class="form-group col-8">
              <label for="updateWikiLink"> Link di wikipedia</label>
              <input type="text" class="form-control" name="updateWikiLink" value="<?=$f7?>">
            </div>

			  <div class="form-group col-3">
              <label for="updateVulnerabilita">Vulnerabilità</label>
              <input type="text" pattern="(?=.*\d).{3,3}" maxlength="3" class="form-control" name="updateVulnerabilita" value="<?=$f6?>">
            </div>
			</div>
			<div class="form-row">
              <div class="form-group col-3">
              <label for="updateAltezza"> Altezza (cm)</label>
              <input type="text" class="form-control" name="updateAltezza" value="<?=$f8?>">
				</div>
			  <div class="form-group col-3">
              <label for="updateDiametro"> Diametro (cm)</label>
              <input type="text" class="form-control" name="updateDiametro" value="<?=$f9?>">
            </div>
				<div class="form-group col-3">
              <label for="updatePeso"> Peso (kg)</label>
              <input type="text" class="form-control" name="updatePeso" value="<?=$f10?>">
            </div>
			<div class="form-group col-3">
              <label for="updateMediaProle"> Media Prole </label>
              <input type="text" class="form-control" name="updateMediaProle" value="<?=$f11?>">
            </div>
			</div>
				<div class="form-row">
			<div class="form-group col-6">
              <label for="updateHabitat"> Habitat </label>

				<!--SELECT -->
	<?php
       $sql=$conn->query("SELECT nome FROM HABITAT");
					?>
     <select class="form-control" id="tappaP" name="updateHabitat">
      <option value="<?=$f12?>">Habitat attuale: <?=$f12?></option>
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
	<!--FINE SELECT-->
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
					<div class="form-group col-3-offset-3 align-content-around">
                    <button type="submit" class="btn btn-success btn-block"  form="modificaSpecie"><i class="fa fa-arrow-right"></i> Aggiorna  </button>
                  </div>




		</div>
	  </div>
</body>
</html>
