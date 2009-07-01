<?php
// On inclut le modèle
include_once('models/admin.php');
// Initialisation des variables
$message = '';
//Si personne n'est connecté
if(!isLogged()){
	if(tryToConnect($message,$isLogged,$droit)){
		include_once('views/admin.php');
	}
	else{
		include_once('views/connexion.php');
	}
}
//Si quelqu'un est connecté, l'on affiche la page admin
else{
	if(isset($_GET['deconnexion']) AND $_GET['deconnexion'] == 1){
		session_unset();
		session_destroy();
		$isLogged = false;
		$message .= '<p class="accept">Vous avez été correctement déconnecté.</p><br />';
		include_once('views/connexion.php');
	}
	else{
		include_once('views/admin.php');
	}
}
?>