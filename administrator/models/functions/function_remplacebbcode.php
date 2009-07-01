<?php
//--------------------------------------------
//	Author: Conception-Web.ch | François Wagner
//	Description: 
//		La fonction sert à remplacer le BB code en code HTML, elle prend en paramètre le texte contenant le BB code
//	Date: 16.09.08
//	Version: 1
//--------------------------------------------
function remplace_bb_code($texte){
	$texte = preg_replace('#\[image\](.+)\[/image\]#isU','<a href="$1"><img src="$1" height="150" alt="" /></a>',$texte); 
	$texte = preg_replace('#\[lien url=(.+)\](.+)\[/lien\]#isU', '<a href="$1">$2</a>', $texte);
	$texte = preg_replace('#\[bold\](.+)\[/bold\]#isU', '<span class="bold">$1</span>', $texte);
	$texte = preg_replace('#\[italique\](.+)\[/italique\]#isU', '<span class="italique">$1</span>', $texte);
	$texte = preg_replace('#\[droite\](.+)\[/droite\]#isU', '<p class="droite">$1</p>', $texte);
	$texte = preg_replace('#\[gauche\](.+)\[/gauche\]#isU', '<p class="gauche">$1</p>', $texte);
	$texte = preg_replace('#\[centre\](.+)\[/centre\]#isU', '<p class="centre">$1</p>', $texte);
	$texte = preg_replace('#\[souligne\](.+)\[/souligne\]#isU', '<span class="souligne">$1</span>', $texte);
	$texte = preg_replace('#</p><br />#i', '</p>', $texte);
	return $texte;
}
?>