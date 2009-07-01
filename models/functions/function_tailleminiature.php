<?php
/////////////////////////////////////////////////////////////////////////////////////////////
// Définir les hauteurs et largeurs d'images en miniatures
/////////////////////////////////////////////////////////////////////////////////////////////
function TailleMiniature($adresse_image,$largeur_min){
	list($largeur_original, $hauteur_original) = getimagesize($adresse_image);
	$pourcentage=$largeur_min/$largeur_original*100;
	$hauteur_min=$hauteur_original-(100-$pourcentage)*($hauteur_original/100);
	$hauteur_min=(int)$hauteur_min;
	return array($hauteur_min,$largeur_min);
}
?>