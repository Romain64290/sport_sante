<?php

/***** Dernière modification : 17/06/2016, Romain TALDU	*****/

require(__DIR__ .'/../../../include/verif_session.php');
$menu=3;
$ss_menu=35;
//include("../../../include/verif_droits.php");
require(__DIR__ .'/../../../include/config.inc.php');
require(__DIR__ .'/../../../include/connexion.inc.php');
require(__DIR__ .'/model.inc.php');

// préparation connexion
$connect = new connection();
$annuel = new annuel($connect);

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
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>Date de naissance</th>
                        <th>profil</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                  
<?php

$data=$annuel->afficheMembreAnnuel($debut_scolaire,$fin_scolaire); 


$compteur = 1;

	 foreach($data as $event){
			
			$id=$event->id_membre;
			$nom=htmlspecialchars($event->nom_membre);
		    $prenom=htmlspecialchars($event->prenom_membre);
		    $telephone=htmlspecialchars($event->telephone);
		    $email=htmlspecialchars($event->email);
			$naissance=$event->age;
	

echo"




<tr>
            <td>$compteur</td>
            <td>$nom</td>
            <td>$prenom</td>
            <td>$telephone</td>
            <td>$email</td>
            <td>$naissance</td>
            <td><a href=\"mes_activites.php?id_user=".$id."&email=".$email."\">Voir le profil</a></td> </tr>";
			
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
    </script>


  </body>
</html>