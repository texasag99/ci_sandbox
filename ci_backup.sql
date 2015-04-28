-- MySQL dump 10.13  Distrib 5.5.38, for debian-linux-gnu (armv7l)
--
-- Host: localhost    Database: ci_sandbox
-- ------------------------------------------------------
-- Server version	5.5.38-0+wheezy1

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
-- Current Database: `ci_sandbox`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `ci_sandbox` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `ci_sandbox`;

--
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `from_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `from_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `retry_limit` int(2) NOT NULL DEFAULT '3',
  `default_pagination` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config`
--

LOCK TABLES `config` WRITE;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` VALUES (1,'bejan.nouri@gmail.com','Bejan Nouri',3,10);
/*!40000 ALTER TABLE `config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(4) NOT NULL,
  `permission` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ACTIVE',
  `category` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `last_updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (9005,'USER-VIEW','Allows permission to view the User Admin screen','ACTIVE','User Admin','2015-04-11 06:41:59','2015-04-14 11:04:10'),(9010,'USER-EDIT','Allows permission to edit users from the User Admin screen','ACTIVE','User Admin','2015-04-11 06:43:09','2015-04-14 11:04:13'),(9015,'USER-ADD','Allows permission to add users from the User Admin screen','ACTIVE','User Admin','2015-04-11 06:44:01','2015-04-11 06:44:01'),(9020,'USER-DELETE','Allows permission to delete users from the User Admin screen','ACTIVE','User Admin','2015-04-11 06:44:43','2015-04-11 06:44:43'),(9030,'ROLE-VIEW','Allows permission to view the Roles screen','ACTIVE','Roles','2015-04-11 06:47:52','2015-04-11 06:47:52'),(9035,'ROLE-EDIT','Allows permission to add and edit roles from the Roles screen','ACTIVE','Roles','2015-04-11 06:49:13','2015-04-11 06:53:13'),(9040,'ROLE-DELETE','Allows permission to delete roles from the Roles screen','ACTIVE','Roles','2015-04-11 06:49:45','2015-04-11 06:49:45'),(9050,'PERMISSION-VIEW','Allows permission to view the Permissions screen','ACTIVE','Permissions','2015-04-11 06:51:58','2015-04-11 06:51:58'),(9055,'PERMISSION-EDIT','Allows permission to add and edit permissions from the Permissions screen','ACTIVE','Permissions','2015-04-11 06:52:47','2015-04-11 06:53:06'),(9060,'PERMISSION-DEL','Allows permission to delete permissions from the Permissions screen','ACTIVE','Permissions','2015-04-11 06:54:05','2015-04-11 06:54:05'),(9065,'SETTINGS-VIEW','Allows permission to view the global settings screen','ACTIVE','Settings','2015-04-11 06:58:07','2015-04-11 06:58:07'),(9070,'SETTINGS-EDIT','Allows permissions to edit the global settings of the app','ACTIVE','Settings','2015-04-11 06:56:23','2015-04-11 06:56:23'),(9999,'SUPER-ADMIN','Global admin permission that allows access to the entire application','ACTIVE','Administrator','2015-04-11 06:39:18','2015-04-11 06:39:18');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `last_updated` datetime NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ACTIVE',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (31,'SYS-ADMIN','System Administrator','2015-04-11 07:00:53','2015-04-14 11:06:42','ACTIVE'),(32,'USER-ADMIN','Administers users rights and privileges','2015-04-13 17:12:47','2015-04-14 11:02:27','ACTIVE'),(33,'GENERAL-ACCESS','This is a role that allows you to view but not edit, add or delete','2015-04-14 20:54:13','2015-04-16 11:29:46','ACTIVE'),(34,'ROLES-ADMIN','Creates, removes and manages the roles in the system','2015-04-16 12:06:39','2015-04-16 12:06:57','ACTIVE'),(35,'PERMISSION-ADMIN','Creates, removes and manages the permissions in the system','2015-04-16 12:07:48','2015-04-16 12:08:16','ACTIVE'),(36,'SETTINGS-ADMIN','Manages the application settings','2015-04-16 12:08:50','2015-04-16 12:09:12','ACTIVE');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `session_id` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('1ffd7b3da1e8f6e28a9322d48af759f7','71.251.112.31','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:37.0) Gecko/20100101 Firefox/37.0',1429671380,'a:4:{s:5:\"email\";s:21:\"bejan.nouri@gmail.com\";s:12:\"is_logged_in\";i:1;s:4:\"name\";s:11:\"Bejan Nouri\";s:11:\"permissions\";a:13:{i:0;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9999\";}i:1;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9005\";}i:2;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9010\";}i:3;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9015\";}i:4;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9020\";}i:5;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9030\";}i:6;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9035\";}i:7;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9040\";}i:8;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9050\";}i:9;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9055\";}i:10;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9060\";}i:11;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9065\";}i:12;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9070\";}}}',NULL),('306e8e84cb3b5612e6772d03a7d52c2d','71.251.112.31','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36',1429062608,'a:4:{s:5:\"email\";s:20:\"bejan.nouri@live.com\";s:12:\"is_logged_in\";i:1;s:4:\"name\";s:11:\"Bejan Nouri\";s:11:\"permissions\";a:4:{i:0;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9005\";}i:1;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9030\";}i:2;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9050\";}i:3;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9065\";}}}',NULL),('35924039f5681306cd02d97f09a3e735','71.180.21.110','Mozilla/5.0 (Linux; Android 4.4.4; XT1049 Build/KXA21.12-L2.7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.9',1429021055,'a:4:{s:5:\"email\";s:21:\"bejan.nouri@gmail.com\";s:12:\"is_logged_in\";i:1;s:4:\"name\";s:11:\"Bejan Nouri\";s:11:\"permissions\";a:4:{i:0;O:8:\"stdClass\":1:{s:13:\"permission_id\";s:4:\"9005\";}i:1;O:8:\"stdClass\":1:{s:13:\"permission_id\";s:4:\"9010\";}i:2;O:8:\"stdClass\":1:{s:13:\"permission_id\";s:4:\"9015\";}i:3;O:8:\"stdClass\":1:{s:13:\"permission_id\";s:4:\"9020\";}}}',NULL),('5d01ba613a2b647d79f73acf381ba5e9','71.180.21.98','Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0',1428960799,'a:4:{s:5:\"email\";s:21:\"bejan.nouri@gmail.com\";s:12:\"is_logged_in\";i:1;s:4:\"name\";s:11:\"Bejan Nouri\";s:11:\"permissions\";a:5:{i:0;O:8:\"stdClass\":1:{s:13:\"permission_id\";s:4:\"9999\";}i:1;O:8:\"stdClass\":1:{s:13:\"permission_id\";s:4:\"9005\";}i:2;O:8:\"stdClass\":1:{s:13:\"permission_id\";s:4:\"9010\";}i:3;O:8:\"stdClass\":1:{s:13:\"permission_id\";s:4:\"9015\";}i:4;O:8:\"stdClass\":1:{s:13:\"permission_id\";s:4:\"9020\";}}}',NULL),('69d066281a61dbdb6d7b6c9349024080','71.180.21.98','Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0',1429045317,'a:4:{s:5:\"email\";s:21:\"bejan.nouri@gmail.com\";s:12:\"is_logged_in\";i:1;s:4:\"name\";s:11:\"Bejan Nouri\";s:11:\"permissions\";a:5:{i:0;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9999\";}i:1;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9005\";}i:2;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9010\";}i:3;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9015\";}i:4;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9020\";}}}',NULL),('6f179a6182ad62726f2b1f9ae71a8f62','71.180.21.98','Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0',1429217431,'',NULL),('70828414cbd0591226b091194869b0d3','71.180.21.110','Mozilla/5.0 (X11; Linux armv7l; rv:31.0) Gecko/20100101 Firefox/31.0 Iceweasel/31.4.0',1429200530,'a:4:{s:5:\"email\";s:21:\"bejan.nouri@gmail.com\";s:12:\"is_logged_in\";i:1;s:4:\"name\";s:11:\"Bejan Nouri\";s:11:\"permissions\";a:5:{i:0;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9999\";}i:1;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9005\";}i:2;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9010\";}i:3;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9015\";}i:4;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9020\";}}}',NULL),('79ca0c7521f0c635d6a102db0e35def5','71.180.21.98','Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0',1429217457,'',NULL),('88af5e54828e35341535c9bf52ecfdcb','71.251.112.31','Mozilla/5.0 (Linux; Android 4.4.4; XT1049 Build/KXA21.12-L2.7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.9',1428971559,'a:4:{s:5:\"email\";s:21:\"bejan.nouri@gmail.com\";s:12:\"is_logged_in\";i:1;s:4:\"name\";s:11:\"Bejan Nouri\";s:11:\"permissions\";a:5:{i:0;O:8:\"stdClass\":1:{s:13:\"permission_id\";s:4:\"9999\";}i:1;O:8:\"stdClass\":1:{s:13:\"permission_id\";s:4:\"9005\";}i:2;O:8:\"stdClass\":1:{s:13:\"permission_id\";s:4:\"9010\";}i:3;O:8:\"stdClass\":1:{s:13:\"permission_id\";s:4:\"9015\";}i:4;O:8:\"stdClass\":1:{s:13:\"permission_id\";s:4:\"9020\";}}}',NULL),('8b665187d4ea45ce25f54497bfd4ad39','71.251.112.31','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.90 Safari/537.36',1429670160,'a:4:{s:5:\"email\";s:21:\"bejan.nouri@gmail.com\";s:12:\"is_logged_in\";i:1;s:4:\"name\";s:11:\"Bejan Nouri\";s:11:\"permissions\";a:13:{i:0;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9999\";}i:1;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9005\";}i:2;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9010\";}i:3;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9015\";}i:4;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9020\";}i:5;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9030\";}i:6;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9035\";}i:7;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9040\";}i:8;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9050\";}i:9;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9055\";}i:10;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9060\";}i:11;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9065\";}i:12;O:8:\"stdClass\":1:{s:2:\"id\";s:4:\"9070\";}}}',NULL),('cf15ec380eb45bebde34f33840eebaba','71.251.112.31','Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:37.0) Gecko/20100101 Firefox/37.0',1429249061,'',NULL),('e0d5eddb485479d9e6e4807a9947475d','71.180.21.110','Mozilla/5.0 (X11; Linux armv7l; rv:31.0) Gecko/20100101 Firefox/31.0 Iceweasel/31.4.0',1429820745,'',NULL),('f4854507038eabb05fa87ffcee88be3a','71.180.21.98','Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0',1429023993,'a:4:{s:5:\"email\";s:21:\"bejan.nouri@gmail.com\";s:12:\"is_logged_in\";i:1;s:4:\"name\";s:11:\"Bejan Nouri\";s:11:\"permissions\";a:5:{i:0;O:8:\"stdClass\":1:{s:13:\"permission_id\";s:4:\"9999\";}i:1;O:8:\"stdClass\":1:{s:13:\"permission_id\";s:4:\"9005\";}i:2;O:8:\"stdClass\":1:{s:13:\"permission_id\";s:4:\"9010\";}i:3;O:8:\"stdClass\":1:{s:13:\"permission_id\";s:4:\"9015\";}i:4;O:8:\"stdClass\":1:{s:13:\"permission_id\";s:4:\"9020\";}}}',NULL);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temp_user`
--

DROP TABLE IF EXISTS `temp_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `temp_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp_user`
--

LOCK TABLES `temp_user` WRITE;
/*!40000 ALTER TABLE `temp_user` DISABLE KEYS */;
INSERT INTO `temp_user` VALUES (29,'Billy@billy.com','6e879c436fcdde9c11dcb2d067dd435a','1267a87a8017ae58f47f55f3c0089fbf');
/*!40000 ALTER TABLE `temp_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(64) COLLATE utf8_unicode_ci NOT NULL,
  `first` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `last_updated` datetime DEFAULT NULL,
  `status` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'INACTIVE',
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  `retry_counter` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'bejan.nouri@gmail.com','1267a87a8017ae58f47f55f3c0089fbf','Bejan','Nouri','2014-07-03 00:00:00','2015-04-21 22:57:12','ACTIVE',0,0),(3,'bejan.nouri@live.com','1267a87a8017ae58f47f55f3c0089fbf','Bejan','Nouri','2014-07-11 15:20:17','2015-04-16 11:52:01','ACTIVE',0,0);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_profile`
--

DROP TABLE IF EXISTS `user_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `address1` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `address2` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `state` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `zip` int(20) NOT NULL,
  `country` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `email2` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `fax` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `last_updated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_profile`
--

LOCK TABLES `user_profile` WRITE;
/*!40000 ALTER TABLE `user_profile` DISABLE KEYS */;
INSERT INTO `user_profile` VALUES (1,1,'4574 Robin Hood Trail W','','Sarasota','FL',34232,'US','bejan.nouri@live.com','941-444-6514','941-444-6514','','','http://www.threshinglabs.com','2015-04-21 22:57:13'),(2,2,'1629 Barber Road','','Sarasota','FL',34240,'US','bejan.nouri@csfi.com','941-379-0881','941-444-6514','','','','2014-07-11 14:59:59'),(3,3,'1629 Barber Road','','Sarasota','FL',34232,'US','bejan.nouri@live.com','941-379-0881','941-444-6514','','','http://www.csfi.com','2015-04-16 11:52:01'),(5,5,'none','','bobville','TX',75008,'US','','','','','','','2015-03-12 11:14:02'),(6,6,'1629 Barber Road','','Sarasota','FL',34240,'US','bejan.nouri@csfi.com','941-379-0881','941-444-6514','','','http://www.csfi.com','2015-03-30 16:56:48');
/*!40000 ALTER TABLE `user_profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xref_roles_permissions`
--

DROP TABLE IF EXISTS `xref_roles_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xref_roles_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(4) NOT NULL,
  PRIMARY KEY (`role_id`,`permission_id`),
  KEY `permission_id` (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xref_roles_permissions`
--

LOCK TABLES `xref_roles_permissions` WRITE;
/*!40000 ALTER TABLE `xref_roles_permissions` DISABLE KEYS */;
INSERT INTO `xref_roles_permissions` VALUES (15,1030),(16,1030),(22,1030),(15,1111),(22,1833),(15,8756),(32,9005),(33,9005),(32,9010),(32,9015),(32,9020),(34,9030),(34,9035),(34,9040),(33,9050),(35,9050),(35,9055),(35,9060),(33,9065),(36,9065),(36,9070),(12,9999),(15,9999),(31,9999);
/*!40000 ALTER TABLE `xref_roles_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `xref_user_roles`
--

DROP TABLE IF EXISTS `xref_user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `xref_user_roles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `xref_user_roles`
--

LOCK TABLES `xref_user_roles` WRITE;
/*!40000 ALTER TABLE `xref_user_roles` DISABLE KEYS */;
INSERT INTO `xref_user_roles` VALUES (1,31),(1,32),(1,34),(1,35),(1,36);
/*!40000 ALTER TABLE `xref_user_roles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-04-27 21:20:29
