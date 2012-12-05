<?php
	session_start();
//Añado RESPUESTAS a las cuestiones
	require_once('includes/cuestiones.inc');
	require_once('includes/db_tools.inc');
//Conexion a la base de datos	
	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		conectar($db);
	}
	else redirect_to("index.php");
//Variables
	$resp = $_POST['answer'];
	$its = $_POST['correcta'];
	$idQ=$_SESSION['idQ'];
	$q_id = $idQ;//htmlspecialchars(trim($_POST['Cuestion_id']));  
	$RespuestaCorrecta=0;	
//Arreglo de expresion
	$resp = str_replace("\\","\\\\",$resp);
	echo $resp;
//Obtengo las Respuestas de la cuestion
	$query="SELECT * FROM Respuestas WHERE Cuestion_id= '$q_id' ";
	$result =mysql_query($query);
//Consulta si hay una respuesta verdadera
	while($answer_row= mysql_fetch_array($result)){
		if ($answer_row['Correcta'] == 1)
			$RespuestaCorrecta=1;
	}
//Actualizo la Base de datos	
	if ($its == 0){
		$accion="INSERT INTO Respuestas (Respuesta, Cuestion_id, Correcta,Porcentaje) VALUES ('$resp','$q_id','$its','-33')";
		mysql_query($accion) or die(mysql_error());
	}
	if ($its == 1)
		if ($RespuestaCorrecta == 0){
			$accion="INSERT INTO Respuestas (Respuesta, Cuestion_id, Correcta,Porcentaje) VALUES ('$resp','$q_id','$its','100')";
			mysql_query($accion) or die(mysql_error());
		}
	if ($its && $RespuestaCorrecta) 
			echo '--';
?>
