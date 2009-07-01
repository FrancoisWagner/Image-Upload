<?php
//**********************************************************************
//	Nom: imagesManagement.inc.php
//	Description: page permettant � un administrateur de g�rer les images
//	Version: 2.0
//	Auteur: Fran�ois Wagner
//	Date: Avril-mai 2009
//**********************************************************************
// D�claration des variables
$message = '';
$content = '';
$droitPage = 2;
$id = '';
// Si le user est connect�, on peut afficher la page de configuration du compte
if(isLogged()){
	if($droit & $droitPage){
		if(isset($_GET['user'])){
			$id = mysqlInjection($_GET['user']);
		}
		// Inclusion du mod�le
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