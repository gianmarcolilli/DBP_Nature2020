   <?php
     require_once('header.php');
    ?>
  
  <body>
<div class="container">
   <?php
	  include('navbar.php');
	  /* define variables and set to empty values */
      $f1Err = $f2Err = $ff3Err = $f4Err = $f5Err = $f6Err = $f7Err = $f8Err = $f9Err = $f10Err = $f11Err = $f12Err = "";
      $f1 = $f2 = $f3 = $f4 = $f5 = $f6 = $f7 = $f8 = $f9 = $f10 = $f11 = $f12 =  "";
	$t1 = $t2 = $t3 = $t4 = $t5 = $t6 = $t7 = $t8 = $t9 = $t10 = $t11 = $t12 =  "";
	  
	$f1=$_POST['nomeLatino'];			$t1='nomeLatino';
	$f2=$_POST['tipo'];					$t2='tipo';		
	$f3=$_POST['nomeItaliano'];			$t3='nomeItaliano';
	$f4=$_POST['classe'];				$t4='classe';
	$f5=$_POST['annoClassif'];			$t5='annoClassif';
	$f6=$_POST['vulnerabilita'];		$t6='vulnerabilita';
	$f7=$_POST['wikiLink'];				$t7='wikiLink';
	$f8=$_POST['cmAltezza'];			$t8='cmAltezza';
	$f9=$_POST['cmDiametro'];			$t9='cmDiametro';
	$f10=$_POST['peso'];				$t10='peso';
	$f11=$_POST['mediaProle'];			$t11='mediaProle';
	$f12=$_POST['nomeHabitat'];			$t12='nomeHabitat';
	$contConvalida = 0;
	
	
	if (empty($f1) || $f1 == "$t1") {
          $f1Err = "$t1" ."is required";
        } else {
          $contConvalida++;
        }

        if (empty($f2) || $f2 == "$t2") {
          $f2Err = "$t2" ." is required";
        } else {
          $contConvalida++;
        }

        if (empty($f3) || $t3 == "$t3") {
          $f3Err = "$t3" ." is required";
        } else {
          $contConvalida++;
        }

        if (empty($f4) || $t4 == "$t4") {
          $f4Err = "$t4"."is required";
        } else {
          $contConvalida++;
        }
	
		if (empty($f5) || $t5 == "$t5") {
          $f5Err = "$t5"."is required";
        } else {
          $contConvalida++;
        }

		if (empty($f6) || $t6 == "$t6") {
          $f6Err = "$t6"."is required";
        } else {
          $contConvalida++;
        }
	
		if (empty($f7) || $t7 == "$t7") {
          $f7Err = "$t7"."is required";
        } else {
          $contConvalida++;
        }
	
		if (empty($f8) || $t8 == "$t8") {
          $f8Err = "$t8"."is required";
        } else {
          $contConvalida++;
        }
	
		if (empty($f8) || $t8 == "$t8") {
          $f8Err = "$t8"."is required";
        } else {
          $contConvalida++;
        }
	
		if (empty($f9) || $t9 == "$t9") {
          $f9Err = "$t9"."is required";
        } else {
          $contConvalida++;
        }
        
		if (empty($f10) || $t10 == "$t10") {
          $f10Err = "$t10"."is required";
        } else {
          $contConvalida++;
        }
	
		if (empty($f11) || $t11 == "$t11") {
          $f11Err = "$t11"."is required";
        } else {
          $contConvalida++;
        }
	
		if (empty($f12) || $t12 == "$t12") {
          $f12Err = "$t12"."is required";
        } else {
          $contConvalida++;
        }

        if($contConvalida == 6){
          echo "\n I campi sono stati compilati correttamente";
          $sql = "CALL inserisciSpecieFaunistica('$f1', '$f2', '$f3', '$f4', '$f5', '$f6', '$f7', '$f8', '$f9', '$f10', '$f11, '$f12')";
        if ($conn->query($sql) === TRUE) {
          echo "<br>La specie è stata inserita correttamente.";
          //require 'mongoDBconn.php';
          
        } else {
          echo "\nError: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
			
		header("refresh:3;url=./elencoSpecie.php");
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
		if(!empty($f8Err))
        echo "<br>" . $f8Err;
		if(!empty($f9Err))
        echo "<br>" . $f9Err;
		if(!empty($f10Err))
        echo "<br>" . $f10Err;
		if(!empty($f11Err))
        echo "<br>" . $f11Err;
		if(!empty($f12Err))
        echo "<br>" . $f12Err;
        header("refresh:3;url=./inserisciSpecie.php");
      }
	  ?>
	
          
	
</body>
