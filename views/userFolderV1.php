<div id="filterUserFolder"></div>
	<div id="boxUserFolder">
	<div id="boxheader">
		<span id="boxtitle"></span>
		<span id="boxclose"><a href="javascript:hide('filterUserFolder');javascript:hide('boxUserFolder');">Fermer</a></span>
	</div>
	<div id="boxcontent">
	</div>
</div>
<p class="titre">
	<span>Mon compte</span>
</p><br />
<!-- *********************************************** -->
<!-- LES IMAGES -->
<!-- *********************************************** -->
<fieldset>
	<legend>Mes images</legend>
	<div id="images"></div><br />
	<table id="table2" class="sortable" cellpadding="0" cellspacing="0" border="0" >
		<thead>
			<tr>
				<th><h3>Nom</h3></th>
				<th class="nosort">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php echo $contentImages;?>
		</tbody>
	</table><br />
</fieldset><br />
