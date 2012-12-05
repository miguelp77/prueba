<?php
	session_start();
//Elimino un TEMA y sus CONCEPTOS
	require_once('includes/db_tools.inc');
//	require_once('includes/misfunciones.php');
	if($_SESSION['db_name']){
		$db=$_SESSION['db_name'];
		conectar($db);
	
	$idTh = htmlspecialchars(trim($_POST['idTema']));  
//	$Nombre= htmlspecialchars(trim($_POST['NewConcepto']));  
	
	$query="DELETE FROM Conceptos WHERE fk_idTema= '$idTh'";
	$result =mysql_query($query) or die(mysql_error());
	$query="DELETE FROM Temas WHERE idTema= '$idTh'";
	$result =mysql_query($query) or die(mysql_error());	
	}

?>
