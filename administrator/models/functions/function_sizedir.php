<?php
//--------------------------------------------
//	Author: François Wagner
//	Mail: francois.wagner@yahoo.fr
//	Description: 
//		La fonction sert à retourner la taille d'un répertoire (incluant ses sous-répertoires).
//		La fonction prend un argument qui est le realpath du répertoire.
//		La fonction requière la fonction getsizename() pour pouvoir retourner l'untié de mesure appropriée.
//	Date: 22.05.08
//	Version: 1
//--------------------------------------------
function sizedir($src){
	$size=0;
	$h = opendir($src);
	while(($o = readdir($h)) !== FALSE){
		if (($o != '.') and ($o != '..')){
			if(is_file($src.$o)){
				$size=$size+filesize($src.$o);
			}
		}
	}
	closedir($h);
	return getsizename($size);
}
?>