<?php

/***** Dernière modification : 17/06/2016, Romain TALDU	*****/

session_start();

/*
si la variable de session login n'existe pas cela siginifie que le visiteur
n'a pas de session ouverte, il n'est donc pas logué ni autorisé à
acceder à l'espace membres*/

if(!isset($_SESSION['id_membre'])) {
  header ('location: ../../../admin/index.php'); 
  exit;
}