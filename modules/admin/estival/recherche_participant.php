<?php

/***** Dernière modification : 09/05/2017, Romain TALDU	*****/


$menu=2;
$ss_menu=24;
require(__DIR__ .'/../../../include/config.inc.php');
require(__DIR__ .'/../../../include/connexion.inc.php');
require(__DIR__ .'/model.inc.php');

// verifie que la session est active, sinon reoriente vers la page de login
require(__DIR__ .'/../../../include/verif_session.php');
//verifie que les droits sont valide si la session est active, sinon reoriente vers la page de login
include("../../../include/verif_droits.php");

// préparation connexion
$connect = new connection();
$estival = new estival($connect);

$date_jour= date('Y-m-d H:i:s');
$annee = date('Y');

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
                        <th>Nom / Prénom</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>Date de naissance</th>
                        <th>Activité(s)</th>
                      </tr>
                    </thead>
                    <tbody>
                  
<?php 

$data=$estival->afficheTousUser($annee); 

$compteur = 1;

foreach($data as $event){
			
			$id=$event->id_estival_user;
			$nom=htmlspecialchars($event->nom_estival_user);
                        $prenom=htmlspecialchars($event->prenom_estival_user);
                        $email=htmlspecialchars($event->email_estival_user);
                        $telephone=htmlspecialchars($event->tel_estival_user);
			$naissance=$event->age_estival_user;
			
	

echo"




<tr>
            <td style=\"width:5%; text-align: left\">$compteur</td>
            <td style=\"width: 24%; text-align: left\">$nom $prenom</td>
            <td style=\"width: 12%; text-align: left\">$telephone</td>
            <td style=\"width: 12%; text-align: left\">$email</td>
            <td style=\"width: 12%; text-align: left\">$naissance</td>
            <td style=\"width: 35%; text-align: left\">";
			
			
$data2=$estival->afficheactiviteTousUser($id);   			


  foreach($data2 as $event2){
			

	        $id_activite=$event2->id_estival_activite;
			
			$titre_estival_activite=htmlspecialchars($event2->titre_estival_activite);
			$start_estival_activite=$event2->start_estival_activite;
			
			$jour_activite=explode(" ",$start_estival_activite);
			$jour_activite=explode("-",$jour_activite[0]);
			$jour_activite=$jour_activite[2]."/".$jour_activite[1];
			
			$heure_debut=explode(" ",$start_estival_activite);
			$heure_debut=explode(":",$heure_debut[1]);
			$heure_debut=$heure_debut[0]."h".$heure_debut[1];
			
			$titre_estival_activitejs=addslashes($titre_estival_activite);
			
			$presence=$event2->presence_reunion;
			if($presence == 1){$presence ="Présent(e)";}else{$presence ="Absent(e) ou non renseigné";}
			
 if($start_estival_activite>$date_jour){ 
echo"<a href=\"#\" onclick=\"suppUser($id,$id_activite,new String('$titre_estival_activitejs'));\">$titre_estival_activite le $jour_activite à $heure_debut  &nbsp;&nbsp;<span class=\"label label-danger\"><i class=\"fa fa-trash-o\"></i>&nbsp;Supp.</span></a><br>";
 } else{echo"$titre_estival_activite le $jour_activite à $heure_debut  &nbsp;&nbsp;[$presence]<br>";}
  
  
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