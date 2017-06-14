
<?php

/***** Dernière modification : 17/06/2016, Romain TALDU	*****/

require(__DIR__ .'/../../../include/verif_session.php');
//include("../../../include/verif_droits.php");
require(__DIR__ .'/../../../include/config.inc.php');
require(__DIR__ .'/../../../include/connexion.inc.php');
require(__DIR__ .'/model.inc.php');

$origine=$_GET['origine'];

// préparation connexion
$connect = new connection();
$annuel = new annuel($connect);

$resultat=$annuel->suppActivite($_GET['id_activite']);


if($origine=="listing"){header('Location: listing.php');}else{header('Location: calendrier.php');}
