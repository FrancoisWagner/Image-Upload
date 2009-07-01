<?php
//**********************************************************************
//	Nom: mailsManagement.inc.php
//	Description: page permettant � un administrateur de g�rer les mails
//	Version: 2.0
//	Auteur: Fran�ois Wagner
//	Date: Avril-mai 2009
//**********************************************************************
// D�claration des variables
$message = '';
$content = '';
$droitPage = 2;
// Si le user est connect�, on peut afficher la page de configuration du compte
if(isLogged()){
	if($droit & $droitPage){
		// Inclusion du mod�le
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