
<?php

/***** Dernière modification : 17/06/2016, Romain TALDU	*****/

require(__DIR__ .'/../../../include/verif_session.php');
//include("../../../include/verif_droits.php");
require(__DIR__ .'/../../../include/config.inc.php');
require(__DIR__ .'/../../../include/connexion.inc.php');
require(__DIR__ .'/model.inc.php');

$id_activite=$_GET['id_activite'];


// préparation connexion
$connect = new connection();
$annuel = new annuel($connect);

$resultat=$annuel->suppMonActivite($id_activite,$_SESSION["id_membre"]);

header('Location: mes_activites.php?success=ok');