<?php
//--------------------------------------------
//	Author: François Wagner
//	Mail: francois.wagner@yahoo.fr
//	Description: 
//		La fonction sert à retourner la bonne unité de mesure (octet, ko, Mo ou Go).
//		La fonction prend en argument une taille en octets.
//	Date: 22.05.08
//	Version: 1
//--------------------------------------------
function getsizename($octet){
    // Array contenant les differents unités 
    $unite = array(' octets',' ko',' Mo',' Go');
    if($octet < 1000){// octet
		return $octet.$unite[0];
    }
	else{
		if ($octet < 1000000){// ko
			$ko = round($octet/1024,2);
            return $ko.$unite[1];
        }
        else{// Mo ou Go 
            if($octet < 1000000000){// Mo 
                $mo = round($octet/(1024*1024),2);
                return $mo.$unite[2];
            }
            else{// Go 
                $go = round($octet/(1024*1024*1024),2);
                return $go.$unite[3];    
            }
        }
    }
}
?>