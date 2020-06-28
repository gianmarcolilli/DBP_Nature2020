<?php
    require_once "mysql.php";
    if(isset($_GET['foto'])) {
        $sql = "SELECT foto FROM segnalazione WHERE foto=" . $_GET['foto'];
		$result = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysqli_error($conn));
		$row = mysqli_fetch_array($result);
		header("Content-type: " . $row["imageType"]);
        echo $row["foto"];
	}
	mysqli_close($conn);
?>