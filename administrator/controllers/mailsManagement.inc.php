<?php
//**********************************************************************
//	Nom: mailsManagement.inc.php
//	Description: page permettant à un administrateur de gérer les mails
//	Version: 2.0
//	Auteur: François Wagner
//	Date: Avril-mai 2009
//**********************************************************************
// Déclaration des variables
$message = '';
$content = '';
$droitPage = 2;
// Si le user est connecté, on peut afficher la page de configuration du compte
if(isLogged()){
	if($droit & $droitPage){
		// Inclusion du modèle
		include_once('models/mailsManagement.php');
		getBackDataMails($content);
		// Inclusion de la vue
		include_once('views/mailsManagement.php');
	}
	else{
		header('Location: admin.html');
	}
}
// Sinon on affiche la page d'accueil
else{
	header('Location: admin.html');
}
?>