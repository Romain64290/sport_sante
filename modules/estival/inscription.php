<?php

/***** Dernière modification : 17/06/2016, Romain TALDU	*****/

require(__DIR__ .'/../../include/config.inc.php');
require(__DIR__ .'/../../include/connexion.inc.php');
require(__DIR__ .'/model.inc.php');
session_start();
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
    <!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="../../plugins/fullcalendar-2.7.2/fullcalendar.min.css">
    <link rel="stylesheet" href="../../plugins/fullcalendar-2.7.2/fullcalendar.print.css" media="print">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
        <!-- iCheck -->
    <link rel="stylesheet" href="../../plugins/iCheck/square/blue.css">

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
	
	.cnil{
  padding-left : 15px;
  color: #666;
}

</style>
  </head>
  <body>
  	
  	<div style="min-height: 903px;margin-left: 0px;margin-top: 0px;" class="content-wrapper" >
        <!-- Content Header (Page header) -->
       
        <section class="content-header">
          <h1>
             <img src="images/logo_50.png" style="margin-top:-10px;margin-bottom:-10px">
            <small>Programmation été 2016</small>
          </h1>
        </section>
  	<div class="masqueimgpourmobile">
			<img src="images/frise.png" style="position:absolute; top:10px; right: 50px;">
			</div>
  	
    	<!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-3">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h4 class="box-title">Votre sélection :</h4>
                </div>
                <div class="box-body">
                  <!-- the events -->
                  <div id="external-events">
                  	
                   
                    	
                    <?php	
         $nb_articles = count($_SESSION['activite']['id_activite']);
         if($nb_articles ==0){echo"Aucune activité sélectionnée.";}
         
                    for($i = 0; $i < $nb_articles; $i++)
    {
           
      echo"<div class=\"external-event ".$_SESSION['activite']['color'][$i]."\">".$_SESSION['activite']['titre'][$i]." ".$_SESSION['activite']['date'][$i]."
           <div style=\"float:right;\"><button type = \"button\" onclick=\"window.location.href='supprimer_activite.php?supp=".$_SESSION['activite']['id_activite'][$i]."&validation=ok';\" class = \"btn btn-default btn-xs\" ><span class = \"glyphicon glyphicon-trash \"></span> </button></div>	
           </div>";
    
    } 
    	?>
            
                    
                  </div>
                  
                    <div class="masqueimgpourmobile">
				<img src="images/logo_380.png" style="margin-top:50px" class="img-responsive" alt="En forme à Pau">
				</div>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
             
             
             
             
            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Validation de votre inscription</h3>
            </div>
            
            
            
            <!-- /.box-header -->
            <!-- form start -->
             <form name="inscriptionForm"  id="inscriptionForm" role="form" data-toggle="validator" action="ajout_user.php" method="post" data-disable="false">
              <div class="box-body">
           
           
            <div class="row">
            
             <div class="col-md-2">
           
             	
                <div class="form-group has-feedback">
              <div class="input-group">
    <span class="input-group-addon">
    <span class="fa fa-venus-mars"></span>
 	 </span>
           	 <select name="civilite" class="form-control" required  data-error="Veuillez choisir votre civilité">
                <option value="" selected disabled="disabled">Civilité</option>
                <option value="1">Monsieur</option>
                <option value="2">Madame</option>
            </select>            
            <div class="help-block with-errors"></div>
          </div> </div></div>
              	
              	 <div class="col-md-5">
          <div class="form-group has-feedback">
 	 <div class="input-group">
    <span class="input-group-addon">
    <span class="glyphicon glyphicon-user"></span>
 	 </span>
     <input type="text" class="form-control" placeholder="Nom" required name="nom" data-error="Veuillez saisir votre nom"> </div>  
     <div class="help-block with-errors"></div>
  
     </div> </div>     
          
           <div class="col-md-5">
          <div class="form-group has-feedback">
 	 <div class="input-group">
    <span class="input-group-addon">
    <span class="glyphicon glyphicon-user"></span>
 	 </span>
     <input type="text" class="form-control" placeholder="Prénom" required name="prenom" data-error="Veuillez saisir votre prénom"> </div>  
     <div class="help-block with-errors"></div>
   
     </div> </div>        
               
			 </div>	
    <div class="form-group has-feedback">
 	 <div class="input-group">
    <span class="input-group-addon">
    <span class="glyphicon glyphicon-phone"></span>
 	 </span>
     <input type="text" class="form-control" placeholder="Téléphone" required name="telephone" data-error="Veuillez saisir votre numéro de téléphone"></div>  
     <div class="help-block with-errors"></div>
   
     </div>         
          
  
          
    <div class="form-group has-feedback">
 	 <div class="input-group">
    <span class="input-group-addon">
    <span class="glyphicon glyphicon-envelope"></span>
 	 </span>
     <input type="email" class="form-control" placeholder="Email" required name="email" data-error="Veuillez saisir votre email">  </div> 
     <div class="help-block with-errors"></div>
  
     </div>       
          
          
          
 <div class="form-group has-feedback">
 	 <div class="input-group">
    <span class="input-group-addon">
    <span class="glyphicon glyphicon-home"></span>
 	 </span>
    <select name="residence" class="form-control" required  data-error="Veuillez choisir votre lieu de résidence">
                <option value="" selected disabled="disabled">Lieu de résidence</option>
                <option value="artigueloutan">Artigueloutan</option>
                <option value="billere">Billère</option>
                <option value="bizanos">Bizanos</option>
                <option value="gan">Gan</option>
               <option value="gelos">Gelos</option>
                <option value="idron">Idron</option>
                <option value="jurancon">Jurançon</option>
                <option value="lee">Lée</option>
                <option value="lescar">Lescar</option>
                <option value="lons">Lons</option>
                <option value="mazeres_lezons">Mazères-Lezons</option>
                <option value="ousse">Ousse</option>
                <option value="pau">Pau</option>
                <option value="sendets">Sendets</option>
                <option value="autre">__Autre__</option>
                 </select>      
     <div class="help-block with-errors"></div>
     
     
     
     
     
     
     
     
     </div>
     
     
     
     
   
     </div>         
         
            
  <div class="form-group has-feedback">
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input class="form-control" type="text" pattern="^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$" placeholder="Date de naissance : DD/MM/YYYY" required name="naissance" data-error="Veuillez saisir votre date de naissance"> </div>
                   <div class="help-block with-errors"></div>
</div>

              
                
         <label>  Réglement interieur : </label>  
      <div class="box box-solid box-default">
  <div class="box-body box-scroll" style="height: 200px; overflow: auto; padding: 10px;">
 
<b><u>Article 1</u> : </b>
Le dispositif "En Forme à Pau" est organisé par la Ville de Pau à destination d'un public adulte.<br><br>
 <b><u>Article 2</u> : </b>
il est demandé à chaque participant de fournir un certificat médical de non contre indication à la pratique d'activités sportives et un brevet de natation de 25m pour l'activité Stand Up Paddle Board.<br><br>
 <b><u>Article 3</u>: </b>
Les activités se déroulent sur des sites naturels de proximité (parcs, jardins, rivières) et sur les installations sportives municipales de la Ville de Pau <b>du 20 juin 2016 au 3 septembre 2016</b> aux horaires indiqués sur le programme d'activités.<br><br>
 <b><u>Article 4</u> : </b>
Les activités sportives proposées sont gratuites. La Ville de Pau dégage toute responsabilité pour les incidents ou accidents qui pourraient survenir en dehors des créneaux horaires prévus.
<br><br>
 <b><u>Article 5</u> :</b>
Les activités sont encadrées par des professionnels qualifiés et diplômés.<br><br>
  </div><!-- /.box-body -->
  
</div><!-- /.box -->         
               
               
               
               <div class="form-group">
                  <div class="checkbox icheck">
                  <label>
                  <input type="checkbox" id="terms" data-error="Merci de valider les conditions d'utilisation" required> Je certifie avoir pris connaissance du réglement intérieur ci-dessus et accepte les conditions de participation au dispositif proposé.
                  </label><div class="help-block with-errors"></div>
                </div></div>
                
                 <div class="checkbox icheck">
                  <label>
                    <input type="checkbox" name="accepte"> J'accepte de recevoir des informations de la part de la Direction des Sports de la ville de Pau
                  </label>
                </div>
                
             </div>
              <!-- /.box-body -->
              <div class="box-footer">
              	 <button type="button" class="btn btn-default" onclick="window.location.href='index.php'"=>Retour au calendrier</button>  
                <button type="submit" class="btn btn-primary"    <?php if($nb_articles ==0){echo"disabled";} ?>>Valider mon inscription</button>
              </div>
            </form>
  <br>
         <div class="cnil">
            Conformément à la loi "informatique et libertés" du 6 janvier 1978 modifiée, vous bénéficiez d’un droit d’accès et de rectification aux informations qui vous concernent. Si vous souhaitez exercer ce droit et obtenir communication des informations vous concernant, veuillez vous adresser à direction.sports@ville-pau.fr
    <br> <br> </div>
  </div> 




            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
  	
   <?php require(__DIR__ .'/../../include/footer_front.php'); ?>    

 <!-- jQuery 2.1.4 -->
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../../plugins/jquery-ui-1.11.4/jquery-ui.min.js"></script>
   
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js"></script>

     <!-- iCheck -->
    <script src="../../plugins/iCheck/icheck.min.js"></script>

    <script src="../../include/js/validator.js"></script>

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
