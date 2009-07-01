<?php
//**********************************************************************
//	Nom: home.inc.php
//	Description: page d'accueil du site
//	Version: 2.0
//	Auteur: Fran�ois Wagner
//	Date: Avril-mai 2009
//**********************************************************************
// Inclusion du mod�le
include_once('models/home.php');
// D�claration des variables
$message = '';
$content = '';
// Si un user veut activer son compte, on l'active
if(isset($_GET['activation'])AND isset($_GET['login'])){
	activation($message);
}
// Si un user veut se d�connecter, on le d�connecte
if(isset($_GET['disconnect'])AND $_GET['disconnect'] == 1){
	session_unset();
	session_destroy();
	$message .= '<span class="accept"><span></span><p>Vous avez �t� correctement d�connect�.</p></span>';
}
// Si un user veut se connecter, on traite ses variables de connexions
if(isset($_POST['loginConnection']) AND isset($_POST['passwordConnection'])){
	connection($message);
}
// Si un user veut envoyer des images, on traite sa demande
if(isset($_POST['uploader'])){
	dataProcessing($message,$content);
}
// Inclusion de la vue
include_once('views/home.php');
?>