<?php
//**********************************************************************
//	Nom: userFolder.inc.php
//	Description: page permettant à un utilisateur connecté de voir, modifier, supprimer ses images et catégories
//	Version: 2.0
//	Auteur: François Wagner
//	Date: Avril-mai 2009
//**********************************************************************
// Déclaration des variables
$contentCategories = '';
$contentImages = '';
$currentCategory = '1';
$listCategories = '';
$message = '';
$table = '';
$nbr = '';
$precedCategory = '';
// Si le user est connecté, on peut afficher la page de configuration du compte
if(isLogged()){
	// Inclusion du modèle
	include_once('models/userFolder.php');
	if(isset($_GET['category'])){
		$table = explode('-',$_GET['category']);
		$nbr = count($table);
		$currentCategory = mysqlInjection($table[$nbr-1]);
		for($i=0;$i<$nbr-1;$i++){
			$precedCategory .= $table[$i];
			if($i != $nbr-2){
				$precedCategory .= '-';
			}
		}
		if($currentCategory != 1){
			$contentCategories .= '
					<tr>
						<td><a href="userFolder-'.$precedCategory.'.html">\Retour</a></td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>';
			getBackImagesDiapo($contentImagesDiapo,$currentCategory);
		}
	}
	if(isset($_POST['id_modif'])){
		resizeImage($message);
	}
	// Appel des fonctions
	getBackDataCategories($contentCategories,$currentCategory);
	getBackDataImages($contentImages,$currentCategory);
	getBackCategories($listCategories);
	// Inclusion de la vue
	include_once('views/userFolder.php');
}
// Sinon on affiche la page d'accueil
else{
	header('Location: index.html');
}
?>