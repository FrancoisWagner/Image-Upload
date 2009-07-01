<?php
function getBackPartners(&$content,&$contentOld,$file){
	$content .= file_get_contents($file);
	if(file_exists($file.'.old')){
		$contentOld .= file_get_contents($file.'.old');
	}
}
function modifyPartners(&$content,$file){
	$newContent = $_POST['content'];
	$oldContent = file_get_contents($file);
	// Supprimer le fichier .old et on le remplit avec les données du fichier actuel
	if(file_exists($file.'.old')){
		unlink($file.'.old');
	}
	$handle = fopen($file.'.old', 'a+');
	if ($handle) {
		fwrite($handle,$oldContent);
		fclose($handle);
	}
	// On supprime le fichier et on le remplit avec les nouvelles donnés
	unlink($file);
	$handle = fopen($file, 'a+');
	if ($handle) {
		fwrite($handle,$newContent);
		fclose($handle);
	}
}
?>