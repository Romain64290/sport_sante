-- MySQL dump 10.13  Distrib 5.7.9, for Win32 (AMD64)
--
-- Host: 192.168.1.79    Database: sport
-- ------------------------------------------------------
-- Server version	5.5.49-0+deb8u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `annuel_activite`
--

DROP TABLE IF EXISTS `annuel_activite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `annuel_activite` (
  `id_annuel_activite` int(11) NOT NULL AUTO_INCREMENT,
  `titre_annuel_activite` varchar(255) NOT NULL,
  `color_annuel_activite` varchar(45) NOT NULL,
  `color_selection_annuel_activite` varchar(45) NOT NULL,
  `start_annuel_activite` datetime NOT NULL,
  `end_annuel_activite` datetime NOT NULL,
  `description_annuel_activite` text NOT NULL,
  `association_annuel_activite` varchar(255) NOT NULL,
  `lieu_annuel_activite` varchar(255) NOT NULL,
  `lieu_repli_annuel_activite` varchar(255) NOT NULL,
  `public_annuel_activite` varchar(255) NOT NULL,
  `inscrit_annuel_activite` int(11) NOT NULL,
  `limite_annuel_activite` int(11) NOT NULL,
  PRIMARY KEY (`id_annuel_activite`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `annuel_activite`
--

LOCK TABLES `annuel_activite` WRITE;
/*!40000 ALTER TABLE `annuel_activite` DISABLE KEYS */;
/*!40000 ALTER TABLE `annuel_activite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `annuel_user_has_activite`
--

DROP TABLE IF EXISTS `annuel_user_has_activite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `annuel_user_has_activite` (
  `id_membre` int(11) NOT NULL,
  `id_annuel_activite` int(11) NOT NULL,
  PRIMARY KEY (`id_membre`,`id_annuel_activite`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `annuel_user_has_activite`
--

LOCK TABLES `annuel_user_has_activite` WRITE;
/*!40000 ALTER TABLE `annuel_user_has_activite` DISABLE KEYS */;
/*!40000 ALTER TABLE `annuel_user_has_activite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entreprise_activite`
--

DROP TABLE IF EXISTS `entreprise_activite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entreprise_activite` (
  `id_entreprise_activite` int(11) NOT NULL AUTO_INCREMENT,
  `titre_entreprise_activite` varchar(255) NOT NULL,
  `color_entreprise_activite` varchar(45) NOT NULL,
  `color_selection_entreprise_activite` varchar(45) NOT NULL,
  `start_entreprise_activite` datetime NOT NULL,
  `end_entreprise_activite` datetime NOT NULL,
  `description_entreprise_activite` text NOT NULL,
  `association_entreprise_activite` varchar(255) NOT NULL,
  `lieu_entreprise_activite` varchar(255) DEFAULT NULL,
  `lieu_repli_entreprise_activite` varchar(255) DEFAULT NULL,
  `public_entreprise_activite` varchar(255) NOT NULL,
  `inscrit_entreprise_activite` int(11) NOT NULL,
  `limite_entreprise_activite` int(11) NOT NULL,
  PRIMARY KEY (`id_entreprise_activite`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entreprise_activite`
--

LOCK TABLES `entreprise_activite` WRITE;
/*!40000 ALTER TABLE `entreprise_activite` DISABLE KEYS */;
INSERT INTO `entreprise_activite` VALUES (2,'danse','#39cccc','bg-teal','2017-05-26 16:00:00','2017-05-26 17:00:00','gxdfgh','','gdhfgh','dfghdfg','',0,0);
/*!40000 ALTER TABLE `entreprise_activite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entreprise_direction`
--

DROP TABLE IF EXISTS `entreprise_direction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entreprise_direction` (
  `id_direction` int(11) NOT NULL AUTO_INCREMENT,
  `nom_direction` varchar(255) NOT NULL,
  `groupe` int(11) NOT NULL,
  PRIMARY KEY (`id_direction`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entreprise_direction`
--

LOCK TABLES `entreprise_direction` WRITE;
/*!40000 ALTER TABLE `entreprise_direction` DISABLE KEYS */;
INSERT INTO `entreprise_direction` VALUES (1,'Communication et animation événementielle',1),(2,'Cabinet',1),(3,'Modernisation – Territoire – Pilotage – Ressources',2),(4,'Délégation aux grands projets',2),(5,'Délégation à la qualité, la prospective et l\'innovation',2),(6,'Mission Commerce',2),(7,'Mission Eaux vives 2017',2),(8,'Mission Ville-jardin',2),(9,'Finances',2),(10,'Mobilités',2),(11,'Tourisme',2),(12,'Juridique – Foncier – Logistique – Achats',2),(13,'Ressources humaines – Qualité des services',2),(14,'Urbanisme – Aménagement – Construction durables',2),(15,'Cycle de l\'eau',3),(16,'Développement durable et déchets',3),(17,'Espaces publics et voirie',3),(18,'Habitat et rénovation urbaine',3),(19,'Nature et patrimoine végétal',3),(20,'Prévention et sécurité routière',3),(21,'Accueils, modernisation et citoyenneté',4),(22,'Cohésion sociale',4),(23,'Culture',4),(24,'Vie scolaire',4),(25,'Restauration publique',4),(26,'Sports',4),(27,'Vie des quartiers, emploi et valorisation des compétences',4);
/*!40000 ALTER TABLE `entreprise_direction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entreprise_user`
--

DROP TABLE IF EXISTS `entreprise_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entreprise_user` (
  `id_entreprise_user` int(11) NOT NULL AUTO_INCREMENT,
  `civilite_entreprise_user` varchar(45) NOT NULL,
  `nom_entreprise_user` varchar(45) NOT NULL,
  `prenom_entreprise_user` varchar(45) NOT NULL,
  `email_entreprise_user` varchar(45) NOT NULL,
  `tel_entreprise_user` varchar(45) NOT NULL,
  `age_entreprise_user` varchar(45) NOT NULL,
  `residence_entreprise_user` varchar(45) NOT NULL,
  `accepte_mail` varchar(45) DEFAULT NULL,
  `date_inscription` datetime NOT NULL,
  `ip_user` varchar(45) NOT NULL,
  `direction` int(11) NOT NULL,
  `collectivite` int(11) NOT NULL COMMENT '1 ville, 2 agglo, 3 CCAS',
  `lieu_travail` int(11) NOT NULL COMMENT '1 Hôtel de France, 2 Hôtel de Ville, 3  Les Allées, 4 Centre technique municipal - D3D, 5 CCAS, 6 Autres',
  PRIMARY KEY (`id_entreprise_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entreprise_user`
--

LOCK TABLES `entreprise_user` WRITE;
/*!40000 ALTER TABLE `entreprise_user` DISABLE KEYS */;
INSERT INTO `entreprise_user` VALUES (1,'1','TALDU','Romain','romain_taldu@hotmail.com','0605339404','30/05/1979','','on','2017-05-11 16:34:51','172.17.161.90',8,1,2),(2,'1','TALDU2','Romain','romain_taldu@hotmail.com','0605339404','30/05/1981','','on','2017-05-11 16:36:02','172.17.161.90',5,1,1),(3,'1','TALDU','Romain','romain_taldu@hotmail.com','0605339404','30/05/1979','','on','2017-05-11 16:55:01','172.17.161.90',5,2,2);
/*!40000 ALTER TABLE `entreprise_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entreprise_user_has_activite`
--

DROP TABLE IF EXISTS `entreprise_user_has_activite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entreprise_user_has_activite` (
  `id_entreprise_user` int(11) NOT NULL DEFAULT '0',
  `id_entreprise_activite` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entreprise_user_has_activite`
--

LOCK TABLES `entreprise_user_has_activite` WRITE;
/*!40000 ALTER TABLE `entreprise_user_has_activite` DISABLE KEYS */;
/*!40000 ALTER TABLE `entreprise_user_has_activite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estival_activite`
--

DROP TABLE IF EXISTS `estival_activite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estival_activite` (
  `id_estival_activite` int(11) NOT NULL AUTO_INCREMENT,
  `titre_estival_activite` varchar(255) NOT NULL,
  `color_estival_activite` varchar(45) NOT NULL,
  `color_selection_estival_activite` varchar(45) NOT NULL,
  `start_estival_activite` datetime NOT NULL,
  `end_estival_activite` datetime NOT NULL,
  `description_estival_activite` text NOT NULL,
  `association_estival_activite` varchar(255) NOT NULL,
  `lieu_estival_activite` varchar(255) NOT NULL,
  `lieu_repli_estival_activite` varchar(255) NOT NULL,
  `public_estival_activite` varchar(255) NOT NULL,
  `inscrit_estival_activite` int(11) NOT NULL,
  `limite_estival_activite` int(11) NOT NULL,
  `lien_map` varchar(255) NOT NULL,
  `email_absent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_estival_activite`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estival_activite`
--

LOCK TABLES `estival_activite` WRITE;
/*!40000 ALTER TABLE `estival_activite` DISABLE KEYS */;
INSERT INTO `estival_activite` VALUES (2,'poker','#3c8dbc','bg-light-blue','2017-06-22 14:00:00','2017-06-22 18:00:00','gdfg','sdfgsdf','sdfgsdfg','sdfgsdf','dsfgsd',7,8,'https://www.google.fr/maps/place/Pau/@43.3218841,-0.4136968,12z/data=!3m1!4b1!4m5!3m4!1s0xd564885b45c7ae9:0x4066517481394b0!8m2!3d43.2951!4d-0.370797?sa=X&ved=0ahUKEwjfjfLRr4PUAhWCORoKHQ8dAsoQ8gEIlgEwDQ',NULL),(3,'gfhdfghd','#00a65a','bg-green','2017-06-08 16:00:00','2017-06-08 18:00:00','dqsdf','qsdfqsdfq','sdfqsdfq','qsdfqsdfqsd','qsdfqsdf',0,7,'https://www.google.fr/maps/place/Pau/@43.3218841,-0.4136968,12z/data=!3m1!4b1!4m5!3m4!1s0xd564885b45c7ae9:0x4066517481394b0!8m2!3d43.2951!4d-0.370797?sa=X&ved=0ahUKEwjfjfLRr4PUAhWCORoKHQ8dAsoQ8gEIlgEwDQ',1),(4,'cvbxcvb','#00a65a','bg-green','2017-06-07 14:00:00','2017-06-07 16:00:00','','dfghfghdfg','dfghdfg','gfhdfghdf','dfghdfgh',5,7,'https://www.google.fr/maps/place/Pau/@43.3218841,-0.4136968,12z/data=!3m1!4b1!4m5!3m4!1s0xd564885b45c7ae9:0x4066517481394b0!8m2!3d43.2951!4d-0.370797?sa=X&ved=0ahUKEwjfjfLRr4PUAhWCORoKHQ8dAsoQ8gEIlgEwDQ',1),(5,'test69','#39cccc','bg-teal','2017-05-22 14:00:00','2017-05-22 16:00:00','fgqdfg','sdfgsdfg','sdfgsdfg','dsfgsdfg','dfhdfg',1,7,'https://www.google.fr/maps/place/Pau/@43.3218841,-0.4136968,12z/data=!3m1!4b1!4m5!3m4!1s0xd564885b45c7ae9:0x4066517481394b0!8m2!3d43.2951!4d-0.370797?sa=X&ved=0ahUKEwjfjfLRr4PUAhWCORoKHQ8dAsoQ8gEIlgEwDQ',1);
/*!40000 ALTER TABLE `estival_activite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estival_user`
--

DROP TABLE IF EXISTS `estival_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estival_user` (
  `id_estival_user` int(11) NOT NULL AUTO_INCREMENT,
  `civilite_estival_user` varchar(45) NOT NULL,
  `nom_estival_user` varchar(45) NOT NULL,
  `prenom_estival_user` varchar(45) NOT NULL,
  `email_estival_user` varchar(45) NOT NULL,
  `tel_estival_user` varchar(45) NOT NULL,
  `age_estival_user` varchar(45) NOT NULL,
  `residence_estival_user` varchar(45) NOT NULL,
  `accepte_mail` varchar(45) DEFAULT NULL,
  `date_inscription` datetime NOT NULL,
  `ip_user` varchar(45) NOT NULL,
  PRIMARY KEY (`id_estival_user`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estival_user`
--

LOCK TABLES `estival_user` WRITE;
/*!40000 ALTER TABLE `estival_user` DISABLE KEYS */;
INSERT INTO `estival_user` VALUES (1,'1','TALDU','Romain','romain_taldu@hotmail.com','0605339404','30/05/1979','gan','on','2017-05-29 16:42:50','172.17.161.90'),(2,'2','paparem','ggigi','romain_taldu@hotmail.com','0605339404','21/04/1987','jurancon','on','2017-05-29 16:44:21','172.17.161.90'),(3,'1','taldu','Romain','romain_taldu@hotmail.com','0605339404','30/05/1979','gan',NULL,'2017-06-09 12:23:00','172.17.161.90'),(4,'1','TALDU','Romain','r.taldu@agglo-pau.fr','0605339404','30/05/1979','billere',NULL,'2017-06-09 12:29:32','172.17.161.90'),(5,'1','TALDU','Romain','romain_taldu@hotmail.com','0605339404','30/05/1979','gan',NULL,'2017-06-09 12:43:16','172.17.161.90'),(6,'1','TALDU','Romain','r.taldu@agglo-pau.fr','0605339404','30/05/1981','bizanos','on','2017-06-09 12:46:28','172.17.161.90'),(7,'1','TALDU','Romain','r.taldu@agglo-pau.fr','0605339404','30/05/1981','jurancon','on','2017-06-09 12:47:52','172.17.161.90'),(8,'1','TALDU','Romain','romain_taldu@hotmail.com','0605339404','30/05/1979','billere','on','2017-06-09 12:55:44','172.17.161.90'),(9,'1','TALDU','Romain','romain_taldu@hotmail.com','0605339404','30/05/1979','bizanos','on','2017-06-09 13:03:58','172.17.161.90');
/*!40000 ALTER TABLE `estival_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estival_user_has_activite`
--

DROP TABLE IF EXISTS `estival_user_has_activite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estival_user_has_activite` (
  `id_estival_user` int(11) DEFAULT NULL,
  `id_estival_activite` int(11) DEFAULT NULL,
  `presence_reunion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estival_user_has_activite`
--

LOCK TABLES `estival_user_has_activite` WRITE;
/*!40000 ALTER TABLE `estival_user_has_activite` DISABLE KEYS */;
INSERT INTO `estival_user_has_activite` VALUES (1,2,1),(1,4,1),(2,2,1),(2,4,1),(5,2,0),(7,4,0),(8,4,0),(9,4,0);
/*!40000 ALTER TABLE `estival_user_has_activite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `membres`
--

DROP TABLE IF EXISTS `membres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `membres` (
  `id_membre` int(11) NOT NULL AUTO_INCREMENT,
  `id_typemembre` int(11) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `nom_membre` varchar(45) NOT NULL,
  `prenom_membre` varchar(45) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_inscription` datetime NOT NULL,
  `validation_inscription` int(11) NOT NULL,
  `token` varchar(100) NOT NULL,
  `civilite` varchar(45) NOT NULL,
  `telephone` varchar(45) NOT NULL,
  `age` varchar(45) NOT NULL,
  `residence` varchar(45) NOT NULL,
  `accepte_mail` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_membre`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membres`
--

LOCK TABLES `membres` WRITE;
/*!40000 ALTER TABLE `membres` DISABLE KEYS */;
INSERT INTO `membres` VALUES (1,4,'4075cc72e829861798e3be24010317e2094d637c','Taldu','Romain','r.taldu@agglo-pau.fr','2016-01-20 00:00:00',1,'61527780957a0ce3ab35e41.37765923','','','','',''),(42,1,'c38d918cc07194cecaa839d597b819bf61bc5c35','UserAnnuel','Cedric','romain_taldu@hotmail.com','2017-05-11 15:25:25',1,'983924770591958cb231f25.21892971','1','0606060606','30/05/1979','gelos','on'),(43,3,'c38d918cc07194cecaa839d597b819bf61bc5c35','Admin64','Fred','romain_taldu2@hotmail.com','2017-05-11 15:26:40',0,'','','','','',NULL),(44,1,'f06ae5e749fa17b0dac1c4c813246da882281e0b','vfgsdfgh','fgsdfgdsf','romain_taldu22@hotmail.com','2017-05-16 11:55:08',1,'','1','fgsdfgsdfgs','30/05/1979','gan','on');
/*!40000 ALTER TABLE `membres` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `membres_has_zone`
--

DROP TABLE IF EXISTS `membres_has_zone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `membres_has_zone` (
  `id_membre` int(11) NOT NULL,
  `id_zone` int(11) NOT NULL,
  PRIMARY KEY (`id_membre`,`id_zone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membres_has_zone`
--

LOCK TABLES `membres_has_zone` WRITE;
/*!40000 ALTER TABLE `membres_has_zone` DISABLE KEYS */;
INSERT INTO `membres_has_zone` VALUES (3,1),(3,2),(3,3),(4,2),(5,2),(10,1),(10,3),(14,1),(14,3),(30,1),(30,2),(31,2);
/*!40000 ALTER TABLE `membres_has_zone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type_membre`
--

DROP TABLE IF EXISTS `type_membre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type_membre` (
  `id_typemembre` int(11) NOT NULL AUTO_INCREMENT,
  `type_membre` varchar(45) NOT NULL,
  PRIMARY KEY (`id_typemembre`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_membre`
--

LOCK TABLES `type_membre` WRITE;
/*!40000 ALTER TABLE `type_membre` DISABLE KEYS */;
INSERT INTO `type_membre` VALUES (1,'utilisateur'),(2,'redacteur'),(3,'administrateur'),(4,'super-adminstrateur');
/*!40000 ALTER TABLE `type_membre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zone`
--

DROP TABLE IF EXISTS `zone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zone` (
  `id_zone` int(11) NOT NULL AUTO_INCREMENT,
  `nom_zone` varchar(45) NOT NULL,
  PRIMARY KEY (`id_zone`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zone`
--

LOCK TABLES `zone` WRITE;
/*!40000 ALTER TABLE `zone` DISABLE KEYS */;
INSERT INTO `zone` VALUES (1,'Estival'),(2,'Reste de l\'année'),(3,'Entreprise ');
/*!40000 ALTER TABLE `zone` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-14 15:31:33
