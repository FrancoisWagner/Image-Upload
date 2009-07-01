<p class="titre">
	<span>Statistiques</span>
</p><br />
<fieldset>
	<legend>Statistiques | Image-Upload</legend>
	<span class="member">Nombre de membres: <span class="bold"><?php echo $nbrUsers;?></span></span><br /><br />
	<span class="image">Nombre d'images hébergées: <span class="bold"><?php echo $nbrImages;?></span></span><br /><br />
	<span class="size">Taille totale des images hébergées: <span class="bold"><?php echo $sizeImages;?></span></span><br /><br />
	<span class="visitors"><span class="bold"><?php echo $nbrVisitors;?></span> visiteur<?php if($nbrVisitors > 1){echo 's';}?> actuellement en ligne</span><br />
</fieldset><br />
<?php
// If a user is logged, we show him his statistics
if(isLogged()){
?>
	<fieldset>
		<legend>Statistiques | <?php echo htmlspecialchars($_SESSION['login']);?></legend>
		<span class="image">Nombre d'images hébergées: <span class="bold"><?php echo $nbrImagesUser;?></span></span><br /><br />
		<span class="size">Taille de toutes vos images hébergées: <span class="bold"><?php echo $sizeImagesUser;?></span></span><br /><br />
		<span class="date">Date de votre inscription sur le site: <span class="bold"><?php echo $dateSignUp;?></span></span><br />
	</fieldset>
<?php
}
?>