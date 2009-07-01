<?php
// On inclut le mod�le
include_once('models/admin.php');
// Initialisation des variables
$message = '';
//Si personne n'est connect�
if(!isLogged()){
	if(tryToConnect($message,$isLogged,$droit)){
		include_once('views/admin.php');
	}
	else{
		include_once('views/connexion.php');
	}
}
//Si quelqu'un est connect�, l'on affiche la page admin
else{
	if(isset($_GET['deconnexion']) AND $_GET['deconnexion'] == 1){
		session_unset();
		session_destroy();
		$isLogged = false;
		$message .= '<p class="accept">Vous avez �t� correctement d�connect�.</p><br />';
		include_once('views/connexion.php');
	}
	else{
		include_once('views/admin.php');
	}
}
?>