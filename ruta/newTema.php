<?php
	session_start();
	require_once('includes/db_tools.inc');
	$db=$_SESSION['db_name'];
	conectar($db);

	$Nombre = htmlspecialchars(trim($_POST['Nombre']));//Nombre del Tema
	$idAsig = 1;//htmlspecialchars(trim($_POST['idAsig']));//Nombre del Tema

	$sql_insert="INSERT INTO Temas (fk_idAsignatura,Nombre) VALUES ('$idAsig','$Nombre')";
	$query = mysql_query($sql_insert) or die(mysql_error());

	echo mysql_insert_id(); //Devuelvo el tema

?>
