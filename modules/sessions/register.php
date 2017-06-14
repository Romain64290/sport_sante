<?php

/***** Dernière modification : 12/05/2017, Romain TALDU	*****/

require(__DIR__ .'/../../include/config.inc.php');

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
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
      <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/font-awesome-4.6.3/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../../plugins/ionicons-2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
   
    
   

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition register-page">
    <div class="register-box">
      <div class="register-logo"></div>

      <div class="register-box-body">
      	<img src="../../admin/<?php echo LOGO_ADMIN; ?>" class="img-responsive" style="display: block; margin-left: auto; margin-right: auto">
        <p class="login-box-msg">S'inscrire au backoffice.</p>
        <form name="formulaire" role="form" data-toggle="validator" action="add_register.php" method="post" data-disable="false">
          
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Votre Nom" required name="nom" data-error="Veuillez saisir votre nom">
            <span class="glyphicon glyphicon-user form-control-feedback"></span><div class="help-block with-errors"></div>
          </div>
          
           <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Votre Prénom" required name="prenom" data-error="Veuillez saisir votre prénom">
            <span class="glyphicon glyphicon-user form-control-feedback"></span><div class="help-block with-errors"></div>
          </div>
          
           
          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Votre Email" required name="email" data-error="Veuillez saisir votre email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span><div class="help-block with-errors"></div>
          </div>
          
          <div class="form-group has-feedback">
            <input type="password" data-minlength="6" class="form-control" placeholder="Mot de passe  -  6 caractères au minimum" name="password_resgister" id="password" required data-error="Veuillez choisir un mot de passe d'au moins 6 caractères">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            <!--<span class="help-block">6 caractères au minimum</span> --><div class="help-block with-errors"></div>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Retapez votre mot de passe" name="repassword" id="repassword"  data-match="#password" data-match-error="Désolé, les mots de passe ne correspondent pas."required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span> <div class="help-block with-errors"></div>
          </div>
          <div class="row">
            
             <div class="col-xs-12" align="right">
               
           
             <button type="button" class="btn btn-default" onclick="window.location.href='../../admin/index.php'"><i class="fa fa-arrow-circle-left"></i> Annuler</button> &nbsp;&nbsp;
             <button type="submit" class="btn btn-primary" >S'enregistrer</button>
            </div><!-- /.col -->
        </form>
        
        
 

      </div><!-- /.form-box -->
    </div><!-- /.register-box -->

    <!-- jQuery 2.1.4 -->
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
   
    
     <script src="../../include/js/validator.js"></script>
    
    <script>
      $(function () {
     
      });
    </script>

  
    
  </body>
</html>
