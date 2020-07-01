<!DOCTYPE html>
<html lang="en" dir="ltr">

<!-- import scripts, css, user session -->
<?php include('header.php'); ?>

<body>

  <?php
  include('navbar.php');
  include('connection.php');

  ?>

  <!-- Visualizzazione profilo personale -->
  <div class="alert alert-info alert-dismissable" role="alert">
    <strong>Pagina di inserimento per le proposte di classificazione.</strong> Qui puoi aggiungere una proposta di classificazione relativa ad una segnalazione di avvistamento.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

  <br>
  <h3 align="center">Inserisci nuova proposta di classificazione</h3>

  <form action="inserisciProposta_do.php" method="post">
      <div class = "container">
        <div class="form-row">

          <div class="form-group col-3">
            <label for="insert">ID segnalazione di riferimento</label>
            <input type="text" class="form-control-plaintext text-uppercase" name="idS" value=<?php echo $_POST['idSegnalazione']; ?> readonly>
          </div>

          <div class="form-group col-9">
            <label for="insert">Seleziona la specie di interesse</label>
            <select class="form-control text-uppercase" id="nomeSpecie" name="nomeSpecie">
              <option value="0">-- seleziona una specie -- </option>
              <?php
              $sql= "select nomeLatino, nomeItaliano from specie";
              try {
                $stmt = $conn->prepare($sql);
                $stmt->execute();
              } catch (PDOException $e) {
                print $e;
                exit();
              }
              $result = $stmt->fetchAll();
              foreach ($result as $row) :
                $nomeLat=$row['nomeLatino'];
                $nomeIt=$row['nomeItaliano'];
                ?>
                <option value="<?= $nomeLat?>"> Nome Latino: <?= $nomeLat?> --> Nome Italiano: <?= $nomeIt?> </option>
                <?php
              endforeach;
              ?>
            </select>
          </div>

          <div class="form-group col-12">
            <label for="insert">Commento</label>
            <textarea type="text" class="form-control" name="commento" placeholder="Inserisci un commento per la proposta di classificazione " ></textarea>
          </div>

          <div class="form-group">
            <div class="col-12">
              <button type="submit" class="btn btn-success btn-block" ><i class="fa fa-arrow-right" ></i>
                Inserisci proposta
              </button>
            </div>
          </div>

        </div>
      </div>
  </form>

</body>
</html>
