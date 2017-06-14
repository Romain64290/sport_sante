<?php

/***** Dernière modification : 29/05/2017, Romain TALDU	*****/

require(__DIR__ .'/../../../include/config.inc.php');
require(__DIR__ .'/../../../include/connexion.inc.php');
require(__DIR__ .'/model.inc.php');

// verifie que la session est active, sinon reoriente vers la page de login
require(__DIR__ .'/../../../include/verif_session.php');
//verifie que les droits sont valide si la session est active, sinon reoriente vers la page de login
include("../../../include/verif_droits.php");

// préparation connexion
$connect = new connection();
$estival = new estival($connect);

$id_activite=$_GET['id_activite'];
$id_usager=$_GET['id_user'];
$etat=$_GET['etat'];



$estival->changePresence($id_usager,$etat,$id_activite); 

header('Location:edit.php?id_activite='.$id_activite);