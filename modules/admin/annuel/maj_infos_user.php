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

$accepte = empty($_POST['accepte']) ? "" : $_POST['accepte'];

$result=$annuel->majMembre($_SESSION["id_membre"],$_POST["telephone"],$_POST["residence"],$accepte);

header('Location: mon_profil.php?success=info'); exit;

?>