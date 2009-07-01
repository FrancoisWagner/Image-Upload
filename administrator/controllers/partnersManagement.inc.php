<?php
//**********************************************************************
//	Nom: partnersManagement.inc.php
//	Description: page permettant à un administrateur de gérer les partenaires
//	Version: 2.0
//	Auteur: François Wagner
//	Date: Avril-mai 2009
//**********************************************************************
// Déclaration des variables
$message = '';
$content = '';
$contentOld = '';
$droitPage = 2;
$file = '../views/includes/partners.html';
// Si le user est connecté, on peut afficher la page de configuration du compte
if(isLogged()){
	if($droit & $droitPage){
		// Inclusion du modèle
		include_once('models/partnersManagement.php');
		if(isset($_POST['content']) AND $_POST['content'] != NULL){
			modifyPartners($content,$file);
			getBackPartners($content,$contentOld,$file);
		}
		else{
			getBackPartners($content,$contentOld,$file);
		}
		// Inclusion de la vue
		include_once('views/partnersManagement.php');
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