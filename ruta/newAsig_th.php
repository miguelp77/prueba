<?php
	session_start();
//DUPE se puede borrar, CORRECTO en newAsig_th.php	
	header ('Content-type: text/html; charset=utf-8');
	require_once('includes/misfunciones.php');
	$conexion = Conectar();

	$Nombre = htmlspecialchars(trim($_POST['Nombre']));//Nombre de la asignatura
	$Creador = "Miguel";
	$Alumnos=1;//Numero de alumnos en esta asignatura

//Creo N
	$sql_insert="INSERT INTO Materias (Nombre,Creador,Alumnos) VALUES ('$Nombre','$Creador','$Alumnos')";
	$query = mysql_query($sql_insert) or die(mysql_error());
	
	
	
	echo mysql_insert_id();
	
	
	
//	$result =mysql_query($Sara) or die(mysql_error());
	//$Yorch =mysql_affected_rows();	
	//echo $Yorch;
//	$Reto= mysql_insert_id();
//Ordeno los indices despues de introducir una cuestion nueva
		$Irene="SELECT idAsignatura FROM Materias WHERE Nombre= '$Nombre'";
		$query = mysql_query($Irene);
		$Yorch= mysql_fetch_array($query);
//		echo $Yorch['idAsignatura'];

?>
