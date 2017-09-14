<?php

/***** Dernière modification : 02/11/2016, Romain TALDU	*****/

require(__DIR__ .'/../../../include/verif_session.php');
$menu=6;
$ss_menu=62;

if($_SESSION['id_typemembre']!=1){$menu=3;}
	
//include("../../../include/verif_droits.php");
require(__DIR__ .'/../../../include/config.inc.php');
require(__DIR__ .'/../../../include/connexion.inc.php');
require(__DIR__ .'/model.inc.php');

// préparation connexion
$connect = new connection();
$annuel = new annuel($connect);

$success = empty($_GET['success']) ? "" : $_GET['success'];
$id_user = empty($_GET['id_user']) ? "" : $_GET['id_user'];



if($_SESSION['id_typemembre']==1){$membre=$_SESSION["id_membre"];}
if($_SESSION['id_typemembre']==3 OR $_SESSION['id_typemembre']==4){$membre=$id_user;}

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
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="../../../plugins/timepicker/bootstrap-timepicker.min.css">
        <!-- iCheck -->
    <link rel="stylesheet" href="../../../plugins/iCheck/square/blue.css">

 
 <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../../dist/css/skins/_all-skins.min.css">
    
   <!-- Jquerry ui pour date picker-->
  <link rel="stylesheet" href="../../../plugins/jquery-ui-1.11.4/themes/smoothness/jquery-ui.css">
  <script src="../../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <script src="../../../plugins/jquery-ui-1.11.4/jquery-ui.js"></script>
  
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
            Mes activités
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="../index.php"><i class="fa fa-heartbeat"></i> Accueil</a></li>
            <li class="active">Mes activités</li>
          </ol>
        </section>

      



  	<!-- Main content -->
        <section class="content">
          <div class="row">
            
            <div class="col-md-9">
              <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Mes inscriptions en cours : </h3>
              <div class="box-tools pull-right">
                   <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
  <div class="box-body">
  	        
  <table id="encours" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                      	<th style="width: 5%; text-align: left">#</th>
                        <th style="width: 95%; text-align: left">Activité(s)</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                  
<?php 


$data=$annuel->afficheActiviteEncoursMembreAnnuel($membre); 


$compteur = 1;

	 foreach($data as $event){
			
			$id_activite=$event->id_annuel_activite;
			
			$titre_annuel_activite=htmlspecialchars($event->titre_annuel_activite);
			$start_annuel_activite=$event->start_annuel_activite;
		
			$jour_activite=explode(" ",$start_annuel_activite);
			$jour_activite=explode("-",$jour_activite[0]);
			$jour_activite=$jour_activite[2]."/".$jour_activite[1]."/".$jour_activite[0];
			
			$heure_debut=explode(" ",$start_annuel_activite);
			$heure_debut=explode(":",$heure_debut[1]);
			$heure_debut=$heure_debut[0]."h".$heure_debut[1];

			$monactivite="$titre_annuel_activite le $jour_activite à $heure_debut";
			$monactivitejs=addslashes($monactivite);
                        
                         $description_annuel_activite=htmlspecialchars($event->description_annuel_activite);
			$description_annuel_activite = str_replace(array("\r\n", "\r", "\n"), "<br>", $description_annuel_activite); 
                        $description_annuel_activitejs=addslashes($description_annuel_activite);
			
			$lieu_annuel_activite=htmlspecialchars($event->lieu_annuel_activite);
                        $lieu_annuel_activitejs=addslashes($lieu_annuel_activite);
                        
			$lieu_repli_annuel_activite=htmlspecialchars($event->lieu_repli_annuel_activite);
                        $lieu_repli_annuel_activitejs=addslashes($lieu_repli_annuel_activite);
 
echo"
<tr>
            <td style=\"width: 5%; text-align: left\">$compteur</td>
            <td style=\"width: 95%; text-align: left\"><a href=\"#\" onclick=\"detailActivite(new String('$monactivitejs'),new String('$description_annuel_activitejs'),new String('$lieu_annuel_activitejs'),new String('$lieu_repli_annuel_activitejs'));\">$monactivite </a> &nbsp;&nbsp;"
        . "<a href=\"#\" onclick=\"suppActivite($id_activite,new String('$monactivitejs'),$membre);\"><span class=\"label label-danger\"><i class=\"fa fa-trash-o\"></i>&nbsp;Supp.</span></a></td> </tr>";
			
			$compteur++;	
    }
    
    
	
		

?>
                  
                    </tbody>
                   
                  </table>
            </div></div>


            </div><!-- /.col -->
          </div><!-- /.row -->
          
          
          <div class="row">
            
            <div class="col-md-9">
              <div class="box box-primary collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">Mon historique : </h3>
                 <div class="box-tools pull-right">
                   <!-- <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
                     <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                 
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           <div class="box-body">
  	        
  <table id="historique" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                      	<th style="width: 5%; text-align: left">#</th>
                        <th style="width: 95%; text-align: left">Activité(s)</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                  
<?php 

$data=$annuel->afficheActiviteHistoMembreAnnuel($membre); 


$compteur = 1;

	 foreach($data as $event){
			
			$id_activite=$event->id_annuel_activite;
			
			$titre_annuel_activite=htmlspecialchars($event->titre_annuel_activite);
			$start_annuel_activite=$event->start_annuel_activite;
		
			$jour_activite=explode(" ",$start_annuel_activite);
			$jour_activite=explode("-",$jour_activite[0]);
			$jour_activite=$jour_activite[2]."/".$jour_activite[1]."/".$jour_activite[0];
			
			$heure_debut=explode(" ",$start_annuel_activite);
			$heure_debut=explode(":",$heure_debut[1]);
			$heure_debut=$heure_debut[0]."h".$heure_debut[1];
                        
                       
	

echo"
<tr>
            <td style=\"width: 5%; text-align: left\">$compteur</td>
            <td style=\"width: 95%; text-align: left\">$titre_annuel_activite le $jour_activite à $heure_debut</td> </tr>";
			
			$compteur++;	
    }
    
    
	
		

?>
                  
                    </tbody>
                   
                  </table>
            </div>
            
          </div>

            </div><!-- /.col -->
          </div><!-- /.row -->
          
          
          
          
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
    
     <script src="../../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../../plugins/datatables/dataTables.bootstrap.min.js"></script>
    
    
     <!-- InputMask -->
    <script src="../../../plugins/input-mask/jquery.inputmask.js"></script>
    <script src="../../../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="../../../plugins/input-mask/jquery.inputmask.extensions.js"></script>

    <!-- jQuery UI 1.11.4 -->
    <script src="../../../plugins/jquery-ui-1.11.4/jquery-ui.min.js"></script>
    
    
    <!--Validation du formulaire -->
    <script src="../../../include/js/validator.js"></script>
    
    <script src="../../../plugins/sweetalert2/sweetalert2.min.js"></script>
    
    <script>
      $(function () {

        $('#encours').DataTable({
        "stateSave": true,
         "stateDuration": 60 * 3,
          "ordering": false,
           "language": {
            "lengthMenu": "_MENU_  enregistrements par page",
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
    
      $('#historique').DataTable({
        "stateSave": true,
         "stateDuration": 60 * 3,
          "ordering": false,
           "language": {
            "lengthMenu": "_MENU_  enregistrements par page",
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
      
<?php if($success=="ok"){echo" 

swal(
  'Activité supprimée!',
  'Cette activité est supprimée de votre liste!',
  'success'
)";}
?>
          
      });
      
  function suppActivite(idactivite,activite,id_user) {
  	  
  swal({
  title: 'Etes vous sûr de vouloir supprimer cette activité ?',
  text: ""+activite,
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Oui, on supprime !',
  cancelButtonText: 'Annuler !'
}).then(function () {
 document.location.href="supp_monactivite.php?id_activite="+idactivite+"&id_user="+id_user;
})
    
 }         
     
     
  function detailActivite(activite,description,lieu,repli) {
  	  
  swal({
  title: ""+activite,
  html: "<div align=\"left\"><b>Description : </b>"+description+"<br><br><b>Lieu : </b>"+lieu+"<br><br><b>Lieu de repli : </b>"+repli+"</div>",
  type: 'info'
}).then(function () {
 document.location.href="supp_monactivite.php?id_activite="+idactivite;
})
    
 }         
      
    </script>
 


  </body>
</html>