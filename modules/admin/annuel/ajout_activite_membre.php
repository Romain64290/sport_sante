<?php

/***** Dernière modification : 02/11/2016, Romain TALDU	*****/

require(__DIR__ .'/../../../include/verif_session.php');
//include("../../../include/verif_droits.php");
require(__DIR__ .'/../../../include/config.inc.php');
require(__DIR__ .'/../../../include/connexion.inc.php');
require(__DIR__ .'/model.inc.php');

// préparation connexion
$connect = new connection();
$annuel = new annuel($connect);

$result=$annuel->addActiviteMembre($_SESSION["id_membre"],$_GET["ajout"]);

header('Location: mon_calendrier.php?success='.$result); exit;

?>