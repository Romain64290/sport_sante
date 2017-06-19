<?php
 
 /***** Dernière modification : 01/09/2016, Romain TALDU	*****/
 
  /**
 *Définition de l'ensemble des constantes
 * 
 **/ 
   
   
   
  // Adresse du serveur de base de données
  define('DB_SERVEUR', 'localhost');

  // Login
  define('DB_LOGIN','root');
 
  // Mot de passe
  define('DB_PASSWORD','eruption');
 
  // Nom de la base de données
  define('DB_NOM','sport');
 
  // Driver correspondant à la BDD utilisée
  define('DB_DSN','mysql:host='. DB_SERVEUR .';dbname='. DB_NOM);

    
  // DATE DU JOUR (DATE TIME)
  define('DATETIME_JOUR', date('Y-m-d H:i:s'));
  
  // From email dev
  //define("FROM_EMAIL","bvnhgfhgfh@gmail.com");
  // From email prod
  define("FROM_EMAIL","NO-REPLY@agglo-pau.net");
  
  
  // Réglage des locales
  setlocale(LC_ALL, 'fr_FR.UTF-8');
  
   // Adresse du site
   define("URL_SITE", "https://".$_SERVER['HTTP_HOST']);
  
  // Adapter le logo de l'administration en fonction de l'url d'origine.
 if($_SERVER['HTTP_HOST']=="sport2.cyberbase.local"){define("LOGO_ADMIN", "logo_pausport.png");}  //version dev
 if($_SERVER['HTTP_HOST']=="efapau1.agglo-pau.fr"){define("LOGO_ADMIN", "logo_enforme.png");}		
 if($_SERVER['HTTP_HOST']=="mapausport.agglo-pau.fr"){define("LOGO_ADMIN", "logo_pausport.png");}
 if($_SERVER['HTTP_HOST']=="efapau2.agglo-pau.fr"){define("LOGO_ADMIN", "logo_enforme.png");}
