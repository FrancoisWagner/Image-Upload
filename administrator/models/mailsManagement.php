<?php
function getBackDataMails(&$content){
	$sql = mysqlRequest("SELECT id,pseudo,mailAddress,timestamp,ip,mail FROM contact");
	while ($row = mysql_fetch_array($sql)){
		$id = $row[0];
		$pseudo = htmlspecialchars($row[1], ENT_QUOTES);
		$mailAddress = htmlspecialchars($row[2], ENT_QUOTES);
		$day = date('d', $row[3]);
		$month = date('F', $row[3]);
		$year = date('Y', $row[3]);
		$ip = $row[4];
		$mail = nl2br(htmlspecialchars($row[5], ENT_QUOTES));
		$content .= '	<tr>
							<td id="mail'.$row['id'].'">'.$id.'</td>
							<td>'.$pseudo.'</td>
							<td>'.$mailAddress.'</td>
							<td>'.$month.' '.$day.', '.$year.'</td>
							<td>'.$ip.'</td>
							<td>
								<span class="info"><span>Supprimer le mail</span><a href="javascript:deleteMail(\''.$id.'\')"><img src="views/images/icones/delete.png" alt="" /></a></span>
								<span class="info"><span>Afficher le mail</span><a href="javascript:showMail(\''.$mail.'\')"><img src="views/images/icones/show.png" alt="" /></a></span>
							</td>
						</tr>
					';
	}
}
?>