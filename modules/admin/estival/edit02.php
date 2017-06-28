<?php

/***** Dernière modification : 09/05/2017, Romain TALDU	*****/


require(__DIR__ .'/../../../include/config.inc.php');
require(__DIR__ .'/../../../include/connexion.inc.php');
require(__DIR__ .'/../../../plugins/PHPMailer/class.phpmailer.php');
require(__DIR__ .'/model.inc.php');

// verifie que la session est active, sinon reoriente vers la page de login
require(__DIR__ .'/../../../include/verif_session.php');
//verifie que les droits sont valide si la session est active, sinon reoriente vers la page de login
include("../../../include/verif_droits.php");

$origine=$_POST['origine'];

$menu=2;
if($origine=="calendrier"){$ss_menu=22;}else{$ss_menu=23;}

// préparation connexion
$connect = new connection();
$estival = new estival($connect);



$resultat=$estival->majActivite($_POST['id_activite'],$_POST['nom'],$_POST['date'],$_POST['heure_debut'],$_POST['heure_fin'],$_POST['description'],$_POST['association'],$_POST['lieu'],$_POST['repli'],$_POST['public'],$_POST['limite'],$_POST['couleur'],$_POST['lien_map']);

//envoi d'un email à tous les participants
$estival->emailEditActivite($_POST['id_activite']);


if($origine=="listing"){header('Location: listing.php');}else{header('Location: calendrier.php');}
