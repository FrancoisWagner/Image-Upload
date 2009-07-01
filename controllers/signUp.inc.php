<?php
//**********************************************************************
//	Nom: signUp.inc.php
//	Description: page permettant de s'inscire sur le site
//	Version: 2.0
//	Auteur: Fran�ois Wagner
//	Date: Avril-mai 2009
//**********************************************************************
// Inclusion du mod�le
include_once('models/signUp.php');
// D�claration des variables
$message = '';
$dir = 'upload';
// Si le formulaire d'inscription a �t� rempli, on le traite
if(isset($_POST['login']) AND isset($_POST['password'])AND isset($_POST['verifPassword'])AND isset($_POST['mailAddress'])){
	if(checkData($message)){
		// Si l'inscription s'est bien pass�e, on va pouvoir cr�er les dossiers de l'utilisateur
		if(register($message)){
			createDir($dir.'/'.trim($_POST['login']),true);
			createDir($dir.'/'.trim($_POST['login']).'/miniatures',true);
			createDir($dir.'/'.trim($_POST['login']).'/miniatures/petites',true);
			createDir($dir.'/'.trim($_POST['login']).'/miniatures/moyennes',true);
			createDir($dir.'/'.trim($_POST['login']).'/miniatures/grandes',true);
			$message .=  '<span class="accept"><span></span><p>L\'inscription s\'est bien d�roul�e, vous allez recevoir un mail d\'activation de votre compte.</p></span>';
		}
		else{
			$message .=  '<span class="error"><span></span><p>Un probl�me est survenu durant l\'acc�s � la base de donn�es ou l\'envoi du mail de validation, veuillez signaler ce probl�me depuis la page <a href="contactUs.html">Contact</a>.</p></span>';
		}
	}
}
include_once('views/signUp.php');
?>