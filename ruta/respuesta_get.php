<?php
	session_start();
//Obtengo Enunciado de la cuestiones
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');

	if(isset($_SESSION['db_name'])){
	$db=$_SESSION['db_name'];
	conectar($db);
	}
	$idQ=$_SESSION['idQ'];
	$idR=$_POST['idR'];
	$accion="SELECT Respuesta,Correcta,Porcentaje FROM Respuestas WHERE Resp_id= $idR";
	$query=mysql_query($accion) or die(mysql_error());
	$row=mysql_fetch_row($query);
	$row[0] = str_replace("\\\\","\\",$row[0]);
	$respuesta = join("··",$row);
	echo $respuesta;	
?>
