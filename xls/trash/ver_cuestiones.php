<?php 
	require_once('includes/misfunciones.php');
	require_once('funciones_de_administracion.php');
	require_once('funciones_de_administracion.tfc');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/
TR/html4/strict.dtd">
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="estilos/basic.css">
<meta http-equiv="Content-Type" content="text/html;
charset=utf-8">
<title>Cuestiones simples</title>

	    <SCRIPT SRC="jsMath/easy/load.js"></SCRIPT>
 

<script src="jquery/jquery-1.4.2.js" type="text/javascript"></script>
	<script src="jquery/jquery.timers.js" type="text/javascript"></script>
	
<script src="jquery/jquery.hoveraccordion.min.js" type="text/javascript"></script>
	<script src="includes/scripts.js" type="text/javascript"></script>
</head>
<body>
<div class='clear'>
<span class="css_button"> <a href="#"> Click me!</a> </span>
<span class="css_button"> <a href="#"> Click me!</a> </span>
<span class="css_button"> <a href="#"> Click me!</a> </span>
</div>
<div id="contenedor">
			<div id="pregunta">
				<span class="redondear"># <?php GetRelativeNumber(1); ?></span><br/>
				<span class='deadtime'>12</span>
		</div>	

	<div id='imagen1'>
			<img src="<?php GetImage(1);?> " />
	</div>
<div class='clear'></div>
	<div id="contenido">
		<div id='imagen2'>
			<img src="<?php GetImage2(1);?> " />
		</div>
	<div id='enunciado'>
		<?php GetEnunciado(1); ?>
	</div>		
		<div id='respuestas'>
			<?php GetAnswers(1); ?>
			</div>

	</div>

</div>
</body>
</html>

