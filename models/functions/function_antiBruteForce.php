<?php
function antiBruteForce($login,$password){
	$quota = 10;
	$login = trim($login);
	$password = $password;
	$dirFilesBruteForce = REALPATH_SITE.'bruteforce';
	if(!file_exists($dirFilesBruteForce.'/'.$login.'.bf')){
		writeBruteForceFile($dirFilesBruteForce,0,$login);
		return true;
	}
	else{
		/* On r�cup�re nos informations */
        $handle = fopen($dirFilesBruteForce.'/'.$login.'.bf', 'r+');
        $informationQuota = fgets($handle,4096);
		fclose($handle);            
		/* On s�pare nos valeurs */
        $informationQuota = explode('-SEPARATEUR-',$informationQuota);
		/* Si ce n'est pas la date d'aujourd'hui on remet le compteur � 0 et on affecte nous m�me les valeurs */
        if( $informationQuota[1] != date('y-m-d')){
            writeBruteForceFile($dirFilesBruteForce,0,$login);
            $informationQuota[0] = 0;
        }
		/* On regarde si le quotas n'est pas atteint on pourra donc v�rifier nos informations */
        if($quota > $informationQuota[0]){
			if(!passwordTrue($login,$password)){
				writeBruteForceFile($dirFilesBruteForce,($informationQuota[0]+1),$login);
				return true;
			}
			else{
				return true;
			}
        }
		else{
			return false;
		}
	}
}
function writeBruteForceFile($file,$quota,$login){
    $handle = fopen($file.'/'.$login.'.bf', 'w+');
    fwrite($handle,$quota.'-SEPARATEUR-'.date('y-m-d'));
    fclose($handle);
}
?>