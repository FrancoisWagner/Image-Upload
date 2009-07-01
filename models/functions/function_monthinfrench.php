<?php
//--------------------------------------------
//	Author: François Wagner
//	Mail: francois.wagner@yahoo.fr
//	Description: 
//		La fonction sert à retourner un mois en français.
//		La fonction prend en argument un mois en anglais.
//	Date: 22.05.08
//	Version: 1
//--------------------------------------------
function monthInFrench($month){
	switch($month){
		case 'January':
			$month_french='janvier';
			break;
		case 'February':
			$month_french='février';
			break;
		case 'March':
			$month_french='mars';
			break;
		case 'April':
			$month_french='avril';
			break;
		case 'May':
			$month_french='mai';
			break;
		case 'June':
			$month_french='juin';
			break;
		case 'July':
			$month_french='juillet';
			break;
		case 'August':
			$month_french='août';
			break;
		case 'September':
			$month_french='septembre';
			break;
		case 'October':
			$month_french='octobre';
			break;
		case 'November':
			$month_french='novembre';
			break;
		case 'December':
			$month_french='décembre';
			break;
	}
	return $month_french;
}