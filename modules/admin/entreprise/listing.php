<?php

/***** Dernière modification : 17/06/2016, Romain TALDU	*****/

$menu=4;
$ss_menu=43;
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
            Vue en liste
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="../index.php"><i class="fa fa-heartbeat"></i> Accueil</a></li>
            <li class="active">Vue en listing</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">




<div class="box box-primary">
            <div class="box-header with-border">
                  <h3 class="box-title">Tableau des activités à venir</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Activité</th>
                        <th>Date</th>
                        <th>Taux de remplissage</th>
                        <th>Liste</th>
                      </tr>
                    </thead>
                    <tbody>
                  
<?php 
                  
$data=$entreprise->afficheActivite(); 

foreach($data as $event){
			
			$id_entreprise_activite=$event->id_entreprise_activite;
			$titre_entreprise_activite=htmlspecialchars($event->titre_entreprise_activite);
			$color_entreprise_activite=$event->color_entreprise_activite;
			$start_entreprise_activite=$event->start_entreprise_activite;
			$end_entreprise_activite=$event->end_entreprise_activite;
			$description_entreprise_activite=htmlspecialchars($event->description_entreprise_activite);
			$description_entreprise_activite = str_replace(array("\r\n", "\r", "\n"), "<br>", $description_entreprise_activite); 
			$association_entreprise_activite=htmlspecialchars($event->association_entreprise_activite);
			$lieu_entreprise_activite=htmlspecialchars($event->lieu_entreprise_activite);
			$lieu_repli_entreprise_activite=htmlspecialchars($event->lieu_repli_entreprise_activite);
			$public_entreprise_activite=htmlspecialchars($event->public_entreprise_activite);
			$inscrit_entreprise_activite=$event->inscrit_entreprise_activite;
			$limite_entreprise_activite=$event->limite_entreprise_activite;
			
			if($limite_entreprise_activite!=0 AND $inscrit_entreprise_activite>=$limite_entreprise_activite)
			{$titre_entreprise_activite=$titre_entreprise_activite."<b> [COMPLET]</b>";}
				
			if($limite_entreprise_activite==0){$limite_entreprise_activite="Illimité";}
			
			$jour_activite=explode(" ",$start_entreprise_activite);
			$jour_activite=explode("-",$jour_activite[0]);
			$jour_activite=$jour_activite[2]."/".$jour_activite[1];
			
			$heure_debut=explode(" ",$start_entreprise_activite);
			$heure_debut=explode(":",$heure_debut[1]);
			$heure_debut=$heure_debut[0]."h".$heure_debut[1];
			
			$heure_fin=explode(" ",$end_entreprise_activite);
			$heure_fin=explode(":",$heure_fin[1]);
			$heure_fin=$heure_fin[0]."h".$heure_fin[1];
			
			
			
			
			
			echo "<tr>
                        <td><a href=\"edit.php?id_activite=".$id_entreprise_activite."&origine=listing\">".$titre_entreprise_activite."</a></td>
                        <td>".$jour_activite." à ".$heure_debut."</td>
                        <td>".$inscrit_entreprise_activite." / ".$limite_entreprise_activite."</td>
                        <td><a href=\"liste_pdf.php?id_activite=".$id_entreprise_activite."\" target=\"_blank\"><span class=\"label label-primary\"><i class=\"fa fa-download\"></i> &nbsp; PDF</span></a></td>
                        
                      </tr>";
			
						

			
		}              
                  
?>
                  
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>Activité</th>
                        <th>Date</th>
                        <th>Taux de remplissage</th>
                        <th>Liste</th>
                       </tr>
                    </tfoot>
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
    
     <script src="../../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../../plugins/datatables/dataTables.bootstrap.min.js"></script>
    
    
    <script>
      $(function () {
    
$('#example1').DataTable({
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
    </script>


  </body>
</html>