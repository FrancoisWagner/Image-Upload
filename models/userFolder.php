<?php
function getBackDataCategories(&$contentCategories,$currentCategory){
	// Initialisation des variables
	$sql = '';
	$row = '';
	$id = '';
	$sql2 = '';
	$row2 = '';
	$i = 0;
	$size = 0;
	// ***************************
	$sql = mysqlRequest("SELECT id FROM members WHERE login='".mysqlInjection($_SESSION['login'])."'");
	$row = mysql_fetch_row($sql);
	$id = $row[0];
	$sql = mysqlRequest("SELECT id,nom FROM categories WHERE FK_member='".$id."' AND parentDirectory='".$currentCategory."'");
	while($row = mysql_fetch_array($sql)){
		$sql2 = mysqlRequest("SELECT poids FROM images WHERE FK_category='".$row['id']."'");
		$size = 0;
		$i = 0;
		while($row2 = mysql_fetch_array($sql2)){
			$size += $row2['poids'];
			$i++;
		}
		$contentCategories .= 
					'<tr>
						<td><input type="checkbox" id="category'.$row['id'].'" /></td>
						<td><a href="userFolder-'.$currentCategory.'-'.$row['id'].'.html">'.$row['nom'].'</a></td>
						<td>'.getsizename($size).'</td>
						<td>'.$i.'</td>
						<td><span class="info"><span>Supprimer le dossier</span><a href="javascript:deleteCategory(\''.$row['id'].'\');"><img src="views/images/icones/delete.png" alt="" /></a></span>
						</td>
					</tr>';
	}
}
function getBackDataImages(&$contentImages,$currentCategory){
	// Initialisation des variables
	$sql = '';
	$row = '';
	$id = '';
	$day = '';
	$month = '';
	$year = '';
	// ***************************
	$sql = mysqlRequest("SELECT id FROM members WHERE login='".mysqlInjection($_SESSION['login'])."'");
	$row = mysql_fetch_row($sql);
	$id = $row[0];
	$sql = mysqlRequest("SELECT id,nom,taille,poids,timestamp,directory,type FROM images WHERE FK_member='".$id."' AND FK_category='".$currentCategory."'");
	while($row = mysql_fetch_array($sql)){
		$day = date('d', $row['timestamp']);
		$month = date('F', $row['timestamp']);
		$year = date('Y', $row['timestamp']);
		$contentImages .= 
					'<tr>
						<td><input type="checkbox" id="image'.$row['id'].'" /></td>
						<td><span class="info"><span><img src="'.$row['directory'].'miniatures/petites/'.$row['nom'].'" alt="" /></span><a href="#" onclick="javascript:showImage(\''.$row['directory'].'\',\''.$row['nom'].'\')">'.$row['nom'].'</a></span></td>
						<td>'.$row['taille'].'</td>
						<td>'.getsizename($row['poids']).'</td>
						<td>'.$month.' '.$day.', '.$year.'</td>
						<td>
							<span class="info"><span>Supprimer l\'image</span><a href="javascript:deleteImage(\''.$row['id'].'\');"><img src="views/images/icones/delete.png" alt="" /></a></span>
						';
						if($row['type'] != 'bmp'){
							$contentImages .= '<span class="info"><span>Modifier l\'image</span><a href="javascript:showResize(\''.$row['id'].'\',\''.$row['nom'].'\');"><img src="views/images/icones/imageEdit.png" alt="" /></a></span>';
						}
		$contentImages .='</td>
					</tr>';
	}
}
function getBackCategories(&$listCategories){
	// Initialisation des variables
	$sql = '';
	$row = '';
	// ***************************
	$sql = mysqlRequest("SELECT categories.id,categories.nom FROM categories LEFT JOIN members ON members.id=categories.FK_member WHERE members.login='".mysqlInjection($_SESSION['login'])."'");
    while($row = mysql_fetch_row($sql)){
		$listCategories .= '<option>'.$row[1].'</option>';
	}
}
function getBackImagesDiapo(&$contentImagesDiapo,$currentCategory){
	// Initialisation des variables
	$sql = '';
	$row = '';
	$i = 0;
	// ***************************
	$sql = mysqlRequest("SELECT id FROM members WHERE login='".mysqlInjection($_SESSION['login'])."'");
	$row = mysql_fetch_row($sql);
	$id = $row[0];
	$sql = mysqlRequest("SELECT nom,directory FROM images WHERE FK_member='".$id."' AND FK_category='".$currentCategory."'");
	while($row = mysql_fetch_array($sql)){
		if($i == 0){
			$contentImagesDiapo .= '
					<a href="'.$row[1].$row[0].'" class="highslide" onclick="return hs.expand(this)">
						&nbsp;&nbsp;Voir les images de cette catégorie
					</a>
					<div class="hidden">';
			$i++;
		}
		else{
			$contentImagesDiapo .= '
					<a href="'.$row[1].$row[0].'" class="highslide" onclick="return hs.expand(this)">
					</a>
					<div class="highslide-caption">
						'.$row[0].'
					</div>
					';
		}
	}
	if($i == 1){
		$contentImagesDiapo .= '</div>';
	}
}
function resizeImage(&$message){
	ini_set("memory_limit","32M");
	// On récupére l'ID de l'image à redimensionner
	$idImage = mysqlInjection($_POST['id_modif']);
	// Le login de session
	$login = mysqlInjection($_SESSION['login']);
	$sql = mysqlRequest("SELECT id FROM members WHERE login='".$login."'");
	$row = mysql_fetch_row($sql);
	$idLogin = $row[0];
	$sql = mysqlRequest ("SELECT directory, type, FK_member, nom FROM images WHERE id='".$idImage."'");
	$row = mysql_fetch_row($sql);
	$directory = $row[0];
	$type = $row[1];
	$FK_member = $row[2];
	$name = $row[3];
	// On  vérifie si le login de session est bien le propriétaire de l'image
	if($idLogin == $FK_member){
		list($largeur_original, $hauteur_original) = getimagesize($directory.$name);
		switch ($type){
			case 'jpeg':
			$image = imagecreatefromjpeg($directory.$name);
			break;
			case 'png':
			$image = imagecreatefrompng($directory.$name);
			break;
			case 'gif':
			$image = imagecreatefromgif($directory.$name);
			break;
			case 'plain':
			$image = imagecreatefrompng($directory.$name);
			break;
			default:
			return false;
		}
		if(isset($_POST['prop_largeur']) AND $_POST['prop_largeur'] == true){
			if(is_numeric($_POST['largeur'])){
				$pourcentage = $_POST['largeur']/$largeur_original*100;
				$hauteur = $hauteur_original-(100-$pourcentage)*($hauteur_original/100);
				$image_redim = imagecreatetruecolor($_POST['largeur'], $hauteur);
				imagecopyresized($image_redim, $image, 0, 0, 0, 0, $_POST['largeur'], $hauteur, $largeur_original, $hauteur_original);
				unlink($directory.$name);
				imagejpeg($image_redim , $directory.$name, 100);
				switch ($type){
					case 'jpeg':
					imagejpeg($image_redim , $directory.$name, 100);
					break;
					case 'png':
					imagejpng($image_redim , $directory.$name, 100);
					break;
					case 'gif':
					imagegif($image_redim , $directory.$name, 100);
					break;
					case 'plain':
					imagepng($image_redim , $directory.$name, 100);
					break;
					default:
					return false;
				}
				$size = getsizename(filesize($directory.$name));
				$sql = mysqlRequest("UPDATE images SET taille='".$_POST['largeur'].'x'.$hauteur."', poids='".$size."' WHERE id='".$idImage."'");
				$message .= '<span class="accept"><span></span><p>L\'image a été correctement modifiée.</p></span>';
			}
			else{
				$message .= '<span class="error"><span></span><p>La largeur donnée n\'est pas un nombre.</p></span>';
			}
		}
		else if(isset($_POST['prop_hauteur']) AND $_POST['prop_hauteur'] == true){
			if(is_numeric($_POST['hauteur'])){
				$pourcentage=$_POST['hauteur']/$hauteur_original*100;
				$largeur=$largeur_original-(100-$pourcentage)*($largeur_original/100);
				$image_redim = imagecreatetruecolor($largeur, $_POST['hauteur']);
				imagecopyresized($image_redim, $image, 0, 0, 0, 0, $largeur, $_POST['hauteur'], $largeur_original, $hauteur_original);
				unlink($directory.$name);
				imagejpeg($image_redim , $directory.$name, 100);
				switch ($type){
					case 'jpeg':
					imagejpeg($image_redim , $directory.$name, 100);
					break;
					case 'png':
					imagejpng($image_redim , $directory.$name, 100);
					break;
					case 'gif':
					imagegif($image_redim , $directory.$name, 100);
					break;
					case 'plain':
					imagepng($image_redim , $directory.$name, 100);
					break;
					default:
					return false;
				}
				$size = getsizename(filesize($directory.$name));
				$sql = mysqlRequest("UPDATE images SET taille='".$largeur.'x'.$_POST['hauteur']."', poids='".$size."' WHERE id='".$idImage."'");
				$message .= '<span class="accept"><span></span><p>L\'image a été correctement modifiée.</p></span>';
			}
			else{
				$message .= '<span class="error"><span></span><p>La hauteur donnée n\'est pas un nombre.</p></span>';
			}
		}
		else{
			if(is_numeric($_POST['hauteur'])){
				if(is_numeric($_POST['largeur'])){
					$image_redim = imagecreatetruecolor($_POST['largeur'], $_POST['hauteur']);
					imagecopyresized($image_redim, $image, 0, 0, 0, 0, $_POST['largeur'], $_POST['hauteur'], $largeur_original, $hauteur_original);
					unlink($directory.$name);
					imagejpeg($image_redim , $directory.$name, 100);
					switch ($type){
						case 'jpeg':
						imagejpeg($image_redim , $directory.$name, 100);
						break;
						case 'png':
						imagejpng($image_redim , $directory.$name, 100);
						break;
						case 'gif':
						imagegif($image_redim , $directory.$name, 100);
						break;
						case 'plain':
						imagepng($image_redim , $directory.$name, 100);
						break;
						default:
						return false;
					}
					$size = getsizename(filesize($directory.$name));
					$sql = mysqlRequest("UPDATE images SET taille='".$_POST['largeur'].'x'.$_POST['hauteur']."', poids='".$size."' WHERE id='".$idImage."'");
					$message .= '<span class="accept"><span></span><p>L\'image a été correctement modifiée.</p></span>';
				}
				else{
					$message .= '<span class="error"><span></span><p>La largeur donnée n\'est pas un nombre.</p></span>';
				}
			}
			else{
				$message .= '<span class="error"><span></span><p>La hauteur donnée n\'est pas un nombre.</p></span>';
			}
		}
	}
	else{
		$message .= '<span class="error"><span></span><p>Vous n\'êtes pas propriétaire de l\'image que vous voulez modifier.</p></span>';
	}
}
?>