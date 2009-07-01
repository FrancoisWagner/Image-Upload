<?php
//--------------------------------------------
//	Author: Conception-Web.ch | François Wagner
//	Description: 
//		La fonction sert à retourner un jour en français.
//		La fonction prend en argument un jour en anglais.
//	Date: 22.05.08
//	Version: 1
//--------------------------------------------
function dayInFrench($day){
	switch($day){
		case 'Monday':
			$day_french='lundi';
			break;
		case 'Tuesday':
			$day_french='mardi';
			break;
		case 'Wednesday':
			$day_french='mercredi';
			break;
		case 'Thursday':
			$day_french='jeudi';
			break;
		case 'Friday':
			$day_french='vendredi';
			break;
		case 'Saturday':
			$day_french='samedi';
			break;
		case 'Sunday':
			$day_french='dimanche';
			break;
	}
	return $day_french;
}
?>