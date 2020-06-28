<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Progetto Basi di Dati 2020</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="css/landing-page.min.css" rel="stylesheet">


  <?php
  include("mysql.php");
  session_start();
  include("userLevel.php");
  ?>
</head>
<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand">Nature</a>
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
          <a class="nav-link" href="/nature/index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#">Area utente <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#">Messaggi <span class="sr-only">(current)</span></a>
        </li>
      </ul>
    </nav>


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
          $sqlP=$conn->query("
          SELECT nomeUtente, email, professione, annoNascita, tipo, classifTotali,classifCorrette, classifNonCorrette, affidabilita
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
    <div id="accordion">
      <div class="card">
        <div class="card-header" id="headingOne">
          <h5 class="mb-0">
            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              Riepilogo segnalazioni
            </button>
          </h5>

          <p align = center>
            <?php
            $cod = $nomeU = $data = $latGPS = $lonGPS = "";
            $sql=$conn->query("
            SELECT id, dataSegnalazione, latitudineGPS, longitudineGPS
            FROM SEGNALAZIONE, UTENTE
            WHERE UTENTE.nomeUtente = SEGNALAZIONE.nomeUtente
            AND email = '{$_SESSION['email']}'
            ");
            echo "<table class=\"table-sm table-bordered table-hover\">
            <thead>
            <tr align=\"center\">
            <th scope=\"col\">#</th>
            <th scope=\"col\">cod</th>
            <th scope=\"col\">data</th>
            <th scope=\"col\">latitudine</th>
            <th scope=\"col\">longitudine</th>
            </tr>
            </thead>
            <tbody>
            ";
            $count = mysqli_num_rows($sql);
            if($count > 0){
              while ($row = $sql->fetch_assoc()) {
                unset($cod, $nomeU, $data, $latGPS, $lonGPS);
                $cod = $row['id'];
                $nomeU = $row['nomeUtente'];
                $data = $row['dataSegnalazione'];
                $latGPS = $row['latitudineGPS'];
                $lonGPS = $row['longitudineGPS'];
                echo "<tr align=\"center\">
                <th scope=\"row\">$cod</th>
                <td>$cod</td>
                <td>$data</td>
                <td>$latGPS</td>
                <td>$lonGPS</td>
                </tr>
                ";
              }
              echo "</tbody>
              </table>
              ";
            } else {
              echo "</tbody>
              </table>
              ";
            }
            ?>

          </div>
          <div class="card">
            <div class="card-header" id="headingTwo">
              <h5 class="mb-0">
                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Escursioni aderite
                </button>
              </h5>
              <p align = center>
              </div>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                <div class="card-body">
                  <p align = "center">Qui è possibile trovare lo storico delle escursioni a cui hai aderito.</p>
                </div>
                <div class = "container">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">id</th>
                        <th scope="col">Titolo</th>
                        <th scope="col">Data</th>
                        <th scope="col">Partenza</th>
                        <th scope="col">Ritorno</th>
                        <th scope="col">Descrizione</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">*</th>
                        <td>*</td>
                        <td>*</td>
                        <td>*</td>
                        <td>*</td>
                        <td>*</td>
                      </tr>
                      <tr>
                        <th scope="row">*</th>
                        <td>*</td>
                        <td>*</td>
                        <td>*</td>
                        <td>*</td>
                        <td>*</td>
                      </tr>
                      <tr>
                        <th scope="row">*</th>
                        <td>*</td>
                        <td>*</td>
                        <td>*</td>
                        <td>*</td>
                        <td>*</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
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
                <div class="card-body">
                  <p align = "center">Qui è possibile trovare lo storico delle donazioni effettuato a raccolte fondi.</p>
                </div>
                <div class = "container">
                  <?php
                  $id = $nomeU = $importoD = $noteD = "";
                  $sql=$conn->query("
                  SELECT id, nomeUtente, importoDonazione, noteDonazione
                  FROM adesione
                  WHERE UTENTE.nomeUtente = ADESIONE.nomeUtente
                  ");
                  echo "<table class=\"table-sm table-bordered table-hover\">
                  <thead>
                  <tr align=\"center\">

                  <th scope=\"col\">id</th>
                  <th scope=\"col\">nome Utente</th>
                  <th scope=\"col\">importo donazione</th>
                  <th scope=\"col\">note donazione</th>
                  </tr>
                  </thead>
                  <tbody>
                  ";
                  $count = mysqli_num_rows($sql);
                  if($count > 0){
                    while ($row = $sql->fetch_assoc()) {
                      unset($id, $nomeU, $importD, $noteD);
                      $id = $row['id'];
                      $nomeU = $row['nomeUtente'];
                      $importoD = $row['importoDonazione'];
                      $noteD = $row['noteDonazione'];

                      echo "<tr align=\"center\">

                      <td>$id</td>
                      <td>$nomeU</td>
                      <td>$importoD</td>
                      <td>$noteD</td>
                      </tr>
                      ";
                    }
                    echo "</tbody>
                    </table>
                    ";
                  } else {
                    echo "</tbody>
                    </table>
                    ";
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>

          <!-- Bootstrap core JavaScript -->
          <script src="vendor/jquery/jquery.min.js"></script>
          <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
