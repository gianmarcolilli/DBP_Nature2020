<?php
require_once('mysql.php');
if (isset($_SESSION['email']) && (!empty($_SESSION['email']))){
  $nome = "";
  $sql=$conn->query("SELECT nomeUtente
    FROM UTENTE
    WHERE email = '{$_SESSION['email']}'
    ");
    unset($nome);
    while ($row = $sql->fetch_assoc()) {
      $nome = $row['nomeUtente'];
    }

  }
  ?>
