<?php
function modifyPassword(&$message){
	if($_POST['oldPassword'] != NULL AND $_POST['newPassword'] != NULL AND $_POST['newPassword2'] != NULL){
		$login = mysqlInjection($_SESSION['login']);
		$result = mysqlRequest("SELECT password FROM members WHERE login='".$login."'");
		$row = mysql_fetch_row($result);
		if($row[0] == md5($_POST['oldPassword'])){
			if($_POST['newPassword'] == $_POST['newPassword2']){
				$result = mysqlRequest("UPDATE members SET password='".md5($_POST['newPassword'])."' WHERE login='".$login."'");
				$message .= '<span class="accept"><span></span><p>Le mot de passe a été correctement changé.</p></span>';
			}
			else{
				$message .= '<span class="error"><span></span><p>Les deux nouveaux mot de passe ne sont pas identiques, veuillez réessayer.</p></span>';
			}
		}
		else{
			$message .= '<span class="error"><span></span><p>Votre ancien mot de passe n\'est pas correcte, veuillez réessayer.</p></span>';
		}
	}
	else{
		$message .= '<span class="error"><span></span><p>Veuillez remplir correctement le formulaire.</p></span>';
	}
}
?>