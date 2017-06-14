<?php

/***** Dernière modification : 08/07/2016, Romain TALDU	*****/

require(__DIR__ .'/../../include/config.inc.php');
require(__DIR__ .'/../../include/connexion.inc.php');
require(__DIR__ .'/../../plugins/PHPMailer/class.phpmailer.php');
require(__DIR__ .'/model.inc.php');

// préparation connexion
$connect = new connection();
$session = new session($connect);

$captcha;
      	
      	
      	if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
 //contenu message à personaliser veuillez saisir le capcha history.go -1
	  
		  
		  
        }
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfA0BcTAAAAAEdLj5AhxXvftUWl0vxRDb5d7o0O&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
        //$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LezOhITAAAAAMHXdVI1zpYdQyrrVy4iz4g6mCYW&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
        if($response.success==false)
        {
          echo '<h2>Vous êtes un spammeur !</h2>';
        }else
        {

 //contenu message à personaliser : ok
 
$email=$_POST['email'];

$new_pwd=$session->newPwd($email);


		}




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
 	
<?php if($new_pwd==TRUE){ ?> 	
<div class="box box-solid box-primary">
  <div class="box-header with-border">
  	<span class='glyphicon glyphicon-ok'></span>
    <h3 class="box-title">Mot de passe oublié</h3>
    <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->

    </div><!-- /.box-tools -->
  </div><!-- /.box-header -->
  
  <div class="box-body">
   Un email vous a été envoyé avec un lien pour choisir un nouveau mot de passe.
    
      </div><!-- /.box-body -->

</div><!-- /.box -->
<?php }else{?>
<div class="box box-solid box-danger">
  <div class="box-header with-border">
  	<span class='glyphicon glyphicon-remove'></span>
    <h3 class="box-title">Mot de passe oublié</h3>
    <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->

    </div><!-- /.box-tools -->
  </div><!-- /.box-header -->
  
  <div class="box-body">
    Votre adresse email n'est pas enregistrée dans la base de données.<br>
    <a href="../../admin/index.php">Revenir à la page d'accueil</a>
    
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
