<?php
//Actualizo el Nombre de los TEMAS
	session_start();
//	header ('Content-type: text/html; charset=utf-8');
	require_once('includes/db_tools.inc');
//	require_once('includes/misfunciones.php');
	$db=$_SESSION['db_name'];
	conectar($db);

	$idTh = htmlspecialchars(trim($_POST['Tema']));  
	$Tema= htmlspecialchars(trim($_POST['NewTema']));  
	
	$query="UPDATE Temas SET Nombre='$Tema' WHERE idTema= '$idTh'";
	$result =mysql_query($query) or die(mysql_error());
//	echo "id: ".$idTh." Tema: ".$Tema;
	if($result) echo $Tema;
//echo (mysql_affected_rows()) ? "-- Actualizada.<br />" : "-- Sin cambios. <br />"; 

?>
