<?php
if (isset($_SESSION['email']) && (!empty($_SESSION['email']))) {

  //Initialize var
  $tipoUtente = 'semplice';

  // Check se utente semplice
  $sql=$conn->query("SELECT email
                    FROM UTENTE
                    WHERE email='{$_SESSION['email']}'
                    AND tipo = 'semplice'
                    ");
  $count = mysqli_num_rows($sql);
  if ($count == 1){
    $tipoUtente = 'semplice';
  } else {
  // Check se utente premium
  $sql=$conn->query("SELECT email
                    FROM UTENTE
                    WHERE email='{$_SESSION['email']}'
                    AND tipo = 'premium'
                    ");
    if ($count == 1){
      $tipoUtente = 'premium';
    } else {
      // Check se utente amministratore
      $sql=$conn->query("SELECT email
                        FROM UTENTE
                        WHERE email='{$_SESSION['email']}'
                        AND tipo = 'amministratore'
                        ");
      $count = mysqli_num_rows($sql);
      if ($count == 1){
        $tipoUtente = 'amministratore';
      }
    }
  }
}
?>
