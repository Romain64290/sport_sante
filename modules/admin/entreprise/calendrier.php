<?php

/***** Dernière modification : 04/05/2017, Romain TALDU	*****/


$menu=4;
$ss_menu=42;
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
	 
	    	    
	events: [
	
<?php  

$data=$entreprise->afficheActiviteCalendrier();


foreach($data as $event){
			
			$id_entreprise_activite=$event->id_entreprise_activite;
			$titre_entreprise_activite=addslashes(htmlspecialchars($event->titre_entreprise_activite));
			$color_entreprise_activite=$event->color_entreprise_activite;
			$start_entreprise_activite=$event->start_entreprise_activite;
			$end_entreprise_activite=$event->end_entreprise_activite;
			$description_entreprise_activite=htmlspecialchars($event->description_entreprise_activite);
			$description_entreprise_activite = str_replace(array("\r\n", "\r", "\n"), "<br>", $description_entreprise_activite); 
			$association_entreprise_activite=htmlspecialchars($event->association_entreprise_activite);
			$lieu_entreprise_activite=htmlspecialchars($event->lieu_entreprise_activite);
			$lieu_repli_entreprise_activite=htmlspecialchars($event->lieu_repli_entreprise_activite);
			$public_entreprise_activite=htmlspecialchars($event->public_entreprise_activite);
			$inscrit_entreprise_activite=$event->inscrit_entreprise_activite;
			$limite_entreprise_activite=$event->limite_entreprise_activite;
			
			if($limite_entreprise_activite!=0 AND $inscrit_entreprise_activite>=$limite_entreprise_activite)
			{$etat="complet";$color_entreprise_activite="#666666";$titre_entreprise_activite=$titre_entreprise_activite." [COMPLET]";}
			else
			{$etat="";}
			
			
			if($limite_entreprise_activite==0){$limite_entreprise_activite="Illimité";}
			
			
			$jour_activite=explode(" ",$start_entreprise_activite);
			$jour_activite=explode("-",$jour_activite[0]);
			$jour_activite=$jour_activite[2]."/".$jour_activite[1];
			
			$heure_debut=explode(" ",$start_entreprise_activite);
			$heure_debut=explode(":",$heure_debut[1]);
			$heure_debut=$heure_debut[0]."h".$heure_debut[1];
			
			$heure_fin=explode(" ",$end_entreprise_activite);
			$heure_fin=explode(":",$heure_fin[1]);
			$heure_fin=$heure_fin[0]."h".$heure_fin[1];
			
			
			$description="<b>Porposée par : </b> ".$association_entreprise_activite.", le ".$jour_activite." de ".$heure_debut." à ".$heure_fin." à ".$lieu_entreprise_activite."<br>";
			
			if($description_entreprise_activite!=""){$description.="<br><b>Description : </b>".$description_entreprise_activite."<br>";}
			if($lieu_repli_entreprise_activite!=""){$description.="<br><b>Lieu de repli : </b>".$lieu_repli_entreprise_activite."<br>";}
				
			$description.="<b>Public visé : </b>".$public_entreprise_activite."<br><b>Nombre de participants : </b> ".$inscrit_entreprise_activite." / ".$limite_entreprise_activite."<br><br><b>";
			$description=addslashes($description);
						

			echo "{
					
					title: '$titre_entreprise_activite',
					start: '$start_entreprise_activite',
					end: '$end_entreprise_activite',
					color: '$color_entreprise_activite',
					description: '$description',
	      			url: 'edit.php?id_activite=$id_entreprise_activite&origine=calendrier',
	      			etat:'$etat'
				},";
		} 


?>],

		
		timeFormat: 'H:mm',
		//displayEventEnd: true,
		allDaySlot:false,
		minTime:"06:00:00",
   
	  });

	});
	
	
</script>

  </body>
</html>