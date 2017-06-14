<?php

/***** Dernière modification : 28/10/2016, Romain TALDU	*****/

require(__DIR__ .'/../../../include/verif_session.php');
//include("../../../include/verif_droits.php");
$menu=6;
$ss_menu=61;
require(__DIR__ .'/../../../include/config.inc.php');
require(__DIR__ .'/../../../include/connexion.inc.php');
require(__DIR__ .'/model.inc.php');


// préparation connexion
$connect = new connection();
$annuel = new annuel($connect);

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
<!-- fullCalendar -->
    <link rel="stylesheet" href="../../../plugins/fullcalendar-2.7.2/fullcalendar.min.css">
    <link rel="stylesheet" href="../../../plugins/fullcalendar-2.7.2/fullcalendar.print.css" media="print">
    
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
            Calendrier
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="../index.php"><i class="fa fa-heartbeat"></i> Accueil</a></li>
            <li class="active">Calendrier</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">


 <div class="row">
  <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-body no-padding">
                  <!-- THE CALENDAR -->
                  
                 
                  <div id="calendar"></div>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->


        </section><!-- /.content -->
      </div><!-- /.content-wrapper --> 
   
 <?php require(__DIR__ .'/../../../include/footer_back.php'); ?>
 
            
           
<div id="fullCalModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
        <h4 id="modalTitle" class="modal-title"></h4>
      </div>
      <div id="modalBody" class="modal-body"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
        <a class="btn btn-primary" id="eventUrl" target="_blank "role="button">Ajouter cette activité à la sélection</a>
      </div>
    </div>
  </div>
</div>


<div id="fullCalModal2" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
        <h4 id="modalTitle2" class="modal-title"></h4>
      </div>
      <div id="modalBody2" class="modal-body"></div>
      <div class="modal-footer">
       <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
        <a class="btn btn-primary" id="eventUrl" target="_blank "role="button" disabled>Ajouter cette activité à la sélection</a>
      </div>
    </div>
  </div>
</div>

 
   
   
    <!-- REQUIRED JS SCRIPTS -->
    <!-- jQuery 2.1.4 -->
    <script src="../../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../../../bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../../dist/js/app.min.js"></script>
        <!-- fullCalendar 2.2.5 -->
    <script src="../../../plugins/fullcalendar-2.7.2/lib/moment.min.js"></script>
    <script src="../../../plugins/fullcalendar-2.7.2/fullcalendar.min.js"></script>
     <!-- Page specific script -->
    <script src='../../../plugins/fullcalendar-2.7.2/lang-all.js'></script>
    
    <script src="../../../plugins/sweetalert2/sweetalert2.min.js"></script>
    
    
    <script>
    
  $(document).ready(function() {

	  var date = new Date();
	  var d = date.getDate();
	  var m = date.getMonth();
	  var y = date.getFullYear();
	  
	 

	  $('#calendar').fullCalendar({
		lang:'fr',
	    header: {
	        left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek'
	    },

	    eventLimit: true, // allow "more" link when too many events
	    // DAFFY FOR GAFE TUTORIAL Shared Calendar 
	    // PUT THE URL TO YOUR SHARED GOOGLE CALENDAR XML FEED BETWEEN THESE SINGLE QUOTES
	    // AND MAKE SURE TO USE https INSTEAD OF PLAIN OLD http
	 
	    	    
	events: [
	
<?php   

$data=$annuel->afficheActiviteCalendrier(); 

$date_jour=date('Y-m-d H:i:s');

foreach($data as $event){
			
			$id_annuel_activite=$event->id_annuel_activite;
			$titre_annuel_activite=addslashes(htmlspecialchars($event->titre_annuel_activite));
			$color_annuel_activite=$event->color_annuel_activite;
			$start_annuel_activite=$event->start_annuel_activite;
			$end_annuel_activite=$event->end_annuel_activite;
			$description_annuel_activite=htmlspecialchars($event->description_annuel_activite);
			$description_annuel_activite = str_replace(array("\r\n", "\r", "\n"), "<br>", $description_annuel_activite); 
			$association_annuel_activite=htmlspecialchars($event->association_annuel_activite);
			$lieu_annuel_activite=htmlspecialchars($event->lieu_annuel_activite);
			$lieu_repli_annuel_activite=htmlspecialchars($event->lieu_repli_annuel_activite);
			$public_annuel_activite=htmlspecialchars($event->public_annuel_activite);
			$inscrit_annuel_activite=$event->inscrit_annuel_activite;
			$limite_annuel_activite=$event->limite_annuel_activite;
			
			
			
		$description="";
			
			if($limite_annuel_activite!=0 AND $inscrit_annuel_activite>=$limite_annuel_activite)
			{$etat="complet";$color_annuel_activite="#666666";$description="<b>[ Cette activité est complète. ]</b><br><br>";}
			else
			{$etat="";}
			
			if($start_annuel_activite <$date_jour){$etat="complet";}
			
			if($limite_annuel_activite==0){$limite_annuel_activite="Illimité";}
						
			$jour_activite=explode(" ",$start_annuel_activite);
			$jour_activite=explode("-",$jour_activite[0]);
			$jour_activite=$jour_activite[2]."/".$jour_activite[1];
			
			$heure_debut=explode(" ",$start_annuel_activite);
			$heure_debut=explode(":",$heure_debut[1]);
			$heure_debut=$heure_debut[0]."h".$heure_debut[1];

			$heure_fin=explode(" ",$end_annuel_activite);
			$heure_fin=explode(":",$heure_fin[1]);
			$heure_fin=$heure_fin[0]."h".$heure_fin[1];
			
			if($start_annuel_activite <$date_jour){$description="<b>[ Cette activité est terminée. ]</b><br><br>";}
			
			$description.="<b>Proposée par : </b> ".$association_annuel_activite.", le ".$jour_activite." de ".$heure_debut." à ".$heure_fin." : ".$lieu_annuel_activite."<br>";
			
			if($description_annuel_activite!=""){$description.="<br><b>Description : </b>".$description_annuel_activite."<br>";}
			if($lieu_repli_annuel_activite!=""){$description.="<br><b>Lieu de repli : </b>".$lieu_repli_annuel_activite."<br>";}
				
			$description.="<b>Public visé : </b>".$public_annuel_activite."<br><b>Nombre de participants : </b> ".$inscrit_annuel_activite." / ".$limite_annuel_activite."<br><br><b>";
			$description=addslashes($description);
						

			echo "{
					
					title: '$titre_annuel_activite',
					start: '$start_annuel_activite',
					end: '$end_annuel_activite',
					color: '$color_annuel_activite',
					description: '$description',
	      			url: 'ajout_activite_membre.php?ajout=$id_annuel_activite',
	      			etat:'$etat'
				},";

}

?>],

		
	timeFormat: 'H:mm',
		
		allDaySlot:false,
		minTime:"06:00:00",
	
	
	defaultView: 'month',
			
		eventClick: function(event, jsEvent, view) {
		   if(event.etat==''){
		  $('#modalTitle').html(event.title);
	      $('#modalBody').html(event.description);
	      $('#eventUrl').attr('href', event.url);
	      $('#eventUrl').attr('target','_self');
	      $('#fullCalModal').modal();
	      return false;}
	      else{
	      $('#modalTitle2').html(event.title);
	      $('#modalBody2').html(event.description);
	      $('#fullCalModal2').modal();
	      return false;	
	      	
	      											}
	      
	    },
  
  
	  });
//recupere si la vue est en mois ou semaine pour affichage perso apres siaie du panier	  
//var view = $('#calendar').fullCalendar('getView');
//alert("The view's title is " + view.name );
	});
	
	
$(function() {

<?php if($success=="ok"){echo" 

swal(
  'Inscription validée!',
  'Cette activité a été ajoutée à votre liste \"Mes activités\"!',
  'success'
)";}
?>

<?php if($success=="deja"){echo" 

swal(
  'Inscription refusée!',
  'Vous êtes déjà inscrit(e) à cette activité.',
  'error'
)";}
?>

<?php if($success=="complet"){echo" 

swal(
  'Inscription refusée!',
  'Désolé, cette activité est désormais complète.',
  'error'
)";}
?>


});
	
	
</script>

  </body>
</html>