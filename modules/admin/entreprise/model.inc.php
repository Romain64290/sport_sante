<?php

/***** Dernière modification : 04/05/2017, Romain TALDU	*****/

class entreprise {

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
 * Affichage des activités dans la vue ne listing
 **************************************************************************/
  
 function afficheActivite()
  {
	
$date=date( "Y-m-d 00:00:00");
	
  try{
    	
$select = $this->con->prepare('SELECT * 
		FROM entreprise_activite
		WHERE start_entreprise_activite  > :date
	    ORDER BY start_entreprise_activite ASC');	
				
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
 
 function ajoutActivite($nom,$date,$heure_debut,$heure_fin,$description,$lieu,$lieu_repli,$limite,$couleur)
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
$insert = $this->con->prepare('INSERT INTO entreprise_activite (titre_entreprise_activite,color_entreprise_activite,color_selection_entreprise_activite,start_entreprise_activite,end_entreprise_activite,description_entreprise_activite,lieu_entreprise_activite,lieu_repli_entreprise_activite,limite_entreprise_activite)
VALUES(:nom,:couleur,:couleur_selection,:start,:end,:description,:lieu,:lieu_repli,:limite)');
 
 	$execute=$insert->execute(array(
	'nom' => $nom,
	'couleur' => $color,
	'couleur_selection' => $color_selection,
	'start' => $start,
	'end' => $end,
	'description' => $description,
	'lieu' => $lieu,
	'lieu_repli' => $lieu_repli,
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
 * Affichage des utilisateurs
 **************************************************************************/
  
 function afficheUser($id_activite)
  {
		
try{	
$select = $this->con->prepare('SELECT entreprise_user.id_entreprise_user,nom_entreprise_user,prenom_entreprise_user,age_entreprise_user,residence_entreprise_user,tel_entreprise_user,email_entreprise_user 
						FROM entreprise_user
						INNER JOIN entreprise_user_has_activite ON entreprise_user.id_entreprise_user=entreprise_user_has_activite.id_entreprise_user
						WHERE id_entreprise_activite  = :id_entreprise_activite');
						
$select->execute(array(
		':id_entreprise_activite' => $id_activite
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
  
 function afficheTousUser()
  {
	

try{
// recherche de charque particpant 
$select = $this->con->prepare('SELECT entreprise_user.id_entreprise_user,nom_entreprise_user,prenom_entreprise_user,age_entreprise_user
						FROM entreprise_user
						ORDER BY nom_entreprise_user ASC
						');
						
$select->execute();

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
						FROM entreprise_activite
						INNER JOIN entreprise_user_has_activite ON entreprise_activite.id_entreprise_activite=entreprise_user_has_activite.id_entreprise_activite
						WHERE id_entreprise_user  = :id_entreprise_user
						ORDER BY titre_entreprise_activite ASC
						');
						
						
$select->execute(array(
':id_entreprise_user' => $id
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
		FROM entreprise_activite
		WHERE id_entreprise_activite  = :id_entreprise_activite');
						
		$select->execute(array(
		':id_entreprise_activite' => $id_activite
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
 * Suppression d'une activité
 **************************************************************************/
  
 function suppActivite($id_activite)
  {
   

    try{	
$select = $this->con->prepare('DELETE 
		FROM entreprise_activite
		WHERE id_entreprise_activite  = :id_entreprise_activite');
						
$select->execute(array(
		':id_entreprise_activite' => $id_activite
		));
		 }
  catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors de Suppression d'une activité</b>\n";
	throw $e;
        exit;
    }
		
	try{
$select2 = $this->con->prepare('DELETE 
		FROM entreprise_user_has_activite
		WHERE id_entreprise_activite  = :id_entreprise_activite');
						
$select2->execute(array(
		':id_entreprise_activite' => $id_activite
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
		FROM entreprise_user_has_activite
		WHERE id_entreprise_activite  = :id_entreprise_activite AND id_entreprise_user  = :id_entreprise_user');
						
		$select->execute(array(
		':id_entreprise_activite' => $id_activite,
		':id_entreprise_user' => $id_user,
		));

 }
  catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors de Suppression d'un utilisateur</b>\n";
	throw $e;
        exit;
    }
		
// decrementation du nombre de place de l'activite
	try{
$update = $this->con->prepare('UPDATE entreprise_activite SET inscrit_entreprise_activite = inscrit_entreprise_activite - 1  WHERE id_entreprise_activite  = :id_entreprise_activite');
$update->execute(array(
':id_entreprise_activite' => $id_activite
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
 
 function majActivite($id_activite,$nom,$date,$heure_debut,$heure_fin,$description,$lieu,$lieu_repli,$limite,$couleur)
 
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
$insert = $this->con->prepare('UPDATE entreprise_activite SET titre_entreprise_activite=:nom,color_entreprise_activite=:couleur,color_selection_entreprise_activite=:couleur_selection,start_entreprise_activite=:start,end_entreprise_activite=:end,description_entreprise_activite=:description,lieu_entreprise_activite=:lieu,lieu_repli_entreprise_activite=:lieu_repli,limite_entreprise_activite=:limite
WHERE id_entreprise_activite  = :id_entreprise_activite');
 
 	$execute=$insert->execute(array(
	'nom' => $nom,
	'couleur' => $color,
	'couleur_selection' => $color_selection,
	'start' => $start,
	'end' => $end,
	'description' => $description,
	'lieu' => $lieu,
	'lieu_repli' => $lieu_repli,
	'limite' => $limite,
	'id_entreprise_activite' => $id_activite
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





  }
