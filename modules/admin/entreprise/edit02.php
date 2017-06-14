<?php

/***** Dernière modification : 05/05/2017, Romain TALDU	*****/


require(__DIR__ .'/../../../include/config.inc.php');
require(__DIR__ .'/../../../include/connexion.inc.php');
require(__DIR__ .'/model.inc.php');
// verifie que la session est active, sinon reoriente vers la page de login
require(__DIR__ .'/../../../include/verif_session.php');
//verifie que les droits sont valide si la session est active, sinon reoriente vers la page de login
include("../../../include/verif_droits.php");


$origine=$_POST['origine'];

$menu=4;
if($origine=="calendrier"){$ss_menu=42;}else{$ss_menu=43;}

// préparation connexion
$connect = new connection();
$entreprise = new entreprise($connect);



$resultat=$entreprise->majActivite($_POST['id_activite'],$_POST['nom'],$_POST['date'],$_POST['heure_debut'],$_POST['heure_fin'],$_POST['description'],$_POST['lieu'],$_POST['repli'],$_POST['limite'],$_POST['couleur']);


if($origine=="listing"){header("Location: listing.php");}else{header("Location: calendrier.php");}
