<?php

/***** Dernière modification : 17/06/2016, Romain TALDU	*****/


require(__DIR__ .'/../../../include/config.inc.php');
require(__DIR__ .'/../../../include/connexion.inc.php');
require(__DIR__ .'/model.inc.php');

// verifie que la session est active, sinon reoriente vers la page de login
require(__DIR__ .'/../../../include/verif_session.php');
//verifie que les droits sont valide si la session est active, sinon reoriente vers la page de login
include("../../../include/verif_droits.php");

$id_activite=$_GET['id_activite'];  
   
// préparation connexion
$connect = new connection();
$estival = new estival($connect);

   	
$result=$estival->infosActivite($id_activite);
 
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

h5{
color:#006997;
}

h4{
color:#006997;
}
</style>

  </head>
 
  <body class="hold-transition skin-blue sidebar-mini">

<div align='center'>
    <u><b>DISPOSITIF ESTIVAL "EN FORME A PAU"</b></u><br>
    <b><?php echo $result[1]; ?>, le <?php echo $jour_activite;?> de <?php echo $heure_debut;?> à <?php echo $heure_fin; ?></b><br>
   <u>Participants</u> : <?php echo $result[11]; ?> / <?php echo $result[12]; ?> <br>
   <u>Lieu</u> : <?php echo $result[8]; ?> <br>
   <u>Lieu de repli</u> : <?php echo $result[9]; ?> <br>
   <u>Public visé</u> : <?php echo $result[10]; ?> <br>
   <u>Intervenant</u> : <?php echo $result[7]; ?> <br>
</div><br><br><br>




    <table cellspacing="0" style="width: 100%; border: solid 1px black; background: #E7E7E7; text-align: center; font-size: 11pt;">
        <tr>
            <th style="width: 4%; ">#</th>
            <th style="width: 20%;">Nom</th>
            <th style="width: 19%;">Prénom</th>
            
        
            <th style="width: 15%;">Tèl</th>
            <th style="width: 30%;">Email</th>
            <th style="width: 12%;">Présence</th>
        </tr>
    </table>
<table cellspacing="0" style="width: 100%; border: solid 1px black; background: #F7F7F7; text-align: center; font-size: 9pt;border-collapse:collapse;">
       
<?php

	
$id_activite=$_GET['id_activite'];  


$data=$estival->afficheUser($id_activite);
	
	  
	 $compteur = 1;
	 foreach($data as $event){
			
			$nom=$event->nom_estival_user;
		        $prenom=$event->prenom_estival_user;
			$naissance=$event->age_estival_user;
			$residence=$event->residence_estival_user;
			$tel=$event->tel_estival_user;
			$email=$event->email_estival_user;
			
	//Calcul de l'age
	$arr1 = explode('/', $naissance);
    $arr2 = explode('/', date('d/m/Y'));
	if(($arr1[1] < $arr2[1]) || (($arr1[1] == $arr2[1]) && ($arr1[0] <= $arr2[0])))
    {$age=$arr2[2] - $arr1[2];} else{$age=$arr2[2] - $arr1[2] - 1;}

 if($compteur % 2 == 0){echo "<tr  style=\"background: #FFF;\">";}else{echo "<tr  style=\"background: #f0F0F0;\">";}   
    
echo"
            <td style=\"width: 4%; text-align: left\">$compteur</td>
            <td style=\"width: 20%; text-align: left\">$nom</td>
            <td style=\"width: 19%; text-align: left\">$prenom</td>
            

            <td style=\"width: 15%; text-align: left\">$tel</td>
            <td style=\"width: 30%; text-align: left\">$email</td>
            <td style=\"width: 12%; text-align: left\"> </td>
           
        </tr>";

	$compteur++;		
	 }

 

?>
 </table>	
  </body>
  </html>