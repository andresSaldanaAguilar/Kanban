-- MySQL dump 10.13  Distrib 5.5.21, for Win64 (x86)
--
-- Host: localhost    Database: proyectoisw
-- ------------------------------------------------------
-- Server version	5.5.21

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
-- Table structure for table `colaborausertab`
--
CREATE DATABASE proyectoISW;
USE proyectoISW;

DROP TABLE IF EXISTS `colaborausertab`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `colaborausertab` (
  `idUsuario` int(11) NOT NULL,
  `idTablero` int(11) NOT NULL,
  PRIMARY KEY (`idUsuario`,`idTablero`),
  KEY `idTablero` (`idTablero`),
  CONSTRAINT `colaborausertab_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `colaborausertab_ibfk_2` FOREIGN KEY (`idTablero`) REFERENCES `tablero` (`idTablero`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `colaborausertab`
--

LOCK TABLES `colaborausertab` WRITE;
/*!40000 ALTER TABLE `colaborausertab` DISABLE KEYS */;
/*!40000 ALTER TABLE `colaborausertab` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `columna`
--

DROP TABLE IF EXISTS `columna`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `columna` (
  `idColumna` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) DEFAULT NULL,
  `NumColumna` int(11) DEFAULT NULL,
  `LimitesWIP` int(11) DEFAULT NULL,
  `idTablero` int(11) DEFAULT NULL,
  PRIMARY KEY (`idColumna`),
  KEY `idTablero` (`idTablero`),
  CONSTRAINT `columna_ibfk_1` FOREIGN KEY (`idTablero`) REFERENCES `tablero` (`idTablero`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `columna`
--

LOCK TABLES `columna` WRITE;
/*!40000 ALTER TABLE `columna` DISABLE KEYS */;
INSERT INTO `columna` VALUES (1,'col1',1,7,1),(2,'col2',2,7,1),(3,'col3',3,7,1),(4,'1',1,5,2),(5,'2',2,5,2),(6,'3',3,5,2),(7,'4',4,5,2),(8,'1',1,4,3),(9,'2',2,4,3),(10,'3',3,4,3),(11,'4',4,4,3),(12,'5',5,4,3),(13,'6',6,4,3),(14,'7',7,4,3),(15,'8',8,4,3),(16,'9',9,4,3);
/*!40000 ALTER TABLE `columna` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `miembrouserport`
--

DROP TABLE IF EXISTS `miembrouserport`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `miembrouserport` (
  `idUsuario` int(11) NOT NULL,
  `idPortafolio` int(11) NOT NULL,
  PRIMARY KEY (`idUsuario`,`idPortafolio`),
  KEY `idPortafolio` (`idPortafolio`),
  CONSTRAINT `miembrouserport_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `miembrouserport_ibfk_2` FOREIGN KEY (`idPortafolio`) REFERENCES `portafolio` (`idPortafolio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `miembrouserport`
--

LOCK TABLES `miembrouserport` WRITE;
/*!40000 ALTER TABLE `miembrouserport` DISABLE KEYS */;
INSERT INTO `miembrouserport` VALUES (3,1);
/*!40000 ALTER TABLE `miembrouserport` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portafolio`
--

DROP TABLE IF EXISTS `portafolio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `portafolio` (
  `idPortafolio` int(11) NOT NULL AUTO_INCREMENT,
  `Portafolio` varchar(100) DEFAULT NULL,
  `Estado` int(11) DEFAULT NULL,
  `FechaCreacion` date DEFAULT NULL,
  `Swag` varchar(100) DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPortafolio`),
  KEY `idUsuario` (`idUsuario`),
  CONSTRAINT `portafolio_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portafolio`
--

LOCK TABLES `portafolio` WRITE;
/*!40000 ALTER TABLE `portafolio` DISABLE KEYS */;
INSERT INTO `portafolio` VALUES (1,'PortafolioTest',1,'2018-11-17','En proceso',1),(2,'Example',1,'2019-02-01','123',1);
/*!40000 ALTER TABLE `portafolio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tablero`
--

DROP TABLE IF EXISTS `tablero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tablero` (
  `idTablero` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) DEFAULT NULL,
  `idPortafolio` int(11) DEFAULT NULL,
  PRIMARY KEY (`idTablero`),
  KEY `idPortafolio` (`idPortafolio`),
  CONSTRAINT `tablero_ibfk_1` FOREIGN KEY (`idPortafolio`) REFERENCES `portafolio` (`idPortafolio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tablero`
--

LOCK TABLES `tablero` WRITE;
/*!40000 ALTER TABLE `tablero` DISABLE KEYS */;
INSERT INTO `tablero` VALUES (1,'Primer Tablero',1),(2,'Segundo Tablero',1),(3,'Ejemplo',1);
/*!40000 ALTER TABLE `tablero` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tarea`
--

DROP TABLE IF EXISTS `tarea`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tarea` (
  `idTarea` int(11) NOT NULL AUTO_INCREMENT,
  `FechaMod` date DEFAULT NULL,
  `ValorNegocios` int(11) DEFAULT NULL,
  `Titulo` varchar(100) DEFAULT NULL,
  `Estado` varchar(100) DEFAULT NULL,
  `FechaCreacion` date DEFAULT NULL,
  `TipoTarea` varchar(100) DEFAULT NULL,
  `idColumna` int(11) DEFAULT NULL,
  `idTablero` int(11) DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `Prioridad` int(11) DEFAULT NULL,
  `Progreso` int(11) DEFAULT NULL,
  `Swag` text,
  `Bloqueo` text,
  PRIMARY KEY (`idTarea`),
  KEY `idColumna` (`idColumna`),
  KEY `idTablero` (`idTablero`),
  KEY `idUsuario` (`idUsuario`),
  CONSTRAINT `tarea_ibfk_1` FOREIGN KEY (`idColumna`) REFERENCES `columna` (`idColumna`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tarea_ibfk_2` FOREIGN KEY (`idTablero`) REFERENCES `tablero` (`idTablero`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tarea_ibfk_3` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tarea`
--

LOCK TABLES `tarea` WRITE;
/*!40000 ALTER TABLE `tarea` DISABLE KEYS */;
INSERT INTO `tarea` VALUES (1,'2019-02-01',9,'Tarea1','En proceso','2018-11-17','tipo',1,1,1,3,100,'Columna swag de ejemplo',''),(2,'2018-11-23',2,'Tarea2','Observacion','2018-11-17','tipo',1,1,1,4,100,'Columna swag de ejemplo',''),(3,'2019-02-01',5,'Tarea3','En proceso','2018-11-17','tipo',1,1,1,3,100,'Columna swag de ejemplo',''),(4,'2018-11-23',5,'Tarea4','En proceso','2018-11-17','tipo',2,1,1,4,30,'Columna swag de ejemplo',''),(5,'2019-02-01',5,'Tarea5','Revision','2018-11-17','tipo',3,1,1,1,20,'Columna swag de ejemplo','wea'),(6,'2019-02-01',5,'Tarea6','Diseno Codificacion','2018-11-17','tipo',3,1,1,2,100,'Columna swag de ejemplo','Un bloqueo'),(12,'2018-11-23',2,'Prueba','Inicio','2018-11-22','Desarrollo',3,1,2,3,50,'La wea',''),(13,'2019-02-01',5,'Example','q4','2019-02-01','1234',3,1,1,5,12,'wea',''),(14,'2019-02-01',4,'wea','1','2019-02-01','1',9,3,3,5,3,'4','');
/*!40000 ALTER TABLE `tarea` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(100) DEFAULT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `ApPaterno` varchar(100) DEFAULT NULL,
  `ApMaterno` varchar(100) DEFAULT NULL,
  `Correo` varchar(100) DEFAULT NULL,
  `Contrasena` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'MigMRL','Miguel','Garcia','Cebada','j_miguel_g_cebada@hotmail.com','1234'),(2,'olblvalbt','Oswaldo','Leyva','Barriento','olblvalbt@hotmail.com','wea'),(3,'andres','andres','saldana','aguilar','andres.saldana@gmail.com','123');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-02-02  2:27:15
