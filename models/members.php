<?php
function getBackDataMembers(&$content){
	// Initialisation des variables
	$sql = '';
	$row = '';
	$login = '';
	$day = '';
	$month = '';
	$year = '';
	$nbrImages = '';
	// ***************************
	//$sql = mysqlRequest("SELECT id, login, timestamp FROM members");
	$sql = mysqlRequest("SELECT members.id, members.login, members.timestamp,COUNT(images.id) AS nbrImages FROM members LEFT JOIN images ON images.FK_member=members.id GROUP BY members.id");
	while ($row = mysql_fetch_array($sql)){
		// On affiche pas l'utilisateur Image-Upload
		if($row['id'] != 1){
			$id = $row['id'];
			$login = htmlspecialchars($row['login'], ENT_QUOTES);
			$day = date('d', $row['timestamp']);
			$month = date('F', $row['timestamp']);
			$year = date('Y', $row['timestamp']);
			//$sql2 = mysqlRequest("SELECT COUNT(*) FROM images WHERE FK_member='".$id."'");
			$nbrImages = $row['nbrImages'];
			$content .= '	<tr>
								';//<td>'.$id.'</td>
			$content .= '		<td>'.$login.'</td>
								<td>'.$month.' '.$day.', '.$year.'</td>
								<td>'.$nbrImages.'</td>
							</tr>
						';
		}
	}
}
?>