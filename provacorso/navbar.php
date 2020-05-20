
<nav class="navbar navbar-expand-lg navbar-fixed-top navbar-dark bg-success">
      <a class="navbar-brand" href="#">NATURE<i class="fa fa-user fa-2x"></i> </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      
        <div class="nav navbar-nav">
         
            <a class="nav-item nav-link <?=stristr($_SERVER['PHP_SELF'],'index.php')?'active':''?>" href="index.php"><i class="fa fa-user"></i> ELENCO UTENTI</a>
			
			<a class="nav-item nav-link <?=stristr($_SERVER['PHP_SELF'],'update.php')?'active':''?>" href="update.php"><i class="fa fa-user-plus"></i> NUOVO UTENTE</a>
			
		  </div>
		  
		<?php
			$recordPerPage = filter_input(INPUT_GET, 'recordPerPage', FILTER_VALIDATE_INT);
		?>
		  
		<form method='GET' class="form-inline pull-xs-right" action="index.php">
		  <span> Mostra</span> 
			<select class="form-control" id="recordPerPage" name="recordPerPage">
			<option <?=$recordPerPage === 5?'selected':''?> value="5">5</option>
			<option <?=$recordPerPage === 10?'selected':''?> value="10">10</option>
			<option <?=$recordPerPage === 15?'selected':''?> value="15">15</option>
			<option <?=$recordPerPage === 25?'selected':''?> value="25">25</option>
			  </select>
			
		<input type="search" value="<?= $search ?>" name="search" id="search" class="form-control" placeholder="parametro">
		
		<button tabindex="1" class="btn btn-primary">
			<i class="fa fa-search fa-fw"></i>CERCA</button>
			<button onClick="location.href='index.php'" class="btn btn-outline-danger" type="reset" name="reimposta"><i class="fa fa-eraser fa-fw"></i>REIMPOSTA</button>
		  
		  </form>
    </nav>
	
