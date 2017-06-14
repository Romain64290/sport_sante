<?php

/***** Dernière modification : 17/06/2016, Romain TALDU	*****/

require(__DIR__ .'/../../../include/verif_session.php');
require(__DIR__ .'/../../../include/config.inc.php');
require(__DIR__ .'/../../../include/connexion.inc.php');
require(__DIR__ .'/model.inc.php');


$id_activite=$_GET['id_activite'];  
   
// préparation connexion
$connect = new connection();
$annuel = new annuel($connect);
	
$result=$annuel->infosActivite($id_activite);
 
$jour_activite=explode(" ",$result[4]);
$jour_activite=explode("-",$jour_activite[0]);
$jour_activite=$jour_activite[2]."/".$jour_activite[1];
			
$heure_debut=explode(" ",$result[4]);
$heure_debut=explode(":",$heure_debut[1]);
$heure_debut=$heure_debut[0]."h".$heure_debut[1];
			
$heure_fin=explode(" ",$result[5]);
$heure_fin=explode(":",$heure_fin[1]);
$heure_fin=$heure_fin[0]."h".$heure_fin[1];
 
 if($result[12]==0){$limite_estival_activite="Illimité";}
 ?>


<!DOCTYPE html>

<html>
  <head>

<style>

td {
height:25px; 
text-align:left;
border-width:1px;
border-style:solid; 
border-color:black;
padding-left:5px;
}

th {
height:25px; 
text-align:left;
border-width:1px;
border-style:solid; 
border-color:black;
padding-left:5px;
}

h5{
color:#006997;
}

h4{
color:#006997;
}
</style>

  </head>
 
  <body>


<div align='center'>
    <u><b>DISPOSITIF ANNUEL "EN FORME A PAU"</b></u><br>
    <b><?php echo $result[1]; ?>, le <?php echo $jour_activite;?> de <?php echo $heure_debut;?> à <?php echo $heure_fin; ?></b><br>
   <u>Participants</u> : <?php echo $result[11]; ?> / <?php echo $result[12]; ?> <br>
   <u>Lieu</u> : <?php echo $result[8]; ?> <br>
   <u>Lieu de repli</u> : <?php echo $result[9]; ?> <br>
   <u>Public visé</u> : <?php echo $result[10]; ?> <br>
   <u>Intervenant</u> : <?php echo $result[7]; ?> <br>
</div><br><br><br>




     <table cellspacing="0" style="width: 100%; border: solid 1px black;  background: #E7E7E7; text-align: center; font-size: 9pt;">
        <tr>
            <th style="width: 4%; text-align: left">#</th>
            <th style="width: 25%; text-align: left">Nom</th>
            <th style="width: 19%; text-align: left">Prénom</th>
            <th style="width: 7%; text-align: left">Age</th>
        
            <th style="width: 15%; text-align: left">Tèl</th>
            <th style="width: 30%; text-align: left">Email</th>
        </tr>
    </table>
<table cellspacing="0" style="width: 100%; border: solid 1px black; background: #F7F7F7; text-align: center; font-size: 9pt;border-collapse:collapse;">
       
<?php

	
$id_activite=$_GET['id_activite'];  

   
$data=$annuel->afficheUsers($id_activite);
	  
	 $compteur = 1;
	 foreach($data as $event){
			
			$nom=$event->nom_membre;
		    $prenom=$event->prenom_membre;
			$naissance=$event->age;
			$residence=$event->residence;
			$tel=$event->telephone;
			$email=$event->email;
			
	//Calcul de l'age
	$arr1 = explode('/', $naissance);
    $arr2 = explode('/', date('d/m/Y'));
	if(($arr1[1] < $arr2[1]) || (($arr1[1] == $arr2[1]) && ($arr1[0] <= $arr2[0])))
    {$age=$arr2[2] - $arr1[2];} else{$age=$arr2[2] - $arr1[2] - 1;}
	
if($compteur % 2 == 0){echo "<tr  style=\"background: #FFF;\">";}else{echo "<tr  style=\"background: #f0F0F0;\">";}

echo"
            <td style=\"width: 4%; text-align: left\">$compteur</td>
            <td style=\"width: 25%; text-align: left\">$nom</td>
            <td style=\"width: 19%; text-align: left\">$prenom</td>
            <td style=\"width: 7%; text-align: left\">$age</td>

            <td style=\"width: 15%; text-align: left\">$tel</td>
            <td style=\"width: 30%; text-align: left\">$email</td>
           
        </tr>";

	$compteur++;		
	 }

 

?>
 </table>	
 
 </body>
 
 </html>
 