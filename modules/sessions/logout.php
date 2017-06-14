<?php 

/***** Dernière modification : 17/06/2016, Romain TALDU	*****/

session_start();

// Suppression des variables de session et de la session

$_SESSION = array();
session_destroy();

header ('location: ../../admin/index.php'); 

?>