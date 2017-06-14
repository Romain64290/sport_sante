<?php

/***** Dernière modification : 17/06/2016, Romain TALDU	*****/

require(__DIR__ .'/../../include/config.inc.php');
require(__DIR__ .'/../../include/connexion.inc.php');
require(__DIR__ .'/../../plugins/PHPMailer/class.phpmailer.php');
require(__DIR__ .'/model.inc.php');


/* Démarrage ou prolongation de la session */
session_start();

// préparation connexion
$connect = new connection();
$fo_entreprise = new fo_entreprise($connect);


// Insertion de l'utilisateur et Affichage d'une message d"erreur en cas de pb
$resultat=$fo_entreprise->insertionUtilisateur($_POST['civilite'],$_POST['nom'],$_POST['prenom'],$_POST['telephone'],$_POST['email'],$_POST['collectivite'],$_POST['lieu_travail'],$_POST['direction'],$_POST['naissance'],$_POST['accepte']);
if(!$resultat){Header("Location:validation_inscription.php?erreur=pbinsert");}

else{
	
// Recuperation de l'id de l'envoi 
$id_envoi=$resultat;
}

//Ajout de l'activite si elle n'est pas pleine et insertion.
$nb_articles = count($_SESSION['activite']['id_activite']);
if($nb_articles ==0){Header("Location:validation_inscription.php?erreur=aucune_activite");exit;}
$activite_pleine="";
    for($i = 0; $i < $nb_articles; $i++)
    {
 $resultat2=$fo_entreprise->insertionActivite($id_envoi,$_SESSION['activite']['id_activite'][$i]);    
 $activite_pleine.=$resultat2;
    } 


//recupération la reservation pour envoi email
$resa=$fo_entreprise->afficheReservation($id_envoi);

//recupération de l'email de l'utilisateur
$email_user=$fo_entreprise->recupMailUser($id_envoi);

//envoi du mail de confirmation d'incription
$resultat3=$fo_entreprise->envoiMailConfirmation($id_envoi,$resa,$email_user);


header("Location:validation_inscription.php?id_user=$id_envoi&activite_pleine=$activite_pleine");