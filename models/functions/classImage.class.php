<?php
class Image{
	public $name;
	public $imageWidth;
	public $imageHeight;
	public $size;
	public $height;
	public $width;
	public $types = array('jpeg','png','bmp','gif','plain');
	public $dir;
	public $type;
	public $tmpName;
	//Fonction permettant de récupérer l'extension du fichier et vérifier si c'est une extension acceptée
	public function getType(){
		// AVEC L'EXTENSION FILEINFO
		/* $finfo = new finfo(FILEINFO_MIME, MIME_MAGIC); // Retourne le type mime
		if (!$finfo) {
			echo "Échec de l'ouverture de la base de données fileinfo";
			exit();
		}
		$extension = explode('/',$finfo->file($this -> tmpName)); */
		// SANS FILEINFO
		$extension = explode('/',mime_content_type($this -> tmpName)); 
		$nbr = count($extension);
		$this -> type = $extension[$nbr-1];
		if(in_array($this -> type,$this -> types)){
			if($this -> type == 'plain'){
				$type = getimagesize($this -> tmpName);
				if($type[2] == 3){
					return true;
				}
				else{
					return false;
				}
			}
			else{
				return true;
			}
		}
		else{
			return false;
		}
	}
	//Fonction permettant de renommer le fichier de façon correcte
	public function rename(){
		$patterns = array('/JPG/','/JPEG/','/GIF/','/PNG/','/BMP/','/-/','/\//','/\//','/ /','/%/','/.php/','/.js/','/jpeg/','/"/','/\'/');
		$replacements = array('jpg','jpg','gif','png','bmp','_','_','_','_','_','_','_','jpg','_','_');
		$this -> name = preg_replace($patterns, $replacements, $this -> name);
		$this -> name = strtr($this -> name,  "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ",  "aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn");
		$this -> name = trim($this -> name);
		$extension = strrchr($this -> name, '.');
		$nameImage = explode($extension, $this -> name);
		$i = 0;
		$verifNameImage = 0;
		do{
			if($i == 0){
				if(file_exists($this -> dir . $nameImage[0] . $extension)){
					$i++;
					$this -> name = $nameImage[0].'_'.$i.'_'.$extension;
				}
				else{
					$verifNameImage = 1;
					$this -> name = $nameImage[0].$extension;
				}
			}	
			else{
				if(file_exists($this -> dir . $this -> name)){
					$i++;
					$this -> name = $nameImage[0].'_'.$i.'_'.$extension;
				}
				else{
					$verifNameImage = 1;
				}
			}
		}while($verifNameImage == 0);
	}
	//Fonction permettant créer une miniature
	public function createThumb($width,$thumbDir,$qualityJpeg,$qualityPng){
		$imageSource = $this -> dir.'/'.$this -> name;
		list($widthSource, $heightSource, $x, $y) = getimagesize($imageSource);
		if($widthSource < $width){
			copy($imageSource,$thumbDir.$this -> name);
		}
		else{
			$pourcentage = $width/$widthSource*100;
			if($heightSource > 10){
				$height = $heightSource - (100-$pourcentage)*($heightSource/100);
			}
			else{
				$height = $heightSource;
			}
			$im = imagecreatetruecolor($width,$height);
			ImageAlphaBlending($im, false);
			ImageSaveAlpha($im, true);
			switch ($this -> type){
				case 'jpeg':
				$image = imagecreatefromjpeg($imageSource);
				break;
				case 'png':
				$image = imagecreatefrompng($imageSource);
				break;
				case 'gif':
				$image = imagecreatefromgif($imageSource);
				break;
				case 'plain':
				$image = imagecreatefrompng($imageSource);
				break;
			}
			imagecopyresampled($im, $image, 0, 0, 0, 0, $width, $height, $widthSource, $heightSource);
			switch ($this -> type){
				case 'jpeg':
				$image = imagejpeg($im,$thumbDir.$this -> name,$qualityJpeg);
				break;
				case 'png':
				$image = imagepng($im,$thumbDir.$this -> name,$qualityPng);
				break;
				case 'gif':
				$image = imagegif($im,$thumbDir.$this -> name);
				break;
				case 'plain':
				$image = imagepng($im,$thumbDir.$this -> name,$qualityPng);
				break;
			}
			imagedestroy($im);
		}
		chmod($thumbDir.$this -> name,0777);
	}
	//Fonction permettant de bouger l'image dans le bon répertoire
	public function moveFile(){
		$tmpName = $this -> tmpName;
		if( move_uploaded_file($tmpName, $this -> dir.'/'.$this -> name)){
			$this -> pathImage = $this -> dir.'/'.$this -> name;
			chmod($this -> dir.'/'.$this -> name,0777);
			return true;
		}
		else{
			return false;
		}
	}	
}
?>