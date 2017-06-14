<?php

/***** Dernière modification : 04/05/2017, Romain TALDU	*****/


$menu=4;
$ss_menu=41;
require(__DIR__ .'/../../../include/config.inc.php');
require(__DIR__ .'/../../../include/connexion.inc.php');
require(__DIR__ .'/model.inc.php');

// verifie que la session est active, sinon reoriente vers la page de login
require(__DIR__ .'/../../../include/verif_session.php');
//verifie que les droits sont valide si la session est active, sinon reoriente vers la page de login
include("../../../include/verif_droits.php");

// préparation connexion
$connect = new connection();
$entreprise = new entreprise($connect);

if(isset($_GET["id_activite"])){
		
$result=$entreprise->infosActivite($_GET["id_activite"]); 	
	
switch ($result[2]) 
{ 
    case "#00c0ef": 
        $color="rgb(0, 192, 239)";
    break;
	case "#0073b7": 
        $color="rgb(0, 115, 183)"; 
    break;
	case "#3c8dbc": 
        $color="rgb(60, 141, 188)"; 
    break;
	case "#39cccc": 
        $color="rgb(57, 204, 204)"; 
    break;
	case "#f39c12": 
        $color="rgb(243, 156, 18)"; 
    break;
	case "#ff851b": 
        $color="rgb(255, 133, 27)";
    break;
	case "#00a65a": 
        $color="rgb(0, 166, 90)"; 
    break;
	case "#01ff70": 
        $color="rgb(1, 255, 112)"; 
    break;
	case "#dd4b39": 
        $color="rgb(221, 75, 57)"; 
    break;
	case "#605ca8": 
        $color="rgb(96, 92, 168)"; 
    break;
	case "#f012be": 
        $color="rgb(240, 18, 190)"; 
    break;
	
	case "#001f3f": 
        $color="rgb(0, 31, 63)"; 
    break;
	    
}

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
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="../../../plugins/timepicker/bootstrap-timepicker.min.css">
 
 <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../../dist/css/skins/_all-skins.min.css">
    
   <!-- Jquerry ui pour date picker-->
  <link rel="stylesheet" href="../../../plugins/jquery-ui-1.11.4/themes/smoothness/jquery-ui.css">
  <script src="../../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <script src="../../../plugins/jquery-ui-1.11.4/jquery-ui.js"></script>


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
               	
               	
               	
               	
          <div class="form-group has-feedback">
 	 <div class="input-group">
    <span class="input-group-addon">
    <span class="fa fa-heartbeat"></span>
 	 </span>
     <input type="text" class="form-control"  value="<?php if(isset($result[1])) {echo $result[1];} ?>" placeholder="Nom de l'activité" required name="nom" data-error="Veuillez saisir un nom d'activite"> </div>  
     <div class="help-block with-errors"></div>
  
     </div>  
          
          
       <div class="row">
            
            
            <div class="col-md-4">        
          <div class="form-group"><div class="bootstrap-timepicker">
                    <div class="form-group">
                    
                      <div class="input-group">
                      	<div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" id="datepicker" class="form-control" placeholder="Date de l'activité" required data-error="Veuillez choisir une date" name="date">
                         
                      </div><!-- /.input group --><div class="help-block with-errors"></div>
                    </div><!-- /.form group -->
                  </div>
                  <!-- /.input group -->
                </div>  </div>

            
            
            
            <div class="col-md-4">        
          <div class="form-group"><div class="bootstrap-timepicker">
                    <div class="form-group">
                    
                      <div class="input-group">
                      	<div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                     
                        <input type="text" placeholder="heure début" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask required  data-error="Veuillez choisir une heure de début" name="heure_debut">
                        
                      </div><!-- /.input group --><div class="help-block with-errors"></div>
                    </div><!-- /.form group -->
                  </div>
                  <!-- /.input group -->
                </div>  </div>
                
   <div class="col-md-4">        
          <div class="form-group"><div class="bootstrap-timepicker">
                    <div class="form-group">
                    
                      <div class="input-group">
                      	<div class="input-group-addon">
                          <i class="fa fa-clock-o"></i>
                        </div>
                         <input type="text" placeholder="heure fin" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask required  data-error="Veuillez choisir une heure de fin" name="heure_fin">
                        
                      </div><!-- /.input group --><div class="help-block with-errors"></div>
                    </div><!-- /.form group -->
                  </div>
                  <!-- /.input group -->
                </div>  </div>
                </div>
          
                <div class="form-group has-feedback">       
          <div class="input-group">
      	<textarea class="form-control" rows="4" cols="300" placeholder="Description de l'activité..." name="description"><?php if(isset($result[6])) {echo $result[6];} ?></textarea>
         </div>
 </div>
            
          
  
      <div class="row">
            
            <div class="col-md-6">     
    <div class="form-group has-feedback">
 	 <div class="input-group">
    <span class="input-group-addon">
    <span class="fa fa-map-marker"></span>
 	 </span>
     <input type="lieu"   value="<?php if(isset($result[8])) {echo $result[8];} ?>" class="form-control" placeholder="Lieu" required name="lieu" data-error="Veuillez saisir un lieu">  </div> 
     <div class="help-block with-errors"></div>
  
     </div>    </div>    
          
          
     <div class="col-md-6">     
 <div class="form-group has-feedback">
 	 <div class="input-group">
    <span class="input-group-addon">
    <span class="fa fa-map-marker "></span>
 	 </span>
     <input type="text"  value="<?php if(isset($result[9])) {echo $result[9];} ?>" class="form-control" placeholder="Lieu de repli" name="repli"> </div>  
    
   
     </div> </div> </div>        
         
         
         
         
        <div class="row">
            
            <div class="col-md-6">      
      <div class="form-group has-feedback">
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-code"></i>
                  </div>
                  	   
                    
                   <input type="text"  id="add-new-event" placeholder="Cliquez sur une couleur." name="couleur" class="form-control" required data-error="Veuillez choisir une couleur" value="<?php if(isset($color)) {echo $color;} ?>"></div>
                   &nbsp;  <div class="help-block with-errors"></div>
                    <ul class="fc-color-picker" id="color-chooser">
                      <li><a class="text-aqua" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
                      <li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
                    </ul>
                  
                     
             
               
                 
                  </div>
  
  </div>

<div class="col-md-6"> 
<div class="form-group has-feedback">
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-ticket"></i>
                  </div>
                  <input class="form-control" type="text"  value="<?php if(isset($result[12])) {echo $result[12];} ?>" placeholder="Limite du nombre de places - [illimité : ne rien mettre]"  name="limite" > </div>
                  
</div></div>
</div>

     
     <!-- /.box -->         
                
               <br>
               
              
              <!-- /.box-body -->
              <div class="box-footer">
              	 <button type="button" class="btn btn-default" onclick="window.location.href='../dashboard/index.php'"><i class="fa fa-arrow-circle-left"></i> Annuler</button>  
                <button type="submit" class="btn btn-primary" ><i class="fa fa-floppy-o"></i> &nbsp; Créer l'activité</button>
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
    
     <script src="../../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../../plugins/datatables/dataTables.bootstrap.min.js"></script>
    
    
     <!-- InputMask -->
    <script src="../../../plugins/input-mask/jquery.inputmask.js"></script>
    <script src="../../../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="../../../plugins/input-mask/jquery.inputmask.extensions.js"></script>

    <!-- jQuery UI 1.11.4 -->
    <script src="../../../plugins/jquery-ui-1.11.4/jquery-ui.min.js"></script>
    
    
    <!--Validation du formulaire -->
    <script src="../../../include/js/validator.js"></script>
    
    
    	
    <script>
      $(function () {

  /* ADDING EVENTS */
     var currColor = "<?php if(isset($color)) {echo "$color\";";
        
        
          echo" $('#add-new-event').css({\"background-color\": currColor, \"border-color\": currColor});
          $(\"#add-new-event\").val(currColor);";
        
        
        }else{
        	
        	echo "#3c8dbc\";";
        
	
	  
	  
	  
	  } ?> //Red by default
        
         
          
        //Color chooser button
        var colorChooser = $("#color-chooser-btn");
        $("#color-chooser > li > a").click(function (e) {
          e.preventDefault();
          //Save color
          currColor = $(this).css("color");
          //Add color effect to button
          $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
          $("#add-new-event").val(currColor);
        });
        $("#add-new-event").click(function (e) {
          e.preventDefault();
          //Get value and make sure it is not null
          var val = $("#new-event").val();
          if (val.length == 0) {
            return;
          }

       
        });
      
        
  		//masque de saisie heure 
         $("#datemask").inputmask("hh:mm", {"placeholder": "hh:mm"});
         $("[data-mask]").inputmask();      
       
        
        // datepicker Jquery UI
  		$( "#datepicker" ).datepicker({
altField: "#datepicker",
closeText: 'Fermer',
prevText: 'Précédent',
nextText: 'Suivant',
currentText: 'Aujourd\'hui',
monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
weekHeader: 'Sem.',
dateFormat: 'dd-mm-yy',
firstDay : 1
});
        
      });
    </script>


  </body>
</html>