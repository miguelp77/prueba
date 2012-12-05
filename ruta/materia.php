<?php
	session_start();
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	if(isset($_SESSION['db_name'])) 
		if ($_SESSION['db_name']!="asg_admin") 
			redirect_to('concepto.php');
?>
<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title>Definicion de la asignatura</title>
	<link rel=stylesheet href="css/intro.css" type="text/css">
	<link rel=stylesheet href="css/main.css" type="text/css">
	<script type="text/javascript" src="jquery/jquery-1.4.2.js" ></script>
	<script type="text/javascript" src="jquery/jquery.cookie.js" ></script>
	<script src="js/DefAsig.js" type="text/javascript"></script>
</head>
<body>

			<div id="intro">
				<h2>Definición de la asignatura.</h2>
				<p>	Desde esta pantalla podra definir los temas en los que se divide la asignatura y los conceptos que se desarrollaran dentro de ellos.</p>
			</div>
			<div id="formulario">
				<div class="Materia">
					Nueva asignatura<br />
					<input type="text" id="Asig"/>
					<input type="button" value="Crear" id="newAsig"/><br />
				</div>
				<div class="temas">
					Nuevo tema<br />
					<input type="text" id="Tema"/>
					<input type="button" value="Nuevo" id="newTh"/><br />
				<div class="Otro">
					Concepto<br />
					<input type="text" id="Concepto"/>
					<input type="button" value="Nuevo" id="newConcept"/><br />
					<input type="button" value="Fin" id="bEnd"/><br />
				</div>
			</div>
			<!-- </div> -->
		
		<div class="ready"></div>
	<!-- </div> -->
	<!--Cargo aqui el js para que haga efecto sobre todo -->

</body>
</html>
