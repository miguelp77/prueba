<?php
	session_start();
	require_once('includes/basics.php');
//	conectar($_SESSION['db_name']);
	require_once('includes/db_tools.inc');
//	require_once('includes/misfunciones.php');
	$db=$_SESSION['db_name'];
	conectar($db);
	$idDesc=htmlspecialchars(trim($_POST['idDesc']));;
	$newDesc=htmlspecialchars(trim($_POST['newDesc']));;
	

	$query="UPDATE Conceptos SET Descripcion='$newDesc' WHERE idConcepto='$idDesc'";
	$result = mysql_query($query) or die(mysql_error());;
	echo $newDesc;
?>
