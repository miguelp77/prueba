<?php
	session_start();
	require_once('includes/db_tools.inc');

?> 
<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel=stylesheet href="css/main.css" type="text/css">
		<script src="jquery/jquery-1.4.2.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/login.js"> </script>
</head>
<body>
<div id="contenedor">
	<div id="cabecera">
		Departamento de Teoria de la señal y comunicaciones.
	<!-- Pantalla de login comun -->
	</div>
	<p class="barra"></p>
<!--
	<div id="menu">
 Aqui va el menú. 		
		<div class="css_btt">opt</div><br />
		<div class="css_btt">opt</div><br />
		<div class="css_btt">opt</div><br />
		<div class="css_btt">opt</div><br />
	</div>
-->
	<div id="contenido">
		<!-- Aqui va el contenido -->
	<div class="consola"><?php if(isset($_SESSION['msg'])){echo $_SESSION['msg']; unset($_SESSION['msg']);}?></div>
		<form action="#" method="POST">
				<fieldset>
					<legend>Login</legend>
					<div class="campo">Usuario</div>
					<div class="campo">
						<input placeholder="Introduzca su nombre" type="text" name="alias" autocomplete="off" required="required" />
					</div>
					<div class="clear"></div>
					<div class="campo">Contraseña</div>
					<div class="campo"><input placeholder="Introduzca su contraseña" type="text" name="pass" autocomplete="off"/></div>
					<div class="clear"></div>
				</fieldset>
		</form>
		<button name="validar">Validar</button>
	</div>

	</div>	
	<div id="pie">
		<?php 
			unset($_SESSION['user']);
			echo 'Portal de acceso a Examenes por test.<br />';
		//	show_sessions();
			if(!session_destroy()) echo "¡ERROR! Variables de sesion no destruidas.";		
		 ?>
		<!-- Aqui va el pie -->
	</div>
</body>
</html>
