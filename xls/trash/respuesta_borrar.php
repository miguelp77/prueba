<?php
//Actualizo Enunciado de la cuestiones
	require_once('includes/misfunciones.php');
	$conn = Conectar();
	$q_id = htmlspecialchars(trim($_POST['Cuestion_id']));  
	$query1="SELECT Respuesta FROM Respuestas WHERE Resp_id= '$q_id'";
	$result =mysql_query($query1);
	$respuesta=mysql_fetch_array($result);
	$resp=$respuesta[0];
	
	$query2="DELETE FROM Respuestas WHERE Resp_id= '$q_id' ";
	$result2 =mysql_query($query2);
	echo $resp,' ---    Borrada ';
	
?>
