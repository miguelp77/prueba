-- phpMyAdmin SQL Dump
-- version 3.3.2deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 22-12-2010 a las 12:13:39
-- Versión del servidor: 5.1.41
-- Versión de PHP: 5.3.2-1ubuntu4.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `asg_mike77_bak_bak`
--
CREATE DATABASE `asg_mike77_bak_bak` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `asg_mike77_bak_bak`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Alumnos`
--

CREATE TABLE IF NOT EXISTS `Alumnos` (
  `Alumno_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `Apellidos` text COLLATE utf8_spanish_ci NOT NULL,
  `DNI` varchar(14) COLLATE utf8_spanish_ci NOT NULL,
  `Alias` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `Psw` varchar(20) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'pass',
  `status` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `examenes` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`Alumno_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=19 ;

--
-- Volcar la base de datos para la tabla `Alumnos`
--

INSERT INTO `Alumnos` (`Alumno_id`, `Nombre`, `Apellidos`, `DNI`, `Alias`, `Psw`, `status`, `examenes`) VALUES
(1, 'Miguel', 'Paniagua', '3456', 'migu', 'migu', NULL, '13,13,13,13,13,13,13,13,16,16,16,16,16,16'),
(2, 'miguel', 'paniagua', '1234567', 'miguel', 'miguel123', NULL, '4,13,13,13,13,13,13,13,13,16,16,16,16,16,16'),
(3, 'MARCOS', 'ABAD GUERRERO', '87365834', 'abad', 'abad', NULL, '16,16,16,16,13,13,13,13,13,13,13,13,16,16,16,16,16'),
(4, 'PÃ¡CO', 'PÃ©REZ PÃ©REZ', '34534345', 'perez', 'perez', NULL, '13,13,13,13,13,13,13,16,16,16,16,16,16'),
(7, 'PACO', 'PÃ©REZ PÃ©REZ', '234345z', 'migu3', 'migu3', NULL, '4,5,4,4,16,16,16,16,16,16,16,16,16,13,13,13,13,13,'),
(8, 'Hilario', 'GÃ³mez', '1234123z', 'hilario', 'hilario', NULL, '4,5,4,4,16,16,16,16,16,13,13,13,13,13,13,13,16,16,'),
(9, 'nene', 'Ã±OÃ±O', '34433', 'nene', 'nene', NULL, '13,13,13,13,13,13,13,13,16,16,16,16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Conceptos`
--

CREATE TABLE IF NOT EXISTS `Conceptos` (
  `idConcepto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fk_idTema` int(10) unsigned NOT NULL DEFAULT '0',
  `Nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `Descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `Valor` int(11) DEFAULT '0',
  PRIMARY KEY (`idConcepto`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `Conceptos`
--

INSERT INTO `Conceptos` (`idConcepto`, `fk_idTema`, `Nombre`, `Descripcion`, `Valor`) VALUES
(1, 1, 'unico', 'Sin descripciÃ³n', 0),
(2, 2, 'uno', 'Sin descripciÃ³n', 0),
(3, 2, 'dos', 'Sin descripciÃ³n', 0),
(4, 3, 'se_ales_feb_99.bdp', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cuestiones`
--

CREATE TABLE IF NOT EXISTS `Cuestiones` (
  `Cuestion_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Asig_id` tinyint(4) NOT NULL DEFAULT '0',
  `Enunciado` text COLLATE utf8_spanish_ci NOT NULL,
  `Imagen` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Imagen_aux` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Q_id` int(10) unsigned NOT NULL,
  `Conceptos` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`Cuestion_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=13 ;

--
-- Volcar la base de datos para la tabla `Cuestiones`
--

INSERT INTO `Cuestiones` (`Cuestion_id`, `Asig_id`, `Enunciado`, `Imagen`, `Imagen_aux`, `Q_id`, `Conceptos`) VALUES
(1, 0, ' La relaciÃ³n entrada-salida de un sistema estÃ¡ definida por la siguiente expresiÃ³n:\nIndicar cual de las siguientes afirmaciones es verdadera.\n', NULL, NULL, 0, ''),
(12, 0, ' Doce ak los coeficientes del desarrollo en serie de Fourier del tren de pulsos rectangulares de la figura 1. Indicar cual de las siguientes respuestas corresponde a los coeficientes del desarrollo en serie de Fourier de la seÃ±al de la figura 2.\n', NULL, NULL, 0, '');

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `Ecuaciones`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Examenes`
--

CREATE TABLE IF NOT EXISTS `Examenes` (
  `idExamen` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fk_Alumno_id` int(10) unsigned DEFAULT NULL,
  `IP` int(20) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `expire` datetime DEFAULT NULL,
  `preguntas` text COLLATE utf8_spanish_ci,
  `respuestas` text COLLATE utf8_spanish_ci,
  `resultado` decimal(4,2) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `done` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`idExamen`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=20 ;

--
-- Volcar la base de datos para la tabla `Examenes`
--

INSERT INTO `Examenes` (`idExamen`, `fk_Alumno_id`, `IP`, `created`, `expire`, `preguntas`, `respuestas`, `resultado`, `start`, `done`, `status`) VALUES
(1, 4, 1501623735, NULL, '2010-12-26 21:57:59', '2,10,11,5', NULL, NULL, '2010-12-19 21:57:59', NULL, 1),
(19, 9, -1062675992, NULL, '2010-12-29 10:45:56', '9,10,5,12', NULL, NULL, '2010-12-22 10:45:56', NULL, 1);


CREATE TABLE IF NOT EXISTS `Fuentes` (
  `idFuente` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `identificado` datetime DEFAULT NULL,
  `created` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `preguntas` text COLLATE utf8_spanish_ci,
  `duracion` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `numero` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`idFuente`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=17 ;

INSERT INTO `Fuentes` (`idFuente`, `identificado`, `created`, `preguntas`, `duracion`, `status`, `numero`) VALUES
(13, '2010-12-12 20:24:48', '', '1,2,3,4,5,6,7,8,9,10,11,12', NULL, 0, 5),
(16, '2010-12-15 19:10:20', 'admin ', '1,2,3,4,5,6,7,8,9,10,11,12', 20, 0, 4);

-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `Respuestas` (
  `Resp_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Respuesta` text COLLATE utf8_spanish_ci NOT NULL,
  `Cuestion_id` int(10) unsigned NOT NULL DEFAULT '0',
  `Correcta` tinyint(1) NOT NULL DEFAULT '0',
  `Ultima` tinyint(1) NOT NULL DEFAULT '-1',
  `Porcentaje` tinyint(4) NOT NULL DEFAULT '100',
  PRIMARY KEY (`Resp_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=47 ;

--
-- Volcar la base de datos para la tabla `Respuestas`
--

INSERT INTO `Respuestas` (`Resp_id`, `Respuesta`, `Cuestion_id`, `Correcta`, `Ultima`, `Porcentaje`) VALUES
(1, ' El sistema es lineal e invariante en el tiempo.\n', 1, 1, -1, 100),
(13, '5 a', 5, 0, -1, -33),
(25, ' El sistema es causal y estable.\n', 8, 0, -1, -33),
(45, '4 d', 3, 0, -1, -33);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Temas`
--

CREATE TABLE IF NOT EXISTS `Temas` (
  `idTema` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fk_idAsignatura` int(11) NOT NULL DEFAULT '0',
  `Numero` tinyint(4) DEFAULT NULL,
  `Nombre` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`idTema`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcar la base de datos para la tabla `Temas`
--

INSERT INTO `Temas` (`idTema`, `fk_idAsignatura`, `Numero`, `Nombre`) VALUES
(1, 1, NULL, 'tema unico'),
(2, 1, NULL, 'tema varios'),
(3, 0, NULL, 'Importado');
