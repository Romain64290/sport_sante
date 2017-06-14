
<?php

/***** Dernière modification : 09/05/2017, Romain TALDU	*****/


require(__DIR__ .'/../../../include/config.inc.php');
require(__DIR__ .'/../../../include/connexion.inc.php');
require(__DIR__ .'/model.inc.php');

// verifie que la session est active, sinon reoriente vers la page de login
require(__DIR__ .'/../../../include/verif_session.php');
//verifie que les droits sont valide si la session est active, sinon reoriente vers la page de login
include("../../../include/verif_droits.php");

$menu=2;
$ss_menu=21;

// préparation connexion
$connect = new connection();
$estival = new estival($connect);


$result=$estival->ajoutActivite($_POST['nom'],$_POST['date'],$_POST['heure_debut'],$_POST['heure_fin'],$_POST['description'],$_POST['association'],$_POST['lieu'],$_POST['repli'],$_POST['public'],$_POST['limite'],$_POST['couleur'],$_POST['lien_map']);


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
            Ajouter une activité
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="../index.php"><i class="fa fa-heartbeat"></i> Accueil</a></li>
            <li class="active">Ajouter une activité</li>
          </ol>
        </section>

      



  	<!-- Main content -->
        <section class="content">
          <div class="row">
            
            <div class="col-md-9">
              <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Nouvelle activité</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
             <form name="inscriptionForm"  id="inscriptionForm" role="form" data-toggle="validator" action="validation_ajout_activite.php" method="post" data-disable="false">
             	
              <div class="box-body">
               	
               	
            
               	
<div class="row">


 <div class="col-md-12">
<div class="box box-solid box-success">
  <div class="box-header with-border">
  	<span class='glyphicon glyphicon-ok'></span>
    <h3 class="box-title">Confirmation d'enregistrement</h3>
    <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->

    </div><!-- /.box-tools -->
  </div><!-- /.box-header -->
  <div class="box-body">
    Activité enregistrée avec succès !
    
      </div><!-- /.box-body -->

</div><!-- /.box -->
</div>
 
 </div>        
                
               <br>
               
              
              <!-- /.box-body -->
              <div class="box-footer">
              	 <button type="button" class="btn btn-default" onclick="window.location.href='calendrier.php'"><i class="fa fa-calendar"></i> &nbsp; Vue calendrier</button> &nbsp;
              	 <button type="button" class="btn btn-info" onclick="window.location.href='ajout_activite.php?id_activite=<?php echo $result; ?>'" ><i class="fa fa-files-o"></i> &nbsp;Dupliquer cette activité</button>&nbsp; 
                <button type="button" class="btn btn-primary" onclick="window.location.href='ajout_activite.php'" ><i class="fa fa-file"></i> &nbsp; Créer une nouvelle activité</button>
              </div>
              
             
              
            </form>
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
    
    <!-- jQuery UI 1.11.4 -->
     <script src="../../../plugins/jquery-ui-1.11.4/jquery-ui.min.js"></script>
 

  </body>
</html>




