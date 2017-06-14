<?php

/***** Dernière modification : 19/05/2017, Romain TALDU	*****/

require(__DIR__ .'/../../include/config.inc.php');
require(__DIR__ .'/../../include/connexion.inc.php');
require(__DIR__ .'/model.inc.php');
session_start();

// préparation connexion
$connect = new connection();
$fo_estival = new fo_estival($connect);

$session_activite = isset($_SESSION['activite']) ? $_SESSION['activite'] : NULL;
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
	
	.mentions{
  padding-left : 15px;
  padding-right : 5px;
  padding-top : 10px;
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
  	<!-- Main content -->
  	
  
			<div class="masqueimgpourmobile">
			<img src="images/frise.png" style="position:absolute; top:10px; right: 50px;">
			</div>
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
         $nb_articles = count($session_activite['id_activite']);
         if($nb_articles ==0){echo"Aucune activité sélectionnée.";}
         
                    for($i = 0; $i < $nb_articles; $i++)
    {
           
      echo"<div class=\"external-event ".$session_activite['color'][$i]."\">".$session_activite['titre'][$i]." ".$session_activite['date'][$i]."&nbsp;&nbsp;&nbsp;
           <div style=\"float:right;\"><button type = \"button\" onclick=\"window.location.href='supprimer_activite.php?supp=".$session_activite['id_activite'][$i]."';\" class = \"btn btn-default btn-xs\" ><span class = \"glyphicon glyphicon-trash \"></span></button></div>	
           </div>";
    
    } 
    	?>
              <br><div align="right"> <button type="button" class="btn btn-primary btn-flat" 
                      	
                      <?php if($nb_articles ==0){echo"onclick=\"alert('Merci de sélectionner au moins une activité !');\"";}else{echo"onclick=\"window.location.href='inscription.php'\"";} ?>
                 
                    >Valider votre sélection</button></div>
                   
                  </div>
				  <div class="masqueimgpourmobile">
				<img src="images/logo_380.png" style="margin-top:50px" class="img-responsive" alt="En forme à Pau">
				</div>
				 
				 <div class="masqueimgpourmobile">
				 	<div class="row">
            <div class="col-md-4">
				<img src="images/logo_ppp.jpg"  style="margin-top:10px" class="img-responsive" alt="En forme à Pau"></div>
				<div class="col-md-4">
				<img src="images/ars.jpg" style="margin-top:10px" class="img-responsive" alt="En forme à Pau"></div>
				<div class="col-md-4">
				<img src="images/jeunesse.jpg" style="margin-top:10px" class="img-responsive" alt="En forme à Pau"></div>
				</div>
				<div class="row"><div class="mentions">
					<small>Ce dispositif est mis en place avec le financement de l'ARS (Agence Régionale de Santé), le Ministère en charge des Sports et la Région Aquitaine.</small>
					</div></div>
				</div>
				
                </div><!-- /.box-body -->
              </div><!-- /. box -->
             
            </div><!-- /.col -->
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
  	
  	
  	
 <?php require(__DIR__ .'/../../include/footer_front.php'); ?>    
   
            
           
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




 <!-- jQuery 2.1.4 -->
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
     <script src="../../plugins/jquery-ui-1.11.4/jquery-ui.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js"></script>
    
    <!-- fullCalendar -->
     <script src="../../plugins/fullcalendar-2.7.2/lib/moment.min.js"></script>
    <script src="../../plugins/fullcalendar-2.7.2/fullcalendar.min.js"></script>
    <!-- Page specific script -->
    <script src='../../plugins/fullcalendar-2.7.2/lang-all.js'></script>
    
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

$data=$fo_estival->afficheActivite();

//permet de desactiver les activités 4 heures avant leur écheance
$date_jour_plus4=date('Y-m-d H:i:s',strtotime("+4 hours"));




foreach($data as $event){
			
			$id_estival_activite=$event->id_estival_activite;
			$titre_estival_activite=addslashes(htmlspecialchars($event->titre_estival_activite));
			$color_estival_activite=$event->color_estival_activite;
			$start_estival_activite=$event->start_estival_activite;
			$end_estival_activite=$event->end_estival_activite;
			$description_estival_activite=htmlspecialchars($event->description_estival_activite);
			$description_estival_activite = str_replace(array("\r\n", "\r", "\n"), "<br>", $description_estival_activite); 
			$association_estival_activite=htmlspecialchars($event->association_estival_activite);
			$lieu_estival_activite=htmlspecialchars($event->lieu_estival_activite);
			$lieu_repli_estival_activite=htmlspecialchars($event->lieu_repli_estival_activite);
			$public_estival_activite=htmlspecialchars($event->public_estival_activite);
			$inscrit_estival_activite=$event->inscrit_estival_activite;
			$limite_estival_activite=$event->limite_estival_activite;
			
			$description="";
			
			if($limite_estival_activite!=0 AND $inscrit_estival_activite>=$limite_estival_activite)
			{$etat="complet";$color_estival_activite="#666666";$description="<b>[ Cette activité est complète. ]</b><br><br>";}
			else
			{$etat="";}
			
			if($start_estival_activite <$date_jour_plus4){$etat="complet";}
			
			if($limite_estival_activite==0){$limite_estival_activite="Illimité";}
			
			
			$jour_activite=explode(" ",$start_estival_activite);
			$jour_activite=explode("-",$jour_activite[0]);
			$jour_activite=$jour_activite[2]."/".$jour_activite[1];
			
			$heure_debut=explode(" ",$start_estival_activite);
			$heure_debut=explode(":",$heure_debut[1]);
			$heure_debut=$heure_debut[0]."h".$heure_debut[1];
			
			$heure_fin=explode(" ",$end_estival_activite);
			$heure_fin=explode(":",$heure_fin[1]);
			$heure_fin=$heure_fin[0]."h".$heure_fin[1];
			
			
			if($start_estival_activite <$date_jour_plus4){$description="<b>[ La réservation de cette activité est clôturée : 4h avant le début de l'activité. ]</b><br><br>";$color_estival_activite="#666666";}
			
			$description.="<b>Proposée par : </b> ".$association_estival_activite.", le ".$jour_activite." de ".$heure_debut." à ".$heure_fin." : ".$lieu_estival_activite."<br>".$date_jour_plus4;
			
			if($description_estival_activite!=""){$description.="<br><b>Description : </b>".$description_estival_activite."<br>";}
			if($lieu_repli_estival_activite!=""){$description.="<br><b>Lieu de repli : </b>".$lieu_repli_estival_activite."<br>";}
				
			$description.="<b>Public visé : </b>".$public_estival_activite."<br><b>Nombre de participants : </b> ".$inscrit_estival_activite." / ".$limite_estival_activite."<br><br><b>";
			$description=addslashes($description);
						

			echo	"{
					
					title: '$titre_estival_activite',
					start: '$start_estival_activite',
					end: '$end_estival_activite',
					color: '$color_estival_activite',
					description: '$description',
	      			url: 'ajout_activite.php?ajout=$id_estival_activite',
	      			etat:'$etat'
				},";
		} 

?>],
		
		timeFormat: 'H:mm',
		
		allDaySlot:false,
		minTime:"06:00:00",
	
	defaultDate: '<?php if (!isset($session_activite['date_calendar'][$nb_articles-1])){echo date('Y-m-d');}else{echo $session_activite['date_calendar'][$nb_articles-1];}?>',
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
	
	
</script>
  </body>
</html>
