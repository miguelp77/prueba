<?php
	session_start();
	require_once('includes/misfunciones.php');
//	require_once('checkuser.php');
?> 
<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title>Titulo</title>
	<link rel=stylesheet href="css/main.css" type="text/css">
		<script src="jquery/jquery-1.4.2.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/login.js"> </script>
</head>
<body>
<div id="contenedor">
	<div id="cabecera">
	Departamento de Teoria de la señal y comunicaciones.
	<!-- Pantalla de login comun -->
	</div>
	<p class="barra">template.php</p>
	<div id="menu">
<!-- Aqui va el menú.--> 		
		<div class="css_btt">opt</div><br />
		<div class="css_btt">opt</div><br />
		<div class="css_btt">opt</div><br />
		<div class="css_btt">opt</div><br />
	</div>

	<div id="contenido">
		<hr />
		<!-- Aqui va el contenido -->
		
		Contenido.
		<div class="consola">---Consola---</div>	
		<div class="campo">campo 1</div><div class="campo">campo 2</div><div class="campo">campo 3</div><div class="campo">campo 4</div>
		<div class="clear"></div>
		<div class="campo">campo</div><div class="campo">campo</div><div class="campo">campo</div><div class="campo">campo</div>
		<div class="clear"></div>
		<hr />	
		Puedo mostrarlo por campos.
	</div>
	<div id="pie">
		<!-- Aqui va el pie -->
		Pie de pagina
	</div>

</div>	
</body>
</html>
