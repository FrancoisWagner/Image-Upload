<?php
//**********************************************************************
//	Nom: imagesManagement.inc.php
//	Description: page permettant à un administrateur de gérer les images
//	Version: 2.0
//	Auteur: François Wagner
//	Date: Avril-mai 2009
//**********************************************************************
// Déclaration des variables
$message = '';
$content = '';
$droitPage = 2;
$id = '';
// Si le user est connecté, on peut afficher la page de configuration du compte
if(isLogged()){
	if($droit & $droitPage){
		if(isset($_GET['user'])){
			$id = mysqlInjection($_GET['user']);
		}
		// Inclusion du modèle
		include_once('models/imagesManagement.php');
		getBackDataImages($content,$id);
		// Inclusion de la vue
		include_once('views/imagesManagement.php');
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