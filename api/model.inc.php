<?php

class apiModels {

    private $con;

    public function __construct(connection $con) {
        $this->con = $con->con;
    }

 /***********************************************************************
 Vérification des identifiants de login
 **************************************************************************/

function verifIdentifiants($login,$pass_hache)
  {
   
		try {
				
$req = $this->con->prepare('SELECT * FROM membres
INNER JOIN type_membre ON type_membre.id_typemembre=membres.id_typemembre 
WHERE email = :email AND mot_de_passe = :pass AND validation_inscription = 1');

$req->bindParam(':email', $login, PDO::PARAM_STR);
$req->bindParam(':pass', $pass_hache, PDO::PARAM_STR);
$req->execute();		

$resultat = $req->fetch();
			} 
        
        catch (Exception $e) {
            echo $e->getMessage() . " <br><b>Erreur de verification d'identifiant</b>\n";
            throw $e;
        }

return $resultat;
	
} 
    
    
    
 /***********************************************************************
 * Affichage de tous les administrateurs
 **************************************************************************/
  
 function afficheAdmins()
  {
   
   try{
$select = $this->con->prepare('SELECT *
						FROM membres
						WHERE id_typemembre <> 1 AND validation_inscription = 1
						ORDER BY id_membre ASC
						');
						
$select->execute();
	} 
        
        catch (Exception $e) {
            echo $e->getMessage() . " <br><b>Erreur de l'Affichage des administrateurs</b>\n";
            throw $e;
        }	 


$data = $select->fetchAll(PDO::FETCH_OBJ);	
	 
return $data;
    
 }

/***********************************************************************
 * Affichage d'un administrateur
 **************************************************************************/
  
 function afficheAdmin($id)
  {
   
   try{
$select = $this->con->prepare('SELECT *
						FROM membres
						WHERE id_typemembre <> 1 AND validation_inscription = 1 AND id_membre = :id
						');
						
$select->execute(array(
		':id' => $id
		));


	} 
        
        catch (Exception $e) {
            echo $e->getMessage() . " <br><b>Erreur de l'Affichage d'un administrateur</b>\n";
            throw $e;
        }	 


$data = $select->fetchAll(PDO::FETCH_OBJ);	
	 
return $data;
    
 }
 
/***********************************************************************
 * Affichage de tous les activites
 **************************************************************************/
  
 function afficheActivites()
  {
   
   try{
$select = $this->con->prepare('SELECT *
						FROM estival_activite
						ORDER BY id_estival_activite ASC
						');
						
$select->execute();
	} 
        
        catch (Exception $e) {
            echo $e->getMessage() . " <br><b>Erreur de l'Affichage des activite</b>\n";
            throw $e;
        }	 


$data = $select->fetchAll(PDO::FETCH_OBJ);	
	 
return $data;
    
 }

/***********************************************************************
 * Affichage d'une Activite
 **************************************************************************/
  
 function afficheActivite($id)
  {
   
   try{
$select = $this->con->prepare('SELECT *
						FROM estival_activite
						WHERE id_estival_activite = :id
						');
						
$select->execute(array(
		':id' => $id
		));


	} 
        
        catch (Exception $e) {
            echo $e->getMessage() . " <br><b>Erreur de l'Affichage d'une activite</b>\n";
            throw $e;
        }	 


$data = $select->fetchAll(PDO::FETCH_OBJ);	
	 
return $data;
    
 } 
 
/***********************************************************************
 * Affichage de tous les participants
 **************************************************************************/
  
 function afficheParticipants()
  {
   
   try{
$select = $this->con->prepare('SELECT *
						FROM estival_user
						ORDER BY id_estival_user ASC
						');
						
$select->execute();
	} 
        
        catch (Exception $e) {
            echo $e->getMessage() . " <br><b>Erreur de l'Affichage des Participants</b>\n";
            throw $e;
        }	 


$data = $select->fetchAll(PDO::FETCH_OBJ);	
	 
return $data;
    
 }

/***********************************************************************
 * Affichage d'un participant
 **************************************************************************/
  
 function afficheparticipant($id)
  {
   
   try{
$select = $this->con->prepare('SELECT *
						FROM estival_user
						WHERE id_estival_user = :id
						');
						
$select->execute(array(
		':id' => $id
		));


	} 
        
        catch (Exception $e) {
            echo $e->getMessage() . " <br><b>Erreur de l'Affichage d'un partiicpant</b>\n";
            throw $e;
        }	 


$data = $select->fetchAll(PDO::FETCH_OBJ);	
	 
return $data;
    
 }  
 
 
/***********************************************************************
 * Affichage de tous les participants
 **************************************************************************/
  
 function afficheTypeSignalements()
  {
   
   try{
$select = $this->con->prepare('SELECT *
						FROM type_signalement
						ORDER BY ordre_affichage ASC
						');
						
$select->execute();
	} 
        
        catch (Exception $e) {
            echo $e->getMessage() . " <br><b>Erreur de l'Affichage des types de signalement</b>\n";
            throw $e;
        }	 


$data = $select->fetchAll(PDO::FETCH_OBJ);	
	 
return $data;
    
 }

/***********************************************************************
 * Affichage d'un participant
 **************************************************************************/
  
 function afficheTypeSugnalement($id)
  {
   
   try{
$select = $this->con->prepare('SELECT *
						FROM type_signalement
						WHERE id = :id
						');
						
$select->execute(array(
		':id' => $id
		));


	} 
        
        catch (Exception $e) {
            echo $e->getMessage() . " <br><b>Erreur de l'Affichage d'un type de signalement</b>\n";
            throw $e;
        }	 


$data = $select->fetchAll(PDO::FETCH_OBJ);	
	 
return $data;
    
 }  
 
 
 /***********************************************************************
 * Affichage d'un participant
 **************************************************************************/
  
 function newSignalement($data)
  {
 
 $nom=$data[0]->nom; 
 $prenom = $data[0]->prenom; 
 $email=$data[0]->email; 
 $type_signalement = $data[0]->type_signalement; 
 $coordonnees=$data[0]->coordonnees; 
 $photo = $data[0]->photo;
 
     
 
 try{
	
$insert = $this->con->prepare('INSERT INTO signalement (nom, prenom,email,type_signalement,coordonnees,photo)
VALUES(:nom, :prenom,:email,:type_signalement,:coordonnees,:photo)');
	
$insert->bindParam(':nom', $nom, PDO::PARAM_STR);
$insert->bindParam(':prenom', $prenom, PDO::PARAM_STR);
$insert->bindParam(':email', $email, PDO::PARAM_STR);
$insert->bindParam(':type_signalement', $type_signalement, PDO::PARAM_INT);
$insert->bindParam(':coordonnees', $coordonnees, PDO::PARAM_STR);
$insert->bindParam(':photo', $photo, PDO::PARAM_STR);
$insert->execute();

	}
        catch (Exception $f) {
            echo $f->getMessage() . " <br><b>Erreur lors de la creation d'une fiche de signalement</b>\n";
            throw $f;
        } 
 
  }
 
 
 
 
}
