<?php
	$config = [
		'mysql_host'=>'localhost',
		'mysql_user'=>'root',
		'mysql_password'=>'root',
		'mysql_db'=> 'nature',
		'numPagesNavigator' => 5
	];

$orderByColumns = ['nomeLatino', 'tipo', 'nomeItaliano', 'classe', 'annoClassif', 'vulnerabilita', 'wikiLink', 'cmAltezza', 'cmDiametro', 'peso', 'mediaProle',];
return $config;
