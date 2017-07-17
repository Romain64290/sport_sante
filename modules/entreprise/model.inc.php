<?php

/***** Dernière modification : 11/05/2017, Romain TALDU	*****/

class fo_entreprise {

    private $con;

    public function __construct(connection $con) {
        $this->con = $con->con;
    }
	

/***********************************************************************
 * Affichage des activités
 **************************************************************************/
  
 function afficheActivite()
  {
    
	
  try{
    	
		$select = $this->con->prepare('SELECT * 
		FROM entreprise_activite');
		$select->execute();
		   
	     
    }
  catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors de l'affichage des activités</b>\n";
	throw $e;
        exit;
    }	
      
$result = $select->fetchAll(PDO::FETCH_OBJ);

 return $result; 	   

}

/***********************************************************************
 * Affichage de la liste des particiants à une acitivte
 **************************************************************************/
 
  function afficheListeparticipantsActivite($id_entreprise_activite)
  {
    

  	// liste des participants
			$select2 = $this->con->prepare('SELECT * 
			FROM entreprise_user_has_activite
			INNER JOIN entreprise_user ON entreprise_user.id_entreprise_user=entreprise_user_has_activite.id_entreprise_user
			WHERE id_entreprise_activite=:id_entreprise_activite ORDER BY entreprise_user.nom_entreprise_user ASC');
			$select2->execute(array(
			':id_entreprise_activite' => $id_entreprise_activite
				));
		
		 $liste_participants="";
		
		 $count = $select2->rowCount();
		 	
		 if($count==0){$liste_participants.="<li>Aucun</li>";}
			
		if ($result2 = $select2->fetchAll(PDO::FETCH_OBJ)) {
        

		   	   
			foreach($result2 as $event2){
				$nom_entreprise_user=htmlspecialchars($event2->nom_entreprise_user);
				$prenom_entreprise_user=htmlspecialchars($event2->prenom_entreprise_user);
				
			 $liste_participants.="<li>$nom_entreprise_user $prenom_entreprise_user </li>";	
				
				
	
			}}	
		return $liste_participants;
	
  }
  
  /***********************************************************************
 * Affichage des infos d'une activité
 **************************************************************************/
  
 function afficheInfoActivite($id)
  {
    
try{
    	
		$select = $this->con->prepare('SELECT * 
		FROM entreprise_activite WHERE id_entreprise_activite= :id');
		$select->execute(array(':id' => $id));
 
    }
  catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors de l'affichage du détail de l'activité</b>\n";
	throw $e;
        exit;
    }
  
 $result = $select->fetchAll(PDO::FETCH_OBJ);

 return $result; 
  
}
  
/***********************************************************************
 * Vérifie la présence d'une activite dans le panier
 **************************************************************************
 * @param String $ref_article référence de l'article à vérifier
 * @return Boolean Renvoie Vrai si l'article est trouvé dans le panier, Faux sinon
 */
 
function verif_panier($ref_article)
{
    /* On initialise la variable de retour */
    $present = false;
    /* On vérifie les numéros de références des articles et on compare avec l'article à vérifier */
    if( count($_SESSION['activite']['id_activite']) > 0 && array_search($ref_article,$_SESSION['activite']['id_activite']) !== false)
    {
        $present = true;
    }
    return $present;
}  



/***********************************************************************
 * Supprime un article du panier
 **************************************************************************
 * @param String    $ref_article numéro de référence de l'article à supprimer
 * @return Boolean  Retourn TRUE si la suppression a bien été effectuée, FALSE sinon
 */
 
function supprim_article($ref_article)
{
    $suppression = false;
    /* création d'un tableau temporaire de stockage des articles */
    $panier_tmp = array("id_activite"=>array(),"titre"=>array(),"date"=>array(),"date_calendar"=>array(),"color"=>array());
    /* Comptage des articles du panier */
    $nb_articles = count($_SESSION['activite']['id_activite']);
    /* Transfert du panier dans le panier temporaire */
    for($i = 0; $i < $nb_articles; $i++)
    {
        /* On transfère tout sauf l'article à supprimer */
        if($_SESSION['activite']['id_activite'][$i] != $ref_article)
        {
            array_push($panier_tmp['id_activite'],$_SESSION['activite']['id_activite'][$i]);
            array_push($panier_tmp['titre'],$_SESSION['activite']['titre'][$i]);
            array_push($panier_tmp['date'],$_SESSION['activite']['date'][$i]);
			array_push($panier_tmp['date_calendar'],$_SESSION['activite']['date_calendar'][$i]);
            array_push($panier_tmp['color'],$_SESSION['activite']['color'][$i]);
        }
    }
    /* Le transfert est terminé, on ré-initialise le panier */
    $_SESSION['activite'] = $panier_tmp;
    /* Option : on peut maintenant supprimer notre panier temporaire: */
    unset($panier_tmp);
    $suppression = true;
    return $suppression;
} 


 /**************************************************************************
 * Ajout d'un utilisateur
***************************************************************************/
 
 function insertionUtilisateur($civilite,$nom,$prenom,$telephone,$email,$collectivite,$lieu_travail,$direction,$naissance,$accepte)
  {
  	
    
try{		
$insert = $this->con->prepare('INSERT INTO entreprise_user (civilite_entreprise_user,nom_entreprise_user,prenom_entreprise_user,email_entreprise_user,tel_entreprise_user,age_entreprise_user,direction,collectivite,lieu_travail,accepte_mail,date_inscription,ip_user)
VALUES(:civilite,:nom,:prenom,:email,:tel,:age,:direction,:collectivite,:lieu_travail,:accepte,:date,:ip)');
 
 	$execute=$insert->execute(array(
	'civilite' => $civilite,
	'nom' => $nom,
	'prenom' => $prenom,
	'email' => $email,
	'tel' => $telephone,
	'age' => $naissance,
	'direction' => $direction,
	'collectivite' => $collectivite,
	'lieu_travail' => $lieu_travail,
	'accepte' => $accepte,
	'date' => date('Y-m-d H:i:s'),
	'ip' => $_SERVER['REMOTE_ADDR']
	
	
	));  
  	
 }
  catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors de l'ajout d'un utilisateur</b>\n";
	throw $e;
        exit;
    }
		
		
  if (!$execute) {return FALSE;} 
  else{$lastId = $this->con->lastInsertId(); return $lastId;}
 				
}
 
/**************************************************************************
 * Verificiation si l'activite est complete sinon Ajout de la reservation
***************************************************************************/
 
 function insertionActivite($id_user,$activite)
  {
  	
    
	
// verification si l'activite est encore dispo
$select = $this->con->prepare('SELECT * FROM entreprise_activite
WHERE id_entreprise_activite = :id_entreprise_activite');
$select->execute(array(
':id_entreprise_activite' => $activite
		));
		
if ($result = $select->fetchAll(PDO::FETCH_OBJ)) {
        
  $select->closeCursor();
		   
		 		   
	foreach($result as $event){
			
			$id_entreprise_activite=$event->id_entreprise_activite;
			$inscrit_entreprise_activite=$event->inscrit_entreprise_activite;
			$limite_entreprise_activite=$event->limite_entreprise_activite;
			
	if($limite_entreprise_activite!=0 AND $inscrit_entreprise_activite>=$limite_entreprise_activite)	{$complet=$id_entreprise_activite." "; return $complet;}
			
	else{

// Ajout de la reservation			
$complet="";	
$insert = $this->con->prepare('INSERT INTO entreprise_user_has_activite (id_entreprise_user,id_entreprise_activite)
VALUES(:id_user,:id_activite)');
 
 $execute=$insert->execute(array(
	'id_user' => $id_user,
	'id_activite' => $activite
	
	
	));  

// incrementation du nombre de place de l'activite
$update = $this->con->prepare('UPDATE entreprise_activite SET inscrit_entreprise_activite = inscrit_entreprise_activite + 1  WHERE id_entreprise_activite  = :id_entreprise_activite');
$update->execute(array(
':id_entreprise_activite' => $activite
		));
	
return $complet;  	
				
		}
	
}}
  
  }

/***********************************************************************
 * Affiche les reservations
 **************************************************************************/
  
 function afficheReservation($id_user)
  {
    
	
  try{
    	
		$select = $this->con->prepare('SELECT * FROM entreprise_activite
		INNER JOIN entreprise_user_has_activite ON entreprise_activite.id_entreprise_activite=entreprise_user_has_activite.id_entreprise_activite
		WHERE id_entreprise_user  = :id_entreprise_user');
		$select->execute(array(
		':id_entreprise_user' => $id_user
		));
		
		$select2 = $this->con->prepare('SELECT * FROM entreprise_user
		WHERE id_entreprise_user  = :id_entreprise_user');
		$select2->execute(array(
		':id_entreprise_user' => $id_user
		));
		
		$result2=$select2->fetch();
		$email=$result2['email_entreprise_user'];
		
	 
       if ($result = $select->fetchAll(PDO::FETCH_OBJ)) {
        
           $select->closeCursor();
		   
		   $reservation="";
		   
	foreach($result as $event){
			
			$id_entreprise_activite=$event->id_entreprise_activite;
			$titre_entreprise_activite=htmlspecialchars($event->titre_entreprise_activite);
			$start_entreprise_activite=$event->start_entreprise_activite;
			$end_entreprise_activite=$event->end_entreprise_activite;
			$lieu_entreprise_activite=htmlspecialchars($event->lieu_entreprise_activite);
			
			
			$jour_activite=explode(" ",$start_entreprise_activite);
			$jour_activite=explode("-",$jour_activite[0]);
			$jour_activite=$jour_activite[2]."/".$jour_activite[1];
			
			$heure_debut=explode(" ",$start_entreprise_activite);
			$heure_debut=explode(":",$heure_debut[1]);
			$heure_debut=$heure_debut[0]."h".$heure_debut[1];
			
			$heure_fin=explode(" ",$end_entreprise_activite);
			$heure_fin=explode(":",$heure_fin[1]);
			$heure_fin=$heure_fin[0]."h".$heure_fin[1];

			$reservation.=	"<li>$titre_entreprise_activite le $jour_activite de $heure_debut à $heure_fin &nbsp;&nbsp;&nbsp;[<a href=\"".URL_SITE."/modules/entreprise/validation_desinscription.php?id_user=$id_user&id_activite=$id_entreprise_activite&email=$email\">Se désinscrire</a>]</li>";
			
		} 
	   
           return $reservation;
        }
       return false;
    }
  catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors de l'affichage des reservations</b>\n";
	throw $e;
        exit;
    }
}

/***********************************************************************
 * Affiche les erreurs de réservation car pleine
 **************************************************************************/
  
 function afficheAnnulation($activite_pleine)
  {
  	

	
		$select = $this->con->prepare('SELECT * FROM entreprise_activite
		WHERE id_entreprise_activite = :id_entreprise_activite');
		$select->execute(array(
		':id_entreprise_activite' => $activite_pleine
		));
		
	 
       if ($result = $select->fetchAll(PDO::FETCH_OBJ)) {
        
           $select->closeCursor();
		   
		   $reservation_annul="";
		   
	       foreach($result as $event){
			
			
			$titre_entreprise_activite=htmlspecialchars($event->titre_entreprise_activite);
			$start_entreprise_activite=$event->start_entreprise_activite;
			$end_entreprise_activite=$event->end_entreprise_activite;
			$lieu_entreprise_activite=htmlspecialchars($event->lieu_entreprise_activite);
			
			
			$jour_activite=explode(" ",$start_entreprise_activite);
			$jour_activite=explode("-",$jour_activite[0]);
			$jour_activite=$jour_activite[2]."/".$jour_activite[1];
			
			$heure_debut=explode(" ",$start_entreprise_activite);
			$heure_debut=explode(":",$heure_debut[1]);
			$heure_debut=$heure_debut[0]."h".$heure_debut[1];
			
			$heure_fin=explode(" ",$end_entreprise_activite);
			$heure_fin=explode(":",$heure_fin[1]);
			$heure_fin=$heure_fin[0]."h".$heure_fin[1];

			$reservation_annul.=	"<li>$titre_entreprise_activite le $jour_activite de $heure_debut à $heure_fin $count</li>";
			
										  }
		   
	
}
	   
 
return  $reservation_annul; 	   
	}  

	


 /*******************************************************
 * Envoi email de confirmation d'inscription et supprime session
********************************************************/ 

function envoiMailConfirmation($id_user,$activite,$mail_user)
{

// Création d'un nouvel objet $mail
$mail = new PHPMailer();
// Encodage
$mail->CharSet = 'UTF-8';


//=====Corps du message
$body = "<html><head></head>
<body>
Bonjour,<br>
<br>
Nous vous confirmons votre inscription aux activité(s) suivante(s): <br>
<ul>
$activite
</ul>
<br>
Salutations<br>
<br>
</body>
</html>";
//==========


// Expediteur, adresse de retour et destinataire :
$mail->SetFrom(FROM_EMAIL, "Ville de Pau"); //L'expediteur du mail
$mail->AddReplyTo("NO-REPLY@agglo-pau.fr", "NO REPLY"); //Pour que l'usager réponde au mail
// Si on a le nom : $mail->AddAddress("romain_taldu@hotmail.com", "Romain perso"); 
 //mail du destinataire
$mail->AddAddress($mail_user); 


// Sujet du mail
$mail->Subject = "Ville de Pau - En forme à Pau";
// Le message
$mail->MsgHTML($body);


// Envoi de l'email
$mail->Send();

unset($mail);


unset($_SESSION['activite']); 

}

/***********************************************************************
 * Reuperer Email Participant
 **************************************************************************/
  
 function recupMailUser($id_user)
  {
  	
	try{
		$select = $this->con->prepare('SELECT * FROM entreprise_user
		WHERE id_entreprise_user = :id_entreprise_user');
		$select->execute(array(
		':id_entreprise_user' => $id_user
		));
		}	
	 
    catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors de l'affichage des activités</b>\n";
	throw $e;
        exit;
    }
  
 $result = $select->fetch();
 
 $recup_email=$result['email_entreprise_user'];

 return  $recup_email;
  
}


	
/***********************************************************************
 * Verifie si l'activité existe et peut etre suppriméé
 **************************************************************************/
  
 function verifiSuppressionActivite($id_user,$id_activite,$email)
 
  {
 	
// verifie si l'activité exsiste et si elle est unique
// l'email est associé à l'id pour séciriser la fonctionne de suppréssion
$select = $this->con->prepare('SELECT COUNT(*) as nbr FROM entreprise_activite
	INNER JOIN entreprise_user_has_activite ON entreprise_activite.id_entreprise_activite=entreprise_user_has_activite.id_entreprise_activite
	INNER JOIN entreprise_user ON entreprise_user.id_entreprise_user=entreprise_user_has_activite.id_entreprise_user
	WHERE entreprise_user.id_entreprise_user  = :id_entreprise_user AND entreprise_user.email_entreprise_user  LIKE :email AND entreprise_activite.id_entreprise_activite  = :id_activite');
	
	$select->execute(array(
	':id_entreprise_user' => $id_user,
	':id_activite' => $id_activite,
	':email' => $email
		
		));
		
$result = $select->fetch();
$quantite=$result['nbr'];

return $quantite;

  }

 

/***********************************************************************
 * Suppression d'un utilisateur
 **************************************************************************/
  
 function suppUser($id_activite,$id_user)
  {
    
	

    	
		$select = $this->con->prepare('DELETE 
		FROM entreprise_user_has_activite
		WHERE id_entreprise_activite  = :id_entreprise_activite AND id_entreprise_user  = :id_entreprise_user');
						
		$select->execute(array(
		':id_entreprise_activite' => $id_activite,
		':id_entreprise_user' => $id_user,
		));
		
		
		// decrementation du nombre de place de l'activite
$update = $this->con->prepare('UPDATE entreprise_activite SET inscrit_entreprise_activite = inscrit_entreprise_activite - 1  WHERE id_entreprise_activite  = :id_entreprise_activite');
$update->execute(array(
':id_entreprise_activite' => $id_activite
		));
		
		
}

/***********************************************************************
 * Affiche activité supprimée
 **************************************************************************/  
  function afficheactivitesupprime($id_activite)
  {
  
  	
$select2 = $this->con->prepare('SELECT * FROM entreprise_activite
		WHERE id_entreprise_activite  = :id_entreprise_activite');
		$select2->execute(array(
		':id_entreprise_activite' => $id_activite
		));
		
		$result2=$select2->fetch();

		
			$titre_entreprise_activite=htmlspecialchars($result2['titre_entreprise_activite']);
			$start_entreprise_activite=$result2['start_entreprise_activite'];
			$end_entreprise_activite=$result2['end_entreprise_activite'];
			$lieu_entreprise_activite=htmlspecialchars($result2['lieu_entreprise_activite']);
			
			
			$jour_activite=explode(" ",$start_entreprise_activite);
			$jour_activite=explode("-",$jour_activite[0]);
			$jour_activite=$jour_activite[2]."/".$jour_activite[1];
			
			$heure_debut=explode(" ",$start_entreprise_activite);
			$heure_debut=explode(":",$heure_debut[1]);
			$heure_debut=$heure_debut[0]."h".$heure_debut[1];
			
			$heure_fin=explode(" ",$end_entreprise_activite);
			$heure_fin=explode(":",$heure_fin[1]);
			$heure_fin=$heure_fin[0]."h".$heure_fin[1];

			$reservation=	"<li>$titre_entreprise_activite le $jour_activite de $heure_debut à $heure_fin </li>";
			
		
	   
           return $reservation;

	
  } 





}
