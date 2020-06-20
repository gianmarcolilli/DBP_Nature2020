<?php
require_once('header.php');
require_once('navbar.php');
?>

<body>
<?php
include('connection.php');
$sql= "select 	
id, 
id2,
stato,
inizio,
descrizione,
maxImporto from raccoltafondi";
try {
  $stmt = $conn->prepare($sql);
  $stmt->execute();
} catch (PDOException $e) {
    print $e;
    exit();
}
$result = $stmt->fetchAll();
	
?>
<h2 class="text-success"> Elenco delle campagne di raccolta fondi</h2>
		  <?php
foreach ($result as $row) : 
	$f1=$row['id'];
	$f2=$row['id2'];
	$f3=$row['stato'];
	$f4=$row['inizio'];
	$f5=$row['descrizione'];
	$f6=$row['maxImporto'];
	$f7=$row[''];
	
	//intestazione di ogni riga della tabella
	$t1='ID campagna raccolta: ';
	$t2='Creatore della raccolta: ';
	$t3='Stato della raccolta: ';
	$t4='Inizio: ';
	$t5='Descrizione: ';
	$t6='Massimo importo da poter raccogliere: ';
	$t7='';
?>
<section class="showcase">
    <div class="container-fluid p-0">
      <div class="row no-gutters">

<div class="col-lg-6 order-lg-2  showcase-img" style="background-image:(/img/bg-showcase-2.jpg);"></div>
		  <div class="col-lg-6">
		  <table>
		 <tbody>
			 <tr><td> <h2><?=$t1?> <?= $f1?></h2></td></tr>
			
			 <tr> 
				<td><p class="lead mb-0"> <?=$t2?></p><p style="font-style: italic"><?= $f2?> </p>
				 </td>
			 </tr>
			<tr>
				<td><p class="lead mb-0"> <?=$t3?></p><p style="font-style: italic"><?= $f3?> </p>
				</td>
			 </tr>
		 	<tr>
				<td><p class="lead mb-0"> <?=$t4?></p><p style="font-style: italic"><?= $f4?> </p>
				</td>
			 </tr>
			 <tr>
				 <td><p class="lead mb-0"> <?=$t5?></p><p style="font-style: italic"><?= $f5?> </p>
				 </td>
			 </tr>
			 <tr>
				 <td><p class="lead mb-0"> <?=$t6?></p><p style="font-style: italic"><?= $f6?> </p>
				 </td>
			 </tr>
			 <br>
        </tbody>
	 </table>
	</div>
</div>
</div>
</section>
 <?php
endforeach; ?>
</body>
</html>