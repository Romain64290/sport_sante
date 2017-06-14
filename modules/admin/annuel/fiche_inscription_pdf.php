<?php

/***** Dernière modification : 17/06/2016, Romain TALDU	*****/

require(__DIR__ .'/../../../include/verif_session.php');
require(__DIR__ .'/../../../include/config.inc.php');
require(__DIR__ .'/../../../include/connexion.inc.php');
require(__DIR__ .'/model.inc.php');


$email=$_GET['email'];
$motdepasse=$_GET['motdepasse'];   
   
// préparation connexion
$connect = new connection();
$annuel = new annuel($connect);
	
//$inscription=$annuel->newMembre($id_membre);
 

 ?>
 
 <div align="center"><h1>En forme à Pau </h1></div>
<br><br><br>
Pour vous connecter à votre espac ede reservation d'activités "En forme à Pau",<br>
veuillez tapez l'adresse suivante :  <div style="color:#00F;">http://efapau2.agglo-pau.fr</div>
<br>

Saisissez les identifiants suivants: <br>
<ul>
<li><b>Email :</b> <?php echo $email; ?></li>
<li><b>Mot de passe :</b> <?php echo $motdepasse; ?></li>
</ul>
<br><br>

Une fois connecté, vous pourrez personnaliser votre mot de passe
<br>
Pensez à recherche votre carte, .....




