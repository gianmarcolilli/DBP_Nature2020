<!DOCTYPE html>
<html lang="en" dir="ltr">

<!-- import scripts, css, user session -->
<?php include('header.php'); ?>

<body>

<!-- import navbar -->
<?php require_once('navbar.php');	?>

  <!-- Masthead -->
  <header class="masthead text-white text-center">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-xl-12 mx-auto">
          <h1 class="mb-5">Piattaforma di citizen science collaborativa per la
            gestione e classificazione della bio-diversità floristiche/faunistica</h1>
        </div>
        <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">

        </div>
      </div>
    </div>
  </header>


  <!-- Image Showcases -->
  <section class="showcase">
    <div class="container-fluid p-0">
      <div class="row no-gutters">
        <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('img/bg-robin.jpg');"></div>
        <div class="col-lg-6 order-lg-1 my-auto showcase-text">
          <a href="elencoSpecie.php"><h2><i class="fa fa-arrow-right"></i> Elenco delle specie</h2></a>
          <p class="lead mb-0">Cliccando sul link si visualizzerà l'elenco di tutte le specie faunistiche e floristiche. </p>
          <?php

          if($tipoUtente == 'amministratore'){  ?>

          <a href="inserisciSpecieA.php"><p class="lead mb-0"><i class="fa fa-plus"></i>Inserisci nuova specie animale</p></a>
          <a href="inserisciSpecieV.php"><p class="lead mb-0"><i class="fa fa-plus"></i>Inserisci nuova specie vegetale</p></a>
          <a href="inserisciHabitat.php"><p class="lead mb-0"><i class="fa fa-plus"></i>Inserisci nuovo habitat</p></a>

        <?php } ?>
			<a href="classificaSpecie.php"><p class="lead mb-0 text-left"><i class="fa fa-clipboard-list"></i> Classifica specie con più segnalazioni</p></a>

        </div>
      </div>
      <div class="row no-gutters">
        <div class="col-lg-6 text-white showcase-img" style="background-image: url('img/bg-donation.jpg');"></div>
        <div class="col-lg-6 my-auto showcase-text">
         <a href="elencoRaccoltaFondi.php"> <h2><i class="fa fa-arrow-right"></i> Elenco delle campagne di raccolta fondi</h2></a>
          <p class="lead mb-0">Potrai visualizzare l'elenco di tutte le campagne di raccolta fondi ancora aperte e potrai effettuare una donazione.</p>
			<?php
          if($tipoUtente == 'amministratore'){
			?>
          <a href="inserisciRaccolta.php"><p class="lead mb-0"><i class="fa fa-plus"></i>Inserisci nuova campagna di raccolta fondi</p></a>
			<?php } ?>
        </div>
      </div>
      <div class="row no-gutters">
        <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('img/bg-evening.jpg');"></div>
        <div class="col-lg-6 order-lg-1 my-auto showcase-text">
          <a href="elencoSegnalazioni.php"><h2><i class="fa fa-arrow-right"></i> Elenco delle segnalazioni di avvistamento</h2></a>
          <p class="lead mb-0">Potrai visualizzare tutte le segnalazioni di avvistamento effettuate dagli utenti iscritti alla piattaforma.</p>
			<?php
          if($tipoUtente != 'amministratore'){
			?>
          <a href="inserisciSegnalazione.php"><p class="lead mb-0"><i class="fa fa-plus"></i>Inserisci nuova segnalazione d'avvistamento</p></a>
			<?php } ?>
			<?php
          if($tipoUtente == 'amministratore'){
			?>
			<a href="elencoProposteClassif.php"><p class="lead mb-0"><i class="fa fa-edit"></i>Visualizza o modifica proposte di classificazione</p></a>
			<?php } ?>
        </div>
      </div>
      <div class="row no-gutters">
        <div class="col-lg-6 text-white showcase-img" style="background-image: url('img/wanderer.jpg');"></div>
        <div class="col-lg-6 my-auto showcase-text">
         <a href="./elencoEscursioni.php"> <h2> <i class="fa fa-arrow-right"></i> Elenco delle escursioni</h2></a>
         <p class="lead mb-0">Potrai visualizzare l'elenco di tutte escursioni effettuate e da effettuare a cui ci si può iscrivere.</p>
			<?php
          if($tipoUtente == 'premium'){
			?>
         <a href="inserisciEscursione.php"><p class="lead mb-0"><i class="fa fa-plus"></i>Inserisci nuova escursione</p></a>
			<?php } ?>
       </div>
     </div>
   </div>
 </section>

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

  <!-- Call to Action -->
  <section class="call-to-action text-white text-center">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-xl-9 mx-auto">
          <h2 class="mb-4">Ready to get started? Sign up now!</h2>
        </div>
        <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
          <form>
            <div class="form-row">
              <div class="col-12 col-md-9 mb-2 mb-md-0">
                <input type="email" class="form-control form-control-lg" placeholder="Enter your email...">
              </div>
              <div class="col-12 col-md-3">
                <button type="submit" class="btn btn-block btn-lg btn-primary">Sign up!</button>
              </div>
            </div>
          </form>
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

</body>

</html>
