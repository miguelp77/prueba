<?php
	header ('Content-type: text/html; charset=utf-8');
?>
<HTML>
<HEAD>
	<link rel=stylesheet href="estilos/style.css" type="text/css">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
	<TITLE>Creacion de cuestiones</TITLE>
	<script src="jquery/jquery-1.4.2.js" type="text/javascript"></script>
	<script src="jquery/jquery.timers.js" type="text/javascript"></script>
	<script src="jquery/jquery.hoveraccordion.min.js" type="text/javascript"></script>
	<script src="includes/scripts.js" type="text/javascript"></script>

</HEAD>
<BODY>

<div id="contenedor">
<div id="cabecera">
		<p class="centrado"><img src="imagenes/logo_uah.gif" /></p>
<div id="barra_superior">
		<span class="css_button">Boton</span>
		<span class="css_button">Boton</span>
		<span class="css_button">Imagen</span>
		<span class="css_button">Boton</span>
	</div>

</div>

	<div id="contenido">
		</div>
<div class="clear"> 
</div>
<div id="imagen1">
	<p>Imagen 1</p>
	<!--Ejemplo de imagen -->
			<p><img src="img/imagen.png" /></p>
<p>Otra</p>
			<p><img src="http://upload.wikimedia.org/wikipedia/commons/3/39/CircuitosSerieRLyRCenCC.png" /></p>
		
		<span class="css_button centrado">Fig 1</span>
</div>
<div id="sector1">
<p>Sector 1</p>
	<!--Ejemplo de imagen 

		<p class="centrado"><img src="imagenes/logo_uah.gif" /></p> -->

		<form name="myForm" id="myForm">
			<label> Imagen <input type="radio" name="sec1" value="img"/></label>
			<label> Texto <input type="radio" name="sec1" value="txt" /></label>
		</form>
		
</div>
	<span class="css_button" name="Sector1">Enunciado 1</span>

<div id="imagen2">
<p>Imagen 2</p>

		<span class="css_button centrado">Fig 2</span>
</div>

<div id="sector2">
<p>Sector 2</p>
		<p class="centrado"><img src="imagenes/logo_uah.gif" /></p>
		<span class="css_button centrado">Enunciado 2</span>
</div>
<div id="respuestas">
<p>Esta respuesta tiene varios caracteres. En varias lineas puede entrar una misma cuestión. </p>
<p>Esta respuesta tiene varios caracteres. En varias lineas puede entrar una misma cuestión. </p>
</div>

<!--<P align=center><IMG height=4 src=imagenes/linea_azul.gif width=500></P>-->

</BODY>
</HTML>
