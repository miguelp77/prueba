<?php
//Elimino un TEMA y sus CONCEPTOS
	require_once('includes/misfunciones.php');
	$conn = Conectar();
	$idQ = htmlspecialchars(trim($_POST['idQ']));  
//	$Nombre= htmlspecialchars(trim($_POST['NewConcepto']));  
	
	$query="DELETE FROM Cuestiones WHERE Cuestion_id= '$idQ'";
	$result =mysql_query($query) or die(mysql_error());
	$query="DELETE FROM Respuestas WHERE Cuestion_id= '$idQ'";
	$result =mysql_query($query) or die(mysql_error());	
//	echo "id: ".$idTh." Tema: ".$Tema;
//	if($result) echo $Nombre;
//echo (mysql_affected_rows()) ? "-- Actualizada.<br />" : "-- Sin cambios. <br />"; 
	echo "Done!";
?>
