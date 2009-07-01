<?php
function checkData(&$message){
	if(testLogin($message) && testPassword($message) && testMailAddress($message)){
		return true;
	}
	else{
		return false;
	}
}

function testLogin(&$message){
	// Initialisation des variables
	$login = '';
	$sql = '';
	$row = '';
	$x = 0;
	// ***************************
	if($_POST['login'] != NULL){
		$login = mysqlInjection($_POST['login']);
		$sql = mysqlRequest("SELECT * FROM members WHERE login = '".$login."'");
		while($row = mysql_fetch_array($sql)){
			if(strtolower($row['login']) == strtolower($login)){
				$x = 1;
			}			
		}
		if($x == 0){
			if(!preg_match("#[.|/]#", $login)){
				return true;
			}
			else{
				$message .=  '<span class="error"><span></span><p>Le login contient un ou plusieurs caractères non autorisés(/ ou .).</p></span>';
				return false;
			}
		}
		else{
			$message .= '<span class="error"><span></span><p>Login déjà utilisé.</p></span>';
			return false;
		}
	}
	else{
		$message .= '<span class="error"><span></span><p>Le champ "Login" n\'a pas été rempli.</p></span>';
		return false;
	}
}

function testPassword(&$message){
	if ($_POST['password'] != NULL){
		if($_POST['verifPassword'] != NULL){
			if($_POST['password'] == $_POST['verifPassword']){
				return true;
			}
			else{
				$message .= '<span class="error"><span></span><p>Les deux mots de passe ne sont pas identiques.</p></span>';
				return false;
			}
		}
		else{
			$message .= '<span class="error"><span></span><p>Le champ "Vérification du mot de passe" n\'a pas été rempli.</p></span>';
			return false;
		}
	}
	else{
		$message .= '<span class="error"><span></span><p>Le champ "Mot de passe" n\'a pas été rempli.</p></span>';
		return false;
	}
}

function testMailAddress(&$message){
	// Initialisation des variables
	$nbrMailAddress = '';
	// ***************************
	if($_POST['mailAddress']!=NULL){
		if (isValidMailAddress($_POST['mailAddress'])){
			$nbrMailAddress = mysql_result(mysqlRequest("SELECT COUNT(*) FROM members WHERE mail = '".$_POST['mailAddress']."'"), 0);
			if($nbrMailAddress == 0){
				return true;
			}
			else{
				$message .= '<span class="error"><span></span><p>L\'adresse entrée est déjà utilisée.</p></span>';
				return false;
			}
		}
		else{
			$message .= '<span class="error"><span></span><p>Votre adresse e-mail n\'est pas correcte.</p></span>';
			return false;
		}
	}
	else{
		$message .= '<span class="error"><span></span><p>Le champ "Adresse e-mail" n\'a pas été rempli.</p></span>';
		return false;
	}
}

function register(&$message){
	// Initialisation des variables
	$login = '';
	$password = '';
	$mail = '';
	$validation = '';
	$timestamp = '';
	// ***************************
	$login = mysqlInjection($_POST['login']);
	$password = md5($_POST['password']);
	$mail = mysqlInjection($_POST['mailAddress']);
	$validation = rand(100000,999999);
	$timestamp = time();
	if(mysqlRequest("INSERT INTO members VALUES ('' , '".$login."' , '".$password."' ,
        '".$mail."' , '".$timestamp."' , '".$validation."', '', '','2' ) ")){
		if(sendMail($validation)){
			return true;
		}
		else{
			return false;
		}
	}
	else return false;
}

function sendMail($validation){
	// Initialisation des variables
	$login = '';
	$password = '';
	$mail = '';
	$subject = '';
	$numberOfValidation = '';
	$message = '';
	$from = '';
	// ***************************
	//Envoi du mail
	$login = $_POST['login'];
	$password = $_POST['password'];
	$mail = $_POST['mailAddress'];
	$subject = 'Bienvenue sur Image-Upload.ch';
	$numberOfValidation = $validation;
	//Le message qui vous est envoyé
	$message = 
		'Bonjour,'."\r\n".
		'Bienvenue sur Image-Upload.ch! Bien du plaisir avec ce service.'."\r\n".
		'Voici vos données personnelles.'."\r\n".
		'Login: ' . $login ."\r\n".
		'Password: ' . $password . "\r\n".
		'E-Mail :' . $mail . "\r\n".
		'Veulliez, svp cliquer sur le lien suivant pour activer votre compte. ' . "\r\n".
		'http://www.image-upload.ch/index.php?page=home&activation=' . $numberOfValidation . '&login='.$login. "\r\n".
		'Merci pour votre inscription,'. "\r\n".
		'L\'admin d\'Image-Upload.ch';
	//Le mail du posteur
	$from = "From: no-reply@image-upload.ch";
	//Envoie du mail
	if(mail($mail, $subject, $message, $from)){ //La fonction qui envoie le mail
		return true;
	}
	else{
		return false;
	}
}
?>