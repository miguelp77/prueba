<?php
session_start();

//	require_once('includes/db_config.php');
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
//	if(!($_SESSION['login_as']=='admin'))redirect_to("index.php");
	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		conectar($db);
	}else{
//		conectar("asg_admin");//redirect_to('admin_test.php');
//		$_SESSION['db_name']="asg_admin";
	echo "Sin base."."<br />";
	}

// redirect_to('admin_test.php');
//	echo "<pre>{$_SESSION['user']}</pre>";
//	var_dump(($_SESSION['login_as']=='admin'));
?>
<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title>Alumnos</title>
	<link rel="stylesheet" href="css/main.css" />
	<script type="text/javascript" src="js/alumno.js"></script> 
	</head>
<body>

<p>Listado de alumnos <?php if(isset($_SESSION['db_name'])) echo " en <b>".asg_name($_SESSION['db_name'])."</b>";?>
<spam class="small"><br />Apellidos | Nombre |  [DNI] | [status] | [Nota]</spam></p><hr />

<?php
if(isset($db)){
	$sql="SELECT * FROM Alumnos ORDER BY Apellidos ASC";
	$query=mysql_query($sql);
//	echo "<pre>";
	while($result=mysql_fetch_assoc($query)){
		echo $result['Apellidos'].', '.$result['Nombre'].'['.$result['DNI'] .'] <b>['.$result['status'].']</b> <spam class="naranja"> ['.$result['Nota']."]</spam>";
		echo "<div class='css_btt_r' name=".$result['Alumno_id']." title='editar'>editar</div>";
		echo "<div class='css_btt_r' name=".$result['Alumno_id']." title='borrar'>borrar</div>";
		echo "<hr />";
	}
}
//	echo "</pre>";
?>
<p></p>
<div id="alumno_nuevo">
	<br />
	<form>
	<input type='text' name='nombre'/>Nombre<br />
	<input type='text' name='apellidos'/>Apellidos<br />
	<input type='text' name='dni'/>DNI<br />
	<input type='text' name='alias'/>Alias<br />
	<input type='text' name='pass'/>Contraseña<br />
	</form>
	<div class='css_btt' name='create' title='Nuevo alumno'>Guardar</div>
</div>
<div id="alumno_edit">
	
	<br /><hr />
	
	<form>
	<input type='text' name='nombre_u'/>Nombre<br />
	<input type='text' name='apellidos_u'/>Apellidos<br />
	<input type='text' name='dni_u'/>DNI<br />
	<input type='text' name='alias_u'/>Alias<br />
	<input type='text' name='pass_u'/>Contraseña<br />
	</form>
	<div class='css_btt' name='update' title='Actualizar la informacion'>Actualizar</div>
	<hr /><br />
</div>
<div id="alumno_file">
	<hr />
	<input type='file' name='alumno_archivo'/>
	<div class="css_boton" name="alumno_import" title="importacion de alumnos">Continuar</div><br />
	<hr />
</div>
<?php 
if(isset($db)){
echo '<div class="css_btt" name="nuevo" title="nuevo alumno">Nuevo</div>
<div class="css_btt " name="a_import" title="importacion de alumnos">Importar</div>
<div class="css_btt" name="a_lista" title="generar lista de alumnos">Lista</div>';
}
?>
<div id="al_msg"></div>
</body>
</html>
