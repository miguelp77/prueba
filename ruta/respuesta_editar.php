<?php
//Actualizo Enunciado de la cuestiones
session_start();

	require_once('includes/cuestiones.inc');
	require_once('includes/db_tools.inc');
	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		conectar($db);
	}
	else redirect_to("index.php");
	
//	if(isset($_SESSION['idQ']))$idQ=$_SESSION['idQ'];
//	if(isset($_GET['id_otra']))$idQ=$_GET['id_otra'];
	$idR =$_POST['Resp_id'];  
//	$respuesta= htmlspecialchars(trim($_POST['Respuesta']));  
	$respuesta = $_POST['Respuesta'];
	echo	$q_id;
	$query="UPDATE Respuestas SET Respuesta='$respuesta' WHERE Resp_id= '$idR'";
	$result =mysql_query($query) or die(mysql_error());
	if($result) echo $respuesta;
//echo (mysql_affected_rows()) ? "-- Actualizada.<br />" : "-- Sin cambios. <br />"; 

?>
