<?php
function createDir($dirName,$htaccess){
	mkdir($dirName,0777);
	if($htaccess == true){
		$dir = realpath($dirName);
		$handle = fopen($dir.'/.htaccess','x+');
		fwrite($handle,'Options -Indexes');
		fclose($handle);
	}
}
?>