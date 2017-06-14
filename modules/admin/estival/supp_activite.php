
<?php

/***** Dernière modification : 09/05/2017, Romain TALDU	*****/


require(__DIR__ .'/../../../include/config.inc.php');
require(__DIR__ .'/../../../include/connexion.inc.php');
require(__DIR__ .'/model.inc.php');
// verifie que la session est active, sinon reoriente vers la page de login
require(__DIR__ .'/../../../include/verif_session.php');
//verifie que les droits sont valide si la session est active, sinon reoriente vers la page de login
include("../../../include/verif_droits.php");

$origine=$_GET['origine'];

// préparation connexion
$connect = new connection();
$estival = new estival($connect);

$resultat=$estival->suppActivite($_GET['id_activite']);


if($origine=="listing"){header('Location: listing.php');}else{header('Location: calendrier.php');}
