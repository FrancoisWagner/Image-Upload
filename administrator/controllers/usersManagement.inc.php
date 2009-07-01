<?php
//**********************************************************************
//	Nom: usersManagement.inc.php
//	Description: page permettant à un administrateur de gérer les utilisateurs
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
		include_once('models/usersManagement.php');
		getBackDataMembers($content);
		// Inclusion de la vue
		include_once('views/usersManagement.php');
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