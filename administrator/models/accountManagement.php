<?php
function modifyPassword(&$message){
	if($_POST['oldPassword'] != NULL AND $_POST['newPassword'] != NULL AND $_POST['newPassword2'] != NULL){
		$login = mysqlInjection($_SESSION['login']);
		$result = mysqlRequest("SELECT password FROM ".MYSQL_USERS." WHERE login='".$login."'");
		$row = mysql_fetch_row($result);
		if($row[0] == md5($_POST['oldPassword'])){
			if($_POST['newPassword'] == $_POST['newPassword2']){
				$result = mysqlRequest("UPDATE ".MYSQL_USERS." SET password='".md5($_POST['newPassword'])."' WHERE login='".$login."'");
				$message .= '<p class="accept">Le mot de passe a été correctement changé.</p><br />';
			}
			else{
				$message .= '<p class="erreur">Les deux nouveaux mot de passe ne sont pas identiques, veuillez réessayer.</p><br />';
			}
		}
		else{
			$message .= '<p class="erreur">Votre ancien mot de passe n\'est pas correcte, veuillez réessayer.</p><br />';
		}
	}
	else{
		$message .= '<p class="erreur">Veuillez remplir correctement le formulaire.</p><br />';
	}
}
?>