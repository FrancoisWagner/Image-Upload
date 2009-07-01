<div id="content">
	<div id="background">
		<h1>Administration des partenaires</h1>
		<p class="infoPage">Depuis cette page, vous pouvez modifier la boîte contenant les partenaires.</p>
		<div class="center">
			<form action="partnersManagement.html" method="post">
				<p><label for="content" class="bold">Contenu du fichier <?php echo $file;?></label></p><br />
				<p><textarea name="content" rows="15" cols="80"><?php echo $content;?></textarea></p><br />
				<?php if($contentOld != NULL){ ?>
					<p><label for="contentOld" class="bold">Contenu de l'ancienne version du fichier</label></p><br />
					<p><textarea name="contentOld" rows="15" cols="80"><?php echo $contentOld;?></textarea></p><br />
				<?php } ?>
				<input type="submit" class="button" value="Valider" />
			</form>
		</div>
	</div>
</div>