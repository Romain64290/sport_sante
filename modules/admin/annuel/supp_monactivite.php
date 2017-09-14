
<?php

/***** Dernière modification : 17/06/2016, Romain TALDU	*****/

require(__DIR__ .'/../../../include/verif_session.php');
//include("../../../include/verif_droits.php");
require(__DIR__ .'/../../../include/config.inc.php');
require(__DIR__ .'/../../../include/connexion.inc.php');
require(__DIR__ .'/model.inc.php');

$id_activite=$_GET['id_activite'];

if($_SESSION['id_typemembre']==1){$membre=$_SESSION["id_membre"];}
if($_SESSION['id_typemembre']==3 OR $_SESSION['id_typemembre']==4){$membre=$_GET["id_user"];}


// préparation connexion
$connect = new connection();
$annuel = new annuel($connect);



$resultat=$annuel->suppMonActivite($id_activite,$membre);

header('Location: mes_activites.php?success=ok&id_user='.$membre);