<?php
//**********************************************************************
//	Nom: statistics.inc.php
//	Description: page permettant de voir diff�rentes statistiques du site
//	Version: 2.0
//	Auteur: Fran�ois Wagner
//	Date: Avril-mai 2009
//**********************************************************************
// Inclusion du mod�le
include_once('models/statistics.php');
// D�claration des variables
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
// Si un user est connect�, on affiche ses statistiques personnelles
if(isLogged()){
	getInfosUser($nbrImagesUser,$sizeImagesUser,$dateSignUp);
}
// Inclusion de la vue
include_once('views/statistics.php');
?>