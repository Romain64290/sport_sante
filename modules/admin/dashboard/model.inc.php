<?php

/***** Dernière modification : 27/10/2016, Romain TALDU	*****/

 class dashboard {

    private $con;

    public function __construct(connection $con) {
        $this->con = $con->con;
    }

/***********************************************************************
 * Fonction calcul du nombre d'activite
 **************************************************************************/
  
 function afficheNbreActivites($annee)
  {
   
 $annee="%".$annee."%";  
   
	try{
$select = $this->con->prepare('SELECT COUNT(*) as nbr 
FROM estival_activite
WHERE start_estival_activite LIKE :date');

$select->bindParam(':date', $annee, PDO::PARAM_STR);	

$select->execute();
	}
	 catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors du calcul du nombre d'activite </b>\n";
	throw $e;
        exit;
    }

$result = $select->fetch();

$quantite=$result['nbr'];
		
	      echo $quantite;
      
   
}

/***********************************************************************
 * Fonction calcul du nombre de particpants
 **************************************************************************/
  
 function afficheNbreParticipants($annee)
  {

 $annee="%".$annee."%";

	try{
$select = $this->con->prepare('SELECT COUNT(*) as nbr 
FROM estival_user
WHERE date_inscription LIKE :date');

$select->bindParam(':date', $annee, PDO::PARAM_STR);

$select->execute();
	}
	 catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors du calcul du nombre de particpants </b>\n";
	throw $e;
        exit;
    }

$result = $select->fetch();

$quantite=$result['nbr'];
		
	      echo $quantite;
      
   
}




/***********************************************************************
 * Fonction calcul du nombre de particpations
 **************************************************************************/
  
 function afficheNbreParticipations($annee)
  {
   
  $annee="%".$annee."%";
    
	try{
$select = $this->con->prepare('SELECT COUNT(*) as nbr 
FROM estival_user_has_activite
INNER JOIN estival_user ON estival_user.id_estival_user=estival_user_has_activite.id_estival_user
WHERE date_inscription LIKE :date');

$select->bindParam(':date', $annee, PDO::PARAM_STR);	

$select->execute();
	}
	 catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors du calcul du nombre de particpations </b>\n";
	throw $e;
        exit;
    }

$result = $select->fetch();

$quantite=$result['nbr'];
		
	      echo $quantite;
      
   
}
  
  /***********************************************************************
 * Fonction calcul moyenne d'age
 **************************************************************************/
  
 function afficheMoyenneAge($annee)
  {
   
 $annee="%".$annee."%";
 
// nombre de participants
try{	
$select = $this->con->prepare('SELECT COUNT(*) as nbr 
FROM estival_user
WHERE date_inscription LIKE :date');

$select->bindParam(':date', $annee, PDO::PARAM_STR);	

$select->execute();
	}
	 catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors du calcul moyenne d'age </b>\n";
	throw $e;
        exit;
    }
$result = $select->fetch();

// additionne l'age total
try{
$select2 = $this->con->prepare('SELECT age_estival_user '
        . 'FROM estival_user '
        . 'WHERE date_inscription LIKE :date');

$select2->bindParam(':date', $annee, PDO::PARAM_STR);	

$select2->execute();
	}
	 catch (PDOException $f){
       echo $f->getMessage() . " <br><b>Erreur lors du calcul  moyenne d'age </b>\n";
	throw $f;
        exit;
    }

$total_age=0;

$data = $select2->fetchAll(PDO::FETCH_OBJ);	


foreach($data as $key){
			
			
$naissance=$key->age_estival_user;
		
			
//Calcul de l'age
$arr1 = explode('/', $naissance);
$arr2 = explode('/', date('d/m/Y'));
if(($arr1[1] < $arr2[1]) || (($arr1[1] == $arr2[1]) && ($arr1[0] <= $arr2[0])))
{$age=$arr2[2] - $arr1[2];} else{$age=$arr2[2] - $arr1[2] - 1;}

$total_age=$total_age+$age;
	 }


$total_user=$result['nbr'];


if($total_user!=0){$quantite=round($total_age/$total_user);}else{$quantite=0;}
		
 echo $quantite;
      
   
}  
  
  
  
 /***********************************************************************
 * Fonction calcul pourcentage de femmes
 **************************************************************************/
  
 function afficheRatioFemmes($annee)
  {
   
 $annee="%".$annee."%";
 
// nombre de participants	
try{
$select = $this->con->prepare('SELECT COUNT(*) as nbr 
FROM estival_user
WHERE date_inscription LIKE :date');

$select->bindParam(':date', $annee, PDO::PARAM_STR);	

$select->execute();
	}
	 catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors du calcul pourcentage de femmes</b>\n";
	throw $e;
        exit;
    }
$result = $select->fetch();

// nombre de femmes
try{
$select2 = $this->con->prepare('SELECT COUNT(*) as nbr FROM estival_user WHERE civilite_estival_user=2 AND date_inscription LIKE :date');

$select2->bindParam(':date', $annee, PDO::PARAM_STR);

$select2->execute();
	}
	 catch (PDOException $f){
       echo $f->getMessage() . " <br><b>Erreur lors du calcul pourcentage de femmes</b>\n";
	throw $f;
        exit;
    }

$result2 = $select2->fetch();

$total_user=$result['nbr'];
$total_femme=$result2['nbr'];

if($total_user!=0){$quantite=round($total_femme/$total_user*100);}else{$quantite=0;}
		
	      echo $quantite;
      
   
} 
  
  
  /***********************************************************************
 * Fonction calcul du nombre d'activite
 **************************************************************************/
  
 function afficheNbreActivitesEntreprise($annee)
  {
 
  $annee="%".$annee."%";
     
	try{
$select = $this->con->prepare('SELECT COUNT(*) as nbr FROM entreprise_activite');
$select->execute();
	}
	 catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors du calcul du nombre d'activite</b>\n";
	throw $e;
        exit;
    }

$result = $select->fetch();

$quantite=$result['nbr'];
		
	      echo $quantite;
      
   
}

/***********************************************************************
 * Fonction calcul du nombre de particpants - entreprsie
 **************************************************************************/
  
 function afficheNbreParticipantsEntreprise($annee)
  {


    
	try{
$select = $this->con->prepare('SELECT COUNT(*) as nbr FROM entreprise_user');
$select->execute();
	}
	 catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors du calcul du nombre de particpants - entreprsie</b>\n";
	throw $e;
        exit;
    }

$result = $select->fetch();

$quantite=$result['nbr'];
		
	      echo $quantite;
      
   
}




/***********************************************************************
 * Fonction calcul du nombre de particpations - entreprise
 **************************************************************************/
  
 function afficheNbreParticipationsEntreprise($annee)
  {
 

    
	try{
$select = $this->con->prepare('SELECT COUNT(*) as nbr FROM entreprise_user_has_activite');
$select->execute();
	}
	 catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors du calcul du nombre de particpations - entreprise</b>\n";
	throw $e;
        exit;
    }
	 
$result = $select->fetch();

$quantite=$result['nbr'];
		
	      echo $quantite;
      
   
}
  
  /***********************************************************************
 * Fonction calcul moyenne d'age - entreprise
 **************************************************************************/
  
 function afficheMoyenneAgeEntreprise($annee)
  {
    

// nombre de participants
	try{	
$select = $this->con->prepare('SELECT COUNT(*) as nbr FROM entreprise_user');
$select->execute();
	}
	 catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors du calcul moyenne d'age - entreprise</b>\n";
	throw $e;
        exit;
    }
	 
$result = $select->fetch();

// additionne l'age total
	try{
$select2 = $this->con->prepare('SELECT age_entreprise_user FROM entreprise_user');
$select2->execute();
	}
	 catch (PDOException $f){
       echo $f->getMessage() . " <br><b>Erreur lors du calcul moyenne d'age - entreprise</b>\n";
	throw $f;
        exit;
    }

$total_age=0;

$data = $select2->fetchAll(PDO::FETCH_OBJ);	


foreach($data as $key){
			
			
$naissance=$key->age_entreprise_user;
		
			
//Calcul de l'age
$arr1 = explode('/', $naissance);
$arr2 = explode('/', date('d/m/Y'));
if(($arr1[1] < $arr2[1]) || (($arr1[1] == $arr2[1]) && ($arr1[0] <= $arr2[0])))
{$age=$arr2[2] - $arr1[2];} else{$age=$arr2[2] - $arr1[2] - 1;}

$total_age=$total_age+$age;
	 }


$total_user=$result['nbr'];


if($total_user!=0){$quantite=round($total_age/$total_user);}else{$quantite=0;}
		
 echo $quantite;
      
   
}  
  
  
  
 /***********************************************************************
 * Fonction calcul pourcentage de femmes - entreprise
 **************************************************************************/
  
 function afficheRatioFemmesEntreprise($annee)
  {
    

// nombre de participants
	try{	
$select = $this->con->prepare('SELECT COUNT(*) as nbr FROM entreprise_user');
$select->execute();
		}
	 catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors du calcul calcul pourcentage de femmes - entreprise</b>\n";
	throw $e;
        exit;
    }

$result = $select->fetch();

// nombre de femmes
	try{
$select2 = $this->con->prepare('SELECT COUNT(*) as nbr FROM entreprise_user WHERE civilite_entreprise_user=2');
$select2->execute();
		}
	 catch (PDOException $f){
       echo $f->getMessage() . " <br><b>Erreur lors du calcul pourcentage de femmes - entreprise</b>\n";
	throw $f;
        exit;
    }
	 
$result2 = $select2->fetch();

$total_user=$result['nbr'];
$total_femme=$result2['nbr'];


if($total_femme!=0){$quantite=round($total_femme/$total_user*100);}else{$quantite=0;}
		
	      echo $quantite;
      
   
} 
  
  
 /***********************************************************************
 * Fonction repartition par age
 **************************************************************************/
  
//  resultat attendu ex : 5, 10, 15,20,30,20

 function afficheRepartitionAge($annee)
  {
   
 $annee="%".$annee."%";
  
$moinsde20=0;
$vingtaine=0;
$trentaine=0;
$quarantaine=0;
$cinquantaine=0;
$plusde60=0;

// recupere l'age de tous les participants
	try{
$select2 = $this->con->prepare('SELECT age_estival_user 
FROM estival_user
WHERE date_inscription LIKE :date');

$select2->bindParam(':date', $annee, PDO::PARAM_STR);

$select2->execute();
		}
	 catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors du calcul de la Fonction repartition par age</b>\n";
	throw $e;
        exit;
    }

$data = $select2->fetchAll(PDO::FETCH_OBJ);	

foreach($data as $key){
			
$naissance=$key->age_estival_user;
		
			
//Calcul de l'age
$arr1 = explode('/', $naissance);
$arr2 = explode('/', date('d/m/Y'));
if(($arr1[1] < $arr2[1]) || (($arr1[1] == $arr2[1]) && ($arr1[0] <= $arr2[0])))
{$age=$arr2[2] - $arr1[2];} else{$age=$arr2[2] - $arr1[2] - 1;}


//swith case qui incremente les variables de repartition d'age
switch ($age) 
{ 
    case $age < 20 : 
    ++$moinsde20;
    break;
	case $age >= 20 and $age<30: 
    ++$vingtaine;
    break;
	case $age >= 30 and $age<40: 
    ++$trentaine;
    break;
	case $age >= 40 and $age<50: 
    ++$quarantaine;
    break;
	case $age >= 50 and $age<60: 
    ++$cinquantaine;
    break;
	case $age >= 60 : 
    ++$plusde60;
    break;
	
}	

	
	 }





$repartition="$moinsde20, $vingtaine, $trentaine, $quarantaine, $cinquantaine, $plusde60";
		
 echo $repartition;
      
   
}  

/***********************************************************************
 * Affiche le lieu de travail
 **************************************************************************/
  
//  resultat attendu ex : 5, 10, 15,20,30,20

 function afficheLieuTravail($annee)
  {
   

$hotel_france=0;
$hotel_ville=0;
$allees=0;
$ctm=0;
$ccas=0;
$autre=0;

// recupere du lieu de travail de tous les participants
	try{
$select2 = $this->con->prepare('SELECT lieu_travail FROM entreprise_user');
$select2->execute();
		}
	 catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors l'affichage du lieu de travail</b>\n";
	throw $e;
        exit;
    }


$data = $select2->fetchAll(PDO::FETCH_OBJ);	

foreach($data as $key){
			
$lieu=$key->lieu_travail;
		
		
//swith case qui incremente les variables de repartition d'age
switch ($lieu) 
{ 
    case $lieu == 1 : 
    ++$hotel_france;
    break;
	 case $lieu == 2 : 
    ++$hotel_ville;
    break;
	 case $lieu == 3 :  
    ++$allees;
    break;
	 case $lieu == 4 : 
    ++$ctm;
    break;
	 case $lieu == 5 : 
    ++$ccas;
    break;
	 case $lieu == 6 : 
    ++$autre;
    break;
	
}	

	
	 }





$repartition="$hotel_france, $hotel_ville, $allees, $ctm, $ccas, $autre";
		
 echo $repartition;
      
   
}  

/***********************************************************************
 * Fonction repartition par ville
 **************************************************************************/
//  resultat attendu ex : 50, 70, 15
//recuprer le total, pau et autre , en deduire qte agglo

 function afficheRepartitionVille($annee)
  {
    
  $annee="%".$annee."%";

// nombre de participants, donc le total communes
	try{	
$select = $this->con->prepare('SELECT COUNT(*) as nbr 
FROM estival_user
WHERE date_inscription LIKE :date');

$select->bindParam(':date', $annee, PDO::PARAM_STR);

$select->execute();
		}
	 catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors du calcul nombre de participants, donc le total communes</b>\n";
	throw $e;
        exit;
    }
	 
$result = $select->fetch();
$total_communes=$result['nbr'];

// nombre de participants venant de pau	
	try{
$select2 = $this->con->prepare('SELECT COUNT(*) as nbr FROM estival_user WHERE residence_estival_user LIKE "pau" AND date_inscription LIKE :date');
$select2->bindParam(':date', $annee, PDO::PARAM_STR);
$select2->execute();
		}
	 catch (PDOException $f){
       echo $f->getMessage() . " <br><b>Erreur lors du calcul nombre de participants venant de pau	</b>\n";
	throw $f;
        exit;
    }

$result2 = $select2->fetch();
$total_pau=$result2['nbr'];

// nombre de participants venant de l'extérieur de l'agglo
	try{
$select3 = $this->con->prepare('SELECT COUNT(*) as nbr FROM estival_user WHERE residence_estival_user LIKE "autre" AND date_inscription LIKE :date');
$select3->bindParam(':date', $annee, PDO::PARAM_STR);
$select3->execute();
		}
	 catch (PDOException $g){
       echo $g->getMessage() . " <br><b>Erreur lors du calcul nombre de participants venant de l'extérieur de l'agglo</b>\n";
	throw $g;
        exit;
    }

$result3 = $select3->fetch();
$total_autre=$result3['nbr'];

$total_agglo=$total_communes-$total_pau-$total_autre;

$repartition="$total_pau, $total_agglo, $total_autre";
      
echo $repartition;   
}    
  
  
 /***********************************************************************
 * Fonction repartition par Direction
 **************************************************************************/
//  resultat attendu ex : 50, 70, 15


 function afficheRepartitionDirection($annee)
  {
   


// nombre de participants venant de la direction générale	
	try{
$select = $this->con->prepare('
SELECT COUNT(*) as nbr FROM entreprise_user
INNER JOIN entreprise_direction ON entreprise_direction.id_direction=entreprise_user.direction
WHERE groupe =2');
$select->execute();
		}
	 catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors du calcul nombre de participants venant de la direction générale</b>\n";
	throw $e;
        exit;
    }


$result = $select->fetch();
$dgs=$result['nbr'];

// nombre de participants venant de la qualite urbaine
	try{
$select = $this->con->prepare('
SELECT COUNT(*) as nbr FROM entreprise_user
INNER JOIN entreprise_direction ON entreprise_direction.id_direction=entreprise_user.direction
WHERE groupe =3');
$select->execute();
		}
	 catch (PDOException $f){
       echo $f->getMessage() . " <br><b>Erreur lors du calcul nombre de participants venant de la qualite urbaine</b>\n";
	throw $f;
        exit;
    }

$result = $select->fetch();
$qualite_urbaine=$result['nbr'];

// nombre de participants venant du developpement social
	try{	
$select = $this->con->prepare('
SELECT COUNT(*) as nbr FROM entreprise_user
INNER JOIN entreprise_direction ON entreprise_direction.id_direction=entreprise_user.direction
WHERE groupe =4');
$select->execute();
		}
	 catch (PDOException $g){
       echo $g->getMessage() . " <br><b>Erreur lors du calcul nombre de participants venant du developpement social</b>\n";
	throw $g;
        exit;
    }


$result = $select->fetch();
$developpement_social=$result['nbr'];

// nombre de participants venant de la direction transverse	
	try{
$select = $this->con->prepare('
SELECT COUNT(*) as nbr FROM entreprise_user
INNER JOIN entreprise_direction ON entreprise_direction.id_direction=entreprise_user.direction
WHERE groupe =1');
$select->execute();
		}
	 catch (PDOException $h){
       echo $h->getMessage() . " <br><b>Erreur lors du calcul nombre de participants venant de la direction transverse</b>\n";
	throw $h;
        exit;
    }

$result = $select->fetch();
$transverse=$result['nbr'];




$repartition="$dgs,$qualite_urbaine,$developpement_social,$transverse";
      
echo $repartition;   
}    
   
  
 
  /***********************************************************************
 * Affiche de détail par ville 
 **************************************************************************/
/* resultat attendu :  
 * 
		<li>Artigueloutan : 12</li>
      	<li>Billère : 23</li>
      	<li>Bizanos : 14</li>
      	<li>Gan : 7</li>
      	<li>Gelos : 2</li>
      	<li>Idron : 18</li>
      	<li>Jurançon : 21</li>
      	<li>Léé : 1</li>
      	<li>Lescar : 33</li>
      	<li>Lons : 28</li>
      	<li>Mazères-Lezons :7</li>
      	<li>Ousse : 4</li>
      	<li>Pau : 222</li>
      	<li>Sendets : 6</li>
      	<li>_Autre : 5</li>
*/
 function afficheDetailville($annee)
  {
    
  $annee="%".$annee."%";

$artigueloutan=0;
$billere=0;
$bizanos=0;
$gan=0;
$gelos=0;
$idron=0;
$jurancon=0;
$lee=0;
$lescar=0;
$lons=0;
$mazeres_lezons=0;
$ousse=0;
$pau=0;
$sendets=0;
$autre=0;


// recupere les communes de tous les participants
	try{
$select = $this->con->prepare('SELECT residence_estival_user 
FROM estival_user
WHERE date_inscription LIKE :date');

$select->bindParam(':date', $annee, PDO::PARAM_STR);

$select->execute();
		}
	 catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors de la recuperation de tous les participants des communes</b>\n";
	throw $e;
        exit;
    }

$data = $select->fetchAll(PDO::FETCH_OBJ);	

foreach($data as $key){
			
$commune=$key->residence_estival_user;
		
		

//swith case qui incremente les variables de communes
switch ($commune) 
{ 
    case $commune =="artigueloutan" : 
    ++$artigueloutan;
    break;
	case $commune =="billere" : 
    ++$billere;
    break;
	case $commune =="bizanos" : 
    ++$bizanos;
    break;
	case $commune =="gan" : 
    ++$gan;
    break;
	case $commune =="gelos" : 
    ++$gelos;
    break;
	case $commune =="idron" : 
    ++$idron;
    break;
	case $commune =="jurancon" : 
    ++$jurancon;
    break;
	case $commune =="lee" : 
    ++$lee;
    break;
	case $commune =="lescar" : 
    ++$lescar;
    break;
	case $commune =="lons" : 
    ++$lons;
    break;
	case $commune =="mazeres_lezons" : 
    ++$mazeres_lezons;
    break;
	case $commune =="ousse" : 
    ++$ousse;
    break;
	case $commune =="pau" : 
    ++$pau;
    break;
	case $commune =="sendets" : 
    ++$sendets;
    break;
	case $commune =="autre" : 
    ++$autre;
    break;
	
	
}	

	
	 }


$detail_communes="<li>Artigueloutan : $artigueloutan</li>
      	<li>Billère : $billere</li>
      	<li>Bizanos : $bizanos</li>
      	<li>Gan : $gan</li>
      	<li>Gelos : $gelos</li>
      	<li>Idron : $idron</li>
      	<li>Jurançon : $jurancon</li>
      	<li>Léé : $lee</li>
      	<li>Lescar : $lescar</li>
      	<li>Lons : $lons</li>
      	<li>Mazères-Lezons :$mazeres_lezons</li>
      	<li>Ousse : $ousse</li>
      	<li>Pau : $pau</li>
      	<li>Sendets : $sendets</li>
      	<li>_Autre : $autre</li>";
		
 echo $detail_communes;
      
   
} 

 /***********************************************************************
 * Affiche de détail par direction
 **************************************************************************/

 
 function afficheDetailDirection($annee)
  {
    

$res1=0;$res2=0;$res3=0;$res4=0;$res5=0;$res6=0;$res7=0;$res8=0;$res9=0;$res10=0;
$res11=0;$res12=0;$res13=0;$res14=0;$res15=0;$res16=0;$res17=0;$res18=0;$res19=0;$res20=0;
$res21=0;$res22=0;$res23=0;$res24=0;$res25=0;$res26=0;$res27=0;



// recupere les directions de tous les participants
	try{
$select = $this->con->prepare('SELECT direction FROM entreprise_user');
$select->execute();
		}
	 catch (PDOException $e){
       echo $e->getMessage() . " <br><b>Erreur lors de la recuperation de tous les participants des directions </b>\n";
	throw $e;
        exit;
    }

$data = $select->fetchAll(PDO::FETCH_OBJ);	

foreach($data as $key){
			
$direction=$key->direction;
		
		

//swith case qui incremente les variables de directions
switch ($direction) 
{ 
    case $direction == 1 : ++$res1; break;
    case $direction == 2 : ++$res2; break;
    case $direction == 3 : ++$res3; break;
    case $direction == 4 : ++$res4; break;
	case $direction == 5 : ++$res5; break;
	case $direction == 6 : ++$res6; break;
	case $direction == 7 : ++$res7; break;
	case $direction == 8 : ++$res8; break;
	case $direction == 9 : ++$res9; break;
	case $direction == 10 : ++$res10; break;
	case $direction == 11 : ++$res11; break;
	case $direction == 12 : ++$res12; break;
	case $direction == 13 : ++$res13; break;
	case $direction == 14 : ++$res14; break;
	case $direction == 15 : ++$res15; break;
	case $direction == 16 : ++$res16; break;
	case $direction == 17 : ++$res17; break;
	case $direction == 18 : ++$res18; break;
	case $direction == 19 : ++$res19; break;
	case $direction == 20 : ++$res20; break;
	case $direction == 21 : ++$res21; break;
	case $direction == 22 : ++$res22; break;
	case $direction == 23 : ++$res23; break;
	case $direction == 24 : ++$res24; break;
	case $direction == 25 : ++$res25; break;
	case $direction == 26 : ++$res26; break;
	case $direction == 27 : ++$res27; break;
	
	
}	

	
	 }


$detail_direction=" <ul>
      	<li>Communication et animation événementielle  : $res1</li>
      	<li>Cabinet : $res2</li>
      </ul>	
      	
    Direction générale des services  	
      <ul>
      	<li>Modernisation – Territoire – Pilotage – Ressources : $res3</li>
      	<li>Délégation aux grands projets : $res4</li>
      	<li>Délégation à la qualité, la prospective et l'innovation : $res5</li>
      	<li>Mission Commerce : $res6</li>
      	<li>Mission Eaux vives 2017 : $res7</li>
      	<li>Mission Ville-jardin : $res8</li>
      	<li>Finances : $res9</li>
      	<li>Mobilités : $res10</li>
      	<li>Tourisme : $res11</li>
      	<li>Juridique – Foncier – Logistique – Achats : $res12</li>
      	<li>Ressources humaines – Qualité des services : $res13</li>
      	<li>Urbanisme – Aménagement – Construction durables : $res14</li>
      </ul>
      
      Département Qualité urbaine  	
      <ul>
      	<li>Cycle de l'eau  : $res15</li>
      	<li>Développement durable et déchets : $res16</li>
      	<li>Espaces publics et voirie : $res17</li>
      	<li>Habitat et rénovation urbaine : $res18</li>
      	<li>Nature et patrimoine végétal : $res19</li>
      	<li>Prévention et sécurité routière : $res20</li>
      </ul>
      
       Département Développement social   	
      <ul>
      	<li>Accueils, modernisation et citoyenneté  : $res21</li>
      	<li>Cohésion sociale : $res22</li>
      	<li>Culture : $res23</li>
      	<li>Vie scolaire : $res24</li>
      	<li>Restauration publique : $res25</li>
      	<li>Sports : $res26</li>
      	<li>Vie des quartiers, emploi et valorisation des compétences : $res27</li>
      </ul>";
		
 echo $detail_direction;
      
   
} 

}