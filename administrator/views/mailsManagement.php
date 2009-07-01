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
		<h1>Administration des mails</h1>
		<p class="infoPage">Depuis cette page, vous pouvez voir ou supprimer les mails.</p>
		<div id="mails"></div><br />
		<table id="table" class="sortable" cellpadding="0" cellspacing="0" border="0" >
			<thead>
				<tr>
					<th><h3>ID</h3></th>
					<th><h3>Expéditeur</h3></th>
					<th><h3>Adresse mail</h3></th>
					<th><h3>Date</h3></th>
					<th  class="nosort">Adresse IP</th>
					<th><h3>Action</h3></th>
				</tr>
			</thead>
			<tbody>
				<?php echo $content;?>
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
			<img src="views/images/icones/first.png" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
			<img src="views/images/icones/previous.png" width="16" height="16" alt="Previous Page" onclick="sorter.move(-1)" />
			<img src="views/images/icones/next.png" width="16" height="16" alt="Next Page" onclick="sorter.move(1)" />
			<img src="views/images/icones/last.png" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
		</span>
		<span class="text">Affichage de la page <span id="currentpage"></span> sur <span id="pagelimit"></span></span>
	</div><br />
	</div>
</div>
<script type="text/javascript">
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
	sorter.init("table",3);
</script>