<?php

/***** Dernière modification : 02/11/2016, Romain TALDU	*****/

require(__DIR__ .'/../../../include/verif_session.php');
$menu=6;
$ss_menu=63;
//include("../../../include/verif_droits.php");
require(__DIR__ .'/../../../include/config.inc.php');
require(__DIR__ .'/../../../include/connexion.inc.php');
require(__DIR__ .'/model.inc.php');

// préparation connexion
$connect = new connection();
$annuel = new annuel($connect);

$result=$annuel->infoMembre($_SESSION["id_membre"]);

$success = empty($_GET['success']) ? "" : $_GET['success'];

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
            Mon profil
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="../index.php"><i class="fa fa-heartbeat"></i> Accueil</a></li>
            <li class="active">Mon profil</li>
          </ol>
        </section>

      



  	<!-- Main content -->
        <section class="content">
        	
       <div class="row">
            
            <div class="col-md-9">
              <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Modifier mon mot de passe : </h3>
              <div class="box-tools pull-right">
                   <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
                <form name="inscriptionForm2"  id="inscriptionForm2" role="form" data-toggle="validator" action="maj_pwd_user.php" method="post" data-disable="false">
              <div class="box-body">
           
           
         

       <div class="row">
            
                       	
              	 <div class="col-md-6">
          <div class="form-group has-feedback">
 	 <div class="input-group">
    <span class="input-group-addon">
    <span class="glyphicon glyphicon-lock"></span>
 	 </span>
      <input type="password" data-minlength="6" class="form-control" placeholder="Nouveau mot de passe  -  6 caractères au minimum" name="password_resgister" id="password" required data-error="Veuillez choisir un mot de passe d'au moins 6 caractères"> </div>  
     <div class="help-block with-errors"></div>
  
     </div> </div>     
          
           <div class="col-md-6">
          <div class="form-group has-feedback">
 	 <div class="input-group">
    <span class="input-group-addon">
    <span class="glyphicon glyphicon-lock"></span>
 	 </span>
     <input type="password" class="form-control" placeholder="Retapez votre nouveau mot de passe" name="repassword" id="repassword"  data-match="#password" data-match-error="Désolé, les mots de passe ne correspondent pas."required> </div>  
     <div class="help-block with-errors"></div>
   
     </div> </div>        
               
			 </div>	           
			   <div align="right">  <button type="submit" class="btn btn-primary" ><i class="fa fa-floppy-o"></i> &nbsp; Modifier le mot de passe</button>  </div>
             </div>
             
             
              	              
            
            </form>
            
          </div>

            </div><!-- /.col -->
          </div><!-- /.row -->     	
        	
        	
        	
        	
        	
          <div class="row">
            
            <div class="col-md-9">
              <div class="box box-primary collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">Mettre à jour mes informations personnelles : </h3>
               <div class="box-tools pull-right">
                   <!-- <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
                     <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                 
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
                <form name="inscriptionForm"  id="inscriptionForm" role="form" data-toggle="validator" action="maj_infos_user.php" method="post" data-disable="false">
              <div class="box-body">
           
           
            <div class="row">
            
             <div class="col-md-2">
           
             	
                <div class="form-group has-feedback">
              <div class="input-group">
    <span class="input-group-addon">
    <span class="fa fa-venus-mars"></span>
 	 </span>
           	 <select name="civilite" class="form-control" required  data-error="Veuillez choisir votre civilité" disabled>
                <option value="" disabled="true">Civilité</option>
                <option value="1" <?php if($result['civilite']==1){echo "selected";} ?> >Monsieur</option>
                <option value="2" <?php if($result['civilite']==2){echo "selected";} ?> >Madame</option>
            </select>            
            
          </div> <div class="help-block with-errors"></div></div></div>
              	
              	 <div class="col-md-5">
          <div class="form-group has-feedback">
 	 <div class="input-group">
    <span class="input-group-addon">
    <span class="glyphicon glyphicon-user"></span>
 	 </span>
     <input type="text" class="form-control" placeholder="Nom" required name="nom" data-error="Veuillez saisir votre nom" value="<?php echo htmlspecialchars($result['nom_membre']) ?>" disabled> </div>  
     <div class="help-block with-errors"></div>
  
     </div> </div>     
          
           <div class="col-md-5">
          <div class="form-group has-feedback">
 	 <div class="input-group">
    <span class="input-group-addon">
    <span class="glyphicon glyphicon-user"></span>
 	 </span>
     <input type="text" class="form-control" placeholder="Prénom" required name="prenom" data-error="Veuillez saisir votre prénom" value="<?php echo htmlspecialchars($result['prenom_membre']) ?>" disabled> </div>  
     <div class="help-block with-errors"></div>
   
     </div> </div>        
               
			 </div>	
    <div class="form-group has-feedback">
 	 <div class="input-group">
    <span class="input-group-addon">
    <span class="glyphicon glyphicon-phone"></span>
 	 </span>
     <input type="text" class="form-control" placeholder="Téléphone" required name="telephone" data-error="Veuillez saisir votre numéro de téléphone" value="<?php echo htmlspecialchars($result['telephone']) ?>"></div>  
     <div class="help-block with-errors"></div>
   
     </div>         
          
  
          
    <div class="form-group has-feedback">
 	 <div class="input-group">
    <span class="input-group-addon">
    <span class="glyphicon glyphicon-envelope"></span>
 	 </span>
     <input type="email" class="form-control" placeholder="Email" required name="email" data-error="Veuillez saisir votre email" value="<?php echo htmlspecialchars($result['email']) ?>" disabled>  </div> 
     <div class="help-block with-errors"></div>
  
     </div>       
          
          
          
 <div class="form-group has-feedback">
 	 <div class="input-group">
    <span class="input-group-addon">
    <span class="glyphicon glyphicon-home"></span>
 	 </span>
    <select name="residence" class="form-control" required  data-error="Veuillez choisir votre lieu de résidence">
                <option value="" disabled="disabled">Lieu de résidence</option>
                <option value="artigueloutan" <?php if($result['residence']=="artigueloutan"){echo "selected";} ?> >Artigueloutan</option>
                <option value="billere" <?php if($result['residence']=="billere"){echo "selected";} ?> >Billère</option>
                <option value="bizanos" <?php if($result['residence']=="bizanos"){echo "selected";} ?> >Bizanos</option>
                <option value="gan" <?php if($result['residence']=="gan"){echo "selected";} ?> >Gan</option>
               <option value="gelos" <?php if($result['residence']=="gelos"){echo "selected";} ?> >Gelos</option>
                <option value="idron" <?php if($result['residence']=="idron"){echo "selected";} ?> >Idron</option>
                <option value="jurancon" <?php if($result['residence']=="jurancon"){echo "selected";} ?> >Jurançon</option>
                <option value="lee" <?php if($result['residence']=="lee"){echo "selected";} ?> >Lée</option>
                <option value="lescar" <?php if($result['residence']=="lescar"){echo "selected";} ?> >Lescar</option>
                <option value="lons" <?php if($result['residence']=="lons"){echo "selected";} ?> >Lons</option>
                <option value="mazeres_lezons" <?php if($result['residence']=="mazeres_lezons"){echo "selected";} ?> >Mazères-Lezons</option>
                <option value="ousse" <?php if($result['residence']=="ousse"){echo "selected";} ?> >Ousse</option>
                <option value="pau" <?php if($result['residence']=="pau"){echo "selected";} ?> >Pau</option>
                <option value="sendets" <?php if($result['residence']=="sendets"){echo "selected";} ?>>Sendets</option>
                <option value="autre" <?php if($result['residence']=="autre"){echo "selected";} ?>>__Autre__</option>
                 </select>      
   
     
     
     </div>
     
       <div class="help-block with-errors"></div>
     
     
   
     </div>         
         
            
  <div class="form-group has-feedback">
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input class="form-control" type="text" pattern="^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$" placeholder="Date de naissance : DD/MM/YYYY" required name="naissance" data-error="Veuillez saisir votre date de naissance" value="<?php echo htmlspecialchars($result['age']) ?>" disabled> </div>
                   <div class="help-block with-errors"></div>
</div>

  
     <div class="form-group has-feedback">
     
                 <div class="checkbox icheck">
                  <label>
                    <input type="checkbox" name="accepte" <?php if($result['accepte_mail']=="on"){echo "checked";} ?>> J'accepte de recevoir des informations de la part de la Direction des Sports de la ville de Pau
                  </label>
                </div> </div>
                
                
                 <div align="right"><button type="submit" class="btn btn-primary" ><i class="fa fa-floppy-o"></i> &nbsp; Mettre à jour mes informations</button></div>
                
             </div>
              <!-- /.box-body -->
              <!-- /.box-body -->
            
              	               
            
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
    
    
    <!--Validation du formulaire -->
    <script src="../../../include/js/validator.js"></script>
    
       <!-- iCheck -->
    <script src="../../../plugins/iCheck/icheck.min.js"></script>
    
     <script src="../../../plugins/sweetalert2/sweetalert2.min.js"></script>
    
    	
    <script>
      $(function () {
 
   $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });



<?php if($success=="info"){echo" 

swal(
  'Modifications  enregistrées !',
  'Les modifications de votre profil sont bien prises en compte.',
  'success'
)";} ?>
        
        
<?php if($success=="mdp"){echo" 

swal(
  'Modification  enregistrée !',
  'La modification de votre mot de passe est bien prise en compte.',
  'success'
)";} ?>
        
      });
      
      
    </script>


  </body>
</html>