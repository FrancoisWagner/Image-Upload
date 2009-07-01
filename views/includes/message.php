<?php
if($message != NULL){
	echo '
		<script type="text/javascript">document.onkeydown = keyHit;</script>
		<div id="filter"></div>
		<div id="box" >
			<div id="boxheader">
				<span id="boxtitle">Message d\'avertissement</span>
				<span id="boxclose" onclick="javascript:hide(\'filter\');javascript:hide(\'box\');"><a href="#">Fermer/Taper sur enter</a></span>
			</div>
			<div id="boxcontent">
				'.$message.'
			</div>
		</div>
	';
}
?>