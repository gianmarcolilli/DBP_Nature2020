<?php
require_once('header.php');
require_once('navbar.php');
?>

<body>
<?php
include('connection.php');
$sql= "select id,
titolo,
dataEscursione,
oraPartenza,
oraRitorno,
descrizione,
maxPartecipanti from escursione";
try {
  $stmt = $conn->prepare($sql);
  $stmt->execute();
} catch (PDOException $e) {
    print $e;
    exit();
}
$result = $stmt->fetchAll();
	
?>
<h2 class="text-info"> Elenco delle escursioni</h2>
		  
	
	<?php
foreach ($result as $row) : 
	$f1=$row['id'];
	$f2=$row['titolo'];
	$f3=$row['dataEscursione'];
	$f4=$row['oraPartenza'];
	$f5=$row['oraRitorno'];
	$f6=$row['descrizione'];
	$f7=$row['maxPartecipanti'];
	
	//intestazione di ogni riga della tabella
	$t1='ESCURSIONE N° ';
	$t2='Titolo: ';
	$t3='Data: ';
	$t4='Orario di partenza: ';
	$t5='Orario di ritorno: ';
	$t6='Descrizione: ';
	$t7='Numero massimo di partecipanti: ';
	?>
<!--<form action="adesioneEscursione_do.php" method="post">-->
<div id="accordion">
          <div class="card">
            <div class="card-header" id="headingOne">
              <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" name="id">
					<h4><?= $t1 ?><?= $f1 ?></h4>
                </button>
              </h5>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
              <div class="card-body">
                
                <div class = "container">
                  <table class="table table-hover">
                    <tbody>
						<tr>
                        <th scope="col"><?= $t2 ?></th>
						  <td><?= $f2 ?></td>
						</tr>
                     	<tr>
                        <th scope="col"><?= $t3 ?></th>
						  <td><?= $f3 ?></td>
						</tr>
						<tr>
                        <th scope="col"><?= $t4 ?></th>
						  <td><?= $f4 ?></td>
						</tr>
						<tr>
                        <th scope="col"><?= $t5 ?></th>
						  <td><?= $f5 ?></td>
						</tr>
						<tr>
                        <th scope="col"><?= $t6 ?></th>
						  <td><?= $f6 ?></td>
						</tr>
						<tr>
                        <th scope="col"><?= $t7 ?></th>
						  <td><?= $f7 ?></td>
						</tr>
				
                    </tbody>
                  </table>
					<div class="form-group col-3">
                    <button type="submit" class="btn btn-success btn-block"><i class="fa fa-arrow-right"></i> Iscriviti all'escursione  </button>
                  </div>		
                   
                </div>
              </div>
            </div>
		
		</div>
	</div>
    <!--</form>  -->
  <?php
endforeach; ?>
</body>
</html>