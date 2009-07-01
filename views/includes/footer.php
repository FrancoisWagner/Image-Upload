<div class="clearFooter"></div>
	<div id="footer">
		<?php
			$timeEnd = microtime(true);
			$time = round($timeEnd - $timeStart,4);
		?>
		<p>
			<span class="time">Page générée en <?php echo $time;?> secondes</span> | <span class="server"><?php echo $nbrRequest;?> requêtes sql</span> | <span class="visitors"><?php echo $nbrVisitors;?> visiteur<?php if($nbrVisitors > 1){echo 's';}?></span>
			<br />
			<span class="contactUs"><a href="contactUs.html" name="contact" >Contact</a></span> | <span class="information"><a href="http://www.famfamfam.com/lab/icons/silk/preview.php" name="icones" >Icones utilisés pour le site</a></span> | <span class="firefox"><a href="http://www.mozilla-europe.org/fr/firefox/">Optimisé pour Firefox</a></span>
			<br />
			<span class="validXhtml"><a href="http://validator.w3.org/check?uri=referer">Valid XHTML</a></span> | <span class="validCss"><a href="http://jigsaw.w3.org/css-validator/check/referer">Valid CSS</a></span> | <span class="highslide"><a href="http://www.highslide.com/" name="highslide">Highslide JS</a></span> | <span class="tinytable"><a href="http://www.leigeber.com/2009/03/table-sorter/" name="tinytable">TinyTable</a></span>
			<br />
			Design &amp; code by Image-Upload.ch - Tous droits réservés<br />
		</p>
	</div>
</div>