<?php
//--------------------------------------------
//	Author: Conception-Web.ch | François Wagner
//	Description: librairie MySQL
//	Date: 22.05.08
//	Version: 1
//--------------------------------------------

// Fonction pour les requêtes
//La fonction sert à faire une requête MySQL
//La function prend en argument la requête
$nbrRequest = 0;
function mysqlRequest($sql){
	global $nbrRequest;
	$nbrRequest ++;
	dataBaseConnect();
	$request = mysql_query($sql)or die('Requête invalide : ' . mysql_error() . '\n');
	$closeDB = mysql_close()or die('Requête invalide : ' . mysql_error() . '\n');
	return $request;
}
//Fonction pour la connexion à la base
function dataBaseConnect(){
	$connect = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD)or die('Requête invalide : ' . mysql_error() . '\n');
	$selectDB = mysql_select_db(MYSQL_DATA_BASE)or die('Requête invalide : ' . mysql_error() . '\n');
}
//Fonction mysql_real_escape_string
function mysqlInjection($data){
	dataBaseConnect();
	$protectionDB = mysql_real_escape_string($data);
	$closeDB = mysql_close()or die('Requête invalide : ' . mysql_error() . '\n');
	return $protectionDB;
}