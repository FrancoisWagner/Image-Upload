<?php
//**********************************************************************
//	Nom: passwordLost.inc.php
//	Description: page permettant � un utilisateur ne se souvenant plus de son mot de passe, d'en renvoyer un nouveau
//	Version: 2.0
//	Auteur: Fran�ois Wagner
//	Date: Avril-mai 2009
//**********************************************************************
// Inclusion du mod�le
include_once('models/passwordLost.php');
// D�claration des variables
$message = '';
// Si le formulaire de demande de mot de passe a �t� rempli, on le traite
if(isset($_POST['mailAddress']) AND $_POST['mailAddress']!=NULL){
	sendNewPassword($message);
}
// Inclusion de la vue
include_once('views/passwordLost.php');
?>