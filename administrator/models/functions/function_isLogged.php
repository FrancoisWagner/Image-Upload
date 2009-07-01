<?php
//Si la personne est correctement connectée, la fonction retourne true
function isLogged(){
	//Si les deux variables de session existe on teste l'id_session
	if(isset($_SESSION['login']) AND isset($_SESSION['id_session'])){
		if(testSessionId()){
			return true;
		}
		else{//Personne n'est connecté
			session_unset();
			session_destroy();
			return false;
		}
	}
	else{//Personne n'est connecté
		return false;
	}
}
function testSessionId(){
	$login = mysqlInjection($_SESSION['login']);
	$result = mysqlRequest("SELECT id_session FROM ".MYSQL_USERS." WHERE login='" . $login . "'");
	$row = mysql_fetch_row($result);
	if($_SESSION['id_session'] == $row[0] AND $_SESSION['id_session'] == session_id()){
		return true;
	}
	else return false;
}

function loginTrue($login){
	$result = mysqlRequest("SELECT login FROM ".MYSQL_USERS." WHERE login='" . $login . "'");
	if(mysql_num_rows($result) == 1){
		return true;
	}
	else{
		return false;
	}
}

function passwordTrue($login,$password){
	$result = mysqlRequest("SELECT password FROM ".MYSQL_USERS." WHERE login='" . $login . "'");
	$password = md5($password);
	$rows = mysql_fetch_array($result);
	if($password == $rows['password']){
		return true;
	}
	else{
		return false;
	}
}
?>