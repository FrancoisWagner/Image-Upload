<?php
function nbrUsers(&$nbrUsers){
	// Initialisation des variables
	$sql = '';
	$nbrUsers = '';
	// ***************************
	$sql = mysqlRequest("SELECT COUNT(*) FROM members");
	$nbrUsers = mysql_result($sql,0);
}
function nbrImages(&$nbrImages){
	// Initialisation des variables
	$sql = '';
	$nbrImages = '';
	// ***************************
	$sql = mysqlRequest("SELECT COUNT(*) FROM images");
	$nbrImages = mysql_result($sql,0);
}
function sizeImages(&$sizeImages){
	// Initialisation des variables
	$sql = '';
	$row = '';
	// ***************************
	$sql = mysqlRequest("SELECT poids FROM images");
	while($row = mysql_fetch_array($sql)){
		$sizeImages += $row['poids'];
	}
	$sizeImages = getsizename($sizeImages);
}
function getInfosUser(&$nbrImagesUser,&$sizeImagesUser,&$dateSignUp){
	// Initialisation des variables
	$login = '';
	$sql = '';
	$row = '';
	$day = '';
	$month = '';
	$year = '';
	$dateSignUp = '';
	$nbrImagesUser = '';
	// ***************************
	$login = mysqlInjection($_SESSION['login']);
	$request = mysqlRequest("SELECT timestamp,id FROM members WHERE login = '".$login."'");
	$row = mysql_fetch_row($request);
	$day = date('d',$row[0]);
	$month = monthInFrench(date('F',$row[0]));
	$year = date('Y',$row[0]);
	$dateSignUp = $day.' '.$month.' '.$year;
	$id = $row[1];
	$sql = mysqlRequest("SELECT COUNT(*) FROM images WHERE FK_member='".$id."'");
	$nbrImagesUser = mysql_result($sql,0);
	$sql = mysqlRequest("SELECT images.poids FROM images LEFT JOIN members ON images.FK_member = members.id WHERE members.id = '".$id."'");
	while($row = mysql_fetch_array($sql)){
		$sizeImagesUser += $row['poids'];
	}
	$sizeImagesUser = getsizename($sizeImagesUser);
}
?>