<?php

/***** Dernière modification : 28/10/2016, Romain TALDU	*****/

require(__DIR__ .'/../../../include/verif_session.php');
//include("../../../include/verif_droits.php");
$menu=3;
$ss_menu=32;
require(__DIR__ .'/../../../include/config.inc.php');
require(__DIR__ .'/../../../include/connexion.inc.php');
require(__DIR__ .'/model.inc.php');


// préparation connexion
$connect = new connection();
$annuel = new annuel($connect);

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

$data=$annuel->afficheActiviteCalendrier(); 

foreach($data as $event){
			
			$id_annuel_activite=$event->id_annuel_activite;
			$titre_annuel_activite=addslashes(htmlspecialchars($event->titre_annuel_activite));
			$color_annuel_activite=$event->color_annuel_activite;
			$start_annuel_activite=$event->start_annuel_activite;
			$end_annuel_activite=$event->end_annuel_activite;
			$public_annuel_activite=htmlspecialchars($event->public_annuel_activite);
			$inscrit_annuel_activite=$event->inscrit_annuel_activite;
			$limite_annuel_activite=$event->limite_annuel_activite;
			
			if($limite_annuel_activite!=0 AND $inscrit_annuel_activite>=$limite_annuel_activite)
			{$etat="complet";$color_annuel_activite="#666666";$titre_annuel_activite=$titre_annuel_activite." [COMPLET]";}
			else
			{$etat="";}
			
			if($limite_annuel_activite==0){$limite_annuel_activite="Illimité";}
						
			$jour_activite=explode(" ",$start_annuel_activite);
			$jour_activite=explode("-",$jour_activite[0]);
			$jour_activite=$jour_activite[2]."/".$jour_activite[1];
			
			$heure_debut=explode(" ",$start_annuel_activite);
			$heure_debut=explode(":",$heure_debut[1]);
			$heure_debut=$heure_debut[0]."h".$heure_debut[1];

						

			echo "{
					
					title: '$titre_annuel_activite',
					start: '$start_annuel_activite',
					end: '$end_annuel_activite',
					color: '$color_annuel_activite',
					description: '',
	      			url: 'edit.php?id_activite=$id_annuel_activite&origine=calendrier',
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