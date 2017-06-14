
<?php

/***** Dernière modification : 17/06/2016, Romain TALDU	*****/

require(__DIR__ .'/../../../include/verif_session.php');
require(__DIR__ .'/../../../include/config.inc.php');
require(__DIR__ .'/../../../include/connexion.inc.php');
require(__DIR__ .'/model.inc.php');

$menu=3;
$ss_menu=34;

// préparation connexion
$connect = new connection();
$annuel = new annuel($connect);

if(isset($_POST['accepte'])){$accepte=$_POST['accepte'];}else{$accepte="";};

function random($var){
        $string = "";
        $chaine = "a0b1c2d3e4f5g6h7i8j9klmnpqrstuvwxy123456789";
        srand((double)microtime()*1000000);
        for($i=0; $i<$var; $i++){
            $string .= $chaine[rand()%strlen($chaine)];
        }
        return $string;
    }

$motdepasse=random(8);
$motdepasse_crypte=sha1($motdepasse);



$result=$annuel->ajoutNewuser($_POST['civilite'],$_POST['nom'],$_POST['prenom'],$_POST['telephone'],$_POST['email'],$_POST['residence'],$_POST['naissance'],$accepte,$motdepasse_crypte);




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
             Ajouter un utilisateur
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="../index.php"><i class="fa fa-heartbeat"></i> Accueil</a></li>
            <li class="active"> Ajouter un utilisateur</li>
          </ol>
        </section>

      



  	<!-- Main content -->
        <section class="content">
          <div class="row">
            
            <div class="col-md-9">
              <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Nouvel utilisateur</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
             <form name="inscriptionForm"  id="inscriptionForm" role="form" data-toggle="validator" action="validation_ajout_activite.php" method="post" data-disable="false">
             	
              <div class="box-body">
               	
               	
            
               	
<div class="row">


 <div class="col-md-12">
 	
 <?php if(!$result)	 {?>
 	
 	
<div class="box box-solid box-danger">
  <div class="box-header with-border">
  	<span class='glyphicon glyphicon-remove'></span>
    <h3 class="box-title">Erreur d'enregistrement</h3>
    <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->

    </div><!-- /.box-tools -->
  </div><!-- /.box-header -->
  <div class="box-body">
    Cette adresse email est déja présente dans la base de donées !
    
      </div><!-- /.box-body -->

</div><!-- /.box --> 	
 <button type="button" class="btn btn-default" onclick="javascript:history.go(-1)"><i class="fa fa-arrow-circle-left"></i> Retour</button>  
	
<?php }else{ ?>
	
	
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
    Utilisateur enregistrée avec succès !
    
      </div><!-- /.box-body -->

</div><!-- /.box -->
  <b>Votre email : </b><?php echo $_POST['email']; ?><br>
  <b>Votre mot de passe temporaire : </b><?php echo $motdepasse;?>   &nbsp;&nbsp;&nbsp;
  <br>  <br>
  <button type="button" class="btn btn-primary" onclick="window.open('conv_fiche_pdf.php?email=<?php echo $_POST['email']; ?>&motdepasse=<?php echo $motdepasse;?>');"></i> <i class="fa fa-download"></i> &nbsp; Voir la fiche d'inscription en PDF</button> 
  
  </td>


<?php } ?>

</div>
 
 </div>        
                
               <br>
               
              
              <!-- /.box-body -->
              <div class="box-footer">
          
   
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




