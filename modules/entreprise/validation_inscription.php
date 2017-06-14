<?php

/***** Dernière modification : 11/05/2017, Romain TALDU	*****/

require(__DIR__ .'/../../include/config.inc.php');
require(__DIR__ .'/../../include/connexion.inc.php');
require(__DIR__ .'/model.inc.php');
session_start();

// préparation connexion
$connect = new connection();
$fo_entreprise = new fo_entreprise($connect);

$id_user=$_GET['id_user'];
$activite_pleine=$_GET['activite_pleine'];
?>

<!DOCTYPE html>
<html>
  <head>   
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>En forme à Pau</title>
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
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
        <!-- iCheck -->
 

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <style>

	 html, body {
            min-height: 100%;
            padding: 0;
            margin: 0;
            font-family: 'Source Sans Pro', "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
     
 .masqueimgpourmobile {   
	}
		@media screen and (max-width: 992px) {
	.masqueimgpourmobile {   
		display:none;
	}
	}
</style>
  </head>
  <body>
  	
  	<div style="min-height: 903px;margin-left: 0px;margin-top: 0px;" class="content-wrapper" >
        <!-- Content Header (Page header) -->
       
        <section class="content-header">
          <h1>
             <img src="images/logo_50.png" style="margin-top:-10px;margin-bottom:-10px">
            <small></small>
          </h1>
        </section>
<div class="masqueimgpourmobile">
			<img src="images/frise.png" style="position:absolute; top:10px; right: 50px;">
			</div>
   
        <section class="content">
<br><br>
 <div class="row">
 <div class="col-md-3">
 </div>

 <div class="col-md-6">
<div class="box box-solid box-success">
  <div class="box-header with-border">
  	<span class='glyphicon glyphicon-ok'></span>
    <h3 class="box-title">Confirmation de votre inscription</h3>
    <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->

    </div><!-- /.box-tools -->
  </div><!-- /.box-header -->
  <div class="box-body">
    Nous vous confirmons votre inscription aux activité(s) suivante(s): <br>
    <ul>
<?php 

$reservation=$fo_entreprise->afficheReservation($id_user); 
 	 
	echo $reservation;
	
?>
   </ul> 

  Un email reprenant ces informations vous est également envoyé.
    
      </div><!-- /.box-body 

</div><!-- /.box -->
</div>
 <div class="col-md-3">
 </div>
 </div>

<?php  
if($activite_pleine !=""){

echo"<div class=\"callout callout-danger lead\">
    <h4>Attention !</h4>
   
     Les inscriptions suivante(s) sont annulée(s) car elles sont désormais pleine(s) :
      <ul>";

$activite_pleine=explode(" ", $activite_pleine);   
$count = count($activite_pleine);

for ($i = 0; $i < $count; $i++) {  

$afficheAnnulation=$fo_entreprise->afficheAnnulation($activite_pleine[$i]);
	
echo $afficheAnnulation;	

}



echo"</ul></div>"; 
}



?>


        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
  	
   <?php require(__DIR__ .'/../../include/footer_front.php'); ?>    	

 <!-- jQuery 2.1.4 -->
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
   <script src="../../plugins/jquery-ui-1.11.4/jquery-ui.min.js"></script>
    <!-- Slimscroll -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js"></script>

  

 

  </body>
</html>