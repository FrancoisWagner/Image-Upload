<?php
//**********************************************************************
//	Nom: configurationAccount.inc.php
//	Description: page permettant � un utilisateur connect� de changer son mot de passe
//	Version: 2.0
//	Auteur: Fran�ois Wagner
//	Date: Avril-mai 2009
//**********************************************************************
// D�claration des variables
$message = '';
// Si le user est connect�, on peut afficher la page de configuration du compte
if(isLogged()){
	// Inclusion du mod�le
	include_once('models/configurationAccount.php');
	// Si le user a rempli le formulaire de changement de mot de passe, on traite celui-ci � l'aide de la fonction modifyPassword
	if(isset($_POST['oldPassword']) AND isset($_POST['newPassword']) AND isset($_POST['newPassword2'])){
		modifyPassword($message);
	}
	// Inclusion de la vue
	include_once('views/configurationAccount.php');
}
// Sinon on affiche la page d'accueil
else{
	header('Location: index.html');
}
?>