<?php
function tryToConnect(&$message,&$isLogged,&$droit){
	// Initialisation des variables
	$login = '';
	$password = '';
	//Si les variables de connexion existent
	if(isset($_POST['login']) AND isset($_POST['password'])){
		$login = htmlspecialchars($_POST['login'],ENT_QUOTES);
		$password = htmlspecialchars($_POST['password'],ENT_QUOTES);
		//Le login existe
		if(loginTrue($login)){
			//Si le password est juste
			if(passwordTrue($login,$password)){
				$_SESSION['login'] = $login;
				$_SESSION['id_session'] = session_id();
				$sql = mysqlRequest("UPDATE ".MYSQL_USERS." SET id_session = '".$_SESSION['id_session']."' WHERE login = '".$login."'");
				$sql = mysqlRequest("SELECT ".MYSQL_GROUPS.".numero_bit FROM ".MYSQL_USERS." LEFT JOIN ".MYSQL_GROUPS." ON ".MYSQL_GROUPS.".id = ".MYSQL_USERS.".FK_droit WHERE ".MYSQL_USERS.".login = '".$_SESSION['login']."'");
				$row = mysql_fetch_row($sql);
				$droit = $row[0];
				$isLogged = true;
				return true;
			}
			else{
				$message .= '<p class="erreur">Le mot de passe entré est faux, veuillez réessayer.</p><br />';
				return false;
			}
		}
		else{
			$message .= '<p class="erreur">L\'identifiant entré n\'existe pas, veuillez réessayer.</p><br />';
			return false;
		}
	}
	else{
		return false;
	}
}
?>