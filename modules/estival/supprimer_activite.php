<?php

/***** Dernière modification : 17/06/2016, Romain TALDU	*****/

require(__DIR__ .'/../../include/config.inc.php');
require(__DIR__ .'/../../include/connexion.inc.php');
require(__DIR__ .'/model.inc.php');


/* Démarrage ou prolongation de la session */
session_start();

// préparation connexion
$connect = new connection();
$fo_estival = new fo_estival($connect);

/* Article exemple */
$id = $_GET['supp'];
$valid = $_GET['validation'];
$retrait = $fo_estival->supprim_article($id); 


if($valid=="ok"){Header("Location:inscription.php");}else{Header("Location:index.php");}
?>
