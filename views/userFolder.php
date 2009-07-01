<div id="filterUserFolder"></div>
	<div id="boxUserFolder">
	<div id="boxheaderUserFolder">
		<span id="boxtitleUserFolder"></span>
		<span id="boxcloseUserFolder"><a href="javascript:hide('filterUserFolder');javascript:hide('boxUserFolder');">Fermer</a></span>
	</div>
	<div id="boxcontentUserFolder">
	</div>
</div>
<p class="titre">
	<span>Mon compte</span>
</p><br />
<?php
if($currentCategory == 1){
?>
<!-- *********************************************** -->
<!-- LES CATEGORIES -->
<!-- *********************************************** -->
<fieldset>
	<legend>Mes catégories</legend>
	<div id="categories"></div><br />
	<table id="table" class="sortable" cellpadding="0" cellspacing="0" border="0" >
		<thead>
			<tr>
				<th class="nosort"><input type="checkbox" onclick="javascript:checkAll('category',this.checked);" id="checkboxAllcategory" /></th>
				<th><h3>Nom</h3></th>
				<th class="nosort">Poids</th>
				<th><h3>Nombres d'images</h3></th>
				<th class="nosort">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php echo $contentCategories;?>
		</tbody>
	</table><br />
	<div class="controls">
		<span class="perpage">
			<select id="categorySize" onchange="sorter.size(this.value)">
				<option value="5">5</option>
				<option value="10">10</option>
				<option value="20" selected="selected">20</option>
				<option value="50">50</option>
				<option value="100">100</option>
			</select>
			<span>Entrées par page</span>
		</span>
		<span class="navigation">
			<img src="views/images/icones/first.png" width="16" height="16" alt="First Page" onclick="uncheckAll('category');sorter.move(-1,true)" />
			<img src="views/images/icones/previous.png" width="16" height="16" alt="First Page" onclick="uncheckAll('category');sorter.move(-1)" />
			<img src="views/images/icones/next.png" width="16" height="16" alt="First Page" onclick="uncheckAll('category');sorter.move(1)" />
			<img src="views/images/icones/last.png" width="16" height="16" alt="Last Page" onclick="uncheckAll('category');sorter.move(1,true)" />
		</span>
		<span class="text">Affichage de la page <span id="currentpage"></span> sur <span id="pagelimit"></span></span>
		<p>
			Pour la sélection: <a href="javascript:deleteCategoryChecked('<?php echo htmlspecialchars($_SESSION['login']);?>');">Supprimer</a>
		</p>
	</div><br />
</fieldset><br />
<!-- *********************************************** -->
<!-- AJOUTER UNE CATEGORIE -->
<!-- *********************************************** -->
<fieldset>
	<legend>Ajout d'une catégorie</legend>
	<ul>
		<li>Entrer le nom de la catégorie que vous voulez ajouter</li>
		<li>Les accents sont autorisés, mais les caractères spéciaux ne le sont pas</li>
		<li>Le dossier sera ajouté à la racine, vous ne pouvez pas créer de sous-dossiers</li>
	</ul>
	<form class="formulaire" action="javascript:addCategory('<?php echo htmlspecialchars($_SESSION['login']);?>');" method="post">
		<p><label for="category">Nom de votre catégorie: </label><input id="category" name="category" type="text" size="40" maxlength="15" /></p>
		<p class="center"><input type="submit" class="button" value="Ajouter" /></p>
	</form>
</fieldset><br />
<?php
}
else{
?>
<fieldset>
	<legend>Actions</legend>
	<p class="line48px">
		<img src="views/images/return.png" alt="" />  <a href="userFolder.html">Retour</a>
	</p>
	<div class="line16px">
		<?php echo $contentImagesDiapo;?>
	</div>
</fieldset><br />
<?php
}
?>
<!-- *********************************************** -->
<!-- LES IMAGES -->
<!-- *********************************************** -->
<fieldset>
	<legend>Mes images</legend>
	<a href="userFolderV1.html">Voir toutes vos images (y compris les images de la V1 d'Image-Upload).</a><br />
	<div id="images"></div><br />
	<table id="table2" class="sortable" cellpadding="0" cellspacing="0" border="0" >
		<thead>
			<tr>
				<th class="nosort"><input type="checkbox" id="checkboxAllimage" onclick="javascript:checkAll('image',this.checked);" /></th>
				<th><h3>Nom</h3></th>
				<th class="nosort">Taille</th>
				<th class="nosort">Poids</th>
				<th><h3>Date d'envoi</h3></th>
				<th class="nosort">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php echo $contentImages;?>
		</tbody>
	</table><br />
	<div class="controls">
		<span class="perpage">
			<select id="imageSize" onchange="sorter2.size(this.value)">
				<option value="5">5</option>
				<option value="10">10</option>
				<option value="20" selected="selected">20</option>
				<option value="50">50</option>
				<option value="100">100</option>
			</select>
			<span>Entrées par page</span>
		</span>
		<span class="navigation">
			<img src="views/images/icones/first.png" width="16" height="16" alt="First Page" onclick="uncheckAll('image');sorter2.move(-1,true)" />
			<img src="views/images/icones/previous.png" width="16" height="16" alt="First Page" onclick="uncheckAll('image');sorter2.move(-1)" />
			<img src="views/images/icones/next.png" width="16" height="16" alt="First Page" onclick="uncheckAll('image');sorter2.move(1)" />
			<img src="views/images/icones/last.png" width="16" height="16" alt="Last Page" onclick="uncheckAll('image');sorter2.move(1,true)" />
		</span>
		<span class="text">Affichage de la page <span id="currentpage2"></span> sur <span id="pagelimit2"></span></span>
		<p>
			Pour la sélection: <a href="javascript:deleteImagesChecked('<?php echo htmlspecialchars($_SESSION['login']);?>');">Supprimer</a> | <select id="categoryToMove" onchange="moveImages('<?php echo htmlspecialchars($_SESSION['login']);?>');"><option selected="selected">Déplacer</option><option>Racine de votre dossier</option><?php echo $listCategories;?></select>
		</p>
	</div><br />
</fieldset><br />
<!-- *********************************************** -->
<!-- LE FORMULAIRE D UPLOAD-->
<!-- *********************************************** -->
<fieldset id="formUpload">
	<legend>Formulaire d'upload</legend>
	<ul>
		<li>Choisissez les images que vous voulez héberger sur le site.</li>
		<li>Les types de fichiers autorisés sont les suivants: .jpg, .jpeg, .gif, .png et .bmp.</li>
		<li>La taille maximale autorisée par fichier est de <?php echo ini_get('upload_max_filesize');?>.</li>
		<li>La taille maximal totale de vos fichiers autorisée est de <?php echo ini_get('post_max_size');?>.</li>
	</ul>
	<form class="formulaire" enctype="multipart/form-data" action="home.html" method="post" id="upload">
		<p><input type="hidden" name="category" value="<?php echo $currentCategory;?>" /></p>
		<p id="inputFile"></p>
		<div id="filesList"></div>
		<p class="center"><input type="submit" name="uploader" class="button" value="Envoyer" onclick="this.value='Upload en cours...';" /></p>
	</form>
</fieldset><br />
<!-- 
	JAVASCRIPT
-->
<!-- Script javascript pour le mutli-upload -->
<script type="text/javascript" src="models/js/multiFileUpload.js"></script>
<script type="text/javascript">
<?php
if($currentCategory == 1){
?>
	var sorter = new TINY.table.sorter("sorter");
	sorter.head = "head";
	sorter.asc = "asc";
	sorter.desc = "desc";
	sorter.even = "evenrow";
	sorter.odd = "oddrow";
	sorter.evensel = "evenselected";
	sorter.oddsel = "oddselected";
	sorter.paginate = true;
	sorter.currentid = "currentpage";
	sorter.limitid = "pagelimit";
	sorter.init("table",1);
	
<?php
}
?>
	var sorter2 = new TINY.table.sorter("sorter2");
	sorter2.head = "head";
	sorter2.asc = "asc";
	sorter2.desc = "desc";
	sorter2.even = "evenrow";
	sorter2.odd = "oddrow";
	sorter2.evensel = "evenselected";
	sorter2.oddsel = "oddselected";
	sorter2.paginate = true;
	sorter2.currentid = "currentpage2";
	sorter2.limitid = "pagelimit2";
	sorter2.init("table2",1);
</script>
<script type="text/javascript" src="models/js/highslide-4.1.4/highslide/highslide-with-gallery.packed.js"></script>
<script type="text/javascript">
	hs.graphicsDir = 'models/js/highslide-4.1.4/highslide/graphics/';
	hs.align = 'center';
	hs.transitions = ['expand', 'crossfade'];
	hs.wrapperClassName = 'dark borderless floating-caption';
	hs.fadeInOut = true;
	hs.dimmingOpacity = .75;

	// Add the controlbar
	if (hs.addSlideshow) hs.addSlideshow({
		//slideshowGroup: 'group1',
		interval: 5000,
		repeat: false,
		useControls: true,
		fixedControls: 'fit',
		overlayOptions: {
			opacity: .6,
			position: 'bottom center',
			hideOnMouseOut: true
		}
	});
</script>