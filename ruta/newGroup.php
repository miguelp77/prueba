<?php
	session_start();
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		$conn=conectar($db);
	}else redirect_to('admin_test.php');

	$nombre=sanear((string)$_POST['nombre']);

	if(strlen($nombre)>1)
	{
		$sql =  "INSERT INTO Grupos (nombre) VALUES ('$nombre') ";
		$sql .= "ON DUPLICATE KEY UPDATE ";
		$sql .= "nombre = '".$nombre."'";

		$query = mysql_query($sql) or die(mysql_error());

	}
?>