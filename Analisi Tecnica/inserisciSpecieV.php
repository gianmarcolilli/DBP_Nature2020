<?php
require('header.php');
?>

<body>

  <?php
  include('navbar.php');

  ?>

  <!-- Visualizzazione profilo personale -->
  <div class="alert alert-info alert-dismissable" role="alert">
    <strong>Pagina di inserimento di una nuova specie.</strong> Qui l'utente amministratore può inserire una nuova specie nel database.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <br>
  <h3 align="center">Inserisci nuova specie vegetale</h3>
  <div class ="row">
    <div class = "container">
      <form action="inserisciSpecieV_do.php" method="post">
        <div class="form-row">
          <div class="form-group col-6">
            <label for="">Nome Latino</label>
            <input type="text" class="form-control" name="nomeLatino" placeholder="Inserisci il nome in latino">
          </div>
          <div class="form-group col-6">
            <label for="">Nome Italiano</label>
            <input type="text" class="form-control" name="nomeItaliano" placeholder="Inserisci il nome in italiano">
          </div>

          <div class="form-group col-3">
            <label for="">Tipo</label>
            <input type="text" class="form-control" name="tipo" value="Vegetale" readonly >

          </div>
          <div class="form-group col-9">
            <label for=""> Classe</label>
            <input type="text" class="form-control" name="classe" placeholder="Inserisci classe">
          </div>

          <div class="form-group col-4">
            <label for="">Anno classificazione</label>
            <input type="text" pattern="(?=.*\d).{4,4}" maxlength="4" class="form-control" name="annoClassif" placeholder="Anno di classificazione">
            <span class="error"><?php echo $dataErr;?></span>
          </div>
          <div class="form-group col-8">
            <label for=""> Link di wikipedia</label>
            <input type="text" class="form-control" name="wikiLink"  placeholder="Inserisci link di wikipedia">
          </div>

          <div class="form-group col-3">
            <label for="">Vulnerabilità</label>
            <input type="text" pattern="(?=.*\d).{3,3}" maxlength="3" class="form-control" name="vulnerabilita" placeholder="Vulnerabilità">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-3">
            <label for="
            "> Altezza (cm)</label>
            <input type="text" class="form-control" name="cmAltezza" placeholder="Altezza in centimetri">
          </div>
          <div class="form-group col-3">
            <label for=""> Diametro (cm)</label>
            <input type="text" class="form-control" name="cmDiametro" placeholder="Diametro in centimetri">
          </div>
        </div>
        <div class="form-row">
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

          <!--<div class="form-group col-5">
          Se non è presente l'habitat di tuo interesse, aggiungine uno
          <button class="btn btn-info"  >
          <a href="inserisciHabitat.php"><i class="fa fa-plus" aria-hidden="true"> Aggiungi</i></a>
        </button>

      </div>-->

    </div>

    <div class="form-group col-3">
      <button type="submit" class="btn btn-success btn-block"><i class="fa fa-arrow-right"></i> Inserisci nuova specie  </button>
    </div>
  </form>
</div>
</div>
</body>
</html>
