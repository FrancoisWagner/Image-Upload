<?php
//--------------------------------------------
//	Author: Conception-Web.ch | François Wagner
//	Description: Pour tester si qqun est connecté, il suffit de faire if(connecte()), si la fonction retourne true c'est que c'est tout bon...
//	Date: 22.05.08
//	Version: 1
//--------------------------------------------

//Nom de la table MySQL où se trouve les données membres
$table_membre='users';
//Si la personne est correctement connectée, la fonction retourne true
function connecte(){
	//Si les deux variables de session existe on teste l'id_session
	if(isset($_SESSION['login']) AND isset($_SESSION['id_session'])){
		if(test_id_session()){
			return true;
		}
		else{//Personne n'est connecté
			session_destroy();
			return false;
		}
	}
	else{//Personne n'est connecté
		return false;
	}
}
function test_id_session(){
	 global $table_membre;
	$login=mysql_injection($_SESSION['login']);
	$id_session_bdd=requete("SELECT id_session FROM ".$table_membre." WHERE login='" . $login . "'")or die(mysql_error());
	$id_session_bdd=mysql_fetch_array($id_session_bdd);
	if($_SESSION['id_session']==$id_session_bdd['id_session']){
		return true;
	}
	else return false;
}

function login_existe(){
	global $table_membre;
	$login=mysql_injection($_POST['login']);
	$login_existe=requete('SELECT COUNT(*) AS login FROM '.$table_membre.' WHERE login=\'' . $login . '\'')or die(mysql_error());
	$nbr_login = mysql_fetch_array($login_existe);
	if($nbr_login['login']!=0){
		return true;
	}
	else{
		return false;
	}
}

function password_true(){
	global $table_membre;
	$login=mysql_injection($_POST['login']);
	$retour_donnees_bdd=requete("SELECT password FROM ".$table_membre." WHERE login='" . $login . "'")or die(mysql_error());
	$password=md5($_POST['password']);
	$donnees_bdd=mysql_fetch_array($retour_donnees_bdd);
	if($password==$donnees_bdd['password']){
		return true;
	}
	else{
		return false;
	}
}
?>