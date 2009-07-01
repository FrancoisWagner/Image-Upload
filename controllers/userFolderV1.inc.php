<?php
//**********************************************************************
//	Nom: userFolder.inc.php
//	Description: page permettant à un utilisateur connecté de voir les images de la V1
//	Version: 2.0
//	Auteur: François Wagner
//	Date: Avril-mai 2009
//**********************************************************************
// Déclaration des variables
$contentImages = '';
$message = '';
// Si le user est connecté, on peut afficher la page de configuration du compte
if(isLogged()){
	// Inclusion du modèle
	include_once('models/userFolderV1.php');
	// Appel des fonctions
	if(isset($_GET['delete'])){
		deleteImage($message);
	}
	getBackDataImages($contentImages);
	// Inclusion de la vue
	include_once('views/userFolderV1.php');
}
// Sinon on affiche la page d'accueil
else{
	header('Location: index.html');
}
?>