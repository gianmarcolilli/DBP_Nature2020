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
			<label>Selezione il progetto di ricerca da associare alla campagna di raccolta:</label>
          <?php
            $sql=$conn->query("SELECT id FROM PROGETTORICERCA");
            echo "<select class=\"form-control\" id=\"idProgetto\" name=\"idPRicerca\">";
            echo "<option value=\"0\"> Seleziona codice di riferimento progetto</option>";
            //fetch_assoc() è un metodo che mi ritorna TRUE finchè ci sono delle righe nel DB
            while ($row = $sql->fetch_assoc()) {
              unset($idProgetto);
              $idProgetto = $row['id'];
              echo "<option value=\"$idProgetto\">Codice progetto di ricerca: $idProgetto</option>";
            }
            echo "</select>";
          ?>

          <br><br>
          <div class="form-group col-4">
            <label for="insert">Importo massimo</label>
            <input type="text" pattern="(?=.*\d).{4,}"class="form-control" name="maxImporto" placeholder="Stabilire importo da raggiungere">
          </div>

          <div class="form-group col-12">
            <label for="comment">Descrizione:</label>
            <textarea name="descrizione" class="form-control" rows="6" id="description"></textarea>
          </div>


          <div class="form-group">
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
  </div>
</body>
</html>
