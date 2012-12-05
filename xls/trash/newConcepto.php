<?php
	session_start();
	header ('Content-type: text/html; charset=utf-8');
	require_once('includes/misfunciones.php');
	$conexion = Conectar();

	$Nombre = htmlspecialchars(trim($_POST['Nombre']));//Nombre del Tema
	$idTema = htmlspecialchars(trim($_POST['idTema']));//Nombre del Tema
	$desc="Sin descripción";
//	$Irene="SELECT (Asig_id,Enunciado,Imagen,Imagen_aux) FROM Cuestiones WHERE Cuestion_id=1";
	$sql_insert="INSERT INTO Conceptos (fk_idTema,Nombre,Descripcion) VALUES ('$idTema','$Nombre','$desc')";
	$query = mysql_query($sql_insert) or die(mysql_error());
//	$Irene="SELECT idConcepto FROM Conceptos WHERE Nombre= '$Nombre'";
//	$query = mysql_query($Irene);
//	$Yorch= mysql_fetch_array($query);
//	echo $Yorch['idConcepto'];
?>
