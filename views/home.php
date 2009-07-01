<?php
//*************************************************************
// Si on vient d'uploader des images, on les affiche
//*************************************************************
if($content != NULL){
?>
<p class="titre">
	<span>Vos images hébergées</span>
</p><br />
<?php echo $content;?>
<fieldset>
	<legend>Formulaire d'upload</legend>
	<ul>
		<li>Choisissez les images que vous voulez héberger sur le site.</li>
		<li>Les types de fichiers autorisés sont les suivants: .jpg, .jpeg, .gif, .png et .bmp.</li>
		<li>La taille maximale autorisée par fichier est de <?php echo ini_get('upload_max_filesize');?>.</li>
		<li>La taille maximal totale de vos fichiers autorisée est de <?php echo ini_get('post_max_size');?>.</li>
	</ul>
	<form class="formulaire" enctype="multipart/form-data" action="home.html" method="post" id="upload">
		<p id="inputFile"></p>
		<div id="filesList"></div>
		<p class="center"><input type="submit" name="uploader" class="button" value="Envoyer" onclick="this.value='Upload en cours...';" /></p>
	</form>
</fieldset>
<?php
}
//*************************************************************
// Sinon on affiche la page normale
//*************************************************************
else{
?>
<p class="titre">
	<span>Bienvenue sur Image-Upload !</span>
</p><br />
<fieldset>
	<legend>Etape n°1 | Sélectionnez les images</legend>
	<ul>
		<li>Choisissez les images que vous voulez héberger sur le site.</li>
		<li>Les types de fichiers autorisés sont les suivants: .jpg, .jpeg, .gif, .png et .bmp.</li>
		<li>La taille maximale autorisée par fichier est de <?php echo ini_get('upload_max_filesize');?>.</li>
		<li>La taille maximal totale de vos fichiers autorisée est de <?php echo ini_get('post_max_size');?>.</li>
	</ul>
	<form class="formulaire" enctype="multipart/form-data" action="home.html" method="post" id="upload">
		<p id="inputFile"></p>
		<div id="filesList"></div>
		</fieldset><br />
		<fieldset>
			<legend>Etape n°2 | Envoyez-les</legend>
			<ul>
				<li>L'espace disque n'étant pas infini, les plus vieilles images qui ne sont pas aux membres, seront effacées au moment voulu (minimum 6 mois).</li>
				<li>Attention, toutes images à caractères pornographiques, racistes ou incitant à la violence sont absolument interdites !</li>
				<li>Si vous avez correctement choisi vos images, cliquez sur le bouton "Envoyer".</li>
			</ul><br />
			<p class="center"><input type="submit" name="uploader" class="button" value="Envoyer" onclick="this.value='Upload en cours...';" /></p>
	</form>
</fieldset><br />
<?php
//*************************************************************
// Si personne n'est loggé on affiche ce paragraphe
//*************************************************************
if(!isLogged()){
?>
<fieldset>
	<legend>Etape facultative | Devenez membre</legend>
	<p>
		Si vous devenez membre, il vous suffira de vous connecter et vous aurez accès à toutes vos images et cela n'importe où dans le monde et vos images ne seront jamais effacées !<br />
	</p><br />
	<p class="center">
		<a href="signUp.html" class="fontBig">S'inscrire !</a>
	</p>
</fieldset><br />
<?php
}
}
?>
<!-- 
	JAVASCRIPT
-->
<!-- Script javascript pour le mutli-upload -->
<script type="text/javascript" src="models/js/multiFileUpload.js"></script>