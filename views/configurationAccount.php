<p class="titre">
	<span>Configuration de votre compte</span>
</p><br />
<fieldset>
	<legend>Changement de votre mot de passe | <?php echo htmlspecialchars($_SESSION['login'],ENT_QUOTES);?></legend>
	<form action="configurationAccount.html" method="POST" class="formulaire">
		<p><label for="oldPassword">Ancien mot de passe: </label><input type="password" id="oldPassword" name="oldPassword" size="40" /></p>
		<p><label for="newPassword">Nouveau mot de passe: </label><input type="password" id="newPassword" name="newPassword" size="40" /></p>
		<p><label for="newPassword2">Vérification du mot de passe: </label><input type="password" id="newPassword2" size="40" name="newPassword2" /></p>
		<p class="marginLeft"><input class="button" type="submit" value="Valider" /></p>
	</form>
</fieldset><br />