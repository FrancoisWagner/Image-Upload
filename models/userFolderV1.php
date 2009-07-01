<?php
function getBackDataImages(&$contentImages){
	$i = 0;
	$sql = mysqlRequest("SELECT login FROM members WHERE login='".mysqlInjection($_SESSION['login'])."'");
	$row = mysql_fetch_row($sql);
	$login = $row[0];
	if(is_dir('upload/'.$login)){
		$images_jpg = glob('upload/'.$login.'/*.jpg');
		foreach($images_jpg AS $miniature_jpg){
			$chaine = explode('/',$miniature_jpg);
			$nbr = count($chaine);
			$nom = $chaine[$nbr-1];
			$contentImages .= 
				'<tr>
					<td><span class="info"><span><img src="upload/'.$login.'/miniatures/petites/'.$nom.'" alt="" /></span><a href="upload/'.$login.'/'.$nom.'">'.$nom.'</a></span></td>
					<td><span class="info"><span>Supprimer l\'image</span><a href="index.php?page=userFolderV1&amp;delete='.$nom.'"><img src="views/images/icones/delete.png" alt="" /></a></span></td>
				</tr>';
		}
		$images_png = glob('upload/'.$login.'/*.png');
		foreach($images_png AS $miniature_png){
			$chaine = explode('/',$miniature_png);
			$nbr = count($chaine);
			$nom = $chaine[$nbr-1]; 
			$contentImages .= 
				'<tr>
					<td><span class="info"><span><img src="upload/'.$login.'/miniatures/petites/'.$nom.'" alt="" /></span><a href="upload/'.$login.'/'.$nom.'">'.$nom.'</a></span></td>
					<td><span class="info"><span>Supprimer l\'image</span><a href="index.php?page=userFolderV1&amp;delete='.$nom.'"><img src="views/images/icones/delete.png" alt="" /></a></span></td>
				</tr>';
			
		}
		$images_gif = glob('upload/'.$login.'/*.gif');
		foreach($images_gif AS $miniature_gif){
			$chaine = explode('/',$miniature_gif);
			$nbr = count($chaine);
			$nom = $chaine[$nbr-1];
			$contentImages .= 
				'<tr>
					<td><span class="info"><span><img src="upload/'.$login.'/miniatures/petites/'.$nom.'" alt="" /></span><a href="upload/'.$login.'/'.$nom.'">'.$nom.'</a></span></td>
					<td><span class="info"><span>Supprimer l\'image</span><a href="index.php?page=userFolderV1&amp;delete='.$nom.'"><img src="views/images/icones/delete.png" alt="" /></a></span></td>
				</tr>';
			
		}
		$images_bmp = glob('upload/'.$login.'/*.bmp');
		foreach($images_bmp AS $miniature_bmp){
			$chaine = explode('/',$miniature_bmp);
			$nbr = count($chaine);
			$nom = $chaine[$nbr-1];
			$contentImages .= 
				'<tr>
					<td><span class="info"><span><img src="upload/'.$login.'/miniatures/petites/'.$nom.'" alt="" /></span><a href="upload/'.$login.'/'.$nom.'">'.$nom.'</a></span></td>
					<td><span class="info"><span>Supprimer l\'image</span><a href="index.php?page=userFolderV1&amp;delete='.$nom.'"><img src="views/images/icones/delete.png" alt="" /></a></span></td>
				</tr>';
		}
	}
}
function deleteImage(&$message){
	$imageToDelete = htmlspecialchars($_GET['delete'],ENT_QUOTES);
	$sql = mysqlRequest("SELECT login FROM members WHERE login='".mysqlInjection($_SESSION['login'])."'");
	$row = mysql_fetch_row($sql);
	$login = $row[0];
	if(file_exists('upload/'.$login.'/'.$imageToDelete)){
		unlink('upload/'.$login.'/'.$imageToDelete);
		unlink('upload/'.$login.'/miniatures/petites/'.$imageToDelete);
		unlink('upload/'.$login.'/miniatures/moyennes/'.$imageToDelete);
		unlink('upload/'.$login.'/miniatures/grandes/'.$imageToDelete);
		$sql = mysqlRequest("SELECT id,nbrImages FROM members WHERE login='".mysqlInjection($_SESSION['login'])."'");
		$row = mysql_fetch_row($sql);
		$idLogin = $row[0];
		//$nbrImages = $row[1] - 1;
		//$sql = mysqlRequest("SELECT * FROM images WHERE nom='".mysqlInjection($imageToDelete)."'");
		//$row = mysql_fetch_array($sql);
		//if($row){
			//if($row['timestamp'] != 0){
				//mysqlRequest("UPDATE members SET nbrImages='".$nbrImages."' WHERE id='".$idLogin."'");
			//}
			$sql = mysqlRequest("DELETE FROM images WHERE nom='".mysqlInjection($imageToDelete)."'");
		//}
		$message .= '<span class="accept"><span></span><p>L\'image '.$imageToDelete.' a été correctement supprimée.</p></span>';
	}
	else{
		$message .= '<span class="error"><span></span><p>L\'image '.$imageToDelete.' n\'existe pas.</p></span>';
	}
}
?>