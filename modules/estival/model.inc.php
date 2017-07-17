<?php

/***** Dernière modification : 11/05/2017, Romain TALDU	*****/

class fo_estival {

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
		FROM estival_activite');
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
 * Affichage des infos d'une activité
 **************************************************************************/
  
 function afficheInfoActivite($id)
  {
    
try{
    	
		$select = $this->con->prepare('SELECT * 
		FROM estival_activite WHERE id_estival_activite= :id');
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
 
 function insertionUtilisateur($civilite,$nom,$prenom,$telephone,$email,$residence,$naissance,$accepte)
  {
  	
    
try{	
$insert = $this->con->prepare('INSERT INTO estival_user (civilite_estival_user,nom_estival_user,prenom_estival_user,email_estival_user,tel_estival_user,age_estival_user,residence_estival_user,accepte_mail,date_inscription,ip_user)
VALUES(:civilite,:nom,:prenom,:email,:tel,:age,:residence,:accepte,:date,:ip)');
 
 	$execute=$insert->execute(array(
	'civilite' => $civilite,
	'nom' => $nom,
	'prenom' => $prenom,
	'email' => $email,
	'tel' => $telephone,
	'age' => $naissance,
	'residence' => $residence,
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
$select = $this->con->prepare('SELECT * FROM estival_activite
WHERE id_estival_activite = :id_estival_activite');
$select->execute(array(
':id_estival_activite' => $activite
		));
		
if ($result = $select->fetchAll(PDO::FETCH_OBJ)) {
        
  $select->closeCursor();
		   
		 		   
	foreach($result as $event){
			
			$id_estival_activite=$event->id_estival_activite;
			$inscrit_estival_activite=$event->inscrit_estival_activite;
			$limite_estival_activite=$event->limite_estival_activite;
			
	if($limite_estival_activite!=0 AND $inscrit_estival_activite>=$limite_estival_activite)	{$complet=$id_estival_activite." "; return $complet;}
			
	else{

// Ajout de la reservation			
$complet="";	
$insert = $this->con->prepare('INSERT INTO estival_user_has_activite (id_estival_user,id_estival_activite)
VALUES(:id_user,:id_activite)');
 
 $execute=$insert->execute(array(
	'id_user' => $id_user,
	'id_activite' => $activite
	
	
	));  

// incrementation du nombre de place de l'activite
$update = $this->con->prepare('UPDATE estival_activite SET inscrit_estival_activite = inscrit_estival_activite + 1  WHERE id_estival_activite  = :id_estival_activite');
$update->execute(array(
':id_estival_activite' => $activite
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
    	
		$select = $this->con->prepare('SELECT * FROM estival_activite
		INNER JOIN estival_user_has_activite ON estival_activite.id_estival_activite=estival_user_has_activite.id_estival_activite
		WHERE id_estival_user  = :id_estival_user');
		$select->execute(array(
		':id_estival_user' => $id_user
		));
		
		$select2 = $this->con->prepare('SELECT * FROM estival_user
		WHERE id_estival_user  = :id_estival_user');
		$select2->execute(array(
		':id_estival_user' => $id_user
		));
		
		$result2=$select2->fetch();
		$email=$result2['email_estival_user'];
		
	 
       if ($result = $select->fetchAll(PDO::FETCH_OBJ)) {
        
           $select->closeCursor();
		   
		   $reservation="";
		   
	foreach($result as $event){
			
			$id_estival_activite=$event->id_estival_activite;
			$titre_estival_activite=htmlspecialchars($event->titre_estival_activite);
			$start_estival_activite=$event->start_estival_activite;
			$end_estival_activite=$event->end_estival_activite;
			$lieu_estival_activite=htmlspecialchars($event->lieu_estival_activite);
			$lien_map=htmlspecialchars($event->lien_map);
			
			
			$jour_activite=explode(" ",$start_estival_activite);
			$jour_activite=explode("-",$jour_activite[0]);
			$jour_activite=$jour_activite[2]."/".$jour_activite[1];
			
			$heure_debut=explode(" ",$start_estival_activite);
			$heure_debut=explode(":",$heure_debut[1]);
			$heure_debut=$heure_debut[0]."h".$heure_debut[1];
			
			$heure_fin=explode(" ",$end_estival_activite);
			$heure_fin=explode(":",$heure_fin[1]);
			$heure_fin=$heure_fin[0]."h".$heure_fin[1];

			$reservation.=	"<li>$titre_estival_activite le $jour_activite de $heure_debut à $heure_fin - $lieu_estival_activite <a href=\"$lien_map\" target=\"_blank\"> (voir l'adresse sur Google Map)</a> - [<a href=\"".URL_SITE."/modules/estival/validation_desinscription.php?id_user=$id_user&id_activite=$id_estival_activite&email=$email\">Se désinscrire</a>]</li>";
			
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
  	

	
		$select = $this->con->prepare('SELECT * FROM estival_activite
		WHERE id_estival_activite = :id_estival_activite');
		$select->execute(array(
		':id_estival_activite' => $activite_pleine
		));
		
	 
       if ($result = $select->fetchAll(PDO::FETCH_OBJ)) {
        
           $select->closeCursor();
		   
		   $reservation_annul="";
		   
	       foreach($result as $event){
			
			
			$titre_estival_activite=htmlspecialchars($event->titre_estival_activite);
			$start_estival_activite=$event->start_estival_activite;
			$end_estival_activite=$event->end_estival_activite;
			$lieu_estival_activite=htmlspecialchars($event->lieu_estival_activite);
			
			
			$jour_activite=explode(" ",$start_estival_activite);
			$jour_activite=explode("-",$jour_activite[0]);
			$jour_activite=$jour_activite[2]."/".$jour_activite[1];
			
			$heure_debut=explode(" ",$start_estival_activite);
			$heure_debut=explode(":",$heure_debut[1]);
			$heure_debut=$heure_debut[0]."h".$heure_debut[1];
			
			$heure_fin=explode(" ",$end_estival_activite);
			$heure_fin=explode(":",$heure_fin[1]);
			$heure_fin=$heure_fin[0]."h".$heure_fin[1];

			$reservation_annul.=	"<li>$titre_estival_activite le $jour_activite de $heure_debut à $heure_fin $count</li>";
			
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
$mail->Encoding = 'base64';

//$mail->Host = '192.168.1.227';  // Specify main and backup SMTP servers
//$mail->SMTPAuth = true;                               // Enable SMTP authentication
//$mail->Username = 'therassonkonan@gmail.com';                 // SMTP username  'info@visionautoecole.ci';
//$mail->Password = 'ther@sson1';                           // SMTP password
//$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
//$mail->Port = 25;                                    // TCP port to connect to


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
En cas d'indisponibilité, il est demandé à chacun de bien vouloir se désinscrire la veille de l'activité afin de libérer sa place.<br>En cas de mauvais temps, le lieu de repli de l'activité vous sera communiqué par mail <br>
La Ville de Pau vous remercie de votre participation.
<br>
<br>
<i><small>Si vous rencontrez des difficultés pour vous désinscrire, merci de nous contacter <a href=\"mailto:r.taldu@agglo-pau.fr\">ici</a></small></i>
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
$select = $this->con->prepare('SELECT * FROM estival_user
		WHERE id_estival_user = :id_estival_user');
$select->execute(array(
		':id_estival_user' => $id_user
		));
	}	
	 
    catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors de l'affichage des activités</b>\n";
	throw $e;
        exit;
    }
  
 $result = $select->fetch();
 
 $recup_email=$result['email_estival_user'];

 return  $recup_email;
  
}

	
/***********************************************************************
 * Verifie si l'activité existe et peut etre suppriméé
 **************************************************************************/
  
 function verifiSuppressionActivite($id_user,$id_activite,$email)
 
  {
 
		
// verifie si l'activité exsiste et si elle est unique
// l'email est associé à l'id pour séciriser la fonctionne de suppréssion
$select = $this->con->prepare('SELECT COUNT(*) as nbr FROM estival_activite
	INNER JOIN estival_user_has_activite ON estival_activite.id_estival_activite=estival_user_has_activite.id_estival_activite
	INNER JOIN estival_user ON estival_user.id_estival_user=estival_user_has_activite.id_estival_user
	WHERE estival_user.id_estival_user  = :id_estival_user AND estival_user.email_estival_user  LIKE :email AND estival_activite.id_estival_activite  = :id_activite');
	
	$select->execute(array(
	':id_estival_user' => $id_user,
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
		FROM estival_user_has_activite
		WHERE id_estival_activite  = :id_estival_activite AND id_estival_user  = :id_estival_user');
						
		$select->execute(array(
		':id_estival_activite' => $id_activite,
		':id_estival_user' => $id_user,
		));
		
		
		// decrementation du nombre de place de l'activite
$update = $this->con->prepare('UPDATE estival_activite SET inscrit_estival_activite = inscrit_estival_activite - 1  WHERE id_estival_activite  = :id_estival_activite');
$update->execute(array(
':id_estival_activite' => $id_activite
		));
		
		
}
  
/***********************************************************************
 * Affiche activité supprimée
 **************************************************************************/  
  function afficheactivitesupprime($id_activite)
  {
  
  	
$select2 = $this->con->prepare('SELECT * FROM estival_activite
		WHERE id_estival_activite  = :id_estival_activite');
		$select2->execute(array(
		':id_estival_activite' => $id_activite
		));
		
		$result2=$select2->fetch();

		
			$titre_estival_activite=htmlspecialchars($result2['titre_estival_activite']);
			$start_estival_activite=$result2['start_estival_activite'];
			$end_estival_activite=$result2['end_estival_activite'];
			$lieu_estival_activite=htmlspecialchars($result2['lieu_estival_activite']);
			
			
			$jour_activite=explode(" ",$start_estival_activite);
			$jour_activite=explode("-",$jour_activite[0]);
			$jour_activite=$jour_activite[2]."/".$jour_activite[1];
			
			$heure_debut=explode(" ",$start_estival_activite);
			$heure_debut=explode(":",$heure_debut[1]);
			$heure_debut=$heure_debut[0]."h".$heure_debut[1];
			
			$heure_fin=explode(" ",$end_estival_activite);
			$heure_fin=explode(":",$heure_fin[1]);
			$heure_fin=$heure_fin[0]."h".$heure_fin[1];

			$reservation=	"<li>$titre_estival_activite le $jour_activite de $heure_debut à $heure_fin </li>";
			
		
	   
           return $reservation;

	
  } 
  
  
  
  
  
  
  }
