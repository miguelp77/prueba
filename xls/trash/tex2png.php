<?php
	header ('Content-type: text/html; charset=utf-8');
	require_once('includes/misfunciones.php');
	$my_eq="";
?>
<HTML>
	<HEAD>
		<link rel=stylesheet href="estilos/micss.css" type="text/css">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
		<TITLE>TeX a Imagen</TITLE>
	<script src="jquery/jquery-1.4.2.js" type="text/javascript"></script>
	<script src="jquery/jquery.hoveraccordion.min.js" type="text/javascript"></script>
	<script src="jquery/jquery.timers.js" type="text/javascript"></script>
	<script src="includes/scripts.js" type="text/javascript"></script>
	</HEAD>
<body>
<div id="contenedor">
	<div id="cabecera">
		<p class="centrado"><img src="imagenes/logo_uah.gif" /></p>
	</div>	
	<div id="menu">
		<ul>menu</ul>
		<ul><a href="showpng.php">Ver ecuaciones</a></ul>
		
	</div>
	<div id="contenido">
		<p>Ecuacion</p>
			
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
			<textarea name="eq" cols=80 rows=4></textarea><br></br>
			<input type="submit" value="Crear imagen" /> 
		</form>

	<?php
		$my_eq= stripslashes($_POST['eq']);
		tex_to_png($my_eq,"imagen");
	// Ecuacuion de ejemplo
	//	tex_to_png("(a+b)^2 == f(x) = \frac {\sqrt{\frac {(s+1)}{(s-1)(s+2)}}}{2}");
	?>
	Imagen Creada	
	<div id="img_created">
		<img class="redondear sombrear" src="img/imagen.png" title="<? echo $my_eq; ?>"/>
	<!--
		<img src="img/smll.png" title="<? echo $my_eq; ?>"/> 
	-->
		<cite> <?php //	$my_eq= stripslashes($_POST['eq']);
				echo $my_eq; ?> <cite/><br></br>
	</div>	
			
<!--		
	<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<p class="submit"><input type="submit" value="Submit" /></p>
		</form>
-->
	<div id="img_name">
		<input type="text" title="ImgSave">
		<span class="css_button"><A title='SaveImg' href='#'>Salvar</A></span>
	</div>
<?php
/*
	$conn = Conectar();
	$RespuestaCorrecta=0;	
	$exp = $my_eq;
	$eq_path="~/pfc/img/";	
	$q_id = htmlspecialchars(trim($_POST['Cuestion_id']));  
	$its = htmlspecialchars(trim($_POST['correcta']));
	$accion="INSERT INTO Respuestas (Respuesta, Cuestion_id, Correcta) VALUES ('$resp','$q_id','$its')";
	mysql_query($accion) or die(mysql_error());
*/
 
?>
		

	</div>
</div>
</body>

