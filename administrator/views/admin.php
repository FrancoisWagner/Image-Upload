<?php
$menu = '<div id="menuAdmin">';
for($i = 0;$i<$nbr;$i++){
	if($droit & $droitsNavigation[$i] AND $i != 0){
		$menu .= '
			<div class="menuAdmin">
				<span>
					<a href="'.$hrefNavigation[$i].'">
						<img src="views/images/'.$imagesMenu[$i].'" alt="" /><br />
						'.$menuNavigation[$i].'
					</a>
				</span>
			</div>
		';
	}
}
$menu .= '</div>';
?>
<div id="content">
	<div id="background">
		<h1>Bienvenue dans l'administration du site de <?php echo NOM_SITE;?></h1>
		<?php echo $menu;?>
		<div class="clear"></div>
	</div>
</div>