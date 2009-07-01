<?php
//**********************************************************************
//	Nom: passwordLost.inc.php
//	Description: page permettant à un utilisateur ne se souvenant plus de son mot de passe, d'en renvoyer un nouveau
//	Version: 2.0
//	Auteur: François Wagner
//	Date: Avril-mai 2009
//**********************************************************************
// Inclusion du modèle
include_once('models/passwordLost.php');
// Déclaration des variables
$message = '';
// Si le formulaire de demande de mot de passe a été rempli, on le traite
if(isset($_POST['mailAddress']) AND $_POST['mailAddress']!=NULL){
	sendNewPassword($message);
}
// Inclusion de la vue
include_once('views/passwordLost.php');
?>