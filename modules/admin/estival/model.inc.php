<?php

/***** Dernière modification : 04/05/2017, Romain TALDU	*****/

class estival {

    private $con;

    public function __construct(connection $con) {
        $this->con = $con->con;
    }
	

/***********************************************************************
 * Affichage des activités dans la vue calendirer
 **************************************************************************/
  
 function afficheActiviteCalendrier()
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
 * Affichage des activités dans la vue ne listing
 **************************************************************************/
  
 function afficheActivite()
  {
    
	
$date=date( "Y-m-d 00:00:00");
	
  try{
    	
$select = $this->con->prepare('SELECT * 
		FROM estival_activite
		WHERE start_estival_activite  > :date
	    ORDER BY start_estival_activite ASC');	
				
$select->execute(array(
		':date' => $date
		));
		   
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
 * Création d'une activité
 **************************************************************************/
 
 function ajoutActivite($nom,$date,$heure_debut,$heure_fin,$description,$association,$lieu,$lieu_repli,$public,$limite,$couleur,$lien_map)
  {
 	

	
	
$date=explode("-",$date);
$start="$date[2]-$date[1]-$date[0] $heure_debut";
$end="$date[2]-$date[1]-$date[0] $heure_fin";		


//convertion de couleur
switch ($couleur) 
{ 
    case "rgb(0, 192, 239)": 
        $color="#00c0ef"; $color_selection="bg-aqua";
    break;
	case "rgb(0, 115, 183)": 
        $color="#0073b7"; $color_selection="bg-blue";
    break;
	case "rgb(60, 141, 188)": 
        $color="#3c8dbc"; $color_selection="bg-light-blue";
    break;
	case "rgb(57, 204, 204)": 
        $color="#39cccc"; $color_selection="bg-teal";
    break;
	case "rgb(243, 156, 18)": 
        $color="#f39c12"; $color_selection="bg-yellow";
    break;
	case "rgb(255, 133, 27)": 
        $color="#ff851b"; $color_selection="bg-orange";
    break;
	case "rgb(0, 166, 90)": 
        $color="#00a65a"; $color_selection="bg-green";
    break;
	case "rgb(1, 255, 112)": 
        $color="#01ff70"; $color_selection="bg-lime";
    break;
	case "rgb(221, 75, 57)": 
        $color="#dd4b39"; $color_selection="bg-red";
    break;
	case "rgb(96, 92, 168)": 
        $color="#605ca8"; $color_selection="bg-purple";
    break;
	case "rgb(240, 18, 190)": 
        $color="#f012be"; $color_selection="bg-fuchsia";
    break;
	
	case "rgb(0, 31, 63)": 
        $color="#001f3f"; $color_selection="bg-navy";
    break;
	
    
    default:
		$color="#0073b7"; $color_selection="bg-blue";
       
}


	
try{
$insert = $this->con->prepare('INSERT INTO estival_activite (titre_estival_activite,color_estival_activite,color_selection_estival_activite,start_estival_activite,end_estival_activite,description_estival_activite,association_estival_activite,lieu_estival_activite,lieu_repli_estival_activite,public_estival_activite,limite_estival_activite,lien_map)
VALUES(:nom,:couleur,:couleur_selection,:start,:end,:description,:association,:lieu,:lieu_repli,:public,:limite,:lien_map)');
 
 	$execute=$insert->execute(array(
	'nom' => $nom,
	'couleur' => $color,
	'couleur_selection' => $color_selection,
	'start' => $start,
	'end' => $end,
	'description' => $description,
	'association' => $association,
	'lieu' => $lieu,
	'lieu_repli' => $lieu_repli,
	'public' => $public,
	'limite' => $limite,
	'lien_map' => $lien_map
	));    
	
	}
  catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors de la création d'une activité</b>\n";
	throw $e;
        exit;
    }
	
	   
	
	 if (!$execute) {return FALSE;} 
  else{$lastId = $this->con->lastInsertId(); return $lastId;}
  	
  }
  
 /***********************************************************************
 * Affichage des utilisateurs
 **************************************************************************/
  
 function afficheUser($id_activite)
  {
    
try{	
$select = $this->con->prepare('SELECT estival_user.id_estival_user,nom_estival_user,prenom_estival_user,age_estival_user,residence_estival_user,tel_estival_user,email_estival_user,estival_user_has_activite.presence_reunion
						FROM estival_user
						INNER JOIN estival_user_has_activite ON estival_user.id_estival_user=estival_user_has_activite.id_estival_user
						WHERE id_estival_activite  = :id_estival_activite');
						
$select->execute(array(
		':id_estival_activite' => $id_activite
		));
}
 catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors de l'Affichage des utilisateurs</b>\n";
	throw $e;
        exit;
    }		
		
		
		
$data = $select->fetchAll(PDO::FETCH_OBJ);	

return $data;

  }



 /***********************************************************************
 * Affichage de tous les utilisateurs
 **************************************************************************/
  
 function afficheTousUser($annee)
  {
  
$annee ="%$annee%";
    
try{
// recherche de charque particpant 
$select = $this->con->prepare('SELECT *
						FROM estival_user
                                                WHERE date_inscription LIKE :annee
						ORDER BY nom_estival_user ASC
						');
						
$select->execute(array(
':annee' => $annee
		));
}
 catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors de l'Affichage des utilisateurs</b>\n";
	throw $e;
        exit;
    }		
		
		
		
$data = $select->fetchAll(PDO::FETCH_OBJ);	

return $data;

}

/***********************************************************************
 * Affichage de tous les utilisateurs
 **************************************************************************/
  
 function afficheactiviteTousUser($id)
  {	

try{

// affiche toutes les activite de la personne       
$select = $this->con->prepare('SELECT *
						FROM estival_activite
						INNER JOIN estival_user_has_activite ON estival_activite.id_estival_activite=estival_user_has_activite.id_estival_activite
						WHERE id_estival_user  = :id_estival_user
						ORDER BY titre_estival_activite ASC
						');
						
$select->execute(array(
':id_estival_user' => $id
		));

 }
 catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors de l'Affichage des utilisateurs</b>\n";
	throw $e;
        exit;
    }			
		
$data = $select->fetchAll(PDO::FETCH_OBJ);	

return $data;


 }  
/***********************************************************************
 * Edition d'une activité
 **************************************************************************/
  
 function infosActivite($id_activite)
  {
    
try{
$select = $this->con->prepare('SELECT * 
		FROM estival_activite
		WHERE id_estival_activite  = :id_estival_activite');
						
		$select->execute(array(
		':id_estival_activite' => $id_activite
		));
	 }
  catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors de l'Edition d'une activité </b>\n";
	throw $e;
        exit;
    }
		
		
		$data = $select->fetch();
		
	 return $data;
}

/***********************************************************************
 * Envoi d'un email aux inscrits lors de la modification d'une activite
 **************************************************************************/
  
 function emailEditActivite($id_activite)
  {
  
  // reupération des information sur la activité
  try{
    	
		$select = $this->con->prepare('SELECT * 
	    FROM estival_activite
	   WHERE id_estival_activite  = :id_activite');
				
		
		$select->bindParam(':id_activite', $id_activite, PDO::PARAM_INT);
		$select->execute();
		
		$info_activite = $select->fetch();
		
		}
		
	 catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors de l'affichage de la réunion</b>\n";
	throw $e;
        exit;
    }

$titre_estival_activite=htmlspecialchars($info_activite['titre_estival_activite']);
$start_estival_activite=$info_activite['start_estival_activite'];
$end_estival_activite=$info_activite['end_estival_activite'];
$lieu_estival_activite=htmlspecialchars($info_activite['lieu_estival_activite']);
$lien_map=htmlspecialchars($info_activite['lien_map']);
	
$jour_activite=explode(" ",$start_estival_activite);
$jour_activite=explode("-",$jour_activite[0]);
$jour_activite=$jour_activite[2]."/".$jour_activite[1];
	
$heure_debut=explode(" ",$start_estival_activite);
$heure_debut=explode(":",$heure_debut[1]);
$heure_debut=$heure_debut[0]."h".$heure_debut[1];

$heure_fin=explode(" ",$end_estival_activite);
$heure_fin=explode(":",$heure_fin[1]);
$heure_fin=$heure_fin[0]."h".$heure_fin[1];
			
  
  // selection des emails de tous les inscrits
   try{
    	
		$select = $this->con->prepare('SELECT * 
	    FROM estival_user_has_activite
	    INNER JOIN estival_user ON estival_user_has_activite.id_estival_user=estival_user.id_estival_user
            WHERE estival_user_has_activite.id_estival_activite  = :id_activite');
				
		
		$select->bindParam(':id_activite', $id_activite, PDO::PARAM_INT);
		$select->execute();
		
		$liste_inscrits = $select->fetchAll(PDO::FETCH_OBJ);
		
		}
		
	 catch (PDOException $f){
       echo $f->getMessage() . " <br><b>Erreur lors de l'affichage de la réunion</b>\n";
	throw $f;
        exit;
    }
  
   
  // envoi d'un email à chaque inscrit
  
  foreach ($liste_inscrits as $key) 
  	{
  	
	
$email=$key->email_estival_user;
$id_user=$key->id_estival_user;	

// Création d'un nouvel objet $mail
$mail = new PHPMailer();

// Encodage
$mail->CharSet = 'UTF-8';

//=====Corps du message
$body = "<html><head></head>
<body>
Bonjour,<br>
<br>
Nous vous informons de modifications sur l'une de vos activités. Voici les nouvelles informations :  <br>
<ul>
<li>$titre_estival_activite le $jour_activite de $heure_debut à $heure_fin - $lieu_estival_activite  </b><a href=\"$lien_map\" target=\"_blank\"> (voir l'adresse sur Google Map)</a> - [<a href=\"".URL_SITE."/modules/estival/validation_desinscription.php?id_user=$id_user&id_activite=$id_activite&email=$email\">Se désinscrire</a>]</li>
</ul>
<br>Veuillez nous excuser de ce changement<br>
Pour tout renseignement complémentaire, vous pouvez nous contacter au 05 59 27 27 08<br><br>
Salutations<br>
<br>
</body>
</html>";
//==========


// Expediteur, adresse de retour et destinataire :
$mail->SetFrom(FROM_EMAIL, "Ville de Pau"); //L'expediteur du mail
$mail->AddReplyTo("NO-REPLY@agglo-pau.fr", "NO REPLY"); //Pour que l'usager réponde au mail
//mail du destinataire
$mail->AddAddress($email); 

// Sujet du mail
$mail->Subject = "[MODIFICATION] En forme à Pau - $titre_estival_activite du $jour_activite";
// Le message
$mail->MsgHTML($body);


// Envoi de l'email
$mail->Send();

unset($mail);

      
 	 }
  
	
  }




/***********************************************************************
 * Envoi d'un email aux inscrit lors de la supp d'une activite
 **************************************************************************/
  
 function emailSuppActivite($id_activite)
  {
  
  // reupération des information sur la activité
  try{
    	
		$select = $this->con->prepare('SELECT * 
	    FROM estival_activite
	   WHERE id_estival_activite  = :id_activite');
				
		
		$select->bindParam(':id_activite', $id_activite, PDO::PARAM_INT);
		$select->execute();
		
		$info_activite = $select->fetch();
		
		}
		
	 catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors de l'affichage de la réunion</b>\n";
	throw $e;
        exit;
    }

$titre_estival_activite=htmlspecialchars($info_activite['titre_estival_activite']);
$start_estival_activite=$info_activite['start_estival_activite'];
			
$jour_activite=explode(" ",$start_estival_activite);
$jour_activite=explode("-",$jour_activite[0]);
$jour_activite=$jour_activite[2]."/".$jour_activite[1];
	
$heure_debut=explode(" ",$start_estival_activite);
$heure_debut=explode(":",$heure_debut[1]);
$heure_debut=$heure_debut[0]."h".$heure_debut[1];
			
  
  // selection des emails de tous les inscrits
   try{
    	
		$select = $this->con->prepare('SELECT * 
	    FROM estival_user_has_activite
	    INNER JOIN estival_user ON estival_user_has_activite.id_estival_user=estival_user.id_estival_user
            WHERE estival_user_has_activite.id_estival_activite  = :id_activite');
				
		
		$select->bindParam(':id_activite', $id_activite, PDO::PARAM_INT);
		$select->execute();
		
		$liste_inscrits = $select->fetchAll(PDO::FETCH_OBJ);
		
		}
		
	 catch (PDOException $f){
       echo $f->getMessage() . " <br><b>Erreur lors de l'affichage de la réunion</b>\n";
	throw $f;
        exit;
    }
  
   
  // envoi d'un email à chaque inscrit
  
  foreach ($liste_inscrits as $key) 
  	{
  	
	
$email=$key->email_estival_user;

// Création d'un nouvel objet $mail
$mail = new PHPMailer();

// Encodage
$mail->CharSet = 'UTF-8';

//=====Corps du message
$body = "<html><head></head>
<body>
Bonjour,<br>
<br>
Nous vous informons que l'activité suivante a été annulée: <br>
<ul>
<li><b> $titre_estival_activite du $jour_activite à $heure_debut</b></li>
</ul>
<br>Veuillez nous excuser pour ce désagrément<br>
Pour tout renseignement complémentaire, vous pouvez nous contacter au 05 59 27 27 08<br><br>
Salutations<br>
<br>
</body>
</html>";
//==========


// Expediteur, adresse de retour et destinataire :
$mail->SetFrom(FROM_EMAIL, "Ville de Pau"); //L'expediteur du mail
$mail->AddReplyTo("NO-REPLY@agglo-pau.fr", "NO REPLY"); //Pour que l'usager réponde au mail
//mail du destinataire
$mail->AddAddress($email);  

// Sujet du mail
$mail->Subject = "[ANNULATION] En forme à Pau - $titre_estival_activite du $jour_activite";
// Le message
$mail->MsgHTML($body);


// Envoi de l'email
$mail->Send();

unset($mail);

      
 	 }
  
	
  }
 
 

/***********************************************************************
 * Suppression d'une activité
 **************************************************************************/
  
 function suppActivite($id_activite)
  {
    
	
    try{	
$select = $this->con->prepare('DELETE 
		FROM estival_activite
		WHERE id_estival_activite  = :id_estival_activite');
						
$select->execute(array(
		':id_estival_activite' => $id_activite
		));
		 }
  catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors de Suppression d'une activité</b>\n";
	throw $e;
        exit;
    }
		
	try{
$select2 = $this->con->prepare('DELETE 
		FROM estival_user_has_activite
		WHERE id_estival_activite  = :id_estival_activite');
						
$select2->execute(array(
		':id_estival_activite' => $id_activite
		));
	 }
  catch (PDOException $f){
       echo $f->getMessage() . " <br><b>Erreur lors de Suppression d'une activité</b>\n";
	throw $f;
        exit;
    }
		
}


/***********************************************************************
 * Suppression d'un utilisateur
 **************************************************************************/
  
 function suppUser($id_activite,$id_user)
  {
    
	
 try{   	
		$select = $this->con->prepare('DELETE 
		FROM estival_user_has_activite
		WHERE id_estival_activite  = :id_estival_activite AND id_estival_user  = :id_estival_user');
						
		$select->execute(array(
		':id_estival_activite' => $id_activite,
		':id_estival_user' => $id_user,
		));

 }
  catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors de Suppression d'un utilisateur</b>\n";
	throw $e;
        exit;
    }

// decrementation du nombre de place de l'activite
try{
$update = $this->con->prepare('UPDATE estival_activite SET inscrit_estival_activite = inscrit_estival_activite - 1  WHERE id_estival_activite  = :id_estival_activite');
$update->execute(array(
':id_estival_activite' => $id_activite
		));
		
		
 }
  catch (PDOException $f){
       echo $f->getMessage() . " <br><b>Erreur lors de Suppression d'un utilisateur</b>\n";
	throw $f;
        exit;
    }
		
}

/***********************************************************************
 * Mise a jour d'une activité
 **************************************************************************/
 
 function majActivite($id_activite,$nom,$date,$heure_debut,$heure_fin,$description,$association,$lieu,$lieu_repli,$public,$limite,$couleur,$lien_map)
  {
 	

	
	
$date=explode("-",$date);
$start="$date[2]-$date[1]-$date[0] $heure_debut";
$end="$date[2]-$date[1]-$date[0] $heure_fin";		


//convertion de couleur
switch ($couleur) 
{ 
    case "rgb(0, 192, 239)": 
        $color="#00c0ef"; $color_selection="bg-aqua";
    break;
	case "rgb(0, 115, 183)": 
        $color="#0073b7"; $color_selection="bg-blue";
    break;
	case "rgb(60, 141, 188)": 
        $color="#3c8dbc"; $color_selection="bg-light-blue";
    break;
	case "rgb(57, 204, 204)": 
        $color="#39cccc"; $color_selection="bg-teal";
    break;
	case "rgb(243, 156, 18)": 
        $color="#f39c12"; $color_selection="bg-yellow";
    break;
	case "rgb(255, 133, 27)": 
        $color="#ff851b"; $color_selection="bg-orange";
    break;
	case "rgb(0, 166, 90)": 
        $color="#00a65a"; $color_selection="bg-green";
    break;
	case "rgb(1, 255, 112)": 
        $color="#01ff70"; $color_selection="bg-lime";
    break;
	case "rgb(221, 75, 57)": 
        $color="#dd4b39"; $color_selection="bg-red";
    break;
	case "rgb(96, 92, 168)": 
        $color="#605ca8"; $color_selection="bg-purple";
    break;
	case "rgb(240, 18, 190)": 
        $color="#f012be"; $color_selection="bg-fuchsia";
    break;
	
	case "rgb(0, 31, 63)": 
        $color="#001f3f"; $color_selection="bg-navy";
    break;
	
    
    default:
		$color="#0073b7"; $color_selection="bg-blue";
       
}


	
try{
$insert = $this->con->prepare('UPDATE estival_activite SET titre_estival_activite=:nom,color_estival_activite=:couleur,color_selection_estival_activite=:couleur_selection,start_estival_activite=:start,end_estival_activite=:end,description_estival_activite=:description,association_estival_activite=:association,lieu_estival_activite=:lieu,lieu_repli_estival_activite=:lieu_repli,public_estival_activite=:public,limite_estival_activite=:limite,lien_map=:lien_map
WHERE id_estival_activite  = :id_estival_activite');
 
 	$execute=$insert->execute(array(
	'nom' => $nom,
	'couleur' => $color,
	'couleur_selection' => $color_selection,
	'start' => $start,
	'end' => $end,
	'description' => $description,
	'association' => $association,
	'lieu' => $lieu,
	'lieu_repli' => $lieu_repli,
	'public' => $public,
	'limite' => $limite,
	'id_estival_activite' => $id_activite,
	'lien_map' => $lien_map
	));    
	
	 if (!$execute) {return FALSE;} 
  else{return TRUE;}
  	
  }
  catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors mise à jour d'une activité</b>\n";
	throw $e;
        exit;
    } 
	
	 if (!$execute) {return FALSE;} 
  else{return TRUE;}
  	
  }

/***********************************************************************
 * Envoi d'un email aux inscrits qui ne sont pas venus à une activité
 **************************************************************************/
  
 function emailAbsent($id_activite)
  {
 	
 
// recupération des informations sur l'activite
 try{
$select = $this->con->prepare('SELECT * 
		FROM estival_activite
		WHERE id_estival_activite  = :id_estival_activite');
						
		$select->execute(array(
		':id_estival_activite' => $id_activite
		));
		
		
		
	 }
  catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors de la recupération des informations sur la reunion</b>\n";
	throw $e;
        exit;
    }
  
$result= $select->fetch(); 
  
$titre=$result[1];

$date=$result[4];
$date=explode(" ",$date);
$jour=explode("-",$date[0]);
$date_calendar=$date[0];
$heure=explode(":",$date[1]);
$date="le ".$jour[2]."/".$jour[1]." à ".$heure[0]."h".$heure[1];

  
  // selection des emails des inscrits non présent
 try{	
$select = $this->con->prepare('SELECT estival_user.id_estival_user,nom_estival_user,prenom_estival_user,age_estival_user,residence_estival_user,tel_estival_user,email_estival_user,estival_user_has_activite.presence_reunion
						FROM estival_user
						INNER JOIN estival_user_has_activite ON estival_user.id_estival_user=estival_user_has_activite.id_estival_user
						WHERE id_estival_activite  = :id_estival_activite AND presence_reunion  != 1');
						
$select->execute(array(
		':id_estival_activite' => $id_activite
		));
		
 $data = $select->fetchAll(PDO::FETCH_OBJ);		
}
 catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors de l'Affichage des utilisateurs</b>\n";
	throw $e;
        exit;
    }		
  

   
  // envoi d'un email à chaque inscrit
 
 foreach ($data as $key) 
  	{
  	
	
$email=$key->email_estival_user;

// Création d'un nouvel objet $mail
$mail = new PHPMailer();

// Encodage
$mail->CharSet = 'UTF-8';

//=====Corps du message

$body = "<html><head></head>
<body>
Bonjour,<br>
<br>
Vous étiez inscrits à l'activité $titre $date, mais, sauf erreur de notre part, vous n'êtes pas venu. <br>
Pour des raisons pratiques et pour permettre au plus grand nombre d'y participer, il est préférable de nous informer en cas d'empêchement pour que nous puissions inscrire une autre personne à votre place .<br>
En cas de besoin, merci de nous contacter au 05 59 27 27 08<br><br>
Salutations<br>
<br>
</body>
</html>";
//==========


// Expediteur, adresse de retour et destinataire :
$mail->SetFrom(FROM_EMAIL, "Ville de Pau"); //L'expediteur du mail
$mail->AddReplyTo("NO-REPLY@agglo-pau.fr", "NO REPLY"); //Pour que l'usager réponde au mail
//mail du destinataire
$mail->AddAddress($email); 

// Sujet du mail
$mail->Subject = "Ville de Pau - En forme à Pau";
// Le message
$mail->MsgHTML($body);


// Envoi de l'email
$mail->Send();

unset($mail);

      
 	 }
 

 
 //Enregistrement "email envoyé" dans la fiche activite
try{	
$update = $this->con->prepare('UPDATE estival_activite SET email_absent = 1  WHERE id_estival_activite  = :id_activite'); 

$update->bindParam(':id_activite', $id_activite, PDO::PARAM_INT);
$update->execute();	
	}
	
	 catch (Exception $g) {
            echo $g->getMessage() . " <br><b>Erreur lors de l'incrementation de la table activite</b>\n";
            throw $g;
        }		
 


	
  }


/***********************************************************************
 * Mise à jour des présences aux réunions
 **************************************************************************/
  
 function changePresence($id_usager,$etat,$id_activite)
  {
 
	
	try{	
$update = $this->con->prepare('UPDATE estival_user_has_activite SET presence_reunion = :presence_reunion WHERE id_estival_user = :id_estival_user AND id_estival_activite = :id_estival_activite'); 

$update->bindParam(':presence_reunion', $etat, PDO::PARAM_INT);	    	
$update->bindParam(':id_estival_user', $id_usager, PDO::PARAM_INT);
$update->bindParam(':id_estival_activite', $id_activite, PDO::PARAM_INT);
$update->execute();	
	}
	
	 catch (Exception $e) {
            echo $e->getMessage() . " <br><b>Erreur lors de la mise à jour des présence à une activité</b>\n";
            throw $e;
        }		

  }

  }
