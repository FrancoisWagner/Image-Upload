<?php
session_start();
include_once('functions/mysqlLibrary.php');
include_once('functions/function_isLogged.php');
include_once('../../config.php');

if(isset($_POST['deleteImage'])){
	if($_POST['deleteImage'] != NULL){
		deleteImage();
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
if(isset($_POST['deleteUser'])){
	if($_POST['deleteUser'] != NULL){
		deleteUser();
	}
	else{
		echo ' ';
	}
}
if(isset($_POST['deleteMail'])){
	if($_POST['deleteMail'] != NULL){
		deleteMail();
	}
	else{
		echo ' ';
	}
}
if(isset($_POST['login']) AND isset($_POST['activation'])){
	if($_POST['login'] != NULL AND $_POST['activation'] != NULL){
		activation();
	}
	else{
		echo 'Non activ&eacute;';
	}
}
function deleteImages(){
	//On effectue la suppression :
	$Elements = $_POST['elementsImages'];
	$Explode_elements = explode("  ", $Elements);
	for($i = 0; $i < $_POST['nb_elementsImages']; $i++){
		$explodeId = explode('image',$Explode_elements[$i+1]);
		$nbr = count($explodeId);
		$id = mysqlInjection($explodeId[$nbr-1]);
		// On détermine le droit de cette utilisateur
		$sql = mysqlRequest("SELECT FK_droit FROM members WHERE login = '".mysqlInjection($_SESSION['login'])."'");
		$row = mysql_fetch_row($sql);
		$droit = $row[0];
		// Si l'utilisateur est administrateur on peut supprimer l'image
		if($row[0] == 1){
			$sql = mysqlRequest("SELECT members.nbrImages FROM members LEFT JOIN images ON images.FK_member = ".MYSQL_USERS.".id WHERE images.id='".$id."'");
			$row = mysql_fetch_row($sql);
			$nbrImages = $row[0];
			$sql = mysqlRequest("SELECT FK_member,directory,nom FROM images WHERE id='".$id."'");
			$row = mysql_fetch_row($sql);
			$sql = mysqlRequest("DELETE FROM images WHERE id='".$id."'");
			unlink(REALPATH_SITE.$row[1].$row[2]);
			unlink(REALPATH_SITE.$row[1].'miniatures/grandes/'.$row[2]);
			unlink(REALPATH_SITE.$row[1].'miniatures/moyennes/'.$row[2]);
			unlink(REALPATH_SITE.$row[1].'miniatures/petites/'.$row[2]);
			$nbrImages--;
			$sql = mysqlRequest("UPDATE members SET nbrImages='".$nbrImages."' WHERE id='".$row[0]."'");
		}
	}
	echo '<p>Entr&eacute;e(s) correctement supprim&eacute;e(s) !</p>';
}

function deleteImage(){
	$id = mysqlInjection($_POST['deleteImage']);
	$sql = mysqlRequest("SELECT FK_droit FROM members WHERE login = '".mysqlInjection($_SESSION['login'])."'");
	$row = mysql_fetch_row($sql);
	$droit = $row[0];
	if($row[0] == 1){
		$sql = mysqlRequest("SELECT members.nbrImages FROM members LEFT JOIN images ON images.FK_member = ".MYSQL_USERS.".id WHERE images.id='".$id."'");
		$row = mysql_fetch_row($sql);
		$nbrImages = $row[0] - 1;
		$sql = mysqlRequest("SELECT FK_member,directory,nom FROM images WHERE id='".$id."'");
		$row = mysql_fetch_row($sql);
		$sql = mysqlRequest("DELETE FROM images WHERE id='".$id."'");
		unlink(REALPATH_SITE.$row[1].$row[2]);
		unlink(REALPATH_SITE.$row[1].'miniatures/grandes/'.$row[2]);
		unlink(REALPATH_SITE.$row[1].'miniatures/moyennes/'.$row[2]);
		unlink(REALPATH_SITE.$row[1].'miniatures/petites/'.$row[2]);
		$sql = mysqlRequest("UPDATE members SET nbrImages='".$nbrImages."' WHERE id='".$row[0]."'");
		echo 'Image correctement supprim&eacute;e.';
	}
	else{
		echo 'Vous n\'avez pas les droits pour supprimer cette image.';
	}
}
function deleteUser(){
	$id = mysqlInjection($_POST['deleteUser']);
	$sql = mysqlRequest("SELECT FK_droit FROM members WHERE login = '".mysqlInjection($_SESSION['login'])."'");
	$row = mysql_fetch_row($sql);
	$droit = $row[0];
	if($row[0] == 1){
		$sql = mysqlRequest("DELETE FROM images WHERE FK_member='".$id."'");
		$sql = mysqlRequest("DELETE FROM categories WHERE FK_member='".$id."'");
		$sql = mysqlRequest("DELETE FROM members WHERE id='".$id."'");
		echo 'Utilisateur correctement supprim&eacute;.';
	}
	else{
		echo 'Vous n\'avez pas les droits pour supprimer cette image.';
	}
}
function deleteMail(){
	$id = mysqlInjection($_POST['deleteMail']);
	$sql = mysqlRequest("SELECT FK_droit FROM members WHERE login = '".mysqlInjection($_SESSION['login'])."'");
	$row = mysql_fetch_row($sql);
	$droit = $row[0];
	if($row[0] == 1){
		$sql = mysqlRequest("DELETE FROM contact WHERE id='".$id."'");
		echo 'Mail correctement supprim&eacute;.';
	}
	else{
		echo 'Vous n\'avez pas les droits pour supprimer cette image.';
	}
}
function activation(){
	$login = mysqlInjection($_POST['login']);
	$activation = mysqlInjection($_POST['activation']);
	$sql = mysqlRequest("UPDATE members SET activation=1 WHERE login='".$login."' AND activation='".$activation."'");
	if($sql){
		echo 'Compte activ&eacute;';
	}
	else{
		echo 'Non activ&eacute;';
	}
}
?>