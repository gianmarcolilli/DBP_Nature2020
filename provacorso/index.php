<?php
//error_reporting(0);
require_once 'function.php';


$search = getFromGet('search', '');

require_once 'header.php';
require_once 'navbar.php';

//da input_get voglio che la stringa sia pulita come da funzione getFromGet
$orderBy = getFromGet('orderBy', 'nomeLatino');

//2^ verifica che il valore di orderBy si trovi all'interno di OrderByColumns altrimenti passo quello di default
$orderBy = in_array($orderBy, $orderByColumns) ? $orderBy : 'nomeLatino';
//legge parametri che passa orderDir e se non è settato=> di default mette ASC
$orderDir = getFromGet('orderDir', 'ASC');

$recordPerPage = getFromGet('recordPerPage', 10, 'int');

$page = getFromGet('page', 0, 'int');

$params = [
	'orderBy' => $orderBy,
	'orderDir' => $orderDir,
	'start' => $page,
	'limit' => $recordPerPage,
	'search' => $search
];

$totalRecords = getTotalSpecie(['search'=> $search]);

$numPages = ceil($totalRecords/$recordPerPage);
//costruttore url come orderBy=nomeLatino&orderDir=desc
$urlParams = http_build_query($params, '', '&amp;').'&amp;recordPerPage='.$recordPerPage;
$result = getSpecie($params);

$orderParam= $orderDir === 'ASC'? 'DESC' : 'ASC';

$message = getFromGet('message');
	if($message): ?>
<div class="text-info"><?$message?></div>
<?php
endif;
?>
<table class="table table-striped" id="table-specie">
	<thead>
		
		<th <?=$orderBy==='nomeLatino'?" class='$orderDir'":''?>>
			<a href="index.php?orderBy=nomeLatino&amp;orderDir=<?=$orderParam?>"> NOME LATINO </a></th>
		<th <?=$orderBy==='tipo'?" class='$orderDir'":''?>>
			<a href="index.php?orderBy=tipo&amp;orderDir=<?=$orderParam?>">TIPO</a></th>
		<th <?=$orderBy==='nomeItaliano'?" class='$orderDir'":''?>>
			<a href="index.php?orderBy=nomeItaliano&amp;orderDir=<?=$orderParam?>">NOME ITALIANO</a></th>
		<th <?=$orderBy==='classe'?" class='$orderDir'":''?>>
			<a href="index.php?orderBy=classe&amp;orderDir=<?=$orderParam?>">CLASSE</a></th>
		<th <?=$orderBy==='annoClassif'?" class='$orderDir'":''?>>
			<a href="index.php?orderBy=annoClassif&amp;orderDir=<?=$orderParam?>">ANNO CLASSIFICAZIONE</a></th>
		<th <?=$orderBy==='vulnerabilita'?" class='$orderDir'":''?>>
			<a href="index.php?orderBy=vulnerabilita&amp;orderDir=<?=$orderParam?>">VULNERABILITA'</a></th>
		<th <?=$orderBy==='wikiLink'?" class='$orderDir'":''?>>
			<a href="index.php?orderBy=wikiLink&amp;orderDir=<?=$orderParam?>">LINK WIKIPEDIA</a></th>
		<th <?=$orderBy==='cmAltezza'?" class='$orderDir'":''?>>
			<a href="index.php?orderBy=cmAltezza&amp;orderDir=<?=$orderParam?>">ALTEZZA (cm)</a></th>
		<th <?=$orderBy==='cmDiametro'?" class='$orderDir'":''?>>
			<a href="index.php?orderBy=cmDiametro&amp;orderDir=<?=$orderParam?>">DIAMETRO (cm)</a></th>
		<th <?=$orderBy==='peso'?" class='$orderDir'":''?>>
			<a href="index.php?orderBy=peso&amp;orderDir=<?=$orderParam?>">PESO (kg)</a></th>
		<th <?=$orderBy==='mediaProle'?" class='$orderDir'":''?>>
			<a href="index.php?orderBy=mediaProle&amp;orderDir=<?=$orderParam?>">MEDIA PROLE</a></th>
		
		<tr> <td class="text-success text-xs-center" colspan="5"> Record trovati <?=$totalRecords?> /
			Numero pagine = <?=$numPages?></td></tr>
	</thead>



<?php
if($result) : ?>
	<tbody>
	<?php
	foreach ($result as $specie ) : ?>
		<tr>
			<td>
				<?=$specie['nomeLatino']?>
			</td>
				
			<td>
				<?=$specie['tipo']?>
			</td>
				
			<td>
				<?=$specie['nomeItaliano']?>
			</td>

			<td>
				<?=$specie['classe']?>
			</td>

			<td>
				<?=$specie['annoClassif']?>
			</td>

			<td>
				<?=$specie['vulnerabilita']?>
			</td>

			<td>
				<a href="<?=$specie['wikiLink']?>" target="_blank"> <?=$specie['wikiLink']?></a>
			</td>

			<td>
				<?=$specie['cmAltezza']?>
			</td>

			<td>
				<?=$specie['cmDiametro']?>
			</td>
			
			<td>
				<?=$specie['peso']?>
			</td>
			
			<td>
				<?=$specie['mediaProle']?>
			</td>
			<td class="p-a-0 text-sm-left">
				
				<a class="btn btn-success btn-sm" href="updateRecord.php?action=update&amp;nomeLatino=<?=$specie['nomeLatino']?>&amp;<?=$Params?>&amp;">
					<i class="fa fa-pencil-square"></i>&nbsp; MODIFICA
				</a>
				
				<a onClick="return confirm('vuoi eliminare il record?')" class="btn btn-danger btn-sm" href="updateRecord.php?action=delete&amp;nomeLatino=<?=$specie['nomeLatino']?>&amp;<?=$Params?>&amp;">
					<i class="fa fa-trash" ></i>&nbsp; ELIMINA
				</a>
				   
			</td>

		
		</tr>


<?php
endforeach; ?>
	</tbody>
	
	<tfoot>
		<tr>
			<td colspan="4" class="text-xs-center">
			<?php
				require_once'navigator.php';
			?>
			</td>
			<td class="text-info">
				<?php
				$recordsDi = $page*$recordPerPage;
					if($recordsDi > $totalRecords){
						$recordsDi = $totalRecords;
					}
				?>
				<?=($recordsDi)?> di <?=$totalRecords?>
			</td>
		
		</tr>
	</tfoot>
	
	<?php
	else : ?>
	<tr><th class="text-info text-xs-center" colspan="5"><h3>Nessun record trovato!!</h3></th></tr>
<?php
endif;
	?>
	</table>
		
<?php
require_once 'footer.php';

?>