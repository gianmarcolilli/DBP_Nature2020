   <?php
     require_once('header.php');
    ?>
  
  <body>
<div class="container">
   <?php
	  include('navbar.php');
	include('connection.php');
	  /* define variables and set to empty values */
      	$f1Err = $f2Err = $f3Err = $f4Err = $f5Err = $f6Err = $f7Err  = "";
      	$f1 = $f2 = $f3 = $f4 = $f5 = $f6 = $f7 =  "";
		$t1 = $t2 = $t3 = $t4 = $t5 = $t6 = $t7 =   "";
	  
	$f1=$_POST['id'];						$t1='id';
	$f2=$_POST['titolo'];					$t2='titolo';	
	$f3=$_POST['data'];						$t3='data';
	$f4=$_POST['oraPartenza'];				$t4='oraPartenza';
	$f5=$_POST['oraRitorno'];				$t5='oraRitorno';
	$f6=$_POST['descrizione'];				$t6='descrizione';
	$f7=$_POST['maxPartecipanti'];			$t7='maxPartecipanti';
	
	
	$contConvalida = 0;
	
	
	if (empty($f1) || $f1 == "$t1") {
          $f1Err = "$t1" ." is required";
        } else {
          $contConvalida++;
        }

        if (empty($f2) || $f2 == "$t2") {
          $f2Err = "$t2" ." is required";
        } else {
          $contConvalida++;
        }

        if (empty($f3) || $f3 == "$t3") {
          $f3Err = "$t3" ." is required";
        } else {
          $contConvalida++;
        }

        if (empty($f4) || $f4 == "$t4") {
          $f4Err = "$t4"." is required";
        } else {
          $contConvalida++;
        }
	
		if (empty($f5) || $f5 == "$t5") {
          $f5Err = "$t5"." is required";
        } else {
          $contConvalida++;
        }

		if (empty($f6) || $f6 == "$t6") {
          $f6Err = "$t6"." is required";
        } else {
          $contConvalida++;
        }
	
		if (empty($f7) || $f7 == "$t7") {
          $f7Err = "$t7"." is required";
        } else {
          $contConvalida++;
        }
	
		
        if($contConvalida == 7){
          echo "<div class=\"text-success\">\n I campi sono stati compilati correttamente.</div>";
          $sql = "CALL inserisciEscursione('$f1', '$f2', '$f3', '$f4', '$f5', '$f6', '$f7')";
        if ($conn->query($sql) == TRUE) {
          echo "<div class=\"text-success\"><br>L'escursione è stata inserita correttamente.</div>";
          //require 'mongoDBconn.php';
          header("refresh:3;url=./elencoEscursioni.php");
        } else {
          echo "<div class=\"text-danger\">\nError: " . $sql . "<br></div>" . $conn->error;
        }
        $conn->close();
			
		
      } else {
        echo "Try again, list of errors:";
        if(!empty($f1Err))
        echo "<br>" . $f1Err;
        if(!empty($f2Err))
        echo "<br>" . $f2Err;
        if(!empty($f3Err))
        echo "<br>" . $f3Err;
        if(!empty($f4Err))
        echo "<br>" . $f4Err;
        if(!empty($f5Err))
        echo "<br>" . $f5Err;
        if(!empty($f6Err))
        echo "<br>" . $f6Err;
		if(!empty($f7Err))
        echo "<br>" . $f7Err;
		
        header("refresh:3;url=./inserisciEscursione.php");
      }
	  ?>
	
	  </div>  
	
</body>
