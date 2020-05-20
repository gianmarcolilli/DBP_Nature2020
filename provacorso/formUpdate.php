<form style="z-index: 20" id="formUpdate" action="updateRecord.php".php?<?= $qString ?>" method="POST">
	
	<input type="hidden" name="action" id="action" value="updateRecord">
	<input type="hidden" name="id" id="id" value="<?= $row['nomeLatino']?>">
	
	<div class="input-group margin-bottom-sm">
		<span class="input-group-addon"><i class="fa fa-user fa-fw" aria-hidden="true"</i></span>
	<input title="Nome Latino" placeholder="Nome Latino" pattern="[a-zA-z0-9]-\.\${6:128}" type="text" name="nomeLatino" class="form-control" value="<?= $row['nomeLatino']?>" id="nomeLatino " required >
	</div>
		
	<div class="input-group margin-bottom-sm">
		<span class="input-group-addon"><i class="fa fa-user fa-fw" aria-hidden="true"</i></span>
	<input title="Tipo" placeholder="Tipo" pattern="[a-zA-z0-9]-\.\${6:128}" type="text" name="tipo">
	</div>
		
	<div class="input-group margin-bottom-sm">
		<span class="input-group-addon"><i class="fa fa-user fa-fw" aria-hidden="true"</i></span>
	<input title="Classe" placeholder="Classe" pattern="[a-zA-z0-9]-\.\${6:128}" type="text" name="classe">
	</div>
		
	<div class="input-group margin-bottom-sm">
		<span class="input-group-addon"><i class="fa fa-user fa-fw" aria-hidden="true"</i></span>
	<input title="Anno di Classificazione" placeholder="Anno Classificazione" pattern="[a-zA-z0-9]-\.\${6:128}" type="text" name="annoClassif">
	</div>
		
	<div class="input-group margin-bottom-sm">
		<span class="input-group-addon"><i class="fa fa-user fa-fw" aria-hidden="true"</i></span>
	<input title="Vulnerabilità" placeholder="Vulnerabilità" pattern="[a-zA-z0-9]-\.\${6:128}" type="text" name="vulnerabilita">
	</div>
		
	<div class="input-group margin-bottom-sm">
		<span class="input-group-addon"><i class="fa fa-user fa-fw" aria-hidden="true"</i></span>
	<input title="Link di Wikipedia" placeholder="Link Wikipedia" pattern="[a-zA-z0-9]-\.\${6:128}" type="text" name="wikiLink">
	</div>
		
	<div class="input-group margin-bottom-sm">
		<span class="input-group-addon"><i class="fa fa-user fa-fw" aria-hidden="true"</i></span>
	<input title="Altezza (cm)" placeholder="Altezza" pattern="[a-zA-z0-9]-\.\${6:128}" type="text" name="cmAltezza">
	</div>
		
	<div class="input-group margin-bottom-sm">
		<span class="input-group-addon"><i class="fa fa-user fa-fw" aria-hidden="true"</i></span>
	<input title="Diametro (cm)" placeholder="Diametro" pattern="[a-zA-z0-9]-\.\${6:128}" type="text" name="cmDiametro">
	</div>
		
	<div class="input-group margin-bottom-sm">
		<span class="input-group-addon"><i class="fa fa-user fa-fw" aria-hidden="true"</i></span>
	<input title="Peso (g)" placeholder="Peso" pattern="[a-zA-z0-9]-\.\${6:128}" type="text" name="peso">
	</div>
	
	<div class="input-group margin-bottom-sm">
		<span class="input-group-addon"><i class="fa fa-user fa-fw" aria-hidden="true"</i></span>
	<input title="Media Prole" placeholder="Media Prole" pattern="[a-zA-z0-9]-\.\${6:128}" type="text" name="mediaProle">
	</div>
	

</form>