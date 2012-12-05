<?php
session_start();
	require_once('includes/misfunciones.php');
	if(!($_SESSION['login_as']=='admin'))redirect_to("index.php");
//	echo "<pre>{$_SESSION['user']}</pre>";
	var_dump(($_SESSION['login_as']=='admin'));
?>
<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title>Alumnos</title>
	<link rel="stylesheet" href="css/main.css" />
	<!-- <script type="text/javascript" src="js/alumno.js"></script> -->
	</head>
<body>

<p>Listado de alumnos.<br />Apellidos | Nombre | [Alias] | [Contraseña]<hr /></p>

<?php
	
	$conexion = Conectar();

	$sql="SELECT * FROM Alumnos WHERE fk_idAsignatura=1 ORDER BY Apellidos ASC";
	$query=mysql_query($sql);
//	echo "<pre>";
	while($result=mysql_fetch_assoc($query)){
		echo $result['Apellidos'].', '.$result['Nombre'].'	['.$result['Alias']."] [".$result['Psw']."] 	<div class='css_btt' name=".$result['Alumno_id']." title='editar'>editar</div>"."<div class='css_btt' name=".$result['Alumno_id']." title='borrar'>borrar</div>"."<hr />";
	}
//	echo "</pre>";
?>
<div class='css_btt' name="nuevo" title="nuevo alumno">Nuevo</div>
<p>Fin del listado.</p>

</body>
</html>
