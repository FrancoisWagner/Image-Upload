<?php
$dir = 'models/functions/';
// Ouvre un dossier bien connu, et liste tous les fichiers
if (is_dir($dir)){
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
			if($file!='.' AND $file!='..'){
				include_once($dir.$file);
			}
        }
        closedir($dh);
    }
}
?>
