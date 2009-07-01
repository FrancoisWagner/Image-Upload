<?php
function countVisitors(){
	$nbrVisitor = 0;
	$timestampFiveMinutesBefore = time()-(60*5);
	$files = glob('compteur/*.txt');
	if(in_array('compteur/' . $_SERVER['REMOTE_ADDR'] . '.txt', $files)){
		touch('compteur/' . $_SERVER['REMOTE_ADDR'] . '.txt');
	}
	else{
		$newFile=fopen('compteur/' . $_SERVER['REMOTE_ADDR'] . '.txt','x+');
		fclose($newFile);
	}
	$files = glob('compteur/*.txt');
	foreach($files AS $file){
		if(filemtime($file) >= $timestampFiveMinutesBefore){
			$nbrVisitor ++; // Si le fichier a été modifié dans les 5 dernières minutes, on incrémente $nbrVisitor
		}
        else unlink($file); // Sinon on le supprime
    }
    return $nbrVisitor;
}
?>