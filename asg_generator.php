<?php
$conn=mysql_connect(localhost,miguel,Prima2);
$create="CREATE DATABASE asg_admin DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci";
$query = mysql_query($create) or die(mysql_error());
mysql_query("SET NAMES utf8");
$db_selected=mysql_select_db("asg_admin");
$sql="";
$sql .= "CREATE TABLE `Admin` (
  `Admin_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `Apellidos` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `Alias` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Psw` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`Admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci";
$query = mysql_query($sql) or die(mysql_error());
$sql = "";$sql .= "CREATE TABLE `Alumnos` (
  `Alumno_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `idA` int(11) NOT NULL,
  `Nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `Apellidos` text COLLATE utf8_spanish_ci NOT NULL,
  `DNI` varchar(14) COLLATE utf8_spanish_ci NOT NULL,
  `Nota` decimal(4,2) NOT NULL,
  `status` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `num_exam` int(11) DEFAULT NULL,
  `asignatura` mediumtext COLLATE utf8_spanish_ci,
  `Fecha` datetime NOT NULL,
  PRIMARY KEY (`Alumno_id`)
) ENGINE=MyISAM AUTO_INCREMENT=150 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci";
$query = mysql_query($sql) or die(mysql_error());
$sql = "";$sql .= "CREATE TABLE `Ecuaciones` (
  `eq_id` int(11) NOT NULL AUTO_INCREMENT,
  `eq_exp` text COLLATE utf8_spanish_ci NOT NULL,
  `eq_path` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `eq_des` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`eq_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci";
$query = mysql_query($sql) or die(mysql_error());
$sql = "";$sql .= "CREATE TABLE `pdfprinter` (
  `idPDF` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `BBDD` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `opciones` text COLLATE utf8_spanish_ci NOT NULL,
  `valores` text COLLATE utf8_spanish_ci NOT NULL,
  `marca` datetime NOT NULL,
  `rmks` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`idPDF`)
) ENGINE=MyISAM AUTO_INCREMENT=295 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci";
$query = mysql_query($sql) or die(mysql_error());
$sql = "";?>