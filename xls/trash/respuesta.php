<?php
//Actualizo Enunciado de la cuestiones
	require_once('includes/misfunciones.php');
	$conexion = Conectar();
	$RespuestaCorrecta=0;	
	$resp = htmlspecialchars(trim($_POST['answer']));
	$q_id = htmlspecialchars(trim($_POST['Cuestion_id']));  
	$its = htmlspecialchars(trim($_POST['correcta']));
	//echo $its;
	//if $its == "good" then $its=1;
	//if $its == "bad" then $its =0;
	$query="SELECT * FROM Respuestas WHERE Cuestion_id= '$q_id' ";
	$result =mysql_query($query);
	while($answer_row= mysql_fetch_array($result)){
		if ($answer_row['Correcta'] == 1)
			$RespuestaCorrecta=1;
	}
	if ($its == 0){
		$accion="INSERT INTO Respuestas (Respuesta, Cuestion_id, Correcta) VALUES ('$resp','$q_id','$its')";
		mysql_query($accion) or die(mysql_error());
	}
	if ($its == 1)
		if ($RespuestaCorrecta == 0){
			$accion="INSERT INTO Respuestas (Respuesta, Cuestion_id, Correcta) VALUES ('$resp','$q_id','$its')";
			mysql_query($accion) or die(mysql_error());
		}
	if ($its && $RespuestaCorrecta) 
			echo '--';
	//GetAnswers_editor($q_id);
	mysql_free_result(Respuestas); // libera los registros de la tabla
	mysql_close($conexion); // cierra la conexion con la base de datos
	
?>
