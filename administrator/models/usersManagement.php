<?php
function getBackDataMembers(&$content){
	$sql = mysqlRequest("SELECT ".MYSQL_USERS.".id,".MYSQL_USERS.".mail,".MYSQL_USERS.".activation,".MYSQL_USERS.".nbrImages,".MYSQL_USERS.".login,
						".MYSQL_GROUPS.".nom,".MYSQL_USERS.".timestamp FROM ".MYSQL_USERS." LEFT JOIN ".MYSQL_GROUPS." ON ".MYSQL_GROUPS.".id = ".MYSQL_USERS.".FK_droit");
	while ($row = mysql_fetch_array($sql)){
		// On affiche pas l'utilisateur Image-Upload
		if($row[0] != 1){
			$id = $row[0];
			$mail = htmlspecialchars($row[1], ENT_QUOTES);
			$activation = htmlspecialchars($row[2], ENT_QUOTES);
			$nbrImages = htmlspecialchars($row[3], ENT_QUOTES);
			$login = htmlspecialchars($row[4], ENT_QUOTES);
			$droit = htmlspecialchars($row[5], ENT_QUOTES);
			$day = date('d', $row[6]);
			$month = date('F', $row[6]);
			$year = date('Y', $row[6]);
			$content .= '	<tr>
								<td id="user'.$row['id'].'">'.$id.'</td>
								<td>'.$login.'</td>
								<td>'.$mail.'</td>';
			if($activation != 1){
				$content .= '	<td id="activation'.$activation.'">Non activé (<a href="javascript:activation(\''.$login.'\',\''.$activation.'\');">Activer le compte</a>)</td>';
			}
			else{
				$content .= '	<td>Compte activé</td>';
			}
			$content .= '		<td>'.$nbrImages.'</td>
								<td>'.$month.' '.$day.', '.$year.'</td>
								<td>'.$droit.'</td>
								<td>
									<span class="info"><span>Supprimer l\'utilisateur</span><a href="javascript:deleteUser(\''.$id.'\')"><img src="views/images/icones/delete.png" alt="" /></a></span>
									<span class="info"><span>Afficher ses images</span><a href="index.php?page=imagesManagement&amp;user='.$id.'"><img src="views/images/icones/show.png" alt="" /></a></span>
								</td>
							</tr>
						';
		}
	}
}
?>