<?php 

header ('Content-type: text/html; charset=utf-8');

// revoir la numerotation des erreur s et les texts (openclassroom) http://www.restapitutorial.com/lessons/httpmethods.html

//http://www.tutorialsface.com/2016/02/simple-php-mysql-rest-api-sample-example-tutorial/
//http://sport2.cyberbase.local/api/admin/43?user=r.taldu@agglo-pau.fr&password=4075cc72e829861798e3be24010317e2094d637c

require(__DIR__ .'/../include/config.inc.php');
require(__DIR__ .'/../include/connexion.inc.php');
require(__DIR__ .'/model.inc.php');
require('rest.inc.php');

 // préparation connexion
$connect = new connection();
$apimodels = new apiModels($connect);



class API extends REST {
     /*
     * Public method for access api.
     * This method dynmically call the method based on the query string
     *
     */
    
public function processApi(){
    
global $apimodels;

$requette= explode("/", $_REQUEST['rquest']);
$categorie=$requette[0];
$id=intval($requette[1]); // retourne 0 si ce n'est pas un entier

//suppression de la verification de login qui n'est pas secure et qui fait planter le post
//
//$user=$this->_request['user'];
//$password=$this->_request['password'];

 //On  verfie si le couple login/password est bon
//$verif=$apimodels->verifIdentifiants($user,$password);  

//$verif="ok";

 //if (!$verif){
   
 //$this->response('Erreur de mot de passe',403);
     
// }
 //else{  
      
        if (method_exists($this, $categorie)) {
        $resultat=$this->$categorie($id);
        
        // pas de reponse à la requette
    if ($resultat ==NULL) {
         $this->response('pas de contenu',403);
    // marche pas avec204
    // echo"que dalle";
    }else{
     $resultat=$this->json($resultat);           
  // If success everythig is good send header as "OK" return param
    $this->response($resultat, 200);} 
        
        }
        else{
            $this->response('Error code 404, Page not found',404);   // If the method not exist with in this class, response would be "Page not found".
}

      //  }


        }


private function admin($id){
    
global $apimodels;
  
// si id existe , il est sup à 0 
if($id >0){
       
    switch($this->get_request_method()){
            case "POST":
                $this->response('',406);
            break;
            case "GET":                    
               $afficheAdmin=$apimodels->afficheAdmin($id);    
                foreach($afficheAdmin as $key){
			
		 $id_membre=$key->id_membre;
		 $nom_membre=htmlspecialchars($key->nom_membre);
		 $prenom_membre=htmlspecialchars($key->prenom_membre);
		 $email=htmlspecialchars($key->email);
	
                 
                $data[] = [
                "id"   => $id_membre,
                "nom" => $nom_membre,
                "prenom" => $prenom_membre,
                "email" => $email
                 ];   
 
                 }             
            break;
            case "DELETE":
                 $this->response('',406);
            break;
            case "PUT":
                 $this->response('',406);
            break;
            default:
                 $this->response('',406);
            break; }
              
}else{
    
    switch($this->get_request_method()){
            case "POST":
                $this->response('',406);
            break;
            case "GET":                    
                $afficheAdmins=$apimodels->afficheAdmins();
                foreach($afficheAdmins as $key){
			
		 $id_membre=$key->id_membre;
		 $nom_membre=htmlspecialchars($key->nom_membre);
		 $prenom_membre=htmlspecialchars($key->prenom_membre);
		 $email=htmlspecialchars($key->email);
	
                 
                $data[] = [
                "id"   => $id_membre,
                "nom" => $nom_membre,
                "prenom" => $prenom_membre,
                "email" => $email
                 ];         
                }         
            break;
            case "DELETE":
                 $this->response('',406);
            break;
            case "PUT":
                 $this->response('',406);
            break;
            default:
                 $this->response('',406);
            break; }    
       
     } 
    return $data;
}  
    
private function activite($id){
    
global $apimodels;
  
// si id existe , il est sup à 0 
if($id >0){
       
    switch($this->get_request_method()){
            case "POST":
                $this->response('',406);
            break;
            case "GET":                    
               $afficheActivite=$apimodels->afficheActivite($id);    
                foreach($afficheActivite as $key){
			
		 $id_estival_activite=$key->id_estival_activite;
		 $titre_estival_activite=htmlspecialchars($key->titre_estival_activite);
		 $start_estival_activite=htmlspecialchars($key->start_estival_activite);
		 $lieu_estival_activite=htmlspecialchars($key->lieu_estival_activite);
	
                 
                $data[] = [
                "id_estival_activite"   => $id_estival_activite,
                "titre_estival_activite" => $titre_estival_activite,
                "start_estival_activite" => $start_estival_activite,
                "lieu_estival_activite" => $lieu_estival_activite
                ];   
 
                 }               
            break;
            case "DELETE":
                 $this->response('',406);
            break;
            case "PUT":
                 $this->response('',406);
            break;
            default:
                 $this->response('',406);
            break; }
              
}else{
    
    switch($this->get_request_method()){
            case "POST":
                $this->response('',406);
            break;
            case "GET":                    
                $afficheActivites=$apimodels->afficheActivites();
                foreach($afficheActivites as $key){
			
		 $id_estival_activite=$key->id_estival_activite;
		 $titre_estival_activite=htmlspecialchars($key->titre_estival_activite);
		 $start_estival_activite=htmlspecialchars($key->start_estival_activite);
		 $lieu_estival_activite=htmlspecialchars($key->lieu_estival_activite);
	
                 
                $data[] = [
                "id_estival_activite"   => $id_estival_activite,
                "titre_estival_activite" => $titre_estival_activite,
                "start_estival_activite" => $start_estival_activite,
                "lieu_estival_activite" => $lieu_estival_activite
                ];         
                }         
            break;
            case "DELETE":
                 $this->response('',406);
            break;
            case "PUT":
                 $this->response('',406);
            break;
            default:
                 $this->response('',406);
            break; }    
       
     } 
    return $data;
}  
    
  
private function participant($id){
   
global $apimodels;
  
// si id existe , il est sup à 0 
if($id >0){
       
    switch($this->get_request_method()){
            case "POST":
                $this->response('',406);
            break;
            case "GET":                    
                $afficheParticipant=$apimodels->afficheParticipant($id);    
                foreach($afficheParticipant as $key){
			
		 $id_estival_user=$key->id_estival_user;
		 $nom_estival_user=htmlspecialchars($key->nom_estival_user);
		 $prenom_estival_user=htmlspecialchars($key->prenom_estival_user);
		 $email_estival_user=htmlspecialchars($key->email_estival_user);
                 $tel_estival_user=htmlspecialchars($key->tel_estival_user);
	
                 
                $data[] = [
                "id_estival_user"   => $id_estival_user,
                "nom_estival_user" => $nom_estival_user,
                "prenom_estival_user" => $prenom_estival_user,
                "email_estival_user" => $email_estival_user,
                 "tel_estival_user" => $tel_estival_user
                  ];   
 
                }                
            break;
            case "DELETE":
                 $this->response('',406);
            break;
            case "PUT":
                 $this->response('',406);
            break;
            default:
                 $this->response('',406);
            break; }
              
}else{
    
    switch($this->get_request_method()){
            case "POST":
                $this->response('',406);
            break;
            case "GET":                    
                $afficheParticipants=$apimodels->afficheParticipants();
                foreach($afficheParticipants as $key){
			
		 $id_estival_user=$key->id_estival_user;
		 $nom_estival_user=htmlspecialchars($key->nom_estival_user);
		 $prenom_estival_user=htmlspecialchars($key->prenom_estival_user);
		 $email_estival_user=htmlspecialchars($key->email_estival_user);
                 $tel_estival_user=htmlspecialchars($key->tel_estival_user);
	
                 
                 $data[] = [
                "id_estival_user"   => $id_estival_user,
                "nom_estival_user" => $nom_estival_user,
                "prenom_estival_user" => $prenom_estival_user,
                "email_estival_user" => $email_estival_user,
                 "tel_estival_user" => $tel_estival_user
                 ];         
                 }          
            break;
            case "DELETE":
                 $this->response('',406);
            break;
            case "PUT":
                 $this->response('',406);
            break;
            default:
                 $this->response('',406);
            break; }    
       
     } 
    return $data;
} 




private function type_signalement($id){
    
global $apimodels;
  
// si id existe , il est sup à 0 
if($id >0){
       
    switch($this->get_request_method()){
            case "POST":
                $this->response('',406);
            break;
            case "GET":                    
               $afficheTypeSignalement=$apimodels->afficheTypeSignalement($id);    
                foreach($afficheTypeSignalement as $key){
			
		 $id=$key->id;
		 $nom=htmlspecialchars($key->nom);
		 $photo=htmlspecialchars($key->photo);
	
                 
                $data[] = [
                "id"   => $id,
                "nom" => $nom,
                "photo" => $photo
                 ];   
 
                 }             
            break;
            case "DELETE":
                 $this->response('',406);
            break;
            case "PUT":
                 $this->response('',406);
            break;
            default:
                 $this->response('',406);
            break; }
              
}else{
    
    switch($this->get_request_method()){
            case "POST":
                $this->response('',406);
            break;
            case "GET":                    
                $afficheTypeSignalements=$apimodels->afficheTypeSignalements();
                foreach($afficheTypeSignalements as $key){
			
		 $id=$key->id;
		 $nom=htmlspecialchars($key->nom);
		 $photo=htmlspecialchars($key->photo);
	
                 
                $data[] = [
                "id"   => $id,
                "nom" => $nom,
                "photo" => $photo
                 ];   
                }         
            break;
            case "DELETE":
                 $this->response('',406);
            break;
            case "PUT":
                 $this->response('',406);
            break;
            default:
                 $this->response('',406);
            break; }    
       
     } 
    return $data;
}  




private function signalement($id){
    
global $apimodels;
  
// si id existe , il est sup à 0 
if($id >0){      
   
                 $this->response('',406);
           
              
}else{
    
    switch($this->get_request_method()){
            case "POST":
                    
                
                
$data = json_decode( file_get_contents('php://input') );
$NewSignalement=$apimodels->newSignalement($data);

// faire une repose ok si ok
              
            break;
            case "GET":                    
             $this->response('',406);     
            break;
            case "DELETE":
                 $this->response('',406);
            break;
            case "PUT":
                 $this->response('',406);
            break;
            default:
                 $this->response('',406);
            break; }    
       
     } 
    return $data;
}  



/*
 *  Encode array into JSON
 */
private function json($data){
        if(is_array($data)){
          
           
            return json_encode($data,JSON_PRETTY_PRINT);
        }
    }
    
   
    
    
}


    // Initiiate Library
    $api = new API;
    $api->processApi();
  
    
    
?>

