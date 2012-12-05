<?php
	session_start();
	header ('Content-type: text/html; charset=utf-8');
	require_once('includes/misfunciones.php');
	
	$conexion = Conectar();
	$idDesc=htmlspecialchars(trim($_POST['idDesc']));;
	$newDesc=htmlspecialchars(trim($_POST['newDesc']));;
	

	$query="UPDATE Conceptos SET Descripcion='$newDesc' WHERE idConcepto='$idDesc'";
	$result = mysql_query($query) or die(mysql_error());;
	echo $newDesc;
?>
