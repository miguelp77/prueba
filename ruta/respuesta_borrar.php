<?php
	session_start();
//Actualizo Enunciado de la cuestiones
	require_once('includes/cuestiones.inc');
	require_once('includes/db_tools.inc');

	$db=$_SESSION['db_name'];
	$idQ=$_SESSION['idQ'];
	conectar($db);
	
	$q_id = htmlspecialchars(trim($_POST['Cuestion_id']));  
	//$query1="SELECT Respuesta FROM Respuestas WHERE Resp_id= '$q_id'";
	//$result =mysql_query($query1);
	//$respuesta=mysql_fetch_array($result);
	//$resp=$respuesta[0];
	
	$query2="DELETE FROM Respuestas WHERE Resp_id= '$q_id' ";
	$result2 =mysql_query($query2);
//	echo $resp,' ---    Borrada ';
	
?>
