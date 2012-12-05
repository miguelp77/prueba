<?php 
	session_start();
	require_once('../includes/db_tools.inc');
	require_once('../includes/cuestiones.inc');	
	if (!isset($_SESSION['login_as']) OR $_SESSION['login_as']!='admin')
		redirect_to('index.php');
?>

<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title>Admin</title>
	<link rel=stylesheet href="css/main.css" type="text/css">
</head>
<body>
	<div id='admin_list'>
	<?php
		$link=conectar('asg_admin');
		$query="SELECT * FROM asg_admin.Admin";
		$sql=mysql_query($query) or die(mysql_error());
		while($row=mysql_fetch_row($sql)){
			echo "<span class='naranja' >".$row[2].", ".$row[1]."</span>";
			echo "<span class='small underl' value='$row[0]' name='admin_delete'>eliminar</span>";
			echo "<span class='small underl' value='$row[0]' name='admin_edit'>editar</span>";
			echo "<br />";
			echo "[".$row[3]."] [".$row[4]."]";
			echo '<hr />';
		}	
//	foreach($_SERVER as $k=>$val)
	//	echo $k.' '.$val.'<br />';

	?>
	
	</div>
	<span class='css_btt' id='show_admin_form'>Añadir</span>
	<div class='clear'></div>
	<br />
	<div id='admin_form'>
	<fieldset>
	<legend>Nuevo Administrador</legend>
<!--	<form name="input" action="admin_add.php" method="get"> -->
	<form name="input" action="#" method="get"> 
	<div class="campo">Nombre</div><input type="text" name="Nombre" autocomplete="off"/>
	<br />
	<div class="campo">Apellidos</div><input type="text" name="Apellidos" autocomplete="off"/>
	<br />	
	<div class="campo">Usuario</div><input type="text" name="Alias" autocomplete="off"/>
	<br />
	<div class="campo">Contraseña</div><input type="text" name="Psw" autocomplete="off"/>
	<br />			
	</form>
	</fieldset>
	<div class='clear'></div>	
	<span class='css_btt' id='add_admin_form'><a href="#">Guardar</a></span>
	<span class='css_btt' id='update_admin_form'><a href="#">Actualizar</a></span>
	</div>
		<script type="text/javascript" src="../js/admin_added.js"></script> 
</body>
</html>
