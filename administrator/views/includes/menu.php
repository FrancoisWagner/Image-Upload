<ul id="navigation">	
	<?php
	for($i = 0;$i<count($droitsNavigation);$i++){
		if($droit & $droitsNavigation[$i]){
			echo '<li><a href="'.$hrefNavigation[$i].'">'.$menuNavigation[$i].'</a></li>';
		}
	}
	?>
</ul>