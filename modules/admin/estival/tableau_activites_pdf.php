<?php

/***** Dernière modification : 19/05/2017, Romain TALDU	*****/


require(__DIR__ .'/../../../include/config.inc.php');
require(__DIR__ .'/../../../include/connexion.inc.php');
require(__DIR__ .'/model.inc.php');

// verifie que la session est active, sinon reoriente vers la page de login
require(__DIR__ .'/../../../include/verif_session.php');
//verifie que les droits sont valide si la session est active, sinon reoriente vers la page de login
include("../../../include/verif_droits.php");

// préparation connexion
$connect = new connection();
$estival = new estival($connect);

   	

 ?>


<div align='center'>
    <u><b>DISPOSITIF ESTIVAL "EN FORME A PAU"</b></u><br>
</div>
<br><br>
    <table cellspacing="0" style="width: 100%; border: solid 1px black; background: #E7E7E7; text-align: center; font-size: 11pt;">
        <tr>
            <th style="width: 22%; text-align: left">Date</th>
            <th style="width: 25%; text-align: left">Activité</th>
            <th style="width: 33%; text-align: left">Lieu</th>
            <th style="width: 20%; text-align: left">Public visé</th>
        </tr>
    </table>
    
<table cellspacing="0" style="width: 100%; border: solid 1px black; background: #F7F7F7; text-align: center; font-size: 9pt;">
       
<?php

	
$data=$estival->afficheActivite(); 

$compteur = 1;
                  
 foreach($data as $event){
			
			$id_estival_activite=$event->id_estival_activite;
			$titre_estival_activite=htmlspecialchars($event->titre_estival_activite);
			$color_estival_activite=$event->color_estival_activite;
			$start_estival_activite=$event->start_estival_activite;
			$end_estival_activite=$event->end_estival_activite;
			$description_estival_activite=htmlspecialchars($event->description_estival_activite);
			$description_estival_activite = str_replace(array("\r\n", "\r", "\n"), "<br>", $description_estival_activite); 
			$association_estival_activite=htmlspecialchars($event->association_estival_activite);
			$lieu_estival_activite=htmlspecialchars($event->lieu_estival_activite);
			$lieu_repli_estival_activite=htmlspecialchars($event->lieu_repli_estival_activite);
			$public_estival_activite=htmlspecialchars($event->public_estival_activite);
			$inscrit_estival_activite=$event->inscrit_estival_activite;
			$limite_estival_activite=$event->limite_estival_activite;
			
			if($limite_estival_activite!=0 AND $inscrit_estival_activite>=$limite_estival_activite)
			{$titre_estival_activite=$titre_estival_activite."<b> [COMPLET]</b>";}
				
			if($limite_estival_activite==0){$limite_estival_activite="Illimité";}
			
			// formate une date en fonction des locales ( fichier config.inc.php)
			$date=strftime("%a %d %B à %Hh%M",strtotime("$start_estival_activite")); 
			
			$heure_debut=explode(" ",$start_estival_activite);
			$heure_debut=explode(":",$heure_debut[1]);
			$heure_debut=$heure_debut[0]."h".$heure_debut[1];
			
			$heure_fin=explode(" ",$end_estival_activite);
			$heure_fin=explode(":",$heure_fin[1]);
			$heure_fin=$heure_fin[0]."h".$heure_fin[1];
			

	if($compteur % 2 == 0){echo "<tr  style=\"background: #FFF;\">";}else{echo "<tr  style=\"background: #f0F0F0;\">";}		
			
			echo"
                        
                        <td style=\"width: 22%; text-align: left\">".$date."</td>
                   		<td style=\"width: 25%; text-align: left\">".$titre_estival_activite."</td>
                   		 <td style=\"width: 33%; text-align: left\">".$lieu_estival_activite."</td>
                   		 <td style=\"width: 20%; text-align: left\">".$public_estival_activite."</td>       
                        
                       
                      </tr>";
					  
		$compteur++;			  
	 }

 

?>
 </table>	
 