<?php
	session_start();
//	header ('Content-type: text/html; charset=utf-8');
	require_once('includes/misfunciones.php');
	$conexion = Conectar();
//	$Nombre = htmlspecialchars(trim($_POST['Nombre']));//Nombre del Tema
// Another way to debug/test is to view all cookies
	setcookie('Galle', "", time()-3600);
	$Asig=($_COOKIE['Galle']);
?>
<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title>Conceptos</title>
	<link rel="stylesheet" href="css/intro.css" type="text/css">
	<link rel="stylesheet" href="css/main.css" type="text/css">	
<!--	<link rel="shortcut icon" href="http://www.uah.es/imagenes/uah.ico" /> -->
	<script type="text/javascript" src="jquery/jquery-1.4.2.js" ></script>
	<script type="text/javascript" src="jquery/jquery.cookie.js" ></script>
</head>
<body>
<div id="intro">
	<h2>Gestion Asignaturas</h2>

</div>
<div id="contenido2">
	<p>Elija una asginatura del menu para definir los conceptos.<br /></p>
	<p>Puede definirlos pulsando sobre los nombres de los <b>conceptos</b> en negrita<br /></p>
	<p>Una vez terminado pulse el <b>boton Seleciona</b>.</p>
	<div id="cb">
	<?php
		$sql="SELECT * FROM Materias";
		$query = mysql_query($sql);
		echo "<SELECT id='cbAsig' NAME='cbAsig' SIZE='1'>";
		while ($result = mysql_fetch_object( $query )){
			echo "<OPTION VALUE='$result->idAsignatura'> $result->Nombre </OPTION>";
		}
		echo "</SELECT> ";
	?>
	</div>
	<input type="button" value="Selecciona" id="SelectAsig">
	<div class="asig"></div>
	
	<div id="zona">
		<div id="formDesc">
			<textarea name="descripcion" id="" cols="38" rows="10"></textarea>
			<input type="button" id="Grabar" value="Grabar"/>
		</div>
	</div>	
</div>

	
	<script src="js/Asig.js" type="text/javascript"></script>
</body>
</html>
