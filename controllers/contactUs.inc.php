<?php
//**********************************************************************
//	Nom: contactUs.inc.php
//	Description: page permettant à un utilisateur de contacter le webmaster
//	Version: 2.0
//	Auteur: François Wagner
//	Date: Avril-mai 2009
//**********************************************************************
// Inclusion du modèle
include_once('models/contactUs.php');
// Déclaration des variables
$message = '';
// Si le formulaire de contact a été rempli, on le traite
if(isset($_POST['pseudo'], $_POST['mailAddress'], $_POST['message'])){
	sendMail($message);
}
// Inclusion de la vue
include_once('views/contactUs.php');
?>