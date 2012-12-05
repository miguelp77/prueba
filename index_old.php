<?php
	session_start();
	header ('Content-type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<HTML>
<HEAD>
	<link rel=stylesheet href="estilos/style.css" type="text/css">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
	<TITLE>Acceso al servidor web del Departamento de Teoría de la Señal y Comunicaciones</TITLE>
<script src="jquery/jquery-1.4.2.js" type="text/javascript"></script>
<script src="jquery/jquery.hoveraccordion.min.js" type="text/javascript"></script>
	<script src="jquery/jquery.timers.js" type="text/javascript"></script>
	<script src="includes/scripts.js" type="text/javascript"></script>
</HEAD>

<BODY>

<div id="contenedor">
	<div id="cabecera">
		<p class="centrado"><img src="imagenes/logo_uah.gif" /></p>
	</div>
	<div id="menu">
		<ul>menu</ul>
	</div>
	
	<div id="contenido">
	<!--<P align=center><IMG height=4 src=imagenes/linea_azul.gif width=500></P> -->
		<p class="barra">	acceso</p>
<!--	  <p><span class="css_button"><A href='login.php'>Acceso</A></span></p>
    <p><span class="css_button"><A href='bienvenida_administracion.tfc'>Acceso de Profesores</A></span></p>
		<p><span class="css_button"><A href='testjquery.php'>test jquery</A></span></p>
		<p><span class="css_button"><A href='showQs.php'>Cuestiones creadas</A></span></p>
		<p><span class="css_button"><A href='QCreator.php'>Crear</A></span></p>
		<p><span class="css_button"><A href='Qver.php'>Ver</A></span></p>
		<p><span class="css_button"><A href='crear_png.php'>Crear ecuación</A></span></p>
-->


	<p><span class="css_button">Asignaturas</span></p>
	<p><span class="css_button">Alumnos</span></p>
	<p><span class="css_button"><A href='QCreator.php?QQ=1'>Cuestiones</a></span></p>
				
	<!--<div class="clear"></div>-->
	<!--Test ACORDEON-->
<ul id="identifier">
   <li><a href="#">Item 1</a>
      <ul>
           <li>Sub 1a</li>
      </ul>
   </li>
   <li><a href="#">Item 2</a>
      <ul>
           <li>Sub 2a</li>
           <li>Sub 2b</li>
           <li>Sub 2c</li>

      </ul>
   </li>
</ul>

		<p class="barra css_button"> <br></p>

	</div>

<!--<P align=center><IMG height=4 src=imagenes/linea_azul.gif width=500></P>-->
<div id="pie">
		Departamento de Teoría de la señal y Comunicaciones<BR><BR>
	<p class = "firma">TFC Miguel Ángel Paniagua García-Baquero</p>
</div>


<span class="css_button"> Save Now </span>

</BODY>
</HTML>
