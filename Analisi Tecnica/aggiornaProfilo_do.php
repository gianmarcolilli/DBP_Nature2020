<?php
require_once('header.php');
?>
<body>
  <?php
  include('navbar.php');
  include('connection.php');
  ?>

<?php
unset($f1,$f3,$f4,$t1,$t3,$t4,$f1Err,$f3Err,$f4Err,$contConvalida);
$f1=$_POST['inputUsername'];			$t1='username';
/*$f2=$_POST['inputEmail'];					$t2='email';*/
$f3=$_POST['inputProfession'];			$t3='professione';
$f4=$_POST['inputBirthdate'];				$t4='anno di nascita';
$contConvalida = 0;
if (empty($f1)) {
  $f1Err = "$t1" ." is required";
} else {
  $contConvalida++;
}

/*if (!empty($f2) || $f2 == "$t2") {
  $f2Err = "$t2" ." is required";
} else {
  $contConvalida++;
}*/

if (empty($f3)) {
  $f3Err = "$t3" ." is required";
} else {
  $contConvalida++;
}

if (empty($f4)) {
  $f4Err = "$t4"." is required";
} else {
  $contConvalida++;
}

if($contConvalida == 3){
  echo "<div class=\"text-success\">\n I campi sono stati compilati correttamente.</div>";
  $sql = "CALL updateUtente('$f1','$f3','$f4')";
  echo $sql;
  if ($conn->query($sql) == TRUE) {
    echo "<div class=\"text-success\"><br>Le modifiche sono state effettuate correttamente.</div>";
    //require 'mongoDBconn.php';
    header("refresh:3;url=./myarea.php");
  } else {
    echo "<div class=\"text-danger\">\nError: " . $sql . "<br></div>" . $conn->error;
  }
  $conn->close();


} else {
  echo "Try again, list of errors:";
  if(!empty($f1Err))
  echo "<br>" . $f1Err;
  /*if(!empty($f2Err))
  echo "<br>" . $f2Err;*/
  if(!empty($f3Err))
  echo "<br>" . $f3Err;
  if(!empty($f4Err))
  echo "<br>" . $f4Err;
  header("refresh:3;url=./myarea.php");
}
?>



</body>


</html>
