<?php

/***** Dernière modification : 17/06/2016, Romain TALDU	*****/

require(__DIR__ .'/../include/config.inc.php');

session_start();

if(isset($_SESSION['id_membre'])) {
  header ('location: ../modules/admin/dashboard/index.php'); 
  exit;
}

$erreur = isset($_GET['erreur']) ? $_GET['erreur'] : NULL;


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
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/font-awesome-4.6.3/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../plugins/ionicons-2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
     <!--
	 <div class="login-logo">
       [logo]<br><b>Sport/Santé à Pau</b>
      </div> /.login-logo -->

      <div class="login-box-body">
	<img src="<?php echo LOGO_ADMIN; ?>" class="img-responsive" style="display: block; margin-left: auto; margin-right: auto">
        <p class="login-box-msg">Connectez-vous à votre espace personnel.</p>
        <form action="../modules/sessions/login.php" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Email" name="login" required>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Mot de passe" name="password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Valider</button>
            </div><!-- /.col -->
          </div>
        </form>
        <p>
        <a href="../modules/sessions/forget_pwd.php">J'ai oublié mon mot de passe</a><br>
        <?php if(URL_SITE!="https://efapau2.agglo-pau.fr"){ ?> <a href="../modules/sessions/register.php" class="text-center">Je souhaite m'inscrire</a><br> <?php } ?>
        </p>
	<p class="text-danger"><?php if($erreur==1){echo"Nom d'utilisateur ou mot de passe incorrect !";} ?></p>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="../plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
