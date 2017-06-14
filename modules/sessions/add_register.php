<?php

/***** Dernière modification : 08/07/2016, Romain TALDU	*****/

require(__DIR__ .'/../../include/config.inc.php');
require(__DIR__ .'/../../include/connexion.inc.php');
require(__DIR__ .'/model.inc.php');

// préparation connexion
$connect = new connection();
$session = new session($connect);

session_start();

$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$email=$_POST['email'];
$repassword=sha1($_POST['repassword']);

$add_resgister=$session->addRegister($nom,$prenom,$email,$repassword);

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
    <!-- iCheck -->
    <link rel="stylesheet" href="../../plugins/iCheck/square/blue.css">
    
   

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition register-page">
    <div class="register-box">
    	
    	
      <div class="register-logo">
        <img src="../estival/images/<?php echo LOGO_ADMIN; ?>" class="img-responsive" style="display: block; margin-left: auto; margin-right: auto">
      </div>
      
      
  </div><!-- /.register-box -->
     <div class="row">
 <div class="col-md-3">
 </div>

 <div class="col-md-6">
 	
<?php if($add_resgister==TRUE){ ?> 	
<div class="box box-solid box-primary">
  <div class="box-header with-border">
  	<span class='glyphicon glyphicon-ok'></span>
    <h3 class="box-title">Demande d'inscription</h3>
    <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->

    </div><!-- /.box-tools -->
  </div><!-- /.box-header -->
  
  <div class="box-body">
    Votre demande d'inscription a bien été prise en compte. Un administrateur la validera au plus vite.<br>
  Vous recevrez un email de confirmation dès que votre compte sera actif.
    
      </div><!-- /.box-body -->

</div><!-- /.box -->
<?php }else{?>
<div class="box box-solid box-danger">
  <div class="box-header with-border">
  	<span class='glyphicon glyphicon-remove'></span>
    <h3 class="box-title">Demande d'inscription</h3>
    <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->

    </div><!-- /.box-tools -->
  </div><!-- /.box-header -->
  
  <div class="box-body">
    Votre demande d'inscription a été refusée car cette adresse email est déja enregistrée dans la base de données. Veuillez en saisir une nouvelle ou récupérer votre mot de passe.
    <a href="register.html">Revenir à la page d'inscription</a>
    
      </div><!-- /.box-body -->

</div><!-- /.box -->	
<?php }?>
	
</div>
 <div class="col-md-3">
 </div>
 </div>

    <!-- jQuery 2.1.4 -->
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>

  
    
  </body>
</html>
