<?php
function sendMail(&$message){
	if($_POST['pseudo'] != NULL AND $_POST['mailAddress'] != NULL AND $_POST['message'] != NULL){
		if(isValidMailAddress($_POST['mailAddress'])){
			$pseudo = htmlspecialchars(mysqlInjection($_POST['pseudo']), ENT_QUOTES);
			$mail = htmlspecialchars(mysqlInjection($_POST['message']),ENT_QUOTES);
			$mailAddress = htmlspecialchars(mysqlInjection($_POST['mailAddress']),ENT_QUOTES);
			$ip = $_SERVER["REMOTE_ADDR"];
			$headers = 	'From: '.$mailAddress."\r\n".
						'Reply-To: '.$mailAddress."\r\n".
						'X-Mailer: PHP/' . phpversion();
			$content = '
						Mail de la part de '.$pseudo."\r\n".
						'Contenu : '.$mail;
			saveData($pseudo,$content,$mailAddress);
			if(mail(EMAIL_SITE, $_POST['subject'], $content, $headers)){ //La fonction qui envoie le mail
				$message .= '<span class="accept"><span></span><p>Le mail a été correctement envoyé.</p></span>';
			}
			else{
				$message .= '<span class="error"><span></span><p>Erreur lors de l\'envoi du mail. Veuillez réessayer plus tard.</p></span>';
			}
		}
		else{
			$message .= '<span class="error"><span></span><p>Erreur lors de l\'envoi du mail. Merci de mettre une adresse mail valide.</p></span>';
		}
	}
	else{
		$message .= '<span class="error"><span></span><p>Erreur lors de l\'envoi du mail, les champs n\'ont pas été remplis correctement, merci de remplir tous les champs du formulaire.</p></span>';
	}
}
function saveData($pseudo,$mail,$mailAddress){
	mysqlRequest("INSERT INTO contact VALUES('','".$pseudo."','".$mail."','".$mailAddress."','".time()."','".$ip."')");
}
?>