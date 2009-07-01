<div id="filterUserFolder"></div>
	<div id="boxUserFolder">
	<div id="boxheader">
		<span id="boxtitle"></span>
		<span id="boxclose"><a href="javascript:hide('filterUserFolder');javascript:hide('boxUserFolder');">Fermer</a></span>
	</div>
	<div id="boxcontent">
	</div>
</div>
<div id="content">
	<div id="background">
		<h1>Administration des images</h1>
		<p class="infoPage">Depuis cette page, vous pouvez afficher ou supprimer une ou plusieurs images.</p>
		<div id="images"></div><br />
		<table id="table2" class="sortable" cellpadding="0" cellspacing="0" border="0" >
			<thead>
				<tr>
					<th class="nosort"><input type="checkbox" id="checkboxAllimage" onclick="javascript:checkAll('image',this.checked);" /></th>
					<th><h3>Nom</h3></th>
					<th class="nosort">Taille</th>
					<th class="nosort">Poids</th>
					<th><h3>Date d'envoi</h3></th>
					<th><h3>Utilisateur</h3></th>
					<th class="nosort">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php echo $content;?>
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
				Pour la sélection: <a href="javascript:deleteImagesChecked('<?php echo htmlspecialchars($_SESSION['login']);?>');">Supprimer</a>
			</p>
		</div><br />
	</div>
</div>
<!-- 
	JAVASCRIPT
-->
<script type="text/javascript">
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