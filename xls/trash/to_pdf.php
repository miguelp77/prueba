<?php
	header ('Content-type: text/html; charset=utf-8');
	include('includes/misfunciones.php');
	include('includes/integrado.php');
?>
<html>
<head>

	<link rel=stylesheet href="estilos/style.css" type="text/css">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
	<TITLE>Crea PDF</TITLE>

</head>
<body>

	<img class="redondear sombrear" src="img/imagen.png" title="<? echo $my_eq; ?>"/>
	<br></br>
	<img class="redondear" src="img/imagen.png" title="<? echo $my_eq; ?>"/>
	<br></br>
	<img src="img/imagen.png" title="<? echo $my_eq; ?>"/>
	<br></br>
<!--	<span class="css_button"><a href='crear_png.php'>Previous Page</a></span> -->
	<span class="css_button"><a href="crear_png.php">Previous Page</a></span>
	<br></br>
<?php
topdf();

//	passthru('wkhtmltopdf http://localhost/crear_png.php local2.pdf');
?>

</body>
</html>
