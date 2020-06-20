<?php 
require_once("header.php");
?>

<body>
	<!-- Navigation -->
  <nav class="navbar navbar-fixed navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand" >Nature</a>
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
          <a class="nav-link" href="/nature/index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="/nature/myarea.php">Area utente <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#">Messaggi <span class="sr-only">(current)</span></a>
        </li>      </ul>
      <form class="form-inline my-2 my-lg-0">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">

        <?php
        if (isset($_SESSION['email']) && (!empty($_SESSION['email']))) {
        ?>

          <li class="nav-item">
            <span class="nav-link">Benvenuto,
              <?php
              $nome = "";
              $sql=$conn->query("SELECT nomeUtente
                                  FROM UTENTE
                                  WHERE email = '{$_SESSION['email']}'
                                ");
              unset($nome);
              while ($row = $sql->fetch_assoc()) {
                $nome = $row['nomeUtente'];
              }
              echo $nome."!";
              ?>
            </span>
          </li>
          <?php } ?>
          <li class="nav-item">
            <?php
            if (isset($_SESSION['email']) && (!empty($_SESSION['email']))) {
              ?>
              <a class="nav-link" href="./logout.php">Logout</a>
            <?php } ?>
          </li>
          <?php
          if (!isset($_SESSION['email']) && (empty($_SESSION['email']))) {
            ?>
            <li class="nav-item">
              <a class="nav-link" href="./login.html">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./register.html">Sign In</a>
            </li>
          <?php } ?>
        </ul>
      </form>
    </div>
  </nav> <!-- FINE NAVBAR -->
