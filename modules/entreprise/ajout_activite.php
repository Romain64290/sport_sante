<?php

/***** Dernière modification : 17/06/2016, Romain TALDU	*****/

require(__DIR__ .'/../../include/config.inc.php');
require(__DIR__ .'/../../include/connexion.inc.php');
require(__DIR__ .'/model.inc.php');


/* Démarrage ou prolongation de la session */
session_start();

// préparation connexion
$connect = new connection();
$fo_entreprise = new fo_entreprise($connect);

/* Article exemple */
$id = $_GET['ajout'];
$verif=$fo_entreprise->verif_panier($id);

if($verif==true){}else{


// affiche les infos de l'activité selectionnée
$result = $fo_entreprise->afficheInfoActivite($id);
 
$titre=$result[0]->titre_entreprise_activite;

$date=$result[0]->start_entreprise_activite;
$date=explode(" ",$date);
$jour=explode("-",$date[0]);
$date_calendar=$date[0];
$heure=explode(":",$date[1]);
$date="le ".$jour[2]."/".$jour[1]." à ".$heure[0]."h".$heure[1];


$color2=$result[0]->color_selection_entreprise_activite;

/* On vérifie l'existence du activite, sinon, on le crée */
if(!isset($_SESSION['activite']))
{
    /* Initialisation du activite */
    $_SESSION['activite'] = array();
    /* Subdivision du activite */
    $_SESSION['activite']['id_activite'] = array();
	$_SESSION['activite']['titre'] = array();
	$_SESSION['activite']['date'] = array();
	$_SESSION['activite']['date_calendar'] = array();
	$_SESSION['activite']['color'] = array();
  
}

/* Ici, on sait que le activite existe, donc on ajoute l'article dedans. */
array_push($_SESSION['activite']['id_activite'],$id);
array_push($_SESSION['activite']['titre'],$titre);
array_push($_SESSION['activite']['date'],$date);
array_push($_SESSION['activite']['date_calendar'],$date_calendar);
array_push($_SESSION['activite']['color'],$color2);

}



//var_dump($_SESSION['activite']);
//unset($_SESSION['activite']); 
Header("Location:index.php");
?>