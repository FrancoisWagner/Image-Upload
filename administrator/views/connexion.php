<div id="content">
	<div id="style_form" class="formulaire">
		<h1>Connexion</h1>
		<p id="info_form">Connectez-vous afin d'accéder à la partie admin. <a href="../index.php">Retour au site</a>.</p>
			<form action="admin.html" method="post">
			<?php
				echo $message;
			?>
			<p>
				<label for="login">Identifiant<span class="small">Entrez votre identifiant</span></label><input type="text" name="login" id="login" /><br /><br />
				<label for="password">Mot de passe<span class="small">Entrez votre mot de passe</span></label><input type="password" name="password" id="password" /><br /><br />
				<input type="submit" class="button" value="Connexion" />
			</p>
			</form>
			<noscript><p class="erreur">Votre navigateur ne supporte pas le javascript, veuillez faire une mise à jour de celui-ci, ou activez le javascript.</p></noscript>
	</div>
</div>