<?php

 //***** Dernière modification : 17/06/2016, Romain TALDU	*****/

require(__DIR__ .'/../../../include/verif_session.php');
$menu=1;
require(__DIR__ .'/../../../include/config.inc.php');
require(__DIR__ .'/../../../include/connexion.inc.php');
require(__DIR__ .'/model.inc.php');

 if($_SESSION['id_typemembre']==1){header('Location: ../annuel/mon_calendrier.php');exit;}else{
 	

//memorise l'ouverture/fermeture du panel estival
//memorise l'ouverture/fermeture du panel entreprise


// préparation connexion
$connect = new connection();
$dashboard = new dashboard($connect);

// verifie si l'annee des stats est selectionné ou pas
$annee_estival = empty($_POST['annee_estival']) ? date("Y") : $_POST['annee_estival'];

//Les années des entreprises sont decalées ex 2016/2017. la valeur est la premiere des dates : ici 2016. 
//La bascule se faire au 30 juillet.
$annee_entreprise = empty($_POST['annee_entreprise']) ? date("Y") : $_POST['annee_entreprise'] ;

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
     
    
    <script src="../../../plugins/Chart.js-master/dist/Chart.js"></script>

<style>
	
.hauteur {
    height: 60px;
   
}	
	
</style>

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
            Tableau de bord
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Accueil</a></li>
            <li class="active">Tableau de bord</li>
          </ol>
        </section>

        <!-- Main content -->
    
        <section class="content">
             <form action="index.php" method="post">  
     <!-- Info boxes -->
     
         
         <div class="row">
            <div class="col-md-12">
              <div class="box box-primary collapsed-box">
                <div class="box-header with-border">
                  <h3 class="box-title">STATISTIQUES : Estival</h3>
                  <div class="box-tools pull-right">
                   <!-- <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
                     <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                 
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                	
             <div class="row">
                 <div class="col-md-12">   
            
            <div class="form-group has-feedback">
 	 <div class="input-group">
 <span class="input-group-addon">
    <span class="fa fa-pie-chart"></span>
 	 </span>
           	 <select name="annee_estival" class="form-control" onchange="this.form.submit()">
                <option value="2016" <?php if ($annee_estival ==2016){echo "selected";} ?> >Saison : 2016</option>
                <option value="2017" <?php if ($annee_estival ==2017){echo "selected";} ?> >Saison : 2017</option>
                <option value="2018" <?php if ($annee_estival ==2018){echo "selected";} ?> >Saison : 2018</option>
            </select>            
        
     </div>  </div>  
            </div>  </div>
  	
                	
                	
                	
                	<div class="row">
                   
                    <div class="col-md-2">
                    <div class="description-block hauteur border-right">
                      <div class="description-block hauteur">
                      	<span class="info-box-icon bg-red"><i class="fa fa-heartbeat"></i></span>
                     <br>
                     <span class="description-text">Activités</span>
                        <h5 class="description-header"><?php $dashboard->afficheNbreActivites($annee_estival);?></h5>
                         <br>
                      </div><!-- /.description-block hauteur -->
                    </div>   </div>
                    
                    <div class="col-md-2">
                    <div class="description-block hauteur border-right">
                      <div class="description-block hauteur">
                      	 <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>
                     <br>
                     <span class="description-text">PARTICIPANTS</span>
                        <h5 class="description-header"><?php $dashboard->afficheNbreParticipants($annee_estival);?></h5>
                         <br>
                      </div><!-- /.description-block hauteur -->
                    </div>   </div>


					<div class="col-md-2">
                    <div class="description-block hauteur border-right">
                      <div class="description-block hauteur">
                      <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>
                     <br>
                     <span class="description-text">Participations</span>
                        <h5 class="description-header"><?php $dashboard->afficheNbreParticipations($annee_estival);?></h5>
                         <br>
                      </div><!-- /.description-block hauteur -->
                    </div>   </div>
                    
                    <div class="col-md-2">
                    <div class="description-block hauteur border-right">
                      <div class="description-block hauteur">
                      	 <span class="info-box-icon bg-yellow"><i class="fa fa-birthday-cake"></i></span>
                     <br>
                     <span class="description-text">Moyenne d'age</span>
                        <h5 class="description-header"><?php $dashboard->afficheMoyenneAge($annee_estival); ?></h5>
                         <br>
                      </div><!-- /.description-block hauteur -->
                    </div>   </div>


                    
                    <div class="col-md-2">
                      <div class="description-block hauteur">
                      	 <span class="info-box-icon bg-green"><i class="fa fa-venus"></i></span>
                     <br>
                     <span class="description-text">% femmes</span>
                        <h5 class="description-header"><?php $dashboard->afficheRatioFemmes($annee_estival); ?></h5>
                         <br>
                      </div><!-- /.description-block hauteur -->
                    </div>
                  </div><!-- /.row -->
                	
                	<br>	<br>	
                	
                	
                	
                	
                  <div class="row">
                    <div class="col-md-6">
                      

 					<div class="row">
                    <div class="col-md-8">
                    	<p class="text-center">
                        <strong>Répartitions par âge</strong>
                      </p>
                      <div class="chart-responsive">
                      	
                        <canvas id="pieChart" height="100"></canvas>
                        
                      </div><!-- ./chart-responsive -->
                    </div><!-- /.col -->
                    <div class="col-md-4"><br><br>
                      <ul class="chart-legend clearfix middle">
                        <li><i class="fa fa-circle-o text-red"></i> - de 20 ans</li>
                        <li><i class="fa fa-circle-o text-green"></i> de 20 à 29 ans</li>
                        <li><i class="fa fa-circle-o text-yellow"></i> de 30 à 39 ans</li>
                        <li><i class="fa fa-circle-o text-aqua"></i> de 40 à 49 ans</li>
                        <li><i class="fa fa-circle-o text-light-blue"></i> de 50 à 59 ans</li>
                        <li><i class="fa fa-circle-o text-gray"></i> 60 ans et +</li>
                      </ul>
                    </div><!-- /.col -->
                  </div><!-- /.row -->




                    </div><!-- /.col -->
                    <div class="col-md-6">
                    	
                   
                    
                    <div class="row">
                    <div class="col-md-8">
                    	 <p class="text-center">
                        <strong>Répartitions par ville</strong>
                      </p>
                      <div class="chart-responsive">
                       <canvas height="230" width="777" id="barChart" style="height: 230px; width: 777px;"></canvas>
                      </div><!-- ./chart-responsive -->
                    </div><!-- /.col -->
                   
                  </div><!-- /.row -->
                    
                    
                     <div class="panel-group" id="accordionOne" role="tablist" aria-multiselectable="true">

      <h5 class="panel-title">
   
        	 <a data-toggle="collapse" data-parent="#accordionOne" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          => Plus de détails.
        </a>
      </h5>
   
    <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
      <ul>
      	<?php $dashboard->afficheDetailville($annee_estival);?>	
      </ul>
      </div>
    </div>


                    
               </div></div></div></div></div>   </div>    </div> 
    





     <div class="row">
            <div class="col-md-12">
            	
     
              <div class="box box-primary collapsed-box">
                <div class="box-header with-border">
                  <h3 class="box-title">STATISTIQUES : Entreprise</h3>
                  <div class="box-tools pull-right">
                  <!--  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button> -->
                     <button class="btn btn-box-tool" data-widget="collapse" ><i class="fa fa-plus"></i></button> 
                 
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                	
                	  <div class="row">
                 <div class="col-md-12">   
            
            <div class="form-group has-feedback">
 	 <div class="input-group">
 <span class="input-group-addon">
    <span class="fa fa-pie-chart"></span>
 	 </span>
           	 <select name="annee_entreprise" class="form-control" onchange="this.form.submit()">
                <option value="2016" <?php if ($annee_entreprise ==2016){echo "selected";} ?> >Saison : 2016/2017</option>
                <option value="2017" <?php if ($annee_entreprise ==2017){echo "selected";} ?> >Saison : 2017/2018</option>
                <option value="2018" <?php if ($annee_entreprise ==2018){echo "selected";} ?> >Saison: 2018/2019</option>
            </select>            
        
     </div>  </div>  
            </div>  </div>
                	
                	
                	
                	
                	
                	
                	<div class="row">
                   
                    
                    
                    <div class="col-md-2">
                    <div class="description-block hauteur border-right">
                      <div class="description-block hauteur">
                      	<span class="info-box-icon bg-red"><i class="fa fa-heartbeat"></i></span>
                     <br>
                     <span class="description-text">Activités</span>
                        <h5 class="description-header"><?php $dashboard->afficheNbreActivitesEntreprise($annee_entreprise);?></h5>
                         <br>
                      </div><!-- /.description-block hauteur -->
                    </div>   </div>
                    
                    <div class="col-md-2">
                    <div class="description-block hauteur border-right">
                      <div class="description-block hauteur">
                      	 <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>
                     <br>
                     <span class="description-text">PARTICIPANTS</span>
                        <h5 class="description-header"><?php $dashboard->afficheNbreParticipantsEntreprise($annee_entreprise);?></h5>
                        <br>
                      </div><!-- /.description-block hauteur -->
                    </div>   </div>


					<div class="col-md-2">
                    <div class="description-block hauteur border-right">
                      <div class="description-block hauteur">
                      <span class="info-box-icon bg-aqua"><i class="ion ion-ios-people-outline"></i></span>
                     <br>
                     <span class="description-text">Participations</span>
                        <h5 class="description-header"><?php $dashboard->afficheNbreParticipationsEntreprise($annee_entreprise);?></h5>
                         <br>
                      </div><!-- /.description-block hauteur -->
                    </div>   </div>
                    
                    <div class="col-md-2">
                    <div class="description-block hauteur border-right">
                      <div class="description-block hauteur">
                      	 <span class="info-box-icon bg-yellow"><i class="fa fa-birthday-cake"></i></span>
                     <br>
                     <span class="description-text">Moyenne d'age</span>
                        <h5 class="description-header"><?php $dashboard->afficheMoyenneAgeEntreprise($annee_entreprise); ?></h5>
                         <br>
                      </div><!-- /.description-block hauteur -->
                    </div>   </div>


                    
                    <div class="col-md-2">
                      <div class="description-block hauteur">
                      	 <span class="info-box-icon bg-green"><i class="fa fa-venus"></i></span>
                     <br>
                     <span class="description-text">% femmes</span>
                        <h5 class="description-header"><?php $dashboard->afficheRatioFemmesEntreprise($annee_entreprise); ?></h5>
                         <br>
                      </div><!-- /.description-block hauteur -->
                    </div>
                  </div><!-- /.row -->
                	
                	<br>	<br>	
                	
               
                	
                	
                	
                  <div class="row">
                    <div class="col-md-7">
                      

 					<div class="row">
                    <div class="col-md-7">
                    	<p class="text-center">
                        <strong>Lieu de travail</strong>
                      </p>
                      <div class="chart-responsive">
                      	
                        <canvas id="lieuTravail" height="100"></canvas>
                        
                      </div><!-- ./chart-responsive -->
                    </div><!-- /.col -->
                    <div class="col-md-5"><br><br>
                      <ul class="chart-legend clearfix middle">
                        <li><i class="fa fa-circle-o text-red"></i>Hôtel de France</li>
                        <li><i class="fa fa-circle-o text-green"></i>Hôtel de Ville</li>
                        <li><i class="fa fa-circle-o text-yellow"></i>Les Allées</li>
                        <li><i class="fa fa-circle-o text-aqua"></i>Centre technique municipal - D3D</li>
                        <li><i class="fa fa-circle-o text-light-blue"></i>CCAS</li>
                        <li><i class="fa fa-circle-o text-gray"></i>Autres</li>
                      </ul>
                    </div><!-- /.col -->
                  </div><!-- /.row -->




                    </div><!-- /.col -->
                   
                   
                    <div class="col-md-5">
                   
                   
                    
                    <div class="row">
                    <div class="col-md-12">
                    	 <p class="text-center">
                        <strong>Direction</strong>
                      </p>
                      <div class="chart-responsive">
                       <canvas height="230" width="777" id="barDirection" style="height: 230px; width: 777px;"></canvas>
                      </div><!-- ./chart-responsive -->
                    </div><!-- /.col -->
                   
                  </div><!-- /.row -->
                    
                    <br>
                     <div class="panel-group" id="accordionThree" role="tablist" aria-multiselectable="true">

      <h5 class="panel-title">
      <a class="collapsed" data-toggle="collapse" data-parent="#accordionThree" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          => Plus de détails.
        </a>
      </h5>
   
    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
    	
      <div class="panel-body">
      	<?php $dashboard->afficheDetailDirection($annee_entreprise);?>

     
      </div>
    </div>
             
               </div></div></div>
                </div></div>   </div>    </div>    



    
                </form>    
                  
             </section><!-- /.content -->
      </div><!-- /.content-wrapper -->       
    
               
     
  
    
    <script>
    
var ctx = document.getElementById("pieChart");
var myChart = new Chart(ctx, {
  type: 'doughnut',
    data : {
     labels: [
                "- de 20 ans",
                "de 20 à 29 ans",
                 "de 30 à 39 ans",
                  "de 40 à 49 ans",
                   "de 50 à 59 ans",
                    "+ de 60 ans",
            ],
    datasets: [
        {
            data: [<?php $dashboard->afficheRepartitionAge($annee_estival); ?>],
            backgroundColor: [
                 "#FF6384",
                "#00a65a",
                "#f39c12",
                "#00c0ef",
                "#3c8dbc",
                "#d2d6de"
            ]
           
           
        }]
},
    options: {
    animationSteps: 1000	
     }
});

var ctx = document.getElementById("lieuTravail");
var myChart = new Chart(ctx, {
  type: 'doughnut',
    data : {
     labels: [
                "Hôtel de France",
                "Hôtel de Ville",
                 "Les Allées",
                  "Centre technique municipal - D3D",
                   "CCAS",
                    "Autres"
            ],
    datasets: [
        {
            data: [<?php $dashboard->afficheLieuTravail($annee_estival); ?>],
            backgroundColor: [
                 "#FF6384",
                "#00a65a",
                "#f39c12",
                "#00c0ef",
                "#3c8dbc",
                "#d2d6de"
            ]
           
           
        }]
},
    options: {
    animationSteps: 1000	
     }
});

var ctx = document.getElementById("barChart");
var myChart = new Chart(ctx, {
  type: 'bar',
    data : {
     labels: [
                "Pau",
                "Agglo de Pau",
                "Autres"
            ],
    datasets: [
        {
            data: [<?php $dashboard->afficheRepartitionVille($annee_estival); ?>],
            backgroundColor: [
                 "#FF6384",
                "#00a65a",
                "#f39c12"
                
            ]
           
       
        }]
},
    options: {
    animationSteps: 1000,
   scales: {
                xAxes: [{stacked: true }],
                yAxes: [{stacked: true}]
            },
   
     }
});

var ctx = document.getElementById("barDirection");
var myChart = new Chart(ctx, {
  type: 'bar',
    data : {
   
            
             labels: [
                "Direction générale",
                "Qualité urbaine",
                "Développement social",
                "Transverse"
            ],
    datasets: [
        {
            data: [<?php $dashboard->afficheRepartitionDirection($annee_estival); ?>],
            backgroundColor: [
                 "#FF6384",
                "#00a65a",
                "#00c0ef",
                "#f39c12"
                
            ]
           
       
        }]
},
    options: {
    animationSteps: 1000,
   scales: {
                xAxes: [{stacked: true }],
                yAxes: [{stacked: true}]
            },
   
     }
});





</script>

             
      


   
 <?php require(__DIR__ .'/../../../include/footer_back.php'); ?>
   
   
    <!-- REQUIRED JS SCRIPTS -->
    <!-- jQuery 2.1.4 -->
    <script src="../../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../../../bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../../dist/js/app.min.js"></script>

 
  </body>
</html>
<?php } ?>