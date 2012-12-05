<?php
	session_start();
	require_once('includes/db_tools.inc');
	$db=$_SESSION['db_name'];
	conectar($db);

	$Nombre = htmlspecialchars(trim($_POST['Nombre']));//Nombre del CONCEPTO
	$idTema = htmlspecialchars(trim($_POST['idTema']));//id del TEMA
	$desc="Sin descripción";

	$sql_insert="INSERT INTO Conceptos (fk_idTema,Nombre,Descripcion) VALUES ('$idTema','$Nombre','$desc')";
	$query = mysql_query($sql_insert) or die(mysql_error());

?>
