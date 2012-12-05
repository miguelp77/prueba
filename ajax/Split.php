<?php
	session_start();
	header ('Content-type: text/html; charset=utf-8');
	require_once('includes/misfunciones.php');
	$conexion = Conectar();
	$idA=$_COOKIE['Galle'];

//	$idA = htmlspecialchars(trim($_POST['idA']));//identeficador de las ASIGNATURA
	$Creador = "Miguel";
	$Alumnos=1;//Numero de alumnos en esta asignatura
//Obtengo el NOMBRE de la Asignatura	
	$sql_get="SELECT Nombre FROM Materias WHERE idAsignatura='$idA'";
	$query = mysql_query($sql_get) or die(mysql_error());
	$result= mysql_fetch_array($query);
	$Nombre=$result['Nombre'];	
// Compruebo si la TABLA con ese Nombre ya existe
	$sql_check="show tables like $Nombre";
	$query=mysql_query($sql_check) or die(mysql_error());
	if($query)$msg=$query;
//Creo una TABLA con el NOMBRE de la asignatura con la estructura de CUESTIONES
//	$sql_create="CREATE TABLE $Nombre LIKE Cuestiones";
//	$query = mysql_query($sql_create) or die(mysql_error());
		
//	$Irene="SELECT (Asig_id,Enunciado,Imagen,Imagen_aux) FROM Cuestiones WHERE Cuestion_id=1";
//	$sql_insert="INSERT INTO Materias (Nombre,Creador,Alumnos) VALUES ('$Nombre','$Creador','$Alumnos')";
//	$query = mysql_query($sql_insert) or die(mysql_error());
//	echo mysql_insert_id();
//	$result =mysql_query($Sara) or die(mysql_error());
	//$Yorch =mysql_affected_rows();	
	//echo $Yorch;
//	$Reto= mysql_insert_id();
//Ordeno los indices despues de introducir una cuestion nueva
/*
//Tal vez no se necesite
		$Irene="SELECT idAsignatura FROM Materias WHERE Nombre= '$Nombre'";
		$query = mysql_query($Irene);
		$Yorch= mysql_fetch_array($query);
//		echo $Yorch['idAsignatura'];
*/
return $msg;
?>
