<?php

/***** Dernière modification : 27/10/2016, Romain TALDU	*****/

class includes {

    private $con;

    public function __construct(connection $con) {
        $this->con = $con->con;
    }



 /***********************************************************************
 * Verification des zones autorisées
 **************************************************************************/
  
 function verif_zone2($zone,$id_membre,$id_typemembre)
  {
   
	
if($id_typemembre==4){return TRUE;}

else{	
	
try { 
$select = $this->con->prepare('SELECT COUNT(*) as nbr FROM membres_has_zone
                        WHERE id_membre= :id_membre AND id_zone= :zone');
						
$select->bindParam(':id_membre', $id_membre, PDO::PARAM_INT);
$select->bindParam(':zone', $zone, PDO::PARAM_INT);
$select->execute();		

}
	catch (Exception $e) {
            echo $e->getMessage() . " <br><b>Erreur lors de la verification des zones autorisées/b>\n";
            throw $e;
        	}

$result = $select->fetch();
$quantite=$result['nbr'];
		
if ($quantite==0){return FALSE;}else{return TRUE;}
      
   
}
  
  }
  
 /***********************************************************************
 * Compte le nbre dde d'Admin en attente
 **************************************************************************/
  
 function adminAttente()
  {
   
	
	try { 
$select = $this->con->prepare('SELECT COUNT(*) as nbr FROM membres
                        WHERE validation_inscription= :etat');

$select->bindValue(':etat', 0, PDO::PARAM_INT);
$select->execute();	
	}
	catch (Exception $e) {
            echo $e->getMessage() . " <br><b>Erreur lors du calcul du nombre d'admin en attente/b>\n";
            throw $e;
        	}



$result = $select->fetch();
$quantite=$result['nbr'];
		
		
if ($quantite!=0){$resultat="<small class=\"label pull-right bg-yellow\">$quantite</small>";}else{$resultat="";}

return  $resultat;
      
   
}
  
  
  
  }
 