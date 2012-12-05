-- phpMyAdmin SQL Dump
-- version 3.3.2deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 22-12-2010 a las 12:15:22
-- Versión del servidor: 5.1.41
-- Versión de PHP: 5.3.2-1ubuntu4.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `asg_admin`
--
CREATE DATABASE `asg_admin` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `asg_admin`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Admin`
--

CREATE TABLE IF NOT EXISTS `Admin` (
  `Admin_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `Apellidos` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `Alias` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Psw` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`Admin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `Admin`
--

INSERT INTO `Admin` (`Admin_id`, `Nombre`, `Apellidos`, `Alias`, `Psw`) VALUES
(1, 'admin', '', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Alumnos`
--

CREATE TABLE IF NOT EXISTS `Alumnos` (
  `Alumno_id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `Nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `Apellidos` text COLLATE utf8_spanish_ci NOT NULL,
  `DNI` varchar(14) COLLATE utf8_spanish_ci NOT NULL,
  `Alias` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `Psw` varchar(20) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'pass',
  `status` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `IP` int(20) DEFAULT NULL,
  `asignatura` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`Alumno_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=22 ;

--
-- Volcar la base de datos para la tabla `Alumnos`
--

INSERT INTO `Alumnos` (`Alumno_id`, `Nombre`, `Apellidos`, `DNI`, `Alias`, `Psw`, `status`, `IP`, `asignatura`) VALUES
(1, 'PÃ¡CO', 'PÃ©REZ PÃ©REZ', '34534345', '', 'pass', 'realizando', NULL, 'asg_mike77_bak_bak'),
(2, 'Hilario', 'GÃ³mez', '1234123z', '', 'pass', NULL, NULL, 'asg_mike77_bak_bak'),
(3, 'PÃ¡CO', 'PÃ©REZ PÃ©REZ', '34534345', '', 'pass', NULL, NULL, 'asg_mike77_bak_bak'),
(4, 'Miguel', 'Paniagua', '3456', '', 'pass', 'respondien', NULL, 'asg_mike77_bak_bak'),
(5, 'Miguel', 'Paniagua', '3456', '', 'pass', NULL, NULL, 'asg_mike77_bak_bak'),
(6, 'Miguel', 'Paniagua', '3456', '', 'pass', NULL, NULL, 'asg_mike77_bak_bak'),
(7, 'Miguel', 'Paniagua', '3456', '', 'pass', NULL, NULL, 'asg_mike77_bak_bak'),
(8, 'nene', 'Ã±OÃ±O', '34433', '', 'pass', 'realizando', NULL, 'asg_mike77_bak_bak'),
(9, 'nene', 'Ã±OÃ±O', '34433', '', 'pass', 'respondien', NULL, 'asg_mike77_bak_bak'),
(10, 'PÃ¡CO', 'PÃ©REZ PÃ©REZ', '34534345', '', 'pass', NULL, NULL, 'asg_mike77_bak_bak'),
(11, 'PÃ¡CO', 'PÃ©REZ PÃ©REZ', '34534345', '', 'pass', NULL, NULL, 'asg_mike77_bak_bak'),
(12, 'PÃ¡CO', 'PÃ©REZ PÃ©REZ', '34534345', '', 'pass', NULL, NULL, 'asg_mike77_bak_bak'),
(13, 'Hilario', 'GÃ³mez', '1234123z', '', 'pass', NULL, NULL, 'asg_mike77_bak_bak'),
(14, 'Hilario', 'GÃ³mez', '1234123z', '', 'pass', NULL, NULL, 'asg_mike77_bak_bak'),
(15, 'PÃ¡CO', 'PÃ©REZ PÃ©REZ', '34534345', '', 'pass', NULL, NULL, 'asg_mike77_bak_bak'),
(16, 'PÃ¡CO', 'PÃ©REZ PÃ©REZ', '34534345', '', 'pass', NULL, NULL, 'asg_mike77_bak_bak'),
(17, 'MARCOS', 'ABAD GUERRERO', '87365834', '', 'pass', NULL, NULL, 'asg_mike77_bak_bak'),
(18, 'Hilario', 'GÃ³mez', '1234123z', '', 'pass', NULL, NULL, 'asg_mike77_bak_bak'),
(19, 'nene', 'Ã±OÃ±O', '34433', '', 'pass', NULL, NULL, 'asg_mike77_bak_bak'),
(20, 'nene', 'Ã±OÃ±O', '34433', '', 'pass', NULL, NULL, 'asg_mike77_bak_bak'),
(21, 'nene', 'Ã±OÃ±O', '34433', '', 'pass', NULL, NULL, 'asg_mike77_bak_bak');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Ecuaciones`
--

CREATE TABLE IF NOT EXISTS `Ecuaciones` (
  `eq_id` int(11) NOT NULL AUTO_INCREMENT,
  `eq_exp` text COLLATE utf8_spanish_ci NOT NULL,
  `eq_path` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `eq_des` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`eq_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `Ecuaciones`
--

INSERT INTO `Ecuaciones` (`eq_id`, `eq_exp`, `eq_path`, `eq_des`) VALUES
(1, '', 'img/mim.png', NULL),
(2, '', 'img/34.png', NULL);
