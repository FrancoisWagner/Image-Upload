<?php
function createDir($dirName,$htaccess){
	mkdir($dirName,0777);
	chmod($dirName,0777);
	if($htaccess == true){
		$dir = realpath($dirName);
		$handle = fopen($dir.'/index.html','x+');
		fclose($handle);
		chmod($dir.'/index.html',0777);
	}
}
?>