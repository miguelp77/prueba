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
	

	$idR =$_POST['idR'];  
	$answer = $_POST['answer'];
	$correcta=$_POST['correcta'];
	$porcentaje=$_POST['porcentaje'];
	if($porcentaje==null)$porcentaje=0;
/*
	echo $answer;	
	echo '<br />';
	$answer = str_replace("\\","\\\\",$answer);
	echo $answer;
	echo '<br />';
*/
	$answer = str_replace("\\","\\\\",$answer);
//	$answer=rawurldecode($answer);
	$query="UPDATE Respuestas SET Respuesta='$answer',Correcta=$correcta,Porcentaje=$porcentaje WHERE Resp_id='$idR'";
	$result =mysql_query($query) or die(mysql_error());
//	if($result) echo $respuesta;
//echo (mysql_affected_rows()) ? "-- Actualizada.<br />" : "-- Sin cambios. <br />"; 

?>
