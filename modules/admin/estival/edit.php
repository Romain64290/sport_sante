<?php

/***** Dernière modification : 29/05/2017, Romain TALDU	*****/

$id_activite=$_GET['id_activite'];
$origine=$_GET['origine'];

// verifie si la varaible $emailabsent existe
$emailabsent = isset($_GET['emailabsent']) ? $_GET['emailabsent'] : NULL;

$menu=2;
if($origine=="calendrier"){$ss_menu=22;}else{$ss_menu=23;}


require(__DIR__ .'/../../../include/config.inc.php');
require(__DIR__ .'/../../../include/connexion.inc.php');
require(__DIR__ .'/model.inc.php');

// verifie que la session est active, sinon reoriente vers la page de login
require(__DIR__ .'/../../../include/verif_session.php');
//verifie que les droits sont valide si la session est active, sinon reoriente vers la page de login
include("../../../include/verif_droits.php");

// préparation connexion
$connect = new connection();
$estival = new estival($connect);


$result=$estival->infosActivite($id_activite); 
 
$date_jour= date('Y-m-d H:i:s');
 
$date=explode(" ", $result[4]);
$date=explode("-", $date[0]);
$date="$date[2]-$date[1]-$date[0]";


$heure_debut=explode(" ",$result[4]);
$heure_debut=explode(":",$heure_debut[1]);
$heure_debut="$heure_debut[0]:$heure_debut[1]";

$heure_fin=explode(" ",$result[5]);
$heure_fin=explode(":",$heure_fin[1]);
$heure_fin="$heure_fin[0]:$heure_fin[1]";

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
   
 
    <!-- fullCalendar 2.2.5-->
    <link rel="stylesheet" href="../../../plugins/fullcalendar/fullcalendar.min.css">
    <link rel="stylesheet" href="../../../plugins/fullcalendar/fullcalendar.print.css" media="print">

    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../../dist/css/skins/_all-skins.min.css">
    
     <!-- Jquerry ui pour date picker-->
  <link rel="stylesheet" href="../../../plugins/jquery-ui-1.11.4/themes/smoothness/jquery-ui.css">
  <script src="../../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <script src="../../../plugins/jquery-ui-1.11.4/jquery-ui.js"></script>

        <!-- fenetres popup-->
  <link rel="stylesheet" href="../../../plugins/sweetalert2/sweetalert2.min.css">

  </head>
 
  <body class="hold-transition skin-blue sidebar-mini" <?php if($emailabsent=="ok"){echo"onload=\"Emailabsent();\"";} ?>>
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
            Editer une activité
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="../index.php"><i class="fa fa-heartbeat"></i> Accueil</a></li>
            <li class="active">Editer une activité</li>
          </ol>
        </section>

      



  	<!-- Main content -->
        <section class="content">
          <div class="row">
            
            <div class="col-md-9">
              <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Activité à modifier</h3>
              <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
             <form name="inscriptionForm"  id="inscriptionForm" role="form" data-toggle="validator" action="edit02.php" method="post" data-disable="false">
             	
              <div class="box-body">
               	
               	
               	
               	
          <div class="form-group has-feedback">
 	 <div class="input-group">
    <span class="input-group-addon">
    <span class="fa fa-heartbeat"></span>
 	 </span>
     <input type="text" class="form-control" value="<?php echo $result[1]; ?>" placeholder="Nom de l'activité" required name="nom" data-error="Veuillez saisir un nom d'activite"> </div>  
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
                        <input type="text" id="datepicker" class="form-control" placeholder="Date de l'activité" required data-error="Veuillez choisir une date" name="date" value="<?php echo $date; ?>">
                         
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
                         <input type="text" placeholder="heure debut" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask required  data-error="Veuillez choisir une heure de début" name="heure_debut" value="<?php echo $heure_debut; ?>">
                        
                        
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
                
                         <input type="text" placeholder="heure fin" class="form-control" data-inputmask="'alias': 'hh:mm'" data-mask required  data-error="Veuillez choisir une heure de fin" name="heure_fin" value="<?php echo $heure_fin; ?>">
                        
                      </div><!-- /.input group --><div class="help-block with-errors"></div>
                    </div><!-- /.form group -->
                  </div>
                  <!-- /.input group -->
                </div>  </div>
                </div>
          
                <div class="form-group has-feedback">       
          <div class="input-group">
      	<textarea class="form-control" rows="4" cols="300" placeholder="Description de l'activité..." name="description"><?php echo $result[6]; ?></textarea>
         </div>
 </div>
      <div class="form-group has-feedback">
 	 <div class="input-group">
    <span class="input-group-addon">
    <span class="fa fa-link"></span>
 	 </span>
     <input type="text" value="<?php echo $result[7]; ?>" class="form-control" placeholder="Association" required name="association" data-error="Veuillez saisir une association"></div>  
     <div class="help-block with-errors"></div>
   
     </div>         
          
  
      <div class="row">
            
            <div class="col-md-6">     
    <div class="form-group has-feedback">
 	 <div class="input-group">
    <span class="input-group-addon">
    <span class="fa fa-map-marker"></span>
 	 </span>
     <input type="lieu" value="<?php echo $result[8]; ?>" class="form-control" placeholder="Lieu" required name="lieu" data-error="Veuillez saisir un lieu">  </div> 
     <div class="help-block with-errors"></div>
  
     </div>    </div>    
          
          
     <div class="col-md-6">     
 <div class="form-group has-feedback">
 	 <div class="input-group">
    <span class="input-group-addon">
    <span class="fa fa-map-marker "></span>
 	 </span>
     <input type="text" value="<?php echo $result[9]; ?>" class="form-control" placeholder="Lieu de repli" name="repli"> </div>  
    
   
     </div> </div> </div>        
         
         
           <div class="row">
            <div class="col-md-12">     
      <div class="form-group has-feedback">
 	 <div class="input-group">
    <span class="input-group-addon">
    <span class="fa fa-google"></span>
 	 </span>
     <input type="text" class="form-control"  value="<?php echo $result[13]; ?>" placeholder="Lien Google Map" required name="lien_map" data-error="Veuillez saisir le lien google map"></div>  
     <div class="help-block with-errors"></div>
   
     </div>
      </div> </div>    
         
        <div class="row">
            
            <div class="col-md-6">      
  <div class="form-group has-feedback">
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-users"></i>
                  </div>
                  <input class="form-control" type="text" value="<?php echo $result[10]; ?>" placeholder="Public" required name="public" data-error="Veuillez saisir un type de public"> </div>
                   <div class="help-block with-errors"></div>
</div></div>

<div class="col-md-6"> 
<div class="form-group has-feedback">
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-ticket"></i>
                  </div>
                  <input class="form-control" type="text" value="<?php echo $result[12]; ?>" placeholder="Limite du nombre de places - [illimité : ne rien mettre]"  name="limite" > </div>
                  
</div></div>
</div>

      <div class="row">
            
            <div class="col-md-4"> 

     <div class="form-group has-feedback">
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-code"></i>
                  </div>
                  	   
                    
                   <input type="text"  id="add-new-event" placeholder="Cliquez sur une couleur." name="couleur" class="form-control" required data-error="Veuillez choisir une couleur" value="<?php echo $color; ?>"></div>
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
               </div>  </div>
     <!-- /.box -->         
                
               <br>
               
               
               
               
               
              
              <!-- /.box-body -->
              <div class="box-footer">
              	<div class="row">
            
            <div class="col-md-6"> 
              	 <button type="button" class="btn btn-default"  onclick="window.history.back();"><i class="fa fa-arrow-circle-left"></i> Annuler</button> &nbsp;
              	 <button type="button" class="btn btn-info" onclick="window.location.href='ajout_activite.php?id_activite=<?php echo $id_activite; ?>'" ><i class="fa fa-files-o"></i> &nbsp;Dupliquer cette activité</button>&nbsp; 
                <button type="submit" class="btn btn-primary" ><i class="fa fa-floppy-o"></i> &nbsp;Enregistrer les modifications</button>
              </div>
              <div class="col-md-2"></div>
              <div class="col-md-4"align="right">
               <button type="button" class="btn btn-danger" onclick="suppActivite(<?php echo $id_activite; ?>,new String('<?php echo addslashes($result[1]); ?>'),new String('<?php echo $origine; ?>'));"><i class="fa fa-trash-o"></i>&nbsp; Supprimer l'activité</button>
              </div>
              </div>
             <input type="hidden" name="origine" value="<?php echo $origine; ?>">
             <input type="hidden" name="id_activite" value="<?php echo $id_activite; ?>">
              
             
              
              
            </form>
          </div>

            </div><!-- /.col -->
          </div><!-- /.row -->
          
          
         
               
          <div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Liste des inscrits</h3>
    <div class="box-tools pull-right">
      <!-- Buttons, labels, and many other things can be placed here! -->
      <!-- Here is a label for example -->
     
    </div><!-- /.box-tools -->
  </div><!-- /.box-header -->
  <div class="box-body">
   
  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                      	<th>#</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date de naissance</th>
                        <th>Présence</th>
                        <th>Supp.</th>
                      </tr>
                    </thead>
                    <tbody>
                  
<?php 

$data=$estival->afficheUser($id_activite); 

$compteur = 1;

	 foreach($data as $event){
			
			$id=$event->id_estival_user;
			$nom=htmlspecialchars($event->nom_estival_user);
		    $prenom=htmlspecialchars($event->prenom_estival_user);
			$naissance=$event->age_estival_user;
			$presence_reunion=$event->presence_reunion;
			
			$nomjs="$nom $prenom";
			$nomjs=addslashes($nomjs);
	

echo"<tr>
            <td style=\"width:5%; text-align: left\">$compteur</td>
            <td style=\"width: 25%; text-align: left\">$nom</td>
            <td style=\"width: 25%; text-align: left\">$prenom</td>
            <td style=\"width: 20%; text-align: left\">$naissance</td>
            <td style=\"width: 10%; text-align: center\"><input type=\"checkbox\"";
            
if ($presence_reunion == 1){echo " onclick=\"location.href='change_presence.php?id_user=$id&etat=0&id_activite=$id_activite';\" checked  ></td>";}else{echo " onclick=\"location.href='change_presence.php?id_user=$id&etat=1&id_activite=$id_activite';\"></td>";}		
      
            
echo"            <td style=\"width: 15%; text-align: center\"><a href=\"#\" onclick=\"suppUser($id_activite,$id,new String('$nomjs'));\"><span class=\"label label-danger\">&nbsp;Supp.&nbsp;&nbsp;<i class=\"fa fa-trash-o\"></i></span></a></td>
        </tr>";

	$compteur++;		
		
	   
		   
          
        }

?>
                  
                    </tbody>
                   
                  </table>



  </div><!-- /.box-body -->
 
</div><!-- /.box -->
          
 
 
 
 
  <div class="row">
            
            <div class="col-md-12">
              <div class="box box-primary collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">Envoyer un email aux absents</h3>
               <div class="box-tools pull-right">
      <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-plus"></i></button>
      <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
    </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
                <form name="inscriptionForm"  id="inscriptionForm" role="form" data-toggle="validator" action="envoi_email_absent.php" method="post" data-disable="false">
                <input type="hidden" name="id_activite" value="<?php echo $id_activite; ?>">
              <div class="box-body">
           
           
            <div class="row">
            <div class="col-md-12">
     
           
           
           <?php
           $etat_bouton="";
           $detail_disabled ="";
           
		   //verifie si date reunion est passé et si email pas deja envoye
           if($result[5]>$date_jour){ $etat_bouton="disabled"; $detail_disabled ="La date de l'activité n'est pas encore passée";}
		   else{if($result[14]==1){$etat_bouton="disabled";$detail_disabled="L'email à déja été envoyé";}}
		   
             
           
           
           ?>
           
           
           
           
  
              	<button type="submit" class="btn btn-warning" <?php echo $etat_bouton; ?>><i class="fa fa-floppy-o"></i> &nbsp; Envoyer l'email aux absents</button> &nbsp;&nbsp;&nbsp;<?php echo $detail_disabled; ?>
              	
               
			 </div>	
 </div>	 </div>	 </div>	 </div>	 </div>	
 
 
 
 
 
 
 
 
          
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
    
    
    

    <!-- jQuery UI -->
     <script src="../../../plugins/jquery-ui-1.11.4/jquery-ui.min.js"></script>
    <!-- Slimscroll -->
    <script src="../../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../../../plugins/fastclick/fastclick.min.js"></script>
   
    <!-- AdminLTE for demo purposes -->
    <script src="../../../dist/js/demo.js"></script>
    <!-- fullCalendar -->
    <script src="../../../plugins/fullcalendar-2.7.2/lib/moment.min.js"></script>
    <script src="../../../plugins/fullcalendar/fullcalendar.min.js"></script>
    <!-- Page specific script -->
    
    <!--Validation du formulaire -->
    <script src="../../../include/js/validator.js"></script>
     <script src="../../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../../plugins/datatables/dataTables.bootstrap.min.js"></script>
    
      <!--Fenetre popup -->
     <script src="../../../plugins/sweetalert2/sweetalert2.min.js"></script>
     <script src="https://cdn.jsdelivr.net/es6-promise/latest/es6-promise.auto.min.js"></script> <!-- IE support -->
    
    
    	
    <script>
      $(function () {


        /* ADDING EVENTS */
        var currColor = "<?php echo $color; ?>"; //Red by default
        
         $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
          $("#add-new-event").val(currColor);
        
        
        
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
        
        
        
        
   
    
        $('#example1').DataTable({
        "stateSave": true,
         "stateDuration": 60 * 3,	
          "ordering": false,
           "language": {
            "lengthMenu": "_MENU_  enregistements par page",
            "zeroRecords": "Désolé, aucun résultat trouvé.",
            "info": "Affichage page _PAGE_ sur _PAGES_",
            "infoEmpty": "Aucun enregistrement disponible",
            "infoFiltered": "(filtered from _MAX_ total records)",
             "search": "Recherche",
             "paginate": {
       			 "first":      "First",
       			 "last":       "Last",
        		 "next":       "Suivant",
        		 "previous":   "Précédent"
  				  },
         
        }
       
       
      });
     
        
      });
      
  function suppUser(idactivite,iduser,utilisateur) {
  	  
  swal({
  title: 'Etes vous sûr de vouloir supprimer cet utilisateur ?',
  text: ""+utilisateur,
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Oui, on supprime !',
  cancelButtonText: 'Annuler !'
}).then(function () {
 document.location.href="supp_user.php?id_user="+iduser+"&id_activite="+idactivite;
})
    
 }   
 
  function suppActivite(idactivite,activite,origine) {
  	  
  swal({
  title: 'Etes vous sûr de vouloir supprimer cette activite ?',
  text: ""+activite,
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Oui, on supprime !',
  cancelButtonText: 'Annuler !'
}).then(function () {
 document.location.href="supp_activite.php?id_activite="+idactivite+"&origine="+origine; 
 
 })
    
 }  
 
 
 function Emailabsent() {
  	  
  swal({
  title: 'Email aux absents envoyé avec succès !',
  text: "",
  type: 'success',

})
    
 }          
      
    </script>


  </body>
</html>