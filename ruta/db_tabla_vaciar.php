<?php
	session_start();
//Vaciar Tabla de la base de datos
	require_once('includes/db_tools.inc');
	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		conectar($db);
	}

	$tabla = $_POST['tabla'];  
	$sql="TRUNCATE TABLE $tabla";
	$query =mysql_query($sql) or die(mysql_error());

?>
