-- MySQL dump 10.13  Distrib 5.1.67, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: asg_dummy
-- ------------------------------------------------------
-- Server version	5.1.67-0ubuntu0.11.10.1

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
-- Table structure for table `Alumnos`
--

DROP TABLE IF EXISTS `Alumnos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Alumnos` (
  `Alumno_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `Apellidos` text COLLATE utf8_spanish_ci NOT NULL,
  `DNI` varchar(14) COLLATE utf8_spanish_ci NOT NULL,
  `Alias` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `Psw` varchar(20) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'pass',
  `status` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `examenes` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `grupos` varchar(80) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `progreso` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`Alumno_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Conceptos`
--

DROP TABLE IF EXISTS `Conceptos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Conceptos` (
  `idConcepto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fk_idTema` int(10) unsigned NOT NULL DEFAULT '0',
  `Nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `Descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `Valor` int(11) DEFAULT '0',
  PRIMARY KEY (`idConcepto`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Cuestiones`
--

DROP TABLE IF EXISTS `Cuestiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Cuestiones` (
  `Cuestion_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Asig_id` tinyint(4) NOT NULL DEFAULT '0',
  `Enunciado` text COLLATE utf8_spanish_ci NOT NULL,
  `Imagen` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Imagen_aux` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Q_id` int(10) unsigned NOT NULL,
  `Conceptos` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`Cuestion_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Examenes`
--

DROP TABLE IF EXISTS `Examenes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Examenes` (
  `idExamen` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fk_Alumno_id` int(10) unsigned DEFAULT NULL,
  `IP` int(20) NOT NULL DEFAULT '0',
  `orden` text COLLATE utf8_spanish_ci,
  `expire` datetime DEFAULT NULL,
  `preguntas` text COLLATE utf8_spanish_ci,
  `respuestas` text COLLATE utf8_spanish_ci,
  `resultado` decimal(4,2) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `done` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`idExamen`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Expedientes`
--

DROP TABLE IF EXISTS `Expedientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Expedientes` (
  `idExpediente` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idAlumno` int(10) unsigned NOT NULL,
  `pruebas` text COLLATE utf8_spanish_ci,
  `notas` text COLLATE utf8_spanish_ci,
  `Fechas` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`idExpediente`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Fuentes`
--

DROP TABLE IF EXISTS `Fuentes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Fuentes` (
  `idFuente` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `identificado` datetime DEFAULT NULL,
  `created` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `preguntas` text COLLATE utf8_spanish_ci,
  `duracion` tinyint(4) DEFAULT NULL,
  `nombre` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `numero` tinyint(4) DEFAULT NULL,
  `intentos` tinyint(4) NOT NULL DEFAULT '0',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `evaluable` varchar(2) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'no',
  `show_nota` varchar(2) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'no',
  PRIMARY KEY (`idFuente`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Grupos`
--

DROP TABLE IF EXISTS `Grupos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Grupos` (
  `grupo_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `asignados` text COLLATE utf8_spanish_ci NOT NULL,
  UNIQUE KEY `grupo_id` (`grupo_id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Respuestas`
--

DROP TABLE IF EXISTS `Respuestas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Respuestas` (
  `Resp_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Respuesta` text COLLATE utf8_spanish_ci NOT NULL,
  `Cuestion_id` int(10) unsigned NOT NULL DEFAULT '0',
  `Correcta` tinyint(1) NOT NULL DEFAULT '0',
  `Ultima` tinyint(1) NOT NULL DEFAULT '-1',
  `Porcentaje` tinyint(4) NOT NULL DEFAULT '100',
  PRIMARY KEY (`Resp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Temas`
--

DROP TABLE IF EXISTS `Temas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Temas` (
  `idTema` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fk_idAsignatura` int(11) NOT NULL DEFAULT '0',
  `Numero` tinyint(4) DEFAULT NULL,
  `Nombre` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`idTema`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-04-18 20:33:35
