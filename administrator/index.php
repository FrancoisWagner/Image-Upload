<?php
//--------------------------------------------
//	Author: Conception-Web.ch | François Wagner
//	Description: 
//		Index principal du site web.
//	Date: 21.08.08
//	Version: 1.1
//--------------------------------------------
error_reporting(E_ALL);
session_start();
include_once('../config.php');
include_once('models/fonctions.php');
// Initialisation des variables
$page = '';
$pattern = '';
$filename = '';
$pageTitle = '';
$pageInclude = '';
$isLogged = false;
$droit = '';
$menuNavigation = array(
					'Accueil administration',
					'Gestion des utilisateurs',
					'Gestion des images',
					'Gestion des articles',
					'Gestion des mails',
					'Gestion des partenaires',
					'Gestion du compte',
					'Déconnexion');
$droitsNavigation = array(
					1,
					2,
					2,
					2,
					2,
					2,
					1,
					1);
$hrefNavigation = array(
					'admin.html',
					'usersManagement.html',
					'imagesManagement.html',
					'itemsManagement.html',
					'mailsManagement.html',
					'partnersManagement.html',
					'accountManagement.html',
					'index.php?page=admin&amp;deconnexion=1'
					);
$imagesMenu = array(
					'admin.png',
					'usersManagement.png',
					'imagesManagement.png',
					'itemsManagement.png',
					'mailsManagement.png',
					'partnersManagement.png',
					'accountManagement.png',
					'disconnect.png'
					);
$nbr = count($menuNavigation);
// Fin d'initialisation des variables
if(!empty($_GET['page'])){
	$page = htmlspecialchars($_GET['page']);
	$pattern = '#^[a-zA-Z0-9_]+$#';
	if(preg_match($pattern,$page)){
		$filename = 'controllers/'.$page.'.inc.php';
		if(file_exists($filename)){
			header("HTTP/1.1 200 requête effectuée avec succés.");
			$pageTitle = ucfirst($page);
			$pageTitle = preg_replace('/_/',' ',$pageTitle ); 
			$pageInclude = $filename;
		}
		else{
			header("HTTP/1.1 404 la page demandée n'existe pas.");
			$pageTitle = 'Administration';
			$pageInclude = 'controllers/admin.inc.php';
		}
	}
	else{
		header("HTTP/1.1 406 requête non acceptée par le serveur.");
		$pageTitle = 'Administration';
		$pageInclude = 'controllers/admin.inc.php';
	}
}
else{
	header("HTTP/1.1 200 requête effectuée avec succés.");
	$pageTitle = 'Administration';
	$pageInclude = 'controllers/admin.inc.php';
}
if(isLogged()){
	$isLogged = true;
	$sql = mysqlRequest("SELECT ".MYSQL_GROUPS.".numero_bit FROM ".MYSQL_USERS." LEFT JOIN ".MYSQL_GROUPS." ON ".MYSQL_GROUPS.".id = ".MYSQL_USERS.".FK_droit WHERE ".MYSQL_USERS.".login = '".$_SESSION['login']."'");
	$row = mysql_fetch_row($sql);
	$droit = $row[0];
}
ob_start();
include_once($pageInclude);
$contents = ob_get_contents();
ob_end_clean();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
<head>
	<title><?php echo NOM_SITE.' | '.$pageTitle;?></title>
	<!-- Style CSS -->
	<link rel="stylesheet" media="screen" type="text/css" title="style" href="views/includes/style_admin.css" />
	<!-- Auteur de la page -->
	<meta name="author" content="<?php echo AUTEUR_SITE;?>" />
	<!-- Description de la page -->
	<meta name="description" content="<?php echo DESCRIPTION_SITE;?>" />
	<!-- Mots-clés de la page -->
	<meta name="keywords" content="<?php echo MOTS_CLES_SITE;?>" />
	<!-- Empêcher la mise en cache de la page par le navigateur -->
	<meta http-equiv="pragma" content="no-cache" />
	<!-- Table de caractères -->
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
	<!--
		JAVASCRIPT DEVANT ETRE AU DEBUT DE LA PAGE
	-->
	<!-- Fonctions Javascript -->
	<script type="text/javascript" src="models/js/js.js"></script>
	<!--TinyTable JavaScript Table Sorter -->
	<script type="text/javascript" src="models/js/tableSorter.js"></script>
</head>
<body>
	<?php 
		include_once('views/includes/header.php');
		if($isLogged == true){
			include_once('views/includes/menu.php');
		}
	?>
	<div id="page">
		<?php echo $contents;?>
	</div>
	<?php
		include_once('views/includes/footer.html');
	?>
</body>
</html>