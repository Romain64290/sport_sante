<?php

require(__DIR__ .'/include/config.inc.php');

 if(URL_SITE=="http://sport2.cyberbase.local"){header ('location: modules/entreprise/index.php');}
 if(URL_SITE=="http://efapau1.agglo-pau.fr"){header ('location: modules/estival/index.php');}
 if(URL_SITE=="http://mapausport.agglo-pau.fr"){header ('location: modules/entreprise/index.php');}
 if(URL_SITE=="http://efapau2.agglo-pau.fr"){header ('location: admin/index.php');}