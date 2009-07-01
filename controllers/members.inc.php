<?php
//**********************************************************************
//	Nom: members.inc.php
//	Description: page affichant un tableau contenant tout les membres du site
//	Version: 2.0
//	Auteur: François Wagner
//	Date: Avril-mai 2009
//**********************************************************************
// Inclusion du modèle
include_once('models/members.php');
// Déclaration des variables
$content = '';
$message = '';
// Appel des fonctions
getBackDataMembers($content);
// Inclusion de la vue
include_once('views/members.php');
?>