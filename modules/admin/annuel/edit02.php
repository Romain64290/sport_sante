<?php

/***** Dernière modification : 17/06/2016, Romain TALDU	*****/

require(__DIR__ .'/../../../include/verif_session.php');
//include("../../../include/verif_droits.php");
require(__DIR__ .'/../../../include/config.inc.php');
require(__DIR__ .'/../../../include/connexion.inc.php');
require(__DIR__ .'/model.inc.php');

$origine=$_POST['origine'];

$menu=3;
if($origine=="calendrier"){$ss_menu=32;}else{$ss_menu=33;}

// préparation connexion
$connect = new connection();
$annuel = new annuel($connect);


$resultat=$annuel->majActivite($_POST['id_activite'],$_POST['nom'],$_POST['date'],$_POST['heure_debut'],$_POST['heure_fin'],$_POST['description'],$_POST['association'],$_POST['lieu'],$_POST['repli'],$_POST['public'],$_POST['limite'],$_POST['couleur']);


if($origine=="listing"){header('Location: listing.php');}else{header('Location: calendrier.php');}
