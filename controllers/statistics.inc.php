<?php
//**********************************************************************
//	Nom: statistics.inc.php
//	Description: page permettant de voir différentes statistiques du site
//	Version: 2.0
//	Auteur: François Wagner
//	Date: Avril-mai 2009
//**********************************************************************
// Inclusion du modèle
include_once('models/statistics.php');
// Déclaration des variables
$nbrUsers = '';
$nbrImages = '';
$sizeImages = '';
$nbrImagesUser = '';
$sizeImagesUser = '';
$dateSignUp = '';
$message = '';
// Appel des fonctions
nbrUsers($nbrUsers );
nbrImages($nbrImages);
sizeImages($sizeImages);
// Si un user est connecté, on affiche ses statistiques personnelles
if(isLogged()){
	getInfosUser($nbrImagesUser,$sizeImagesUser,$dateSignUp);
}
// Inclusion de la vue
include_once('views/statistics.php');
?>