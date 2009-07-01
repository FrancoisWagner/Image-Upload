<?php
//--------------------------------------------
//	Author: Fran�ois Wagner
//	Mail: francois.wagner@yahoo.fr
//	Description: 
//		La fonction sert � retourner un mois en fran�ais.
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
			$month_french='f�vrier';
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
			$month_french='ao�t';
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
			$month_french='d�cembre';
			break;
	}
	return $month_french;
}