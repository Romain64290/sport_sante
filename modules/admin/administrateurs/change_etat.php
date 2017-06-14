<?php

/***** Dernière modification : 29/06/2016, Romain TALDU	*****/

require(__DIR__ .'/../../../include/verif_session.php');
//include("../../../include/verif_droits.php");
require(__DIR__ .'/../../../plugins/PHPMailer/class.phpmailer.php');
require(__DIR__ .'/../../../include/config.inc.php');
require(__DIR__ .'/../../../include/connexion.inc.php');
require(__DIR__ .'/model.inc.php');

// préparation connexion
$connect = new connection();
$administrateurs = new administrateurs($connect);


$id_membre=$_GET['id_membre'];
$etat=$_GET['etat'];

// Met a jour l'etat de l'administrateur
$administrateurs->changeEtat($id_membre,$etat);

//Si admin est validé
// recupere l'email de l'admin et envoi l'email de confirmation de validation
if($etat==1){
$mail_user=$administrateurs->recupMailUser($id_membre);

$administrateurs->envoiMailValidation($mail_user);

}

header('Location: index.php');