<div class="clearFooter"></div>
	<div id="footer">
		<?php
			$timeEnd = microtime(true);
			$time = round($timeEnd - $timeStart,4);
		?>
		<p>
			<span class="time">Page g�n�r�e en <?php echo $time;?> secondes</span> | <span class="server"><?php echo $nbrRequest;?> requ�tes sql</span> | <span class="visitors"><?php echo $nbrVisitors;?> visiteur<?php if($nbrVisitors > 1){echo 's';}?></span>
			<br />
			<span class="contactUs"><a href="contactUs.html" name="contact" >Contact</a></span> | <span class="information"><a href="http://www.famfamfam.com/lab/icons/silk/preview.php" name="icones" >Icones utilis�s pour le site</a></span> | <span class="firefox"><a href="http://www.mozilla-europe.org/fr/firefox/">Optimis� pour Firefox</a></span>
			<br />
			<span class="validXhtml"><a href="http://validator.w3.org/check?uri=referer">Valid XHTML</a></span> | <span class="validCss"><a href="http://jigsaw.w3.org/css-validator/check/referer">Valid CSS</a></span> | <span class="highslide"><a href="http://www.highslide.com/" name="highslide">Highslide JS</a></span> | <span class="tinytable"><a href="http://www.leigeber.com/2009/03/table-sorter/" name="tinytable">TinyTable</a></span>
			<br />
			Design &amp; code by Image-Upload.ch - Tous droits r�serv�s<br />
		</p>
	</div>
</div>