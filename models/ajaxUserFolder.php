<?php
session_start();
include_once('functions/mysqlLibrary.php');
include_once('functions/function_isLogged.php');
include_once('../config.php');
if(isset($_POST['deleteCategory'])){
	if($_POST['deleteCategory'] != NULL){
		deleteCategory();
	}
	else{
		echo ' ';
	}
}
else if(isset($_POST['category'])){
	if($_POST['category'] != NULL){
		addCategory();
	}
	else{
		echo 'Veuillez remplir correctement le formulaire d\'ajout de cat&eacute;gorie.';
	}
}
else if(isset($_POST['deleteImage'])){
	if($_POST['deleteImage'] != NULL){
		deleteImage();
	}
	else{
		echo ' ';
	}
}
else if(isset($_POST['elementsCategories'])){
	if($_POST['elementsCategories'] != NULL){
		deleteCategories();
	}
	else{
		echo ' ';
	}
}
else if(isset($_POST['elementsImages'])){
	if($_POST['elementsImages'] != NULL){
		deleteImages();
	}
	else{
		echo ' ';
	}
}
else if(isset($_POST['categoryToMove'])){
	if($_POST['categoryToMove'] != NULL){
		moveImages();
	}
	else{
		echo ' ';
	}
}

function deleteCategory(){
	$id = mysqlInjection($_POST['deleteCategory']);
	$nbrImagesDelete = 0;
	$sql = mysqlRequest("SELECT id,nbrImages FROM members WHERE login='".mysqlInjection($_SESSION['login'])."'");
	$row = mysql_fetch_row($sql);
	$idLogin = $row[0];
	$nbrImages = $row[1];
	$sql = mysqlRequest("SELECT FK_member FROM categories WHERE id='".$id."'");
	$row = mysql_fetch_row($sql);
	if($row[0] == $idLogin){
		$sql = mysqlRequest("SELECT nom,directory FROM images WHERE FK_category='".$id."'");
		while($row = mysql_fetch_array($sql)){
			$nbrImagesDelete++;
			unlink('../'.$row['directory'].$row['nom']);
			unlink('../'.$row['directory'].'miniatures/grandes/'.$row['nom']);
			unlink('../'.$row['directory'].'miniatures/moyennes/'.$row['nom']);
			unlink('../'.$row['directory'].'miniatures/petites/'.$row['nom']);
		}
		$sql = mysqlRequest("DELETE FROM images WHERE FK_category='".$id."'");
		$sql = mysqlRequest("DELETE FROM categories WHERE id='".$id."'");
		$nbrImagesNow = $nbrImages - $nbrImagesDelete;
		$sql = mysqlRequest("UPDATE members SET nbrImages='".$nbrImagesNow."'");
	}
	echo 'Cat&eacute;gorie correctement supprim&eacute;e.';
}
function addCategory(){
	$sql = mysqlRequest("SELECT id FROM members WHERE login='".mysqlInjection($_SESSION['login'])."'");
	$row = mysql_fetch_row($sql);
	$idLogin = $row[0];
	$newCategory = mysqlInjection(htmlspecialchars($_POST['category'],ENT_QUOTES));
	$sql = mysqlRequest("INSERT INTO categories (nom,parentDirectory,FK_member) VALUES('".$newCategory."','1','".$idLogin."')");
	echo 'Cat&eacute;gorie correctement ajout&eacute;e. <a href="userFolder.html">Rafra&icirc;chir</a>.';
}
function deleteImage(){
	$id = mysqlInjection($_POST['deleteImage']);
	$sql = mysqlRequest("SELECT id,nbrImages FROM members WHERE login='".mysqlInjection($_SESSION['login'])."'");
	$row = mysql_fetch_row($sql);
	$idLogin = $row[0];
	$nbrImages = $row[1] - 1;
	$sql = mysqlRequest("SELECT FK_member,directory,nom FROM images WHERE id='".$id."'");
	$row = mysql_fetch_row($sql);
	if($row[0] == $idLogin){
		$sql = mysqlRequest("DELETE FROM images WHERE id='".$id."'");
		unlink('../'.$row[1].$row[2]);
		unlink('../'.$row[1].'miniatures/grandes/'.$row[2]);
		unlink('../'.$row[1].'miniatures/moyennes/'.$row[2]);
		unlink('../'.$row[1].'miniatures/petites/'.$row[2]);
		mysqlRequest("UPDATE members SET nbrImages='".$nbrImages."' WHERE id='".$idLogin."'");
	}
	echo 'Image correctement supprim&eacute;e.';
}
function deleteCategories(){
	//On effectue la suppression :
	$Elements = $_POST['elementsCategories'];
	$Explode_elements = explode("  ", $Elements);
	$nbrImagesDelete = 0;
	for($i = 0; $i < $_POST['nb_elementsCategories']; $i++){
		$explodeId = explode('category',$Explode_elements[$i+1]);
		$nbr = count($explodeId);
		$id = mysqlInjection($explodeId[$nbr-1]);
		$sql = mysqlRequest("SELECT id,nbrImages FROM members WHERE login='".mysqlInjection($_SESSION['login'])."'");
		$row = mysql_fetch_row($sql);
		$idLogin = $row[0];
		$nbrImages = $row[1];
		$sql = mysqlRequest("SELECT FK_member FROM categories WHERE id='".$id."'");
		$row = mysql_fetch_row($sql);
		if($row[0] == $idLogin){
			$sql = mysqlRequest("SELECT nom,directory FROM images WHERE FK_category='".$id."'");
			while($row = mysql_fetch_array($sql)){
				$nbrImagesDelete++;
				unlink('../'.$row['directory'].$row['nom']);
				unlink('../'.$row['directory'].'miniatures/grandes/'.$row['nom']);
				unlink('../'.$row['directory'].'miniatures/moyennes/'.$row['nom']);
				unlink('../'.$row['directory'].'miniatures/petites/'.$row['nom']);
			}
			$sql = mysqlRequest("DELETE FROM images WHERE FK_category='".$id."'");
			$sql = mysqlRequest("DELETE FROM categories WHERE id='".$id."'");
			$nbrImagesNow = $nbrImages - $nbrImagesDelete;
			$sql = mysqlRequest("UPDATE members SET nbrImages='".$nbrImagesNow."'");
		}
	}
	echo '<p>Entr&eacute;e(s) correctement supprim&eacute;e(s) !</p>';
}
function deleteImages(){
	//On effectue la suppression :
	$Elements = $_POST['elementsImages'];
	$Explode_elements = explode("  ", $Elements);
	$nbrImagesDelete = 0;
	for($i = 0; $i < $_POST['nb_elementsImages']; $i++){
		$explodeId = explode('image',$Explode_elements[$i+1]);
		$nbr = count($explodeId);
		$id = mysqlInjection($explodeId[$nbr-1]);
		$sql = mysqlRequest("SELECT id,nbrImages FROM members WHERE login='".mysqlInjection($_SESSION['login'])."'");
		$row = mysql_fetch_row($sql);
		$idLogin = $row[0];
		$nbrImages = $row[1];
		$sql = mysqlRequest("SELECT FK_member,directory,nom FROM images WHERE id='".$id."'");
		$row = mysql_fetch_row($sql);
		if($row[0] == $idLogin){
			$nbrImagesDelete++;
			$sql = mysqlRequest("DELETE FROM images WHERE id='".$id."'");
			unlink('../'.$row[1].$row[2]);
			unlink('../'.$row[1].'miniatures/grandes/'.$row[2]);
			unlink('../'.$row[1].'miniatures/moyennes/'.$row[2]);
			unlink('../'.$row[1].'miniatures/petites/'.$row[2]);
		}
	}
	$nbrImagesNow = $nbrImages - $nbrImagesDelete;
	$sql = mysqlRequest("UPDATE members SET nbrImages='".$nbrImagesNow."'");
	echo '<p>Entr&eacute;e(s) correctement supprim&eacute;e(s) !</p>';
}
function moveImages(){
	$categoryToMove = mysqlInjection($_POST['categoryToMove']);
	$imageToMove = mysqlInjection($_POST['imagesToMove']);
	$explodeElements = explode("  ", $imageToMove);
	for($i = 0; $i < $_POST['nb_elementsImagesMove']; $i++){
		$explodeId = explode('image',$explodeElements[$i+1]);
		$nbr = count($explodeId);
		$id = mysqlInjection($explodeId[$nbr-1]);
		$sql = mysqlRequest("SELECT id FROM members WHERE login='".mysqlInjection($_SESSION['login'])."'");
		$row = mysql_fetch_row($sql);
		$idLogin = $row[0];
		if($categoryToMove != 'Racine de votre dossier'){
			$sql = mysqlRequest("SELECT id FROM categories WHERE nom='".$categoryToMove."' AND FK_member='".$idLogin."'");
			$row = mysql_fetch_row($sql);
			$idCategory = $row[0];
		}
		else{
			$idCategory = 1;
		}
		if($row[0] != NULL){
			$sql = mysqlRequest("SELECT FK_member,directory,nom FROM images WHERE id='".$id."'");
			$row = mysql_fetch_row($sql);
			if($row[0] == $idLogin){
				$sql = mysqlRequest("UPDATE images SET FK_category='".$idCategory."' WHERE id='".$id."'");
			}
		}
	}
	echo '<p>Entr&eacute;e(s) correctement d&eacute;plac&eacute;e(s) !</p>';
}
?>