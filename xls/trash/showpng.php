<?php
	header ('Content-type: text/html; charset=utf-8');
	require_once('includes/misfunciones.php');
	$my_eq="";
?>
<HTML>
	<HEAD>
		<link rel=stylesheet href="estilos/micss.css" type="text/css">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
		<TITLE>Imagenes de las ecuaciones</TITLE>
	<script src="jquery/jquery-1.4.2.js" type="text/javascript"></script>
	<script src="jquery/jquery.hoveraccordion.min.js" type="text/javascript"></script>
	<script src="jquery/jquery.timers.js" type="text/javascript"></script>
	<script src="jquery/jquery.bxGallery.min.js" type="text/javascript"></script>	
	<script src="includes/scripts.js" type="text/javascript"></script> 
	
	</HEAD>
<body>
<div id="contenedor">
	<div id="cabecera">
		<p class="centrado"><img src="imagenes/logo_uah.gif" /></p>
	</div>	
	<div id="menu">
		<ul>MENU</ul>
		<ul>Ver ecuaciones</ul>
		<ul><a href="QCreator.php?QQ=1">Volver</a></ul>
		<ul><a href="tex2png.php">Crear ecuaciones</a></ul>
	</div>
	<div id="contenido">
	<? echo Paginas(); ?>		<br></br>	Imagenes Creadas<br></br>
		
	<div class="img2">
		
		<? echo GetEq(0); ?>
		 
		<br></br>
	</div>	
<!--		
-->
	</div>
</div>
</body>

