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
$entreprise = new entreprise($connect);
	
$result=$entreprise->infosActivite($id_activite);
 
$jour_activite=explode(" ",$result[4]);
$jour_activite=explode("-",$jour_activite[0]);
$jour_activite=$jour_activite[2]."/".$jour_activite[1];
			
$heure_debut=explode(" ",$result[4]);
$heure_debut=explode(":",$heure_debut[1]);
$heure_debut=$heure_debut[0]."h".$heure_debut[1];
			
$heure_fin=explode(" ",$result[5]);
$heure_fin=explode(":",$heure_fin[1]);
$heure_fin=$heure_fin[0]."h".$heure_fin[1];
 
 if($result[12]==0){$limite_entreprise_activite="Illimité";}
 ?>


<div align='center'>
    <u><b>DISPOSITIF entreprise "EN FORME A PAU"</b></u><br>
    <b><?php echo $result[1]; ?>, le <?php echo $jour_activite;?> de <?php echo $heure_debut;?> à <?php echo $heure_fin; ?></b><br>
   <u>Participants</u> : <?php echo $result[11]; ?> / <?php echo $result[12]; ?> <br>
   <u>Lieu</u> : <?php echo $result[8]; ?> <br>
   <u>Lieu de repli</u> : <?php echo $result[9]; ?> <br>
  
</div><br><br><br>




    <table cellspacing="0" style="width: 100%; border: solid 1px black; background: #E7E7E7; text-align: center; font-size: 11pt;">
        <tr>
            <th style="width: 4%; text-align: left">#</th>
            <th style="width: 25%; text-align: left">Nom</th>
            <th style="width: 19%; text-align: left">Prénom</th>
           
        
            <th style="width: 15%; text-align: left">Tèl</th>
            <th style="width: 30%; text-align: left">Email</th>
        </tr>
    </table>
<table cellspacing="0" style="width: 100%; border: solid 1px black; background: #F7F7F7; text-align: center; font-size: 9pt;">
       
<?php

	
$id_activite=$_GET['id_activite'];  

$data=$entreprise->afficheUser($id_activite);
	
	
    
	  
	 $compteur = 1;
	 foreach($data as $event){
			
			$nom=$event->nom_entreprise_user;
		    $prenom=$event->prenom_entreprise_user;
			$naissance=$event->age_entreprise_user;
			$residence=$event->residence_entreprise_user;
			$tel=$event->tel_entreprise_user;
			$email=$event->email_entreprise_user;
			
	//Calcul de l'age
	$arr1 = explode('/', $naissance);
    $arr2 = explode('/', date('d/m/Y'));
	if(($arr1[1] < $arr2[1]) || (($arr1[1] == $arr2[1]) && ($arr1[0] <= $arr2[0])))
    {$age=$arr2[2] - $arr1[2];} else{$age=$arr2[2] - $arr1[2] - 1;}

echo"<tr>
            <td style=\"width: 4%; text-align: left\">$compteur</td>
            <td style=\"width: 25%; text-align: left\">$nom</td>
            <td style=\"width: 19%; text-align: left\">$prenom</td>
          

            <td style=\"width: 15%; text-align: left\">$tel</td>
            <td style=\"width: 30%; text-align: left\">$email</td>
           
        </tr>";

	$compteur++;		
	 }

 

?>
 </table>	
 