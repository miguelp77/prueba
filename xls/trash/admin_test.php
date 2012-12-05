<?php
	session_start();
//	header ('Content-type: text/html; charset=utf-8');	
	require_once('includes/misfunciones.php');
	$user_exists = (isset($_SESSION['user'])) ? true : false;
//	echo "Your IP address is " . $_SERVER['REMOTE_ADDR'];  

//	if(!$user_exists) location.href('index.php');
?> 
<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title>Administradores. Inicio</title>
	<link rel=stylesheet href="css/main.css" type="text/css">
	<script src="jquery/jquery-1.4.2.js" type="text/javascript"></script>
	<script src="jquery/jquery.hoveraccordion.min.js" type="text/javascript"></script>
	 <script type="text/javascript" src="js/admin.js"> </script>
	 <script type="text/javascript" src="js/asignatura.js"> </script> 	
	 <script type="text/javascript" src="js/alumno.js"> </script> 	
</head>
<body>
<div id="contenedor">
	<div id="cabecera">
	Departamento de Teoria de la señal y comunicaciones.
	<!-- Pantalla de login comun -->
	</div>
		
	<p class="barra"><?php 	echo "Accediendo como  ". $_SESSION['user']. " [IP " . $_SERVER['REMOTE_ADDR']."]" ?>	<a href="index.php">logout</a></p>
	<div id="menu">
<!-- Aqui va el menú.--> 		
		<div class="css_btt" name="asignaturas" title="Gestion de asignaturas">Asignaturas</div><br />
		<div class="css_btt" name="alumnos" title="Gestion de alumnos">Alumnos</div><br />
		<div class="css_btt" name="db_check" title="Comprueba la BBDD">Base de datos</div><br />		
<!--		<div class="css_btt" name="tools"  title="Herramientas">Herramientas</div><br />
		<div class="css_btt" name="monitor" title="Monitorizar la sesion actual">Monitor</div><br />
		<div class="css_btt" name="salir" title="Salir de la aplicacion">Logoff</div><br />		
-->
	</div>
<!-- comentarioHTML -->
	<div id="contenido">
Asignaturas.<br />
		<hr />
		<!-- Aqui va el contenido -->
		<!-- Contenido.<br /> -->
		
		<!-- 		<div class="consola">---Consola---</div>	 -->		

<!-- 		<div class="campo">news</div><div class="campo">JAR</div><div class="campo">mas</div><div class="campo">otros</div>
		<div class="clear"></div>
		<div class="campo">campo</div><div class="campo">campo</div><div class="campo">campo</div><div class="campo">campo</div>
		<div class="clear"></div>
		<hr />	  -->
		
		<div class="campo css_btt_l" name="new_asg">Nueva</div>
		<div class="campo css_btt_l" name="read_asg">Seleccionar</div>

	</div>
	<div id="pie">
		<!-- Aqui va el pie -->
		Pie de pagina
	</div>

</div>	
</body>
</html>
