<?php
function sendNewPassword(&$message){
	// Initialisation des variables
	$mailAddress = '';
	$sql = '';
	$newPassword = '';
	$newPasswordMd5 = '';
	$subject = '';
	$mail = '';
	$from = '';
	// ***************************
	$mailAddress = mysqlInjection($_POST['mailAddress']);
	$sql = mysqlRequest("SELECT login FROM members WHERE mail = '".$mailAddress."'");
	if(mysql_num_rows($sql) == 1){
		for($i = 0; $i < 6; $i++){
			$newPassword .= mt_rand(0,9);
		}
		$newPasswordMd5 = md5($newPassword);
		if(mysqlRequest("UPDATE members SET password= '".$newPasswordMd5."' WHERE mail='".$mailAddress ."'")){
			$subject = 'Nouveau mot de passe sur Image-Upload.ch [No-Reply]';
			//Le message qui vous est envoyé
			$mail = 'Voilà votre nouveau mot de passe.'."\r\n".
					'Password: ' . $newPassword . "\r\n".
					'L\'admin d\'Image-Upload.ch';
			//Le mail du posteur
			$from = "From: no-reply@image-upload.ch";
			//Envoie du mail
			if(mail($mailAddress, $subject, $mail, $from)){ //La fonction qui envoie le mail
				$message .= '<span class="accept"><span></span><p>La demande c\'est bien déroulée, vous allez recevoir un mail avec votre nouveau password.</p></span>';
			}
			else{
				$message .= '<span class="error"><span></span><p>Erreur lors de l\'envoi du mail, veuillez contacter l\'admin.</p></span>';
			}
		}
		else{
			$message .= '<span class="error"><span></span><p>Erreur mysql, veuillez, svp contacter l\'admin.</p></span>';
		}
	}
	else{
		$message .= '<span class="error"><span></span><p>Aucun compte ayant l\'adresse donnée existe. N\'hésitez pas à vous <a href="signUp.html">inscrire</a>.</p></span>';
	}
}	
?>