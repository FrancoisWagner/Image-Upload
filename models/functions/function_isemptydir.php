<?php
//--------------------------------------------
//	Author: Conception-Web.ch | François Wagner
//	Description: Pour tester si un dossier est vide, si la fonction return true, c'est qu'il est vide, sinon c'est qu'il y a qqch dedans.
//	Date: 31.08.2008
//	Version: 1
//--------------------------------------------
function isemptydir($dir){
	$i=0;
	$handle = opendir($dir);
	while (($file = readdir($handle)) !== FALSE){
		if (($file != '.') and ($file != '..')){
			$i++;
		}
	}
	closedir($handle);
	if($i==0) return true;
	else return false;
}
?>