<?php
		require_once('includes/misfunciones.php');  
?>
<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title>Importacion</title>

		<script src="jquery/jquery-1.4.2.js" ></script>
</head>
<body>		
<div id="contenedor">
	<div id="contenido">
		<input type="button" id="Listados" value="Listados"/>
		<h4>Importacion de archivos [bdp] a la base de datos.</h4>
		<div id="bbdd">
			<p>Elige la base de datos donde importar las preguntas. O puede crear una nueva asignatura.</p>
			<?php
				SelMateria();
			?>
			</div>
		<div id="archivo">
			<p>Elige el archivo que deseas importar.<br />RECUERDE: la extensión debe de ser <red>*.bdp</red></p>
			<input type="file" id="bdp"/>
			<div id="import">
				<input type="button" id="Importar" value="Importar"/>
			</div>
		</div>
		<div id="datos">
		</div>
	</div>
	<div id="listados">
	
	</div>	
</div>

</body>
		<script src="js/import.js" ></script>
</html>
