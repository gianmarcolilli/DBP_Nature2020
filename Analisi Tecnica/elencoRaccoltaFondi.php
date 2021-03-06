<!DOCTYPE html>
<html lang="en" dir="ltr">

<!-- import scripts, css, user session -->
<?php include('header.php'); ?>

<body>
  <?php
  	include('navbar.php');
    include('connection.php');
  $sql = "SELECT id, id2, stato, inizio, descrizione, maxImporto
          FROM raccoltafondi
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
    <p><h2 class="text-dark"> Elenco delle raccolte fondi</h2></p>
    <div class="container-fluid table">
      <table class="table table-striped table-sm table-bordered table-hover" id="table-specie">
          <thead class="thead-inverse ">
            <tr>
              <th>Id della raccolta fondi</th>
              <th>Id del progetto ricerca</th>
              <th>Stato:</th>
              <th>Data inizio:</th>
              <th>Descrizione:</th>
              <th>Importo massimo:</th>
              <th></th>
            </tr>
          </thead>

      <?php
      foreach ($result as $row) :
        $f1=$row['id'];
        $f2=$row['id2'];
        $f3=$row['stato'];
        $f4=$row['inizio'];
        $f5=$row['descrizione'];
        $f6=$row['maxImporto'];


        //intestazione di ogni riga della tabella
        $t1='ID campagna raccolta: ';
        $t2='Creatore della raccolta: ';
        $t3='Stato della raccolta: ';
        $t4='Inizio: ';
        $t5='Descrizione: ';
        $t6='Massimo importo da poter raccogliere: ';

        ?>
        <tbody>
          <tr>
            <td ><?= $f1?></td>
            <td ><?= $f2?></td>
            <td ><?= $f3?></td>
            <td ><?= $f4?></td>
            <td ><?= $f5?></td>
            <td ><?= $f6?></td>

            <td>
              <form action="adesioneRaccolta.php" method="post">
              <div class="form-group"  >
                <div class="row">
                  <div class="col-12 vertical-center text-center">
                    <input type="hidden" name="idRaccoltaFondi" value="<?php echo $f1; ?>" />
                    <button class="btn btn-success" >
                      <i class="fa fa-edit" aria-hidden="true"> Aderisci</i>
                    </button>
                  </div>
                </div>
              </div>
            </form>
            </td>

          </tr>
        </tbody>
        <?php
      endforeach; ?>

    </table>
  </div>
</body>
</html>
