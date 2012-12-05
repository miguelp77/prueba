<?php
	header ('Content-type: text/html; charset=utf-8');
	include('includes/misfunciones.php');
	$my_eq="";
?>

<HTML>
	<HEAD>
	<link rel=stylesheet href="estilos/style.css" type="text/css">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
	<TITLE>TeX a Imagen</TITLE>
	</HEAD>
<body>
<div id="contenedor">
	<div id="cabecera">
		<p class="centrado"><img src="imagenes/logo_uah.gif" /></p>
	</div>	
	<div id="menu">
		<ul>menu</ul>
		<ul>menu</ul>
		<ul>menu</ul>
		<ul>menu</ul>
		<ul>menu</ul>
		<ul>menu</ul>
	</div>
	<div id="contenido">
	<p>Ecuacion</p>
			
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
		
			<textarea name="eq" cols=80 rows=4></textarea> <br></br>
			<input type="submit" value="Crear imagen" /> 
		</form>

	<?php
		$my_eq= stripslashes($_POST['eq']);
		tex_to_png($my_eq);
	// Ecuacuion de ejemplo
	//	tex_to_png("(a+b)^2 == f(x) = \frac {\sqrt{\frac {(s+1)}{(s-1)(s+2)}}}{2}");
	?>
	<div id="img_created">
		<img class="redondear sombrear" src="img/imagen.png" title="<? echo $my_eq; ?>"/>
		<img src="img/smll.png" title="<? echo $my_eq; ?>"/>
		<cite> <?php 
	//	$my_eq= stripslashes($_POST['eq']);
			
		echo $my_eq; ?> <cite/>
		<br></br>
		<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<p class="submit"><input type="submit" value="Submit" /></p>
		</form>

		
	</div>
	</div>
</div>
</body>

