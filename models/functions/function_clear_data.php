<?php
//--------------------------------------------
//	Author: Conception-Web.ch | François Wagner
//	Description: 
//		La fonction sert à nettoyer des données entrées par un utilisateur
//		http://shiii.org/2006/04/09/nettoyer-les-strings-en-input-php/
//	Date: 16.09.08
//	Version: 1
//--------------------------------------------
function clear_data($str){
	$str = htmlentities($str, ENT_QUOTES);
	return $str;
}
?>