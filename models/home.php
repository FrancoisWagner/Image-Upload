<?php
function activation(&$message){
	if($_GET['activation']!=NULL AND $_GET['login'] != NULL){
		$idActivation = mysqlInjection($_GET['activation']);
		$login = mysqlInjection(htmlspecialchars($_GET['login']));
		$result = mysqlRequest("SELECT activation FROM members WHERE login = '".$login."'");
		$rows = mysql_fetch_row($result);
		$activation = 1;
		if($rows[0] != 1){
			if($idActivation == $rows[0]){
				if(mysqlRequest("UPDATE members SET activation = '" . $activation . "' WHERE login ='" . $login . "'")){
					$message .= '<span class="accept"><span></span><p>Activation effectuée. Bien du plaisir avec Image-Upload !</p></span>';
				}
				else{
					$message .= '<span class="error"><span></span><p>Erreur lors de l\'accès à la base de données. Merci de faire remonter ce bug: <a href="contactUs.html">Contact</a>.</p></span>';
				}	
			}
			else{
				$message .= '<span class="error"><span></span><p>Le lien d\'activation n\'est pas valide. Pour plus d\'infos: <a href="contactUs.html">Contact</a>.</p></span>';
			}
		}
		else{
			$message .= '<span class="error"><span></span><p>Votre compte a déjà été activé, pas besoin de le faire deux fois ;-).</p></span>';
		}
	}
	else{
		$message .= '<span class="error"><span></span><p>Le lien d\'activation n\'est pas valide. Pour plus d\'infos: <a href="contactUs.html">Contact</a>.</p></span>';
	}
}
function connection(&$message){
	if($_POST['loginConnection']!=NULL AND $_POST['passwordConnection'] != NULL){
		$login = mysqlInjection($_POST['loginConnection']);
		$password = mysqlInjection($_POST['passwordConnection']);
		if(loginTrue($login)){
			if(antiBruteForce($login,$password)){
				if(passwordTrue($login,$password)){
					if(activationDone($login)){
						$message .= '<span class="accept"><span></span><p>Connexion effectuée !</p></span>';
					}
					else{
						$message .= '<span class="error"><span></span><p>L\'activation de votre compte n\'a pas été effectuée, veuillez la faire au moyen du mail envoyé lors de votre inscription.</p></span>';
					}
				}
				else{
					$message .= '<span class="error"><span></span><p>Le mot de passe entré n\'est pas correcte.</p></span>';
				}
			}
			else{
				$message .= '<span class="error"><span></span><p>Vous vous êtes trompés trop de fois de mot de passe aujourd\'hui, reconnectez-vous demain.</p></span>';
			}
		}
		else{
			$message .= '<span class="error"><span></span><p>Le login entré n\'existe pas.</p></span>';
		}
	}
	else{
		$message .= '<span class="error"><span></span><p>Le formulaire n\'a pas été correctement rempli, veuillez réessayer.</p></span>';
	}
}
function setDir(){
	if(isLogged()){
		$sql = mysqlRequest("SELECT login FROM members WHERE login='".mysqlInjection($_SESSION['login'])."'");
		$row = mysql_fetch_row($sql);
		$login = $row[0];
		$dir = 'upload/'.$row[0].'/';
		return $dir;
	}
	else{
		$month = date('FY');
		if(is_dir('upload/'.$month)){
			$dir = 'upload/'.$month.'/';
			return $dir;
		}
		else{
			createDir('upload/'.$month,true);
			createDir('upload/'.$month.'/miniatures',true);
			createDir('upload/'.$month.'/miniatures/petites',true);
			createDir('upload/'.$month.'/miniatures/moyennes',true);
			createDir('upload/'.$month.'/miniatures/grandes',true);
			$dir = 'upload/'.$month.'/';
			return $dir;
		}
	}
}
function dataProcessing(&$message,&$content){
	$errors = array();
	$dir = setDir();
	foreach($_FILES as $file){
		if($file['name'] != NULL){
			if($file['error'] == 0){
				$image = new Image();
				$image -> tmpName = $file['tmp_name'];
				$image -> size = $file['size'];
				$image -> name = $file['name'];
				$image -> dir = $dir;
				$image -> rename();
				if($image -> getType()){
					if($image -> moveFile()){
						if($image -> type != 'bmp'){
							ini_set("memory_limit","32M");
							$image -> createThumb(150,$image -> dir.'/miniatures/petites/',50,4);
							$image -> createThumb(300,$image -> dir.'/miniatures/moyennes/',50,4);
							$image -> createThumb(600,$image -> dir.'/miniatures/grandes/',70,6);
						}
						else{
							$file = 'views/images/bmp.png';
							copy($file,$image -> dir.'/miniatures/petites/'.$image -> name);
							copy($file,$image -> dir.'/miniatures/moyennes/'.$image -> name);
							copy($file,$image -> dir.'/miniatures/grandes/'.$image -> name);
						}
						list($width, $height, $x, $y) = getimagesize($image -> dir.$image -> name);
						if(isLogged()){
							$sql = mysqlRequest("SELECT id,nbrImages FROM members WHERE login='".mysqlInjection($_SESSION['login'])."'");
							$row = mysql_fetch_row($sql);
							$nbrImages = $row[1]+1;
							mysqlRequest("UPDATE members SET nbrImages='".$nbrImages."' WHERE login='".$row[0]."'");
							if(isset($_POST['category']) AND $_POST['category'] != NULL){
								$category = mysqlInjection($_POST['category']);
								$sql2 = mysqlRequest("SELECT members.login FROM categories LEFT JOIN members ON members.id=categories.FK_member WHERE categories.id='".$category."'");
								$row2 = mysql_fetch_row($sql2);
								if(strtolower($_SESSION['login']) == strtolower($row2[0])){
									mysqlRequest("INSERT INTO images VALUES('','".$image -> name."','".$width." x ".$height."', '".$image -> size."', '".$image -> type."', '".$image -> dir."','".$category."', '".$row[0]."','".time()."')");
								}
								else{
									mysqlRequest("INSERT INTO images VALUES('','".$image -> name."','".$width." x ".$height."', '".$image -> size."', '".$image -> type."', '".$image -> dir."','1', '".$row[0]."','".time()."')");
								}
							}
							else{
								mysqlRequest("INSERT INTO images VALUES('','".$image -> name."','".$width." x ".$height."', '".$image -> size."', '".$image -> type."', '".$image -> dir."','1', '".$row[0]."','".time()."')");
							}
						}
						else{
							$sql = mysqlRequest("SELECT nbrImages FROM members WHERE login='Image-Upload'");
							$row = mysql_fetch_row($sql);
							$nbrImages = $row[0]+1;
							mysqlRequest("INSERT INTO images VALUES('','".$image -> name."', '".$width." x ".$height."', '".$image -> size."','".$image -> type."', '".$image -> dir."','1', '1','".time()."')");
						}
						$content .= setContent($image -> dir,$image -> name);
					}
					else{
						if(!in_array(6,$errors)){
							$errors[] = 6;
						}
					}
				}
				else{
					if(!in_array(5,$errors)){
						$errors[] = 5;
					}
				}
			}
			else{
				switch ($file['error']){
					case 1: // UPLOAD_ERR_INI_SIZE
					if(!in_array(1,$errors)){
						$errors[] = 1;
					}
					break;
					case 2: // UPLOAD_ERR_FORM_SIZE
					if(!in_array(2,$errors)){
						$errors[] = 2;
					}
					break;
					case 3: // UPLOAD_ERR_PARTIAL
					if(!in_array(3,$errors)){
						$errors[] = 3;
					}
					break;
					case 4: // UPLOAD_ERR_NO_FILE
					if(!in_array(4,$errors)){
						$errors[] = 4;
					}
					break;
				}
			}
        }
	}
	if(count($errors) != 0){
		$message .= '<span class="error"><span></span>';
		foreach($errors as $error){
			switch($error){
                case 1: // UPLOAD_ERR_INI_SIZE
                $message .= '<p>Le fichier dépasse la limite autorisée par le serveur (fichier php.ini)</p>';
                break;
                case 2: // UPLOAD_ERR_FORM_SIZE
                $message .= '<p>Le fichier dépasse la limite autorisée dans le formulaire HTML !</p>';
                break;
                case 3: // UPLOAD_ERR_PARTIAL
                $message .= '<p>L\'envoi du fichier a été interrompu pendant le transfert !</p>';
                break;
                case 4: // UPLOAD_ERR_NO_FILE
                $message .= '<p>Le fichier que vous avez envoyé a une taille nulle !</p>';
                break;
				case 5:
				$message .= '<p>Un de vos fichiers a un type non accepté.</p>';
				break;
				case 6:
				$message .= '<p>Un de vos fichiers n\'a pas pu être mis dans le bon dossier.</p>';
				break;
			}
		}
		$message .= '</span>';
	}
}
function setContent($dir,$name){
	$content = '
				<fieldset>
					<legend>'.$name.'</legend>
						<div class="imageHebergee">
							<a href="'.$dir.$name.'" target="blank">
								<img src="'.$dir.'miniatures/petites/'.$name.'" alt="" />
							</a>
						</div>
						<div class="code">
							<p>
								<span class="linkImage">URL de l\'image:</span><br />
								<input onFocus=\'this.select();\' type="text" size="58" value="http://www.image-upload.ch/'.$dir.$name.'" />
							</p><br />
							<p>
								<span class="bbCode">BBcode:</span><br />
								600px: <input onFocus=\'this.select();\' type="text" size="50" value="[url=http://www.image-upload.ch/'.$dir.$name.'][img]http://image-upload.ch/'.$dir.'miniatures/grandes/'.$name.'[/img][/url]" /><br />
								300px: <input onFocus=\'this.select();\' type="text" size="50" value="[url=http://www.image-upload.ch/'.$dir.$name.'][img]http://image-upload.ch/'.$dir.'miniatures/moyennes/'.$name.'[/img][/url]" />
							</p><br />	
							<p>						
								<span class="zCode">Zcode:</span><br />
								600px: <input onFocus=\'this.select();\' type="text" size="50" value=\'<lien url="http://www.image-upload.ch/'.$dir.$name.'"><image>http://image-upload.ch/'.$dir.'miniatures/grandes/'.$name.'</image></lien>\' /><br />
								300px: <input onFocus=\'this.select();\' type="text" size="50" value=\'<lien url="http://www.image-upload.ch/'.$dir.$name.'"><image>http://image-upload.ch/'.$dir.'miniatures/moyennes/'.$name.'</image></lien>\' />
							</p><br />
							<p>						
								<span class="html">HTML:</span><br />
								600px: <input onFocus=\'this.select();\' type="text" size="50" value=\'<a href="http://www.image-upload.ch/'.$dir.$name.'"><img src="http://image-upload.ch/'.$dir.'miniatures/grandes/'.$name.'" alt="" /></a>\' /><br />
								300px: <input onFocus=\'this.select();\' type="text" size="50" value=\'<a href="http://www.image-upload.ch/'.$dir.$name.'"><img src="http://image-upload.ch/'.$dir.'miniatures/moyennes/'.$name.'" alt="" /></a>\' />
							</p>
						</div>
				</fieldset><br />
				';
	return $content;
}
?>