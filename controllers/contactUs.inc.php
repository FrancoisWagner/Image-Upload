<?php
//**********************************************************************
//	Nom: contactUs.inc.php
//	Description: page permettant � un utilisateur de contacter le webmaster
//	Version: 2.0
//	Auteur: Fran�ois Wagner
//	Date: Avril-mai 2009
//**********************************************************************
// Inclusion du mod�le
include_once('models/contactUs.php');
// D�claration des variables
$message = '';
// Si le formulaire de contact a �t� rempli, on le traite
if(isset($_POST['pseudo'], $_POST['mailAddress'], $_POST['message'])){
	sendMail($message);
}
// Inclusion de la vue
include_once('views/contactUs.php');
?>