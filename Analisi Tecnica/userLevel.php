<?php
if (isset($_SESSION['email']) && (!empty($_SESSION['email']))) {
  $tipoUtente = 0;
  // Check se utente premium
  $sql=$conn->query("SELECT email FROM PREMIUM WHERE email='{$_SESSION['email']}'");
  $count = mysqli_num_rows($sql);
  if ($count == 1){
    $tipoUtente=1;
  } else {
    // Check se utente dipendente
    $sql=$conn->query("SELECT email FROM DIPENDENTE WHERE email='{$_SESSION['email']}'");
    $count = mysqli_num_rows($sql);
    if ($count == 1){
      $tipoUtente=2;
    } else {
      // Check se utente semplice
      $sql=$conn->query("SELECT email FROM SEMPLICE WHERE email='{$_SESSION['email']}'");
      $count = mysqli_num_rows($sql);
      if ($count == 1){
        $tipoUtente=3;
      }
    }
  }
}
?>
