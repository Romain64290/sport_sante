<?php

/***** Dernière modification : 27/10/2016, Romain TALDU	*****/

class session {

    private $con;

    public function __construct(connection $con) {
        $this->con = $con->con;
    }


 /***********************************************************************
 Vérification des identifiants de login
 **************************************************************************/

function verif_identifiant($login,$pass_hache)
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
  


 /**************************************************************************
 * Ajout d'un administrateur
***************************************************************************/
 
 function addRegister($nom,$prenom,$email,$repassword)
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
	
$insert = $this->con->prepare('INSERT INTO membres (id_typemembre,mot_de_passe,nom_membre,prenom_membre,email,date_inscription)
VALUES(:id_typemembre,:mot_de_passe,:nom,:prenom,:email,:date)');
	
$insert->bindValue(':id_typemembre', 3, PDO::PARAM_INT);
$insert->bindParam(':mot_de_passe', $repassword, PDO::PARAM_STR);
$insert->bindParam(':nom', $nom, PDO::PARAM_STR);
$insert->bindParam(':prenom', $prenom, PDO::PARAM_STR);
$insert->bindParam(':email', $email, PDO::PARAM_STR);
$insert->bindValue(':date', date('Y-m-d H:i:s'),PDO::PARAM_STR);

$execute=$insert->execute();	
	
	
	
	}
        catch (Exception $f) {
            echo $f->getMessage() . " <br><b>Erreur lors de la creation d'un membre</b>\n";
            throw $f;
        } 
  	
  if (!$execute) {return FALSE;} 
  else{return TRUE;}
 
} else{return FALSE;} 
 				
}


 /**************************************************************************
 * Envoi token pour mise a jour mot de passe
***************************************************************************/
 
 function newPwd($email)
  {
  	
   
try {	

$select = $this->con->prepare('SELECT * FROM membres
                        WHERE email= :email');
                        
$select->bindParam(':email', $email, PDO::PARAM_STR);
$select->execute();

$result = $select->fetch();
$quantite=$select->rowCount();

}
	catch (Exception $e) {
            echo $e->getMessage() . " <br><b>Erreur lors de la verification de l'email dans la base de donées</b>\n";
            throw $e;
        	}		

if($quantite==1){
	
//On génére un jeton totalement unique (c'est capital :D)
$token = uniqid(rand(), true);

$id_membre=$result['id_membre'];
      
	try {	  
$update = $this->con->prepare('UPDATE membres SET token = :token WHERE id_membre = :id_membre');

 
$update->bindParam(':token', $token, PDO::PARAM_STR);
$update->bindParam(':id_membre', $id_membre, PDO::PARAM_INT);
$update->execute();	
  	
	}
	catch (Exception $f) {
            echo $f->getMessage() . " <br><b>Erreur lors de la mise a jour du Token</b>\n";
            throw $f;
        	}
	
	
	
  if (!$update) {return FALSE;} 
  else{
  		
	// Envoi d'un email pour verifier la dmeande avec un lien de mise à jour du mot de passe	

	
$mail = new PHPMailer();
// Encodage
$mail->CharSet = 'UTF-8';



$mail_membre=$result['email'];

//=====Corps du message
$body = "<html><head></head>
<body>
Bonjour,<br>
<br>
Vous nous avez informé de la perte de votre mot de passe. Vous pouvez le changer en cliquant sur le lien suivant :<br>
<ul>
<li><a href=\"".URL_SITE."/modules/sessions/update_pwd.php?id_membre=$id_membre&token=$token&email=$mail_membre\">Modifier le mot de passe</a></li>
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
$mail->AddAddress($mail_membre); 


// Sujet du mail
$mail->Subject = "Ville de Pau - En forme à Pau";
// Le message
$mail->MsgHTML($body);


// Envoi de l'email
$mail->Send();

unset($mail);
	
	
	
			
		
  	return TRUE;
  
  }
 
} else{return FALSE;} 
 				
}

 /**************************************************************************
 * Modification du mot de passe
***************************************************************************/
 
 function updatePWD($id_membre,$token,$email,$repassword)
  {
  	
   
	try {

$update = $this->con->prepare('UPDATE membres SET mot_de_passe = :repassword WHERE id_membre = :id_membre AND token= :token AND email= :email');

$update->bindParam(':token', $token, PDO::PARAM_STR);
$update->bindParam(':id_membre', $id_membre, PDO::PARAM_INT);
$update->bindParam(':email', $email, PDO::PARAM_STR);
$update->bindParam(':repassword', $repassword, PDO::PARAM_STR);
$update->execute();	
	
			}
	catch (Exception $e) {
            echo $e->getMessage() . " <br><b>Erreur lors de la modification du mot de passe</b>\n";
            throw $e;
        	}
	
  	
  if (!$update) {return FALSE;} 
  else{return TRUE;}
 				
}
  
  }