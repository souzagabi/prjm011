CREATE DATABASE  IF NOT EXISTS `prjm010` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `prjm010`;
-- MySQL dump 10.13  Distrib 8.0.25, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: prjm010
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
-- Table structure for table `prjm010010`
--

DROP TABLE IF EXISTS `prjm010010`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prjm010010` (
  `seq_person_id` int NOT NULL AUTO_INCREMENT,
  `person_id` int NOT NULL,
  `name_person` varchar(64) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phonenumber` varchar(11) DEFAULT NULL,
  `rg_person` varchar(10) DEFAULT NULL,
  `cpf_person` varchar(11) DEFAULT NULL,
  `photo` blob,
  `dtregister` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`seq_person_id`),
  KEY `FK_PRJM010010_PRJM010001_idx` (`person_id`),
  CONSTRAINT `fk_PRJM010010_PRJM010001` FOREIGN KEY (`person_id`) REFERENCES `prjm010001` (`person_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prjm010010`
--

LOCK TABLES `prjm010010` WRITE;
/*!40000 ALTER TABLE `prjm010010` DISABLE KEYS */;
INSERT INTO `prjm010010` VALUES (1,1,'ADMINISTRADOR DO SISTEMA','suporte@adjsistemas.com.br','18997545642','251453245','12365845212',NULL,'2021-05-25 00:38:35'),(2,2,'LEANDRO FERREIRA DE SOUZA',NULL,'1111111111','251453246','99999999999',NULL,'2021-06-21 16:49:58'),(3,3,'MARCO AURÉLIO',NULL,'1111111111','251453247','9999999999',NULL,'2021-06-21 19:45:41');
/*!40000 ALTER TABLE `prjm010010` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-07-13 14:26:55
