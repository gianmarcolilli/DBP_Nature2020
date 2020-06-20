<?php
  require_once('header.php');
	require_once('navbar.php');
?>
<body>

  <!-- Banner principale -->
  <header class="masthead text-white text-center">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-xl-12 mx-auto">
          <h1 class="mb-5">Piattaforma di citizen science collaborativa per la
            gestione e classificazione della bio-diversità floristiche/faunistica</h1>
        </div>
      </div>
    </div>
  </header>
    <!-- FINE Banner principale -->


  <?php
    // Controllo utente
    if (isset( $_SESSION['email'] ) && ( !empty($_SESSION['email'] ) ) ) {
  ?>

  <!-- Lettura utenti -->
  <section class="bg-light text-center">
    <br>
    <div class="container">
      <h2>Lettura utenti</h2>
    <br>
    <?php

      $sql=$conn->query("SELECT nomeUtente, email FROM UTENTE");
      echo "<select class=\"form-control\" id=\"tappaP\" name=\"tappaP\">";
      echo "<option value=\"0\">-- Seleziona una opzione --</option>";
      //fetch_assoc() è un metodo che mi ritorna TRUE finchè ci sono delle righe nel DB
      while ($row = $sql->fetch_assoc()) {
        unset($nomeUtente, $email);
        $nomeUtente = $row['nomeUtente'];
        $email = $row['email'];
        echo "<option value=\"$nomeUtente\">Utente: $nomeUtente --> email: $email</option>";
      }
      echo "</select>";
    ?>


    </div>
  <br><br>
  </section>

  <!-- Image Showcases -->
  <section class="showcase side-padding">
    <div align="center">
      <h2>Effettua segnalazione</h2>
    </div>
    <div class="container-fluid p-0">
      <div class="row row-padding">
        <div class="col-lg-6 col-md-6 col-sm-12 order-lg-1 my-auto" align="center">
          <p><b>Lista segnalazioni effettuate</b></p>
          <?php
          $nomeUtente = $dataSegnalazione = $latitudineGPS = $longitudineGPS = "";
          $sql=$conn->query(" SELECT nomeUtente, dataSegnalazione, latitudineGPS, longitudineGPS
                              FROM segnalazione
                            ");
          echo "<table class=\"table-sm table-bordered table-hover\">
                <thead>
                <tr align=\"center\">
                <th scope=\"col\">Nome utente</th>
                <th scope=\"col\">Data</th>
                <th scope=\"col\">Latitudine GPS</th>
                <th scope=\"col\">Longitudine GPS</th>
                </tr>
                </thead>
                <tbody>
                ";
          $count = mysqli_num_rows($sql);
          if($count > 0){
            while ($row = $sql->fetch_assoc()) {
              unset($nomeUtente, $dataSegnalazione, $latitudineGPS, $longitudineGPS);
              $nomeUtente = $row['nomeUtente'];
              $dataSegnalazione = $row['dataSegnalazione'];
              $latitudineGPS = $row['latitudineGPS'];
              $longitudineGPS = $row['longitudineGPS'];
              echo "<tr align=\"center\">
              <th scope=\"row\">$nomeUtente</th>
              <td>$dataSegnalazione</td>
              <td>$latitudineGPS</td>
              <td>$longitudineGPS</td>
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
        </div> <!-- Fine colonna -->
        <div class="col-lg-6 col-md-6 col-sm-12 order-lg-1 my-auto">
          <p><b>Inserisci una segnalazione</b></p>
          <p class="lead mb-0">Potrai visualizzare tutte le segnalazioni di avvistamento effettuate dagli utenti iscritti alla piattaforma.</p>
          <a href="inserisciSegnalazione.php"><p class="lead mb-0"><i class="fa fa-plus"></i>Inserisci nuova segnalazione d'avvistamento</p></a>
        </div>
      </div> <!-- Chiusura ROW -->

      <div class="row no-gutters">
        <div class="col-lg-6 text-white showcase-img" style="background-image: url('img/bg-showcase-2.jpg');"></div>
        <div class="col-lg-6 my-auto showcase-text">
         <a href="elencoRaccoltaFondi.php"> <h2>Elenco delle campagne di raccolta fondi</h2></a>
          <p class="lead mb-0">Potrai visualizzare l'elenco di tutte le campagne di raccolta fondi ancora aperte e potrai effettuare una donazione.</p>
			<a href="inserisciRaccolta.php"><p class="lead mb-0"><i class="fa fa-plus"></i>Inserisci nuova campagna di raccolta fondi</p></a>
        </div>
      </div>
      <div class="row row-padding">
        <div class="col-lg-6 col-md-6 col-sm-12 order-lg-1 my-auto">
          <a href="elencoSpecie.php"><h2>Elenco delle specie</h2></a>
          <p class="lead mb-0">Cliccando sul link si visualizzerà l'elenco di tutte le specie faunistiche e floristiche. </p>
          <a href="inserisciSpecieA.php"><p class="lead mb-0"><i class="fa fa-plus"></i>Inserisci nuova specie animale</p></a>
          <a href="inserisciSpecieV.php"><p class="lead mb-0"><i class="fa fa-plus"></i>Inserisci nuova specie vegetale</p></a>
          <a href="inserisciHabitat.php"><p class="lead mb-0"><i class="fa fa-plus"></i>Inserisci nuovo habitat</p></a>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 order-lg-1 my-auto">
          <a href="elencoSpecie.php"><h2>Elenco delle specie</h2></a>
          <p class="lead mb-0">Cliccando sul link si visualizzerà l'elenco di tutte le specie faunistiche e floristiche. </p>
          <a href="inserisciSpecieA.php"><p class="lead mb-0"><i class="fa fa-plus"></i>Inserisci nuova specie animale</p></a>
          <a href="inserisciSpecieV.php"><p class="lead mb-0"><i class="fa fa-plus"></i>Inserisci nuova specie vegetale</p></a>
          <a href="inserisciHabitat.php"><p class="lead mb-0"><i class="fa fa-plus"></i>Inserisci nuovo habitat</p></a></div>
      </div>
	    <div class="row no-gutters">
        <div class="col-lg-6 text-white showcase-img" style="background-image: url('img/bg-showcase-2.jpg');"></div>
        <div class="col-lg-6 my-auto showcase-text">
         <a href="elencoEscursioni.php"> <h2>Elenco delle escursioni</h2></a>
          <p class="lead mb-0">Potrai visualizzare l'elenco di tutte escursioni effettuate e da effettuare a cui ci si può iscrivere.</p>
			<a href="inserisciEscursione.php"><p class="lead mb-0"><i class="fa fa-plus"></i>Inserisci nuova escursione</p></a>
        </div>
      </div>
    </div>
  </section>


    <?php
        } else {
          ?>
          <br><br><br>
          <div class="container" align="center"><h3>Per poter visualizzare, esegui il <a href="./login.html">login</a>!</h3></div>
          <br><br><br>
          <?php
        }
    ?>

  <!-- Testimonials -->
  <section class="testimonials text-center bg-light">
    <div class="container">
      <h2 class="mb-5">What people are saying...</h2>
      <div class="row">
        <div class="col-lg-4">
          <div class="testimonial-item mx-auto mb-5 mb-lg-0">
            <img class="img-fluid rounded-circle mb-3" src="img/testimonials-1.jpg" alt="">
            <h5>Margaret E.</h5>
            <p class="font-weight-light mb-0">"This is fantastic! Thanks so much guys!"</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="testimonial-item mx-auto mb-5 mb-lg-0">
            <img class="img-fluid rounded-circle mb-3" src="img/testimonials-2.jpg" alt="">
            <h5>Fred S.</h5>
            <p class="font-weight-light mb-0">"Bootstrap is amazing. I've been using it to create lots of super nice landing pages."</p>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="testimonial-item mx-auto mb-5 mb-lg-0">
            <img class="img-fluid rounded-circle mb-3" src="img/testimonials-3.jpg" alt="">
            <h5>Sarah W.</h5>
            <p class="font-weight-light mb-0">"Thanks so much for making these free resources available to us!"</p>
          </div>
        </div>
      </div>
    </div>
  </section>



  <!-- Footer -->
  <footer class="footer bg-light">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
          <ul class="list-inline mb-2">
            <li class="list-inline-item">
              <a href="#">About</a>
            </li>
            <li class="list-inline-item">&sdot;</li>
            <li class="list-inline-item">
              <a href="#">Contact</a>
            </li>
            <li class="list-inline-item">&sdot;</li>
            <li class="list-inline-item">
              <a href="#">Terms of Use</a>
            </li>
            <li class="list-inline-item">&sdot;</li>
            <li class="list-inline-item">
              <a href="#">Privacy Policy</a>
            </li>
          </ul>

        </div>
        <div class="col-lg-6 h-100 text-center text-lg-right my-auto">

          <p class="text-muted small mb-4 mb-lg-0">&copy; Progetto Unibo di Basi di Dati - AA 2020 </p>

        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="css/style.css">
</body>

</html>
