<?php

/***** Dernière modification : 04/05/2017, Romain TALDU	*****/


$menu=4;
$ss_menu=44;
require(__DIR__ .'/../../../include/config.inc.php');
require(__DIR__ .'/../../../include/connexion.inc.php');
require(__DIR__ .'/model.inc.php');
// verifie que la session est active, sinon reoriente vers la page de login
require(__DIR__ .'/../../../include/verif_session.php');
//verifie que les droits sont valide si la session est active, sinon reoriente vers la page de login
include("../../../include/verif_droits.php");

// préparation connexion
$connect = new connection();
$entreprise = new entreprise($connect);

 $jour_annee=date("z");
 if ($jour_annee <182){$annee_scolaire=date("Y-1");}else{$annee_scolaire=date("Y");}
 
$debut_scolaire=date("Y-m-d H:i:s", mktime(0, 0, 0, 7, 1, $annee_scolaire));
$fin_scolaire=date("Y-m-d H:i:s", mktime(0, 0, 0, 6, 30, $annee_scolaire+1));

?>

<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sport / Santé à Pau</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../../../bootstrap/css/bootstrap.min.css">
     <!-- Font Awesome -->
    <link rel="stylesheet" href="../../../plugins/font-awesome-4.6.3/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../../../plugins/ionicons-2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../../dist/css/AdminLTE.min.css">
   
    <link rel="stylesheet" href="../../../dist/css/skins/skin-blue.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../../../plugins/datatables/dataTables.bootstrap.css">
   
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../../dist/css/skins/_all-skins.min.css">
  
      <!-- fenetres popup-->
  <link rel="stylesheet" href="../../../plugins/sweetalert2/sweetalert2.min.css">

  </head>
 
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
    	
<?php
require(__DIR__ .'/../../../include/main_header.php');
require(__DIR__ .'/../../../include/main_slidebar.php');
?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Recherche participant
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="../index.php"><i class="fa fa-heartbeat"></i> Accueil</a></li>
            <li class="active">Recherche participant</li>
          </ol>
        </section>

      



  	<!-- Main content -->
        <section class="content">
          <div class="row">
            
            <div class="col-md-12">
                
          <div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Liste des inscrits</h3>
    <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->
     
    </div><!-- /.box-tools -->
  </div><!-- /.box-header -->
  <div class="box-body">
   
  <table id="participants" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                      	<th>#</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date de naissance</th>
                        <th>Activité(s)</th>
                      </tr>
                    </thead>
                    <tbody>
                  
<?php 

$data=$entreprise->afficheTousUser($debut_scolaire,$fin_scolaire); 

$compteur = 1;

	 foreach($data as $event){
			
			$id=$event->id_entreprise_user;
			$nom=htmlspecialchars($event->nom_entreprise_user);
		    $prenom=htmlspecialchars($event->prenom_entreprise_user);
			$naissance=$event->age_entreprise_user;
	

echo"

<tr>
            <td style=\"width:5%; text-align: left\">$compteur</td>
            <td style=\"width: 20%; text-align: left\">$nom</td>
            <td style=\"width: 20%; text-align: left\">$prenom</td>
            <td style=\"width: 20%; text-align: left\">$naissance</td>
            <td style=\"width: 35%; text-align: left\">";
            
 
 $data2=$entreprise->afficheactiviteTousUser($id);           
            
   foreach($data2 as $event2){
			

	        $id_activite=$event2->id_entreprise_activite;
			
			$titre_entreprise_activite=htmlspecialchars($event2->titre_entreprise_activite);
			$start_entreprise_activite=$event2->start_entreprise_activite;
		
			
			
			$jour_activite=explode(" ",$start_entreprise_activite);
			$jour_activite=explode("-",$jour_activite[0]);
			$jour_activite=$jour_activite[2]."/".$jour_activite[1];
			
			$heure_debut=explode(" ",$start_entreprise_activite);
			$heure_debut=explode(":",$heure_debut[1]);
			$heure_debut=$heure_debut[0]."h".$heure_debut[1];
		
		  $titre_entreprise_activitejs=addslashes($titre_entreprise_activite);

echo"<a href=\"#\" onclick=\"suppUser($id,$id_activite,new String('$titre_entreprise_activitejs'));\">$titre_entreprise_activite le $jour_activite à $heure_debut  &nbsp;&nbsp;<span class=\"label label-danger\"><i class=\"fa fa-trash-o\"></i>&nbsp;Supp.</span></a><br>";
  
   }
            
        
            
 echo"</td>
           
        </tr>";

	$compteur++;
	
	 }

?>
                  
                    </tbody>
                   
                  </table>



  </div><!-- /.box-body -->
 
</div><!-- /.box -->
          
          
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
   
 <?php require(__DIR__ .'/../../../include/footer_back.php'); ?>
   
   
   
    
    
    <!-- REQUIRED JS SCRIPTS -->
    <!-- jQuery 2.1.4 -->
    <script src="../../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../../../bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../../dist/js/app.min.js"></script>
    <!-- Datatable -->
     <script src="../../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../../plugins/datatables/dataTables.bootstrap.min.js"></script>
 
    <!-- jQuery UI 1.11.4 -->
    <script src="../../../plugins/jquery-ui-1.11.4/jquery-ui.min.js"></script>
  
     <!--Fenetre popup -->
     <script src="../../../plugins/sweetalert2/sweetalert2.min.js"></script>
     <script src="https://cdn.jsdelivr.net/es6-promise/latest/es6-promise.auto.min.js"></script> <!-- IE support -->
    	
    <script>
      $(function () {

        $('#participants').DataTable({
        "stateSave": true,
         "stateDuration": 60 * 3,
          "ordering": false,
           "language": {
            "lengthMenu": "_MENU_  enregistements par page",
            "zeroRecords": "Désolé, aucun résultat trouvé.",
            "info": "Affichage page _PAGE_ sur _PAGES_",
            "infoEmpty": "Aucun enregistrement disponible",
            "infoFiltered": "(filtered from _MAX_ total records)",
             "search": "Recherche",
             "paginate": {
       			 "first":      "First",
       			 "last":       "Last",
        		 "next":       "Suivant",
        		 "previous":   "Précédent"
  				  },
         
        }
       
       
      });
      
      });
      
 function suppUser(id,id_activite,activite) {
  	  
  swal({
  title: 'Etes vous sûr de vouloir supprimer cette activite ?',
  text: ""+activite,
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Oui, on supprime !',
  cancelButtonText: 'Annuler !'
}).then(function () {
 document.location.href="supp_user.php?id_user="+id+"&id_activite="+id_activite+"&origine=recherche"; 
 
 
 })
    
 }          
      
      
    </script>


  </body>
</html>