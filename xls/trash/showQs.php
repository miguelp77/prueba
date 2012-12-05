<?php
	header ('Content-type: text/html; charset=utf-8');
	require_once('includes/misfunciones.php');
	$my_eq="";
?>
<HTML>
	<HEAD>
		<link rel=stylesheet href="estilos/micss.css" type="text/css">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
		<TITLE>Cuestiones</TITLE>
	<script src="jquery/jquery-1.4.2.js" type="text/javascript"></script>
	<script src="jquery/jquery.hoveraccordion.min.js" type="text/javascript"></script>
	<script src="jquery/jquery.timers.js" type="text/javascript"></script>
	<script src="jquery/jquery.bxGallery.min.js" type="text/javascript"></script>	
	<script src="jquery/jquery-shuffle.js" type="text/javascript"></script>	
	
	<script src="includes/scripts.js" type="text/javascript"></script> 
	
	</HEAD>
<body>
<div id="contenedor">
  <div id="cabecera">
    <p class="centrado"><img src="imagenes/logo_uah.gif" alt="logo" /></p>
  </div>
  <div id="menu">
    <ul>MENU</ul>
    <ul>Ver ecuaciones</ul>
		<ul><a href="QCreator.php?QQ=1">Volver</a></ul>
    <ul><a href="tex2png.php">Crear ecuaciones</a></ul>
    <ul><a href="#">Ver Cuestiones</a></ul>
    <ul><a href="#" id="PDF_btt">PDF</a></ul>
  </div>
  <div id="contenido">
<!--	<? echo Cuestiones();?>		-->
	<br /><br />
	Cuestiones Creadas<br />
	<div class="img2">
		<? echo GetQ(0); ?>
		<br />
	</div>	
<!--		
-->
	</div>

</div>
<!--  <div id="info"><span class="deadtime">200</span></div> -->
</body>

