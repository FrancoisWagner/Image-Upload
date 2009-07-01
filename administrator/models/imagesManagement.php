<?php
function getBackDataImages(&$content,$id){
	if($id != NULL){
		$sql = mysqlRequest("SELECT images.id,images.nom,images.taille,images.poids,images.timestamp,images.directory,".MYSQL_USERS.".login FROM images LEFT JOIN ".MYSQL_USERS." ON images.FK_member = ".MYSQL_USERS.".id WHERE images.FK_member=".$id);
	}
	else{
		$sql = mysqlRequest("SELECT images.id,images.nom,images.taille,images.poids,images.timestamp,images.directory,".MYSQL_USERS.".login FROM images LEFT JOIN ".MYSQL_USERS." ON images.FK_member = ".MYSQL_USERS.".id");
	}
	while($row = mysql_fetch_array($sql)){
		$day = date('d', $row['timestamp']);
		$month = date('F', $row['timestamp']);
		$year = date('Y', $row['timestamp']);
		$login = htmlspecialchars($row['login'],ENT_QUOTES);
		$content .= 
					'<tr>
						<td><input type="checkbox" id="image'.$row['id'].'" /></td>
						<td><span class="info"><span><img src="../'.$row['directory'].'miniatures/petites/'.$row['nom'].'" alt="" /></span><a href="#" onclick="javascript:showImage(\'../\',\''.$row['directory'].'\',\''.$row['nom'].'\')">'.$row['nom'].'</a></span></td>
						<td>'.$row['taille'].'</td>
						<td>'.getsizename($row['poids']).'</td>
						<td>'.$month.' '.$day.', '.$year.'</td>
						<td>'.$login.'</td>
						<td><span class="info"><span>Supprimer l\'image</span><a href="javascript:deleteImage(\''.$row['id'].'\')"><img src="views/images/icones/delete.png" alt="" /></a></span></td>
					</tr>';
	}
}
?>