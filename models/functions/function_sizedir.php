<?php
//--------------------------------------------
//	Author: Fran�ois Wagner
//	Mail: francois.wagner@yahoo.fr
//	Description: 
//		La fonction sert � retourner la taille d'un r�pertoire (incluant ses sous-r�pertoires).
//		La fonction prend un argument qui est le realpath du r�pertoire.
//		La fonction requi�re la fonction getsizename() pour pouvoir retourner l'unti� de mesure appropri�e.
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