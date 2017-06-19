<?php

require(__DIR__ .'/include/config.inc.php');

 if($_SERVER['HTTP_HOST']=="sport2.cyberbase.local"){header ('location: modules/entreprise/index.php');}
 if($_SERVER['HTTP_HOST']=="efapau1.agglo-pau.fr"){header ('location: modules/estival/index.php');}
 if($_SERVER['HTTP_HOST']=="mapausport.agglo-pau.fr"){header ('location: modules/entreprise/index.php');}
 if($_SERVER['HTTP_HOST']=="efapau2.agglo-pau.fr"){header ('location: admin/index.php');}