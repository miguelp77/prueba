<?php
//Actualizo Enunciado de la cuestiones
	require_once('includes/misfunciones.php');
	$conn = Conectar();
	$q_id = htmlspecialchars(trim($_POST['Resp_id']));  
	$respuesta= htmlspecialchars(trim($_POST['Respuesta']));  
	
	$query="UPDATE Respuestas SET Respuesta='$respuesta' WHERE Resp_id= '$q_id'";
	$result =mysql_query($query) or die(mysql_error());
	if($result) echo $respuesta;
//echo (mysql_affected_rows()) ? "-- Actualizada.<br />" : "-- Sin cambios. <br />"; 

?>
