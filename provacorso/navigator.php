<?php

if(!$page){
	$page = 1;
}
$numPage = $config['numPagesNavigator'];
?>

<nav class="nav nav-inline">
	
	<?php
	$i = ($page - $numPagesNavigator) > 0 ? ($page - $numPagesNavigator) : 1;
	
		if($i<2) :?>
	
	<span class="nav-item">&lt; &lt; &lt;&nbsp;&nbsp;</span>
	
	<?php
	else : ?>
	
	<a class="nav-item nav-link" href="?<?=$urlParams?>&amp;page=<?=$i-1?>">&lt; &lt; &lt; </a>
	 
	<?php
	
	endif;
	   
	   for( ; $i < $page; $i++) :
	   
	   ?>
	
	<a class="nav-item nav-link" href="?<?=$urlParams?>&amp;page=<?=$i?>"><?=$i?> </a>
	
	<?php
		endfor;
	  ?>
	
	
	
	<span class="nav-item"><?=$page?></span>
	
	<?php
		for($i = $page +1; $i<$page +6; $i++) :
			if($i>$numPage){
				break;
	}
	?> 
	
	<a class="nav-item nav-link" href="?<?=$urlParams?>&amp;page<?=$i?>"></a>
	
	<?php
	endfor;
	   if($i < $numPage) : ?>
	
	<a class="nav-item nav-link" href="?<?=$urlParams?>&amp;page<?=$i+1?>"> &gt;&gt;&gt;</a>
	
	<?php
		else : ?> 
	 &gt;&gt;&gt;
	
	<?php		
		endif;
	?>
</nav>