CREATE DATABASE  IF NOT EXISTS `webanimes` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `webanimes`;
-- MySQL dump 10.13  Distrib 8.0.17, for Win64 (x86_64)
--
-- Host: localhost    Database: webanimes
-- ------------------------------------------------------
-- Server version	8.0.16

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
-- Table structure for table `animes`
--

DROP TABLE IF EXISTS `animes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `animes` (
  `idAnimes` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(45) DEFAULT NULL,
  `NumeroVots` int(11) DEFAULT '0',
  `PuntsTotals` int(11) DEFAULT '0',
  PRIMARY KEY (`idAnimes`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `animes`
--

LOCK TABLES `animes` WRITE;
/*!40000 ALTER TABLE `animes` DISABLE KEYS */;
INSERT INTO `animes` VALUES (1,'Inazuma Eleven',3,10),(2,'Evangelion',0,0),(3,'Tokyo Revengers',4,28),(4,'One Piece',0,0),(5,'Danganronpa',2,6),(6,'Sonic X',3,14),(7,'JOJO BIZARRE ADVENTURE',1,0),(8,'Kimetsu no yaiba',0,0),(9,'Jujutsu Kaisen',3,25),(10,'Thundercats',2,0),(11,'Tokyo Ghoul',1,0),(12,'Black clover',3,11),(13,'Violet Evergarden',1,9),(14,'Dragon Ball',4,21),(15,'Kaguya-sama',3,7),(16,'One Punch Man',3,20),(17,'HunterxHunter',2,19);
/*!40000 ALTER TABLE `animes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'marc@ies-sabadell.cat','tetris'),(2,'hector@ies-sabadell.cat','caillou'),(3,'gregorio@ies-sabadell.cat','escacs'),(4,'david@ies-sabadell.cat','pescamines'),(5,'antonio@ies-sabadell.cat','animacio'),(6,'nico@ies-sabadell.cat','bicicleta'),(7,'dani@ies-sabadell.cat','sistemes');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarianime`
--

DROP TABLE IF EXISTS `usuarianime`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarianime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idusuari` varchar(45) NOT NULL,
  `usuarianimeratings` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarianime`
--

LOCK TABLES `usuarianime` WRITE;
/*!40000 ALTER TABLE `usuarianime` DISABLE KEYS */;
INSERT INTO `usuarianime` VALUES (1,'3','[{\"anime\":13,\"rating\":9},{\"anime\":1,\"rating\":1},{\"anime\":6,\"rating\":3},{\"anime\":14,\"rating\":5}]'),(2,'5','[{\"anime\":11,\"rating\":0},{\"anime\":17,\"rating\":10},{\"anime\":9,\"rating\":9},{\"anime\":16,\"rating\":9},{\"anime\":6,\"rating\":9}]'),(3,'1','[{\"anime\":3,\"rating\":1},{\"anime\":10,\"rating\":0},{\"anime\":16,\"rating\":8}]'),(4,'6','[{\"anime\":12,\"rating\":2},{\"anime\":14,\"rating\":8},{\"anime\":16,\"rating\":3},{\"anime\":3,\"rating\":9},{\"anime\":1,\"rating\":0}]'),(5,'4','[{\"anime\":6,\"rating\":2},{\"anime\":10,\"rating\":0},{\"anime\":12,\"rating\":2},{\"anime\":14,\"rating\":0}]'),(6,'2','[{\"anime\":5,\"rating\":0},{\"anime\":3,\"rating\":9},{\"anime\":15,\"rating\":1},{\"anime\":14,\"rating\":8}]'),(7,'7','[{\"anime\":15,\"rating\":3},{\"anime\":5,\"rating\":6},{\"anime\":7,\"rating\":0},{\"anime\":1,\"rating\":9}]');
/*!40000 ALTER TABLE `usuarianime` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-01-17 22:10:43
