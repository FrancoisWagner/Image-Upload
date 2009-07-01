<div id="content">
	<div id="style_form" class="formulaire">
		<h1>Gestion du compte</h1>
		<p id="info_form">Remplissez le formulaire afin de changer votre mot de passe.</p>
			<form action="accountManagement.html" method="POST">
			<?php
				echo $message;
			?>
			<p>
				<label for="oldPassword">Ancien mot de passe <span class="small">Entrez votre ancien mot de passe</span></label><input type="password" id="oldPassword" name="oldPassword" size="40" /><br /><br />
				<label for="newPassword">Nouveau mot de passe <span class="small">Entrez votre nouveau mot de passe</span></label><input type="password" id="newPassword" name="newPassword" size="40" /><br /><br />
				<label for="newPassword2">Vérification du mot de passe <span class="small">Entrez à nouveau votre nouveau mot de passe</span></label><input type="password" id="newPassword2" size="40" name="newPassword2" />
				<input type="submit" class="button" value="Valider" />
			</p>
			</form>
			<noscript><p class="erreur">Votre navigateur ne supporte pas le javascript, veuillez faire une mise à jour de celui-ci, ou activez le javascript.</p></noscript>
	</div>
</div>