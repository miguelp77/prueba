<?php
	session_start();
	header ('Content-type: text/html; charset=utf-8');
	require_once('includes/misfunciones.php');
	$conexion = Conectar();

	$Nombre = htmlspecialchars(trim($_POST['Nombre']));//Nombre del Tema
	$idAsig = htmlspecialchars(trim($_POST['idAsig']));//Nombre del Tema

//	$Irene="SELECT (Asig_id,Enunciado,Imagen,Imagen_aux) FROM Cuestiones WHERE Cuestion_id=1";
	$sql_insert="INSERT INTO Temas (fk_idAsignatura,Nombre) VALUES ('$idAsig','$Nombre')";
	$query = mysql_query($sql_insert) or die(mysql_error());
		echo mysql_insert_id(); //Devuelvo el tema
/*
// DEPURACION , Creo que no se necesita
	$Irene="SELECT idTema FROM Temas WHERE Nombre= '$Nombre'";
	$query = mysql_query($Irene);
	$Yorch= mysql_fetch_array($query);
*/

//	echo $Yorch['idTema']; //Devuelve Tema
?>
