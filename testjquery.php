<?php
	session_start();
	header ('Content-type: text/html; charset=utf-8');
?>
<HTML>
<HEAD>
	<link rel=stylesheet href="estilos/style.css" type="text/css">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
	<TITLE>Acceso al servidor web del Departamento de Teoría de la Señal y Comunicaciones</TITLE>
	<script src="jquery/jquery-1.4.2.js" type="text/javascript"></script>
	<script src="jquery/jquery.hoveraccordion.min.js" type="text/javascript"></script>
	<script src="jquery/jquery.timers.js" type="text/javascript"></script>
	<script src="includes/scripts.js" type="text/javascript"></script>

<script type="text/javascript">
$(document).ready(function() {
	$('.barra').addClass('highlight');
});


</script>
</HEAD>

<BODY>

<div id="contenedor">
	
<div id="cabecera">
		<p class="centrado"><img src="imagenes/logo_uah.gif" /></p>
		<p class="barra" id="hora">	Hora</p>
<span class="css_button"><A href='#' title="Show">Ocultar</A></span>
<span class="css_button"><A href='ver_cuestiones.php' title="Show">Cuestiones</A></span>

	</div>
	<div id="menu">
	<ul>		
		<li id="li1">Cuestiones</li>
			<div id="opt1">
				Ver<br />
				Crear<br />
				Guardar<br />
			</div>
		<li id="li2">2</li>
			<div id="opt2">
				menu2<br />				
				Hora<br />			
			</div>
		<li>3</li>
		<li>4</li>
		<li>5</li>
		<li>6</li>
	</ul>
	<ul id="identifier">
   <li><a href="#">Item 1</a>
      <ul>
           <li>Subitem 1a</li>
      </ul>
   </li>
   <li><a href="#">Item 2</a>
      <ul>
           <li>Subitem 2a</li>
      </ul>
   </li>
</ul>
	</div>
	
	<div id="contenido">
	<!--<P align=center><IMG height=4 src=imagenes/linea_azul.gif width=500></P> -->

		<p><span class="css_button"><A href='#' title="Hide Menu">Hide</A></span></p>
		<p><span class="css_button"><A href='testjquery.html'>test jquery</A></span></p>
		<p><span class="css_button"><A href='#' title="Show Menu">Show</A></span></p>
		<p><span class="css_button"><A href='ver_cuestiones.php'>Ver</A></span></p>
		<p><span class="css_button"><A href='crear_png.php'>Crear ecuación</A></span></p>		
	<!--<div class="clear"></div>-->

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
