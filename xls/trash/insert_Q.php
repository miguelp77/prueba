<?php
	session_start();
	header ('Content-type: text/html; charset=utf-8');
	require_once('includes/misfunciones.php');
	$conexion = Conectar();

	$enunciado = htmlspecialchars(trim($_POST['Enunciado']));
	$imagen1 = htmlspecialchars(trim($_POST['imagen1']));
	$imagen2 = htmlspecialchars(trim($_POST['imagen2']));
	$orden=0;
	$inicio=1;
//	$Irene="SELECT (Asig_id,Enunciado,Imagen,Imagen_aux) FROM Cuestiones WHERE Cuestion_id=1";
	$Cris="INSERT INTO Cuestiones (Enunciado,Imagen,Imagen_aux) VALUES ('$enunciado','$imagen1','$imagen2')";
	$query = mysql_query($Cris);
	//$Yorch =mysql_affected_rows();	
	//echo $Yorch;
	$Reto= mysql_insert_id();
//Ordeno los indices despues de introducir una cuestion nueva
	$Irene="SELECT Cuestion_id FROM Cuestiones ";
	$query = mysql_query($Irene);
	while($Yorch= mysql_fetch_array($query))
		{
		$orden++;
		$Sara="UPDATE Cuestiones SET Q_id='$orden' WHERE Cuestion_id= '$Yorch[0]'";
		$result =mysql_query($Sara) or die(mysql_error());
//		echo $Yorch[0].'---> '.$orden.'<br />';	
//		echo $Qid;
	}

	echo $Reto; // libera los registros de la tabla SE LIBERA SOLO
	mysql_close($conexion); // cierra la conexion con la base de datos
?>
