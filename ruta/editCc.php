<?php
	session_start();
//Actualizo el Nombre de los TEMAS
//	header ('Content-type: text/html; charset=utf-8');
	require_once('includes/db_tools.inc');
//	require_once('includes/misfunciones.php');
	$db=$_SESSION['db_name'];
	conectar($db);

	$idCc = htmlspecialchars(trim($_POST['idConcepto']));  
	$Nombre= htmlspecialchars(trim($_POST['NewConcepto']));  
	
	$query="UPDATE Conceptos SET Nombre='$Nombre' WHERE idConcepto= '$idCc'";
	$result =mysql_query($query) or die(mysql_error());
//	echo "id: ".$idTh." Tema: ".$Tema;
	if($result) echo $Nombre;
//echo (mysql_affected_rows()) ? "-- Actualizada.<br />" : "-- Sin cambios. <br />"; 

?>
