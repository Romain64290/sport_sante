<?php

/***** Dernière modification : 28/10/2016, Romain TALDU	*****/

class annuel {

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
					FROM annuel_activite');
		
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
		FROM annuel_activite
		WHERE start_annuel_activite  > :date
	    ORDER BY start_annuel_activite ASC');	
				
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
 
 function ajoutActivite($nom,$date,$heure_debut,$heure_fin,$description,$association,$lieu,$lieu_repli,$public,$limite,$couleur)
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
$insert = $this->con->prepare('INSERT INTO annuel_activite (titre_annuel_activite,color_annuel_activite,color_selection_annuel_activite,start_annuel_activite,end_annuel_activite,description_annuel_activite,association_annuel_activite,lieu_annuel_activite,lieu_repli_annuel_activite,public_annuel_activite,limite_annuel_activite)
VALUES(:nom,:couleur,:couleur_selection,:start,:end,:description,:association,:lieu,:lieu_repli,:public,:limite)');
 
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
	'limite' => $limite
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
 * Création d'un nouveau membre
 **************************************************************************/
 
 function ajoutNewuser($civilite,$nom,$prenom,$telephone,$email,$residence,$naissance,$accepte,$motdepasse)
  {
 		
 	try {

$select = $this->con->prepare('SELECT COUNT(*) as nbr FROM membres
                        WHERE email= :email');

$select->bindParam(':email', $email, PDO::PARAM_STR);
$select->execute();	

$result = $select->fetch();
$quantite=$result['nbr'];
		
		} 
        
        catch (Exception $e) {
            echo $e->getMessage() . " <br><b>Erreur lors de la recherche de doublon d'email</b>\n";
            throw $e;
        }


if($quantite==0){
	
	try{
	
$insert = $this->con->prepare('INSERT INTO membres (id_typemembre,mot_de_passe,nom_membre,prenom_membre,email,date_inscription,validation_inscription,civilite,telephone,age,residence,accepte_mail)
VALUES(:id_typemembre,:mot_de_passe,:nom,:prenom,:email,:date,:validation_inscription,:civilite,:telephone,:age,:residence,:accepte_mail)');
	
$insert->bindValue(':id_typemembre', 1, PDO::PARAM_INT);
$insert->bindParam(':mot_de_passe', $motdepasse, PDO::PARAM_STR);
$insert->bindParam(':nom', $nom, PDO::PARAM_STR);
$insert->bindParam(':prenom', $prenom, PDO::PARAM_STR);
$insert->bindParam(':email', $email, PDO::PARAM_STR);
$insert->bindValue(':date', date('Y-m-d H:i:s'),PDO::PARAM_STR);
$insert->bindValue(':validation_inscription', 1, PDO::PARAM_INT);
$insert->bindParam(':civilite', $civilite, PDO::PARAM_STR);
$insert->bindParam(':telephone', $telephone, PDO::PARAM_STR);
$insert->bindParam(':age', $naissance, PDO::PARAM_STR);
$insert->bindParam(':residence', $residence, PDO::PARAM_STR);
$insert->bindParam(':accepte_mail', $accepte, PDO::PARAM_STR);

$execute=$insert->execute();

	}
        catch (Exception $f) {
            echo $f->getMessage() . " <br><b>Erreur lors de la creation d'un membre</b>\n";
            throw $f;
        } 
  	
  if (!$execute) {return FALSE;} 
  
  else{$lastId = $this->con->lastInsertId(); return $lastId;}
 
} else{return FALSE;} 
 				
}


 /***********************************************************************
 * Affichage des utilisateurs
 **************************************************************************/
  
 function afficheUsers($id_activite)
  {
  
try{
$select = $this->con->prepare('SELECT * 
						FROM membres
						INNER JOIN annuel_user_has_activite ON membres.id_membre=annuel_user_has_activite.id_membre
						WHERE id_annuel_activite  = :id_annuel_activite AND membres.id_typemembre =1');
						
		$select->execute(array(
		':id_annuel_activite' => $id_activite
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
 * Affichage des utilisateurs non inscrits à l'activité
 **************************************************************************/
  
 function afficheNoUsers($id_activite)
  {
  
	try{
$select = $this->con->prepare('SELECT * 
						FROM membres
						WHERE membres.id_typemembre =1');
						
		$select->execute(array(
		':id_annuel_activite' => $id_activite
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
  
 function afficheMembreAnnuel()
  {

// recherche de charque particpant 
	try{
$select = $this->con->prepare('SELECT *
						FROM membres
						WHERE id_typemembre=1
						ORDER BY nom_membre ASC
						');
						
$select->execute();
		}
  catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors de l'Affichage de tous les utilisateurs</b>\n";
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
		FROM annuel_activite
		WHERE id_annuel_activite  = :id_annuel_activite');
						
		$select->execute(array(
		':id_annuel_activite' => $id_activite
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
 * Affichage des infos membres
 **************************************************************************/
  
 function infoMembre($id_membre)
  {

    try{	
$select = $this->con->prepare('SELECT * 
		FROM membres
		WHERE id_membre  = :id_membre');
						
		$select->execute(array(
		':id_membre' => $id_membre
		));
		
	 }
  catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors de l'affichage des infos d'un membre. </b>\n";
	throw $e;
        exit;
    }
		
		
		$data = $select->fetch();
		
	 return $data;
}
  

/***********************************************************************
 * Suppression d'une activité
 **************************************************************************/
  
 function suppActivite($id_activite)
  {
   

    try{	
$select = $this->con->prepare('DELETE 
		FROM annuel_activite
		WHERE id_annuel_activite  = :id_annuel_activite');
						
$select->execute(array(
		':id_annuel_activite' => $id_activite
		));
		 }
  catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors de Suppression d'une activité</b>\n";
	throw $e;
        exit;
    }
		
	try{
$select2 = $this->con->prepare('DELETE 
		FROM annuel_user_has_activite
		WHERE id_annuel_activite  = :id_annuel_activite');
						
$select2->execute(array(
		':id_annuel_activite' => $id_activite
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
		FROM annuel_user_has_activite
		WHERE id_annuel_activite  = :id_annuel_activite AND id_membre  = :id_membre');
						
$select->execute(array(
		':id_annuel_activite' => $id_activite,
		':id_membre' => $id_user,
		));
		 }
  catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors de Suppression d'un utilisateur</b>\n";
	throw $e;
        exit;
    }
		
// decrementation du nombre de place de l'activite
	try{
$update = $this->con->prepare('UPDATE annuel_activite SET inscrit_annuel_activite = inscrit_annuel_activite - 1  WHERE id_annuel_activite  = :id_annuel_activite');
$update->execute(array(
':id_annuel_activite' => $id_activite
		));
		 }
  catch (PDOException $f){
       echo $f->getMessage() . " <br><b>Erreur lors de Suppression d'un utilisateur</b>\n";
	throw $f;
        exit;
    }
		
}


/***********************************************************************
 * Ajout d'un utilisateur à une activite par un admin
 **************************************************************************/
  
 function AddUser($id_activite,$id_user)
  {
 
// verfier que l'utilisateur n'est pas deja inscrit
try {

$select = $this->con->prepare('SELECT COUNT(*) as nbr FROM annuel_user_has_activite
                        WHERE id_membre= :id_membre AND id_annuel_activite=:id_activite');

$select->bindParam(':id_membre', $id_user, PDO::PARAM_INT);
$select->bindParam(':id_activite', $id_activite, PDO::PARAM_INT);
$select->execute();	

$result = $select->fetch();
$quantite=$result['nbr'];
		
		} 
        
        catch (Exception $e) {
            echo $e->getMessage() . " <br><b>Erreur lors de la recherche de laison id_membre/ id_activite</b>\n";
            throw $e;
        }


if($quantite==0){

//ajoute l'utilisateur

 	try{
 		  	
$insert = $this->con->prepare('INSERT INTO annuel_user_has_activite (id_membre,id_annuel_activite)
VALUES(:id_membre,:id_activite)');
	
$insert->bindParam(':id_membre', $id_user, PDO::PARAM_INT);
$insert->bindParam(':id_activite', $id_activite, PDO::PARAM_INT);
$insert->execute();
		 }
  catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors de Suppression d'un utilisateur</b>\n";
	throw $e;
        exit;
    }
		
// incremente du nombre de place de l'activite
	try{
$update = $this->con->prepare('UPDATE annuel_activite SET inscrit_annuel_activite = inscrit_annuel_activite + 1  WHERE id_annuel_activite  = :id_annuel_activite');
$update->execute(array(
':id_annuel_activite' => $id_activite
		));
		 }
  catch (PDOException $f){
       echo $f->getMessage() . " <br><b>Erreur lors de Suppression d'un utilisateur</b>\n";
	throw $f;
        exit;
    }
		
}
}


/***********************************************************************
 * Suppression d'une activite par un utlisateur
 **************************************************************************/
  
 function suppMonActivite($id_activite,$id_user)
  {
 

 	try{  	
$select = $this->con->prepare('DELETE 
		FROM annuel_user_has_activite
		WHERE id_annuel_activite  = :id_annuel_activite AND id_membre  = :id_membre');
						
$select->execute(array(
		':id_annuel_activite' => $id_activite,
		':id_membre' => $id_user,
		));
		 }
  catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors de Suppression d'un utilisateur</b>\n";
	throw $e;
        exit;
    }
		
// decrementation du nombre de place de l'activite
	try{
$update = $this->con->prepare('UPDATE annuel_activite SET inscrit_annuel_activite = inscrit_annuel_activite - 1  WHERE id_annuel_activite  = :id_annuel_activite');
$update->execute(array(
':id_annuel_activite' => $id_activite
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
 
 function majActivite($id_activite,$nom,$date,$heure_debut,$heure_fin,$description,$association,$lieu,$lieu_repli,$public,$limite,$couleur)
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
$insert = $this->con->prepare('UPDATE annuel_activite SET titre_annuel_activite=:nom,color_annuel_activite=:couleur,color_selection_annuel_activite=:couleur_selection,start_annuel_activite=:start,end_annuel_activite=:end,description_annuel_activite=:description,association_annuel_activite=:association,lieu_annuel_activite=:lieu,lieu_repli_annuel_activite=:lieu_repli,public_annuel_activite=:public,limite_annuel_activite=:limite
WHERE id_annuel_activite  = :id_annuel_activite');
 
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
	'id_annuel_activite' => $id_activite
	));   
	
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
 * Mise a jour des infos membres
 **************************************************************************/
 
 function majMembre($id_membre,$telephone,$residence,$accepte)
  {
 	
		
	try{
$insert = $this->con->prepare('UPDATE membres SET telephone=:telephone,residence=:residence,accepte_mail=:accepte
WHERE id_membre  = :id_membre');
 
 	$execute=$insert->execute(array(
 	'id_membre' => $id_membre,
	'telephone' => $telephone,
	'residence' => $residence,
	'accepte' => $accepte
	));   
	
	 }
  catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors mise à jour des infos membre</b>\n";
	throw $e;
        exit;
    } 
	
	 if (!$execute) {return FALSE;} 
  else{return TRUE;}
  	
  }
  
    /***********************************************************************
 * Mise a jour du mot de passe des membres
 **************************************************************************/
 
 function majMembrepwd($id_membre,$motdepasse)
  {
 	
		
	try{
$insert = $this->con->prepare('UPDATE membres SET mot_de_passe=:motdepasse
WHERE id_membre  = :id_membre');
 
 	$execute=$insert->execute(array(
 	'id_membre' => $id_membre,
	'motdepasse' => $motdepasse
	));   
	
	 }
  catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors mise à jour du mot de passe d'un membre</b>\n";
	throw $e;
        exit;
    } 
	
	 if (!$execute) {return FALSE;} 
  else{return TRUE;}
  	
  }

/***********************************************************************
 * Reservation d'une activite par un membre
 **************************************************************************/
 
 function addActiviteMembre($id_membre,$ajout)
  {
 		
 	try {

$select = $this->con->prepare('SELECT COUNT(*) as nbr FROM annuel_user_has_activite
                        WHERE id_membre= :id_membre AND id_annuel_activite=:ajout');

$select->bindParam(':id_membre', $id_membre, PDO::PARAM_INT);
$select->bindParam(':ajout', $ajout, PDO::PARAM_INT);
$select->execute();	

$result = $select->fetch();
$quantite=$result['nbr'];
		
		} 
        
        catch (Exception $e) {
            echo $e->getMessage() . " <br><b>Erreur lors de la recherche de laison id_membre/ id_activite</b>\n";
            throw $e;
        }


if($quantite==0){
	
	
// verification si l'activite est encore dispo


/*$select = $pdo->prepare('SELECT * FROM estival_activite
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
			
	if($limite_estival_activite!=0 AND $inscrit_estival_activite>=$limite_estival_activite)	{$complet=$id_estival_activite." "; return "complet"; exit;}	
	
	*/
	
	
	
	try{
	
$insert = $this->con->prepare('INSERT INTO annuel_user_has_activite (id_membre,id_annuel_activite)
VALUES(:id_membre,:ajout)');
	
$insert->bindParam(':id_membre', $id_membre, PDO::PARAM_INT);
$insert->bindParam(':ajout', $ajout, PDO::PARAM_INT);
$insert->execute();

	}
        catch (Exception $f) {
            echo $f->getMessage() . " <br><b>Erreur lors de la creation de laison id_membre/ id_activite</b>\n";
            throw $f;
        } 
  


	try{
		
$update = $this->con->prepare('UPDATE annuel_activite SET inscrit_annuel_activite = inscrit_annuel_activite +1
WHERE id_annuel_activite  = :ajout');
 
$update->bindParam(':ajout', $ajout, PDO::PARAM_INT);
$update->execute();
	
	 }
	
  catch (PDOException $g){
       echo $g->getMessage() . " <br><b>Erreur lors l'incrementation de l'activite</b>\n";
	throw $g;
        exit;
    } 

  
  
 return "ok";
 
} else{return "deja";} 
 				
}
  
/***********************************************************************
 * Affichage des inscription en cours d'une utilisateur (vue utilisateur)
 **************************************************************************/
  
 function afficheActiviteEncoursMembreAnnuel($id_membre)
  {

  try{
  	
$date=date("Y-m-d H:i:s");
 
$select = $this->con->prepare('SELECT *
						FROM annuel_activite
						INNER JOIN annuel_user_has_activite ON annuel_activite.id_annuel_activite=annuel_user_has_activite.id_annuel_activite
						WHERE id_membre  = :id_membre AND start_annuel_activite > :date
						ORDER BY start_annuel_activite DESC');
		
$select->bindParam(':id_membre', $id_membre, PDO::PARAM_INT);
$select->bindParam(':date', $date, PDO::PARAM_STR);
$select->execute();

  }
  catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors de l'affichage des inscription en cours d'une utilisateur (vue utilisateur)</b>\n";
	throw $e;
        exit;
    }
		
	 
 $result = $select->fetchAll(PDO::FETCH_OBJ);

 return $result;
  
}

/***********************************************************************
 * Affichage des inscription historique d'une utilisateur (vue utilisateur)
 **************************************************************************/
  
 function afficheActiviteHistoMembreAnnuel($id_membre)
  {

  try{
  	
$date=date("Y-m-d H:i:s");
 
$select = $this->con->prepare('SELECT *
						FROM annuel_activite
						INNER JOIN annuel_user_has_activite ON annuel_activite.id_annuel_activite=annuel_user_has_activite.id_annuel_activite
						WHERE id_membre  = :id_membre AND start_annuel_activite < :date
						ORDER BY start_annuel_activite DESC');
		
$select->bindParam(':id_membre', $id_membre, PDO::PARAM_INT);
$select->bindParam(':date', $date, PDO::PARAM_STR);
$select->execute();

  }
  catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors de l'affichage des inscription en cours d'une utilisateur (vue utilisateur)</b>\n";
	throw $e;
        exit;
    }
		
	 
 $result = $select->fetchAll(PDO::FETCH_OBJ);

 return $result;
  
}



 /*******************************************************
 * Envoi email de confirmation d'inscription 
********************************************************/ 

function envoiEmailNewuser($email,$motdepasse)
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
Nous vous confirmons votre inscription au dispositif \"En forme à Pau\": <br>
Pour vous connecter à votre espace de reservation d'activités, veuillez tapez l'adresse suivante : <a href=\"https://efapau2.agglo-pau.fr\">https://efapau2.agglo-pau.fr</a><br>
Saisissez les identifiants suivants: <br>
<ul>
<li><b>Email :</b> $email </li>
<li><b>Mot de passe :</b> $motdepasse <br></li>
</ul>
Une fois connecté, vous pourrez personnaliser votre mot de passe<br>
Ce compte personnel vous permet également de vous désinscrire des activités réservées.<br><br>
La Ville de Pau vous remercie de votre participation. 
</body>
</html>";
//==========


// Expediteur, adresse de retour et destinataire :
$mail->SetFrom(FROM_EMAIL, "Ville de Pau"); //L'expediteur du mail
$mail->AddReplyTo("NO-REPLY@agglo-pau.fr", "NO REPLY"); //Pour que l'usager réponde au mail
// Si on a le nom : $mail->AddAddress("romain_taldu@hotmail.com", "Romain perso"); 
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

}
