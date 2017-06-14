<?php

/***** Dernière modification : 05/05/2017, Romain TALDU	*****/


class connection{	
 
public $con = '';

function __construct(){

    $this->connect();   

}

function connect(){

    try{
        $this->con = new PDO("mysql:host=".DB_SERVEUR.";dbname=".DB_NOM,DB_LOGIN, DB_PASSWORD);
        $this->con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $this->con->exec('SET NAMES utf8');
    	}
   
   catch(PDOException $e){
        echo 'Hoooppps, Il y a une erreur de connexion à la base de données!';
		echo $e->getMessage().PHP_EOL;
    					}
} 

 
				}
