<?php
require_once('header.php');
?>

<body>
  <div class="container">
    <?php
    include('navbar.php');
    include('connection.php');
	  
	  $f1 = "";
	  $f1 = $_POST['nomeU'];
	  
	  
	  $sql= "CALL EliminaUtente($nomeU)";
	  if ($conn->query($sql) == TRUE) {
        echo "<br>Il profilo è stato eliminato correttamente.";
        header("refresh:3;url=./index.php");
        //require 'mongoDBconn.php';
      } else {
        echo "\nError: " . $sql . "<br>" . $conn->error;
        header("refresh:3;url=./myarea.php");
      }
      $conn->close();
	  ?>
	</div>

</body>
</html>