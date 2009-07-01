<?php
//**********************************************************************
//	Nom: configurationAccount.inc.php
//	Description: page permettant à un utilisateur connecté de changer son mot de passe
//	Version: 2.0
//	Auteur: François Wagner
//	Date: Avril-mai 2009
//**********************************************************************
// Déclaration des variables
$message = '';
// Si le user est connecté, on peut afficher la page de configuration du compte
if(isLogged()){
	// Inclusion du modèle
	include_once('models/configurationAccount.php');
	// Si le user a rempli le formulaire de changement de mot de passe, on traite celui-ci à l'aide de la fonction modifyPassword
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