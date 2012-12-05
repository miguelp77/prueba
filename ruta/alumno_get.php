<?php
	session_start();
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		$conn=conectar($db);
	}else redirect_to('admin_test.php');
//Obtengo
	$id=$_POST['id'];
//sql
	$sql="SELECT Nombre,Apellidos,DNI,Alias,Psw,grupos FROM Alumnos WHERE Alumno_id = $id";
	$query=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_row($query);
	$row[0]=trim($row[0]);
	$row[1]=trim($row[1]);
//Busqueda de grupo --- $row[5]

	$sql="SELECT nombre FROM Grupos WHERE grupo_id = $id";
	$query=mysql_query($sql) or die(mysql_error());
	$grupos=mysql_fetch_row($query);
	if($grupos==null)$grupos=0;
	array_push($row,$grupos);

	echo join(",",$row);
	
	mysql_close($conn);
?>
