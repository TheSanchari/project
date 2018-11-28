-- MySQL dump 10.13  Distrib 5.7.24, for Linux (x86_64)
--
-- Host: localhost    Database: gallery
-- ------------------------------------------------------
-- Server version	5.7.24-0ubuntu0.18.04.1

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
-- Table structure for table `albums`
--

DROP TABLE IF EXISTS `albums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `albums` (
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `albums_users_FK` (`user_id`),
  CONSTRAINT `albums_users_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `albums`
--

LOCK TABLES `albums` WRITE;
/*!40000 ALTER TABLE `albums` DISABLE KEYS */;
INSERT INTO `albums` VALUES ('second album','123',8,58,'2018-11-26 15:00:56','2018-11-26 15:00:56',NULL),('second album','description',8,59,'2018-11-27 11:01:55','2018-11-27 15:32:59',NULL),('my album','nothing',8,60,'2018-11-28 11:24:58','2018-11-28 11:24:58',NULL);
/*!40000 ALTER TABLE `albums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caption` varchar(200) NOT NULL,
  `size` int(11) NOT NULL,
  `ext` varchar(100) DEFAULT NULL,
  `mime` varchar(100) DEFAULT NULL,
  `original_name` varchar(100) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `view_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `images_albums_FK` (`album_id`),
  KEY `images_users_FK` (`user_id`),
  CONSTRAINT `images_albums_FK` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`),
  CONSTRAINT `images_users_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (37,'123',210494,'png','image/png','Screenshot from 2018-11-08 14-29-40.png',8,58,'15432316326336.png','2018-11-26 16:57:12','2018-11-26 16:57:12','2018-11-27 17:32:22',1),(38,'123',210494,'png','image/png','Screenshot from 2018-11-08 14-29-40.png',8,58,'15432316412472.png','2018-11-26 16:57:21','2018-11-26 16:57:21','2018-11-27 18:12:45',1),(39,'123',210494,'png','image/png','Screenshot from 2018-11-08 14-29-40.png',8,58,'15432356258121.png','2018-11-26 18:03:45','2018-11-26 18:03:45','2018-11-27 18:12:48',1),(40,'screenshot 1',210494,'png','image/png','Screenshot from 2018-11-08 14-29-40.png',8,59,'15432970076826.png','2018-11-27 11:06:47','2018-11-27 11:06:47',NULL,1),(41,'123',1075431,'png','image/png','Screenshot from 2018-10-11 12-45-30.png',8,59,'15433047434253.png','2018-11-27 13:15:43','2018-11-27 13:15:43',NULL,1),(42,'screenshot 1',1075431,'png','image/png','Screenshot from 2018-10-11 12-45-30.png',8,59,'15433047918997.png','2018-11-27 13:16:31','2018-11-27 13:16:31',NULL,1),(43,'screenshot 3',210494,'png','image/png','Screenshot from 2018-11-08 14-29-53.png',8,59,'15433128733307.png','2018-11-27 15:31:13','2018-11-27 15:31:13',NULL,1),(44,'screenshot 4',210494,'png','image/png','Screenshot from 2018-11-08 14-29-52.png',8,58,'15433192821393.png','2018-11-27 17:18:02','2018-11-27 17:18:02','2018-11-27 17:39:15',1),(45,'screenshot 5',1075431,'png','image/png','Screenshot from 2018-10-11 12-45-30.png',8,58,'15433205750871.png','2018-11-27 17:39:35','2018-11-27 17:39:35','2018-11-27 18:12:47',1),(46,'screenshot 1',1075431,'png','image/png','Screenshot from 2018-10-11 12-45-30.png',8,58,'15433225762985.png','2018-11-27 18:12:56','2018-11-27 18:12:56','2018-11-28 11:55:48',1),(47,'screenshot 2',210494,'png','image/png','Screenshot from 2018-11-08 14-29-40.png',8,58,'15433225884656.png','2018-11-27 18:13:08','2018-11-27 18:13:08',NULL,1),(48,'screenshot 3',210494,'png','image/png','Screenshot from 2018-11-08 14-29-42 - 1.png',8,58,'15433226263249.png','2018-11-27 18:13:46','2018-11-27 18:13:46',NULL,1),(49,'screenshot 4',210494,'png','image/png','Screenshot from 2018-11-08 14-29-45 - 1.png',8,58,'15433226362311.png','2018-11-27 18:13:56','2018-11-27 18:13:56',NULL,1),(50,'screenshot 5',210494,'png','image/png','Screenshot from 2018-11-08 14-29-40.png',8,58,'15433226494165.png','2018-11-27 18:14:09','2018-11-27 18:14:09','2018-11-28 11:55:50',1),(51,'dog',5279,'jpeg','image/jpeg','pic1.jpeg',8,59,'15433831075331.jpeg','2018-11-28 11:01:47','2018-11-28 11:01:47','2018-11-28 11:10:45',1),(52,'123',1075431,'png','image/png','Screenshot from 2018-10-11 12-45-30.png',8,60,'15433845235499.png','2018-11-28 11:25:23','2018-11-28 11:25:23',NULL,1),(53,'123',210494,'png','image/png','Screenshot from 2018-11-08 14-29-40.png',8,59,'15433845412581.png','2018-11-28 11:25:41','2018-11-28 11:25:41',NULL,1),(54,'screenshot 5',1075431,'png','image/png','Screenshot from 2018-10-11 12-45-30.png',8,58,'15433863909785.png','2018-11-28 11:56:30','2018-11-28 11:56:30',NULL,1);
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(40) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('sanchari','sur','sanchari@gmail.com','123',8);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'gallery'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-11-28 14:46:49
