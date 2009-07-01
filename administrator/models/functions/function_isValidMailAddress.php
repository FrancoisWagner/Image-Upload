<?php
function isValidMailAddress($mailAddress){
	if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#",$mailAddress)){
		return true;
	}
	else return false;
}
?>