CREATE DATABASE  IF NOT EXISTS `prjm011` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `prjm011`;
-- MySQL dump 10.13  Distrib 8.0.25, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: prjm011
-- ------------------------------------------------------
-- Server version	8.0.25

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `prjm011001`
--

DROP TABLE IF EXISTS `prjm011001`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prjm011001` (
  `pessoa_id` int NOT NULL AUTO_INCREMENT,
  `dtcadastro` date DEFAULT NULL,
  `usr_id_exclusao` int DEFAULT NULL,
  `dtexclusao` timestamp NULL DEFAULT NULL,
  `situacao` char(1) DEFAULT '0',
  `dtregistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pessoa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prjm011001`
--

LOCK TABLES `prjm011001` WRITE;
/*!40000 ALTER TABLE `prjm011001` DISABLE KEYS */;
INSERT INTO `prjm011001` VALUES (1,'2021-07-16',NULL,NULL,'0','2021-07-16 07:49:54'),(2,'2021-07-28',NULL,NULL,'0','2021-07-28 13:48:26'),(3,'2021-07-29',NULL,NULL,'0','2021-07-29 16:52:57'),(4,'2021-07-29',NULL,NULL,'0','2021-07-29 18:27:34'),(5,'2021-07-29',NULL,NULL,'0','2021-07-29 18:27:43'),(6,'2021-07-29',NULL,NULL,'0','2021-07-29 18:29:33'),(7,'2021-07-29',NULL,NULL,'0','2021-07-29 18:29:39'),(8,'2021-07-29',NULL,NULL,'0','2021-07-29 18:29:50'),(9,'2021-07-29',NULL,NULL,'0','2021-07-29 18:30:06'),(10,'2021-07-29',NULL,NULL,'0','2021-07-29 18:30:16'),(11,'2021-07-29',NULL,NULL,'0','2021-07-29 18:30:27'),(12,'2021-07-29',NULL,NULL,'0','2021-07-29 18:31:11'),(13,'2021-07-29',NULL,NULL,'0','2021-07-29 18:31:20');
/*!40000 ALTER TABLE `prjm011001` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-07-29 16:55:38