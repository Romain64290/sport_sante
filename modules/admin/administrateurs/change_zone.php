<?php

/***** Dernière modification : 17/06/2016, Romain TALDU	*****/

require(__DIR__ .'/../../../include/verif_session.php');
//include("../../../include/verif_droits.php");
require(__DIR__ .'/../../../include/config.inc.php');
require(__DIR__ .'/../../../include/connexion.inc.php');
require(__DIR__ .'/model.inc.php');

// préparation connexion
$connect = new connection();
$administrateurs = new administrateurs($connect);

$id_zone=$_GET['zone'];
$id_membre=$_GET['id_membre'];
$etat=$_GET['etat'];

$administrateurs->changeZone($id_membre,$id_zone,$etat);

header('Location: index.php');