<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<!-- TemplateBeginEditable name="doctitle" -->
<title>Documento senza titolo</title>
<!-- TemplateEndEditable -->
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>

<body>
	<?php
	try{
		$pdo=new PDO('mysql:host=localhost; dbname=NATURE', 'root', 'Inter1048!');
	}
	catch(PDOException ex){
		echo("Connessione non riuscita");
		exit();
	}
	?>
</body>
</html>
