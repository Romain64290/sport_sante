<?php 

/***** Dernière modification : 17/06/2016, Romain TALDU	*****/

require(__DIR__ .'/../../include/config.inc.php');
require(__DIR__ .'/../../include/connexion.inc.php');
require(__DIR__ .'/model.inc.php');

// préparation connexion
$connect = new connection();
$session = new session($connect);

// Hachage du mot de passe
$pass_hache = sha1($_POST['password']);

// Vérification des identifiants
$resultat=$session->verif_identifiant($_POST['login'],$pass_hache);



if (!$resultat)
{
   header ('location: ../../admin/index.php?erreur=1'); 
}
else
{
    session_start();
    $_SESSION['id_membre'] = $resultat['id_membre'];
	$_SESSION['type_membre'] = $resultat['type_membre'];
	$_SESSION['id_typemembre'] = $resultat['id_typemembre'];
    $_SESSION['nom_membre'] = $resultat['nom_membre'];
	$_SESSION['prenom_membre'] = $resultat['prenom_membre'];
	
    header ('location: ../../modules/admin/dashboard/index.php'); 
}
