<?php
//**********************************************************************
//	Nom: userFolder.inc.php
//	Description: page permettant � un utilisateur connect� de voir les images de la V1
//	Version: 2.0
//	Auteur: Fran�ois Wagner
//	Date: Avril-mai 2009
//**********************************************************************
// D�claration des variables
$contentImages = '';
$message = '';
// Si le user est connect�, on peut afficher la page de configuration du compte
if(isLogged()){
	// Inclusion du mod�le
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