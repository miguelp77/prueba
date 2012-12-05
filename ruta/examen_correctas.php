<?php
	session_start();
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	require_once('includes/cuestiones.inc');	
	$db=$_SESSION['db_name'];
	conectar($db);
//Con la cookie.examen
	if(isset($_COOKIE['examen']))
		$cookie_examen=get_cookie("examen");
	else return false;//$cookie_respuesta="";
//Pillo array
	$preguntas=explode(",",$cookie_examen);
	$correctas=array();
//Hallo las respuestas correctas de las preguntas
	foreach ($preguntas as $key => $value){
		$sql="SELECT Correcta,Resp_id FROM Respuestas WHERE Cuestion_id=$value";
		$query=mysql_query($sql) or die(mysql_error());
		while($row=mysql_fetch_row($query)){
			if($row[0]==1)array_push($correctas,$row[1]);
		}
	}
	echo implode(",",$correctas);
//Destruyo los arrays
	unset($correctas);
	unset($preguntas);
?>
