<?php

/***** Dernière modification : 17/06/2016, Romain TALDU	*****/


require(__DIR__ .'/../../../include/config.inc.php');
require(__DIR__ .'/../../../include/connexion.inc.php');
require(__DIR__ .'/model.inc.php');
// verifie que la session est active, sinon reoriente vers la page de login
require(__DIR__ .'/../../../include/verif_session.php');
//verifie que les droits sont valide si la session est active, sinon reoriente vers la page de login
include("../../../include/verif_droits.php");

$origine=$_GET['origine'];
$id_activite=$_GET['id_activite'];
$id_user=$_GET['id_user'];

// préparation connexion
$connect = new connection();
$entreprise = new entreprise($connect);

$resultat=$entreprise->suppUser($id_activite,$id_user);

if($origine=="recherche"){
header('Location: recherche_participant.php');
}else{
header('Location: edit.php?id_activite='.$id_activite.'&origine='.$origine);
}