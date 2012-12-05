<?php
	session_start();
	session_destroy();
	require_once('includes/db_tools.inc');
//	require_once('includes/misfunciones.php');
	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		conectar($db);//	require_once('checkuser.php');
	}
//foreach($_COOKIE as $name => $value) {
 // setcookie($name,$value,time()-3600*24);
//}


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
	<p class="barra">	 
		<?php 
		
			//echo "long: ".strlen($_SESSION['user']);
	//		$resp = (isset($_SESSION['user'])) ? "Bienvenido <b>".$_SESSION['user']."</b><a href='index.php'> __logout</a>" : "";
	//		echo $resp;
		?>
	</p>
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
		<form>
				<fieldset>
					<legend>Login</legend>
					<div class="campo">Usuario</div>
					<div class="campo"><input type="text" name="alias" autocomplete="off"/></div>
							<div class="clear"></div>
					<div class="campo">Contraseña</div>
					<div class="campo"><input type="text" name="pass" autocomplete="off"/></div>
							<div class="clear"></div>
		
				</fieldset>
		</form>
		<div class="campo"><hr /></div><button name="validar">Validar</button>
	</div>
	<div id="pie">
		login<?php unset($_SESSION['user']) ?>
		<!-- Aqui va el pie -->
	</div>

</div>	
</body>
</html>
