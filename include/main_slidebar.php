 <?php

/***** Dernière modification : 29/06/2016, Romain TALDU	*****/

require(__DIR__ .'/model.inc.php');

// préparation connexion
$connect = new connection();
$includes = new includes($connect);

if (!isset($ss_menu)){$ss_menu="";}

 ?>    
  <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="../../../dist/img/avatar7.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $_SESSION['prenom_membre'];?>  <?php echo $_SESSION['nom_membre']; ?></p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> En ligne</a>
            </div>
          </div>

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">MENU DE NAVIGATION</li>
            <!-- Optionally, you can add icons to the links -->
            
           <?php if($_SESSION['id_typemembre']!=1){ ?>
             <li <?php if($menu==1){echo "class=\"active\"";}?>>
             <a href="../dashboard/index.php"><i class="fa fa-dashboard active"></i> <span>Tableau de bord</span></a>
            </li>
             <?php } ?>
           
             <?php if( $includes->verif_zone2(1,$_SESSION['id_membre'],$_SESSION['id_typemembre'])==TRUE){ ?>
            
            <li class="treeview <?php if($menu==2){echo "active";}?>">
          <a href="#">
            <i class="fa fa fa-heartbeat"></i> <span>Estival</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul style="display: <?php if($menu==2){echo "yes";}else{echo "no";} ?>;" class="treeview-menu menu-open">
          	<li <?php if($ss_menu==21){echo "class=\"active\"";}?>><a href="../estival/ajout_activite.php"><i class="fa fa-circle-o"></i> Ajout d'une activité</a></li>
          	<li <?php if($ss_menu==22){echo "class=\"active\"";}?>><a href="../estival/calendrier.php"><i class="fa fa-circle-o"></i> Vue calendrier</a></li>
            <li <?php if($ss_menu==23){echo "class=\"active\"";}?>><a href="../estival/listing.php"><i class="fa fa-circle-o"></i> Vue en Liste</a></li>
            <li <?php if($ss_menu==24){echo "class=\"active\"";}?>><a href="../estival/recherche_participant.php"><i class="fa fa-circle-o"></i> Recherche participant</a></li>
           
          </ul>
        </li>
           <?php } ?>
        
        
        
        
               <?php if( $includes->verif_zone2(2,$_SESSION['id_membre'],$_SESSION['id_typemembre'])==TRUE){ ?>
        
          <li class="treeview <?php if($menu==3){echo "active";}?>">
          <a href="#">
            <i class="fa fa fa-heartbeat"></i> <span>Annuel</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul style="display: <?php if($menu==3){echo "yes";}else{echo "no";} ?>;" class="treeview-menu menu-open">
     
          	<li <?php if($ss_menu==31){echo "class=\"active\"";}?>><a href="../annuel/ajout_activite.php"><i class="fa fa-circle-o"></i> Ajout d'une activité</a></li>
          	<li <?php if($ss_menu==32){echo "class=\"active\"";}?>><a href="../annuel/calendrier.php"><i class="fa fa-circle-o"></i> Vue calendrier</a></li>
            <li <?php if($ss_menu==33){echo "class=\"active\"";}?>><a href="../annuel/listing.php"><i class="fa fa-circle-o"></i> Vue en Liste</a></li>
            <li <?php if($ss_menu==34){echo "class=\"active\"";}?>><a href="../annuel/ajout_newuser.php"><i class="fa fa-circle-o"></i> Ajout d'un nouvel utilisateur</a></li>
            <li <?php if($ss_menu==35){echo "class=\"active\"";}?>><a href="../annuel/recherche_participant.php"><i class="fa fa-circle-o"></i> Recherche participant</a></li>
          
          </ul>
        </li>
            
            <?php } ?>
        
        
        
        
        
        
              <?php if( $includes->verif_zone2(3,$_SESSION['id_membre'],$_SESSION['id_typemembre'])==TRUE){ ?>
        
          <li class="treeview <?php if($menu==4){echo "active";}?>">
          <a href="#">
            <i class="fa fa fa-heartbeat"></i> <span>Entreprise</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul style="display: <?php if($menu==4){echo "yes";}else{echo "no";} ?>;" class="treeview-menu menu-open">
          	<li <?php if($ss_menu==41){echo "class=\"active\"";}?>><a href="../entreprise/ajout_activite.php"><i class="fa fa-circle-o"></i> Ajout d'une activité</a></li>
          	<li <?php if($ss_menu==42){echo "class=\"active\"";}?>><a href="../entreprise/calendrier.php"><i class="fa fa-circle-o"></i> Vue calendrier</a></li>
            <li <?php if($ss_menu==43){echo "class=\"active\"";}?>><a href="../entreprise/listing.php"><i class="fa fa-circle-o"></i> Vue en Liste</a></li>
            <li <?php if($ss_menu==44){echo "class=\"active\"";}?>><a href="../entreprise/recherche_participant.php"><i class="fa fa-circle-o"></i> Recherche participant</a></li>
          
          </ul>
        </li>
            
            <?php } ?>
            
            
           
            
            
            <?php if($_SESSION['id_typemembre']==4){ ?>
             
              <li <?php if($menu==5){echo "class=\"active\"";}?>>
            <a href="../administrateurs/index.php"><i class="fa fa-users"></i> <span>Gestion des admin</span>
            	<?php echo $includes->adminAttente(); ?>
            	</a>
            </li>
            
            <?php } ?>
            
          
                 <?php if($_SESSION['id_typemembre']==1){ ?>
        
          <li class="treeview active">
          <a href="#">
            <i class="fa fa fa-heartbeat"></i> <span>En forme à Pau</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul style="display: <?php if($menu==6){echo "yes";}else{echo "no";} ?>;" class="treeview-menu menu-open">
          	<li <?php if($ss_menu==61){echo "class=\"active\"";}?>><a href="../annuel/mon_calendrier.php"><i class="fa fa-circle-o"></i> S'inscrire</a></li>
          	<li <?php if($ss_menu==62){echo "class=\"active\"";}?>><a href="../annuel/mes_activites.php"><i class="fa fa-circle-o"></i> Mes activités</a></li>
            <li <?php if($ss_menu==63){echo "class=\"active\"";}?>><a href="../annuel/mon_profil.php"><i class="fa fa-circle-o"></i> Mon profil</a></li>
          
          </ul>
        </li>
            
            <?php } ?>
             
     
            
            
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>