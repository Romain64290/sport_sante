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

$motdepasse=sha1($_POST["repassword"]);

$result=$annuel->majMembrepwd($_SESSION["id_membre"],$motdepasse);

header('Location: mon_profil.php?success=mdp'); exit;

?>