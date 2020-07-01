<!DOCTYPE html>
<html lang="en" dir="ltr">

<!-- import scripts, css, user session -->
<?php include('header.php'); ?>

<body>

  <!-- import navbar -->
  <?php require_once('navbar.php');	?>


  <div class="alert alert-info alert-dismissable" role="alert">
    <strong>Benvenuto nell' area personale.</strong> Qui puoi visualizzare/modificare il tuo profilo.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

  <!-- Visualizzazione profilo personale -->
  <br>
  <h3 align="center">Your Profile</h3>
  <div class ="row">
    <div class = "container">
      <a href="elencoUtenti.php"><p class="lead mb-0 text-right"><i class="fa fa-address-book"></i> Visualizza altri utenti</p></a>

      <?php
      if (isset($_SESSION['email']) && (!empty($_SESSION['email']))) {
        $sqlP=$conn->query("SELECT nomeUtente, email, professione, annoNascita, tipo, classifTotali,classifCorrette, classifNonCorrette, affidabilita
                            FROM UTENTE
                            WHERE email = '{$_SESSION['email']}'
        ");
        while ($row = $sqlP->fetch_assoc()) {
          $nomeU = $row['nomeUtente'];
          $emailU = $row['email'];
          $professioneU = $row['professione'];
          $birthU = $row['annoNascita'];
          $tipoU = $row['tipo'];
          $classifU = $row['classifTotali'];
          $classifCU = $row['classifCorrette'];
          $classifNCU = $row['classifNonCorrette'];
          $affScore = $row['affidabilita'];
        }

        ?>

        <form action="aggiornaProfilo_do.php" method="post">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputUsername">Username</label>
              <input type="text" class="form-control" id="inputUsername" name="inputUsername" value="<?=$nomeU?>" readonly>
            </div>
            <div class="form-group col-md-6">
              <label for="inputEmail">Email</label>
              <input type="email" class="form-control" id="inputEmail" name="inputEmail" value="<?=$emailU?>" readonly>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="inputProfession">Professione</label>
              <input type="text" class="form-control" id="inputProfession" name='inputProfession' value="<?=$professioneU?>">
            </div>
            <div class="form-group col-md-4">
              <label for="inputBirthdate">Anno di nascita</label>
              <input type="text" pattern="(?=.*\d).{4,4}" maxlength="4" class="form-control" id="inputBirthdate" name="inputBirthdate" value="<?=$birthU?>">
            </div>
            <div class="form-group col-md-4">
              <label for="inputTipo">Tipo utente</label>
              <input type="text" class="form-control" id="inputTipo" readonly value="<?=$tipoU?>" >
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-3">
              <label for="inputProfession">Classificazioni totali</label>
              <input type="int" class="form-control" id="classif" readonly value="<?=$classifU?>" >
            </div>
            <div class="form-group col-md-3">
              <label for="inputBirthdate">Classificazioni corrette</label>
              <input type="int" class="form-control" id="classifc" readonly value="<?=$classifCU?>">
            </div>
            <div class="form-group col-md-3">
              <label for="inputTipo">Classificazioni non corrette</label>
              <input type="int" class="form-control" id="classifnc" readonly value="<?=$classifNCU?>" >
            </div>
            <div class="form-group col-md-3">
              <label for="inputTipo">Affidabilità</label>
              <input type="float" class="form-control" id="affid" readonly value="<?=$affScore?>" >
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-8">
                <button type="submit" class="btn btn-success btn-block"><i class="fa fa-arrow-right"></i>
                  Aggiorna il profilo
                </button>
              </div>
            </div>
          </div>
        </form>


        <?php


      } else {
        ?>
        <br><br><br>
        <div class="container" align="center"><h3>Per accedere all'area utente, esegui il <a href="./login.html">login</a>!</h3></div>
        <?php
      }
      ?>

    </div>
  </div>



  <!-- Riepilogo segnalazioni -->

  <br><br>
  <div class="container-fluid" id="accordion">
    <div class="card">
      <div class="card-header" id="headingOne">
        <h5 class="mb-0">
          <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            Riepilogo segnalazioni
          </button>
        </h5>
      </div>
      <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
        <p align = center>
          <?php
          $cod = $nomeU = $data = $latGPS = $lonGPS = "";
          $sql=$conn->query(" SELECT S.id, S.nomeUtente, S.dataSegnalazione, S.latitudineGPS, S.longitudineGPS, S.foto, S.nomeHabitat
                              FROM SEGNALAZIONE AS S, UTENTE AS U
                              WHERE U.nomeUtente = S.nomeUtente
                              AND email = '{$_SESSION['email']}'
                              "); ?>
            <div class = "container">
              <table class="table table-striped table-sm table-bordered table-hover">
                <thead>
                  <tr>
                    <th scope="col">id</th>
                    <th scope="col">Data</th>
                    <th scope="col">Latitudine GPS</th>
                    <th scope="col">Longitudine GPS</th>
                    <th scope="col">foto</th>
                    <th scope="col">nome Habitat</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $count = mysqli_num_rows($sql);
                  if($count > 0){
                    while ($row = $sql->fetch_assoc()) {
                      unset($cod, $nomeU, $data, $latGPS, $lonGPS, $nomeH);
                      $cod = $row['id'];
                      $nomeH = $row['nomeHabitat'];
                      $data = $row['dataSegnalazione'];
                      $latGPS = $row['latitudineGPS'];
                      $lonGPS = $row['longitudineGPS'];?>
                      <tr>
                        <th scope=\"row\"><?= $cod?></th>
                        <td><?= $data?></td>
                        <td><?= $latGPS?></td>
                        <td><?= $lonGPS?></td>
                        <td><? ?></td>
                        <td><?= $nomeH?></td>
                      </tr>
                      <?php
                    }
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </p>
          </div>
        </div>

        <div class="card">
          <div class="card-header" id="headingTwo">
            <h5 class="mb-0">
              <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Escursioni aderite
              </button>
            </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
            <p align = center>
              <?php
              $id = $titolo = $data = $oraP = $oraR = $desc = $maxP = $utCrea = "";
              require_once('mostraNomeUtenteSessione.php');
              $sql=$conn->query(" SELECT E.id, E.titolo, E.dataEscursione, E.oraPartenza, E.oraRitorno, E.descrizione, E.maxPartecipanti, E.utenteCreatore
                                  FROM ESCURSIONE as E, PARTECIPAZIONE_ESCURSIONE as P
                                  WHERE P.utentePartecipante = '$nome' AND P.idESC = E.id
                                  AND P.utenteCreatore = E.utenteCreatore
                "); ?>
                <div class = "container">
                  <table class="table table-striped table-sm table-bordered table-hover">
                    <thead>
                      <tr>
                        <th scope="col">id</th>
                        <th scope="col">Titolo</th>
                        <th scope="col">Data</th>
                        <th scope="col">Ora partenza</th>
                        <th scope="col">Ora ritorno</th>
                        <th scope="col">Descrizione</th>
                        <th scope="col">Max partecipanti</th>
                        <th scope="col">Utente organizzatore</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $count = mysqli_num_rows($sql);
                      if($count > 0){
                        while ($row = $sql->fetch_assoc()) {
                          unset($id, $titolo, $data,  $oraR, $oraP, $desc, $maxP, $utCrea);
                          $id = $row['id'];
                          $titolo = $row['titolo'];
                          $data = $row['dataEscursione'];
                          $oraP = $row['oraPartenza'];
                          $oraR = $row['oraRitorno'];
                          $desc = $row['descrizione'];
                          $maxP = $row['maxPartecipanti'];
                          $utCrea = $row['utenteCreatore'];?>
                          <tr>
                            <th scope=\"row\"><?= $id?></th>
                            <td><?= $titolo?></td>
                            <td><?= $data?></td>
                            <td><?= $oraP?></td>
                            <td><?= $oraR ?></td>
                            <td><?= $desc?></td>
                            <td><?= $maxP?></td>
                            <td><?= $utCrea?></td>
                          </tr>
                          <?php
                        }
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </p>
              </div>
            </div>

            <div class="card">
              <div class="card-header" id="headingThree">
                <h5 class="mb-0">
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Storico donazioni
                  </button>
                </h5>
              </div>

              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
              <p align = center>
                <?php

                require_once('mostraNomeUtenteSessione.php');
                $sql=$conn->query(" SELECT ADESIONE.id, ADESIONE.importoDonazione, ADESIONE.noteDonazione, RACCOLTAFONDI.descrizione
                  FROM ADESIONE, RACCOLTAFONDI
                  WHERE ADESIONE.nomeUtente = '$nome' AND ADESIONE.id = RACCOLTAFONDI.id
                  "); ?>
                  <div class = "container">
                    <table class="table table-striped table-sm table-bordered table-hover">
                      <thead>
                        <tr>
                          <th scope="col">id</th>
                          <th scope="col">Descrizione</th>
                          <th scope="col">Importo Donazione</th>
                          <th scope="col">Note donazione</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $count = mysqli_num_rows($sql);
                        if($count > 0){
                          while ($row = $sql->fetch_assoc()) {
                            unset($id, $desc, $importo, $note);
                            $id = $row['id'];
                            $desc = $row['descrizione'];
                            $importo = $row['importoDonazione'];
                            $note = $row['noteDonazione'];
                            ?>
                            <tr>
                              <th scope=\"row\"><?= $id?></th>
                              <td><?= $desc?></td>
                              <td><?= $importo?></td>
                              <td><?= $note?></td>
                            </tr>
                            <?php
                          }
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </p>
                </div>
              </div>
            </div> <!-- close container-fluid -->

            <!-- Bootstrap core JavaScript -->
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
          </body>
          </html>
