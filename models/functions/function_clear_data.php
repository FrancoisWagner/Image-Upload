<?php
//--------------------------------------------
//	Author: Conception-Web.ch | Fran�ois Wagner
//	Description: 
//		La fonction sert � nettoyer des donn�es entr�es par un utilisateur
//		http://shiii.org/2006/04/09/nettoyer-les-strings-en-input-php/
//	Date: 16.09.08
//	Version: 1
//--------------------------------------------
function clear_data($str){
	$str = htmlentities($str, ENT_QUOTES);
	return $str;
}
?>