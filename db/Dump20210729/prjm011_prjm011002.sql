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
-- Table structure for table `prjm011002`
--

DROP TABLE IF EXISTS `prjm011002`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prjm011002` (
  `pessoa_id` int NOT NULL,
  `usuario_id` int DEFAULT NULL,
  `nome` varchar(256) NOT NULL,
  `email` varchar(64) DEFAULT NULL,
  `classificacao_id` int DEFAULT NULL,
  `dtregistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pessoa_id`),
  KEY `FK_PRJM011002_PRJM011001_idx` (`pessoa_id`) /*!80000 INVISIBLE */,
  KEY `fk_PRJM011002_PRJM011005_idx` (`classificacao_id`),
  KEY `fk_PRJM011002_PRJM011004_idx` (`usuario_id`) /*!80000 INVISIBLE */,
  CONSTRAINT `fk_PRJM011002_PRJM011001` FOREIGN KEY (`pessoa_id`) REFERENCES `prjm011001` (`pessoa_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prjm011002`
--

LOCK TABLES `prjm011002` WRITE;
/*!40000 ALTER TABLE `prjm011002` DISABLE KEYS */;
INSERT INTO `prjm011002` VALUES (1,1,'ADMINISTRADOR DO SISTEMA','souteramoto@gmail.com',1,'2021-07-16 07:54:15'),(2,1,'USUÁRIO PADRÃO',NULL,2,'2021-07-28 13:48:26'),(3,1,'MILENA DOS SANTOS',NULL,3,'2021-07-29 16:52:57'),(4,1,'JOÃO NINGUÉM DA SILVA',NULL,3,'2021-07-29 18:27:34'),(5,1,'JULIANA CONCEIÇÃO DA CUNHA',NULL,3,'2021-07-29 18:27:43'),(6,1,'GABRIEL ALV',NULL,3,'2021-07-29 18:29:33'),(7,1,'GABRIEL ALVES DE SOUZA',NULL,3,'2021-07-29 18:29:39'),(8,1,'MANOEL DOS SANTOS',NULL,3,'2021-07-29 18:29:50'),(9,1,'GABRIEL A',NULL,3,'2021-07-29 18:30:06'),(10,1,'GABRIEL',NULL,3,'2021-07-29 18:30:16'),(11,1,'PEDRO DS SANTOS NEVES',NULL,3,'2021-07-29 18:30:27'),(12,1,'JORGE',NULL,3,'2021-07-29 18:31:11'),(13,1,'MARIA',NULL,3,'2021-07-29 18:31:20');
/*!40000 ALTER TABLE `prjm011002` ENABLE KEYS */;
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
