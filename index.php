<?php
//--------------------------------------------
//	Author: Conception-Web.ch | François Wagner
//	Description: 
//		Index principal du site web.
//	Date: 21.08.08
//	Version: 2.0
//---------------------------------------------
session_start();
error_reporting(E_ALL);
include_once('config.php');
include_once('models/functions.php');
// Initialisation des variables
$page = '';
$pattern = '';
$filename = '';
$pageTitle = '';
$pageInclude = '';
$timeStart = microtime(true);
$nbrVisitors = countVisitors();
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
			$pageTitle = 'Home';
			$pageInclude = 'controllers/home.inc.php';
		}
	}
	else{
		header("HTTP/1.1 406 requête non acceptée par le serveur.");
		$pageTitle = 'Home';
		$pageInclude = 'controllers/home.inc.php';
	}
}
else{
	header("HTTP/1.1 200 requête effectuée avec succés.");
	$pageTitle = 'Home';
	$pageInclude = 'controllers/home.inc.php';
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
	<link rel="stylesheet" media="screen" type="text/css" title="style" href="views/includes/styleVersion2.css" />
	<link rel="stylesheet" type="text/css" href="models/js/highslide-4.1.4/highslide/highslide.css" />
	<!-- Auteur de la page -->
	<meta name="author" content="<?php echo AUTEUR_SITE;?>" />
	<!-- Description de la page -->
	<meta name="description" content="<?php echo DESCRIPTION_SITE;?>" />
	<!-- Mots-clés de la page -->
	<meta name="keywords" content="<?php echo MOTS_CLES_SITE;?>" />
	<!-- Empécher la mise en cache de la page par le navigateur -->
	<meta http-equiv="pragma" content="no-cache" />
	<!-- Table de caractéres -->
	<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" />
	<meta name="verify-v1" content="7EXqrFSEi6j7zM2jdpoTrDLc/R5Kaqw4/Loy3Arha3M=" />
	<!--
		JAVASCRIPT DEVANT ETRE AU DEBUT DE LA PAGE
	-->
	<!-- Fonctions Javascript -->
	<script type="text/javascript" src="models/js/js.js"></script>
	<!--TinyTable JavaScript Table Sorter -->
	<script type="text/javascript" src="models/js/tableSorter.js"></script>
</head>
<body>
	<div id="page">
		<?php
			//***************************************************************
			//	INCLUSION DU MENU ET DU HEADER
			//***************************************************************
			include_once('views/includes/header.php');
		?>
		<div id="content">
			<?php
				//***************************************************************
				//	INCLUSION DE LA COLONNE DE GAUCHE
				//***************************************************************
				include_once('views/includes/columnsLeft.php');
			?>
			<div id="background">
				<div id="middle">
					<?php
						//***************************************************************
						//	INCLUSION DU FICHIER GERANT LES MESSAGES D'AVERTISSEMENT
						//***************************************************************
						include_once('views/includes/message.php');
						echo $contents;
					?>
					<!--
						SI LE NAVIGATEUR N'ACCEPTE PAS LE JAVASCRIPT, ON AFFICHE UN MESSAGE D'AVERTISSEMENT
					-->
					<noscript>
						<fieldset>
							<legend>Avertissement</legend>
							<p>
								Le javascript n'est pas activé sur votre navigateur, veuillez l'activer pour pouvoir utiliser correctement le site, sinon vous risquez d'avoir quelques problèmes lors de votre navigation.
							</p>
						</fieldset>
					</noscript>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	<?php
		//***************************************************************
		//	INCLUSION DU FOOTER
		//***************************************************************
		include_once('views/includes/footer.php');
	?>
</body>
</html>