<?php
//require_once('includes/cuestiones.inc');
	require_once('includes/db_config.php');
	require_once('includes/db_tools.inc');
	require_once('includes/basics.php');


//	echo "asg_admin <br />";
//conectar("asg_admin");

echo "<hr />";
?>
<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel=stylesheet href="css/main.css" type="text/css">
</head>
<body>
<div id="contenedor">
	<div id="cabecera">
	<!-- Pantalla de login comun -->
	</div>
	<p class="barra">	 
		Gestor de Tests | Instalando
	</p>
<!--
	<div id="menu">Aqui va el menú.</div>
-->
	<div id="contenido">
		<!-- Aqui va el contenido -->
	<?php
	// Conexión con la base de datos
		if(connect_to_db()){
			 echo '<ul> Conectado a la base de datos.<br /></ul>';
		}else{ 
			echo '>>> Error en la conexión ... ';
		// Creacion de la base de datos de administracion
			db_create(DB_NAME);
			echo ' Base de datos creada.<br />';
		}
		echo '<ul>Administrador ... </ul>';
		conectar("asg_admin");	
		create_expresiones();
		create_admin();
		echo 'Hecho!<br />';
		echo 'Instalación Finalizada.<br />';
	?>	
		<div class="consola"></div>
		<div class="campo"></div>
	</div>
	<div id="pie">
		Instalador
	</div>

</div>	
</body>
</html>
