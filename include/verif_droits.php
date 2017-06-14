<?php

/***** Dernière modification : 15/05/2016, Romain TALDU	*****/



// réoriente les utilisateurs d'En forme à Pau annuel vers la page de login,
//s'il tente de se conecter à des zones interdites.

if($_SESSION['id_typemembre']==1) {
  header ('location: ../../../admin/index.php'); 
  exit;
}