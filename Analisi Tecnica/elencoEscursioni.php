<!DOCTYPE html>
<html lang="en" dir="ltr">

<!-- import scripts, css, user session -->
<?php include('header.php'); ?>

<body>
  <?php
  require_once('navbar.php');
  include('connection.php');

  $sql= "SELECT id, titolo, dataEscursione, oraPartenza, oraRitorno, descrizione, maxPartecipanti
         FROM escursione
         ";
  try {
    $stmt = $conn->prepare($sql);
    $stmt->execute();
  } catch (PDOException $e) {
    print $e;
    exit();
  }
  $result = $stmt->fetchAll();

  ?>
  <div class="container-fluid">
    <p><h2 class="text-dark"> Elenco delle escursioni</h2></p>
    <div class="container-fluid table">
      <table class="table table-striped table-sm table-bordered table-hover" id="table-specie">
          <thead class="thead-inverse ">
            <tr>
              <th>ESCURSIONE N°</th>
              <th>Titolo:</th>
              <th>Data:</th>
              <th>Orario di partenza:</th>
              <th>Orario di ritorno:</th>
              <th>Descrizione:</th>
              <th>Numero massimo di partecipanti:</th>
              <th></th>
            </tr>
          </thead>

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

            <tbody>
              <tr>
                <td><?= $f1 ?></td>
                <td><?= $f2 ?></td>
                <td><?= $f3 ?></td>
                <td><?= $f4 ?></td>
                <td><?= $f5 ?></td>
                <td><?= $f6 ?></td>
                <td><?= $f7 ?></td>
                <td>
                  <form action="partecipaEscursione_do.php" method="post">
                  <div class="form-group"  >
                    <div class="row">
                      <div class="col-12 vertical-center text-center">
                        <input type="hidden" name="idEscursione" value="<?php echo $f1; ?>" />
                        <button class="btn btn-success" >
                          <i class="fa fa-edit" aria-hidden="true"> Iscriviti</i>
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
              </td>
            </tr>
          </tbody>
          <?php endforeach; ?>

      </table>
    </div>
  </div>
</body>
</html>
