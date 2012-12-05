<?php
//Elimino un TEMA y sus CONCEPTOS
	require_once('includes/misfunciones.php');
	$conn = Conectar();
	$idTh = htmlspecialchars(trim($_POST['idTema']));  
//	$Nombre= htmlspecialchars(trim($_POST['NewConcepto']));  
	
	$query="DELETE FROM Conceptos WHERE fk_idTema= '$idTh'";
	$result =mysql_query($query) or die(mysql_error());
	$query="DELETE FROM Temas WHERE idTema= '$idTh'";
	$result =mysql_query($query) or die(mysql_error());	
//	echo "id: ".$idTh." Tema: ".$Tema;
//	if($result) echo $Nombre;
//echo (mysql_affected_rows()) ? "-- Actualizada.<br />" : "-- Sin cambios. <br />"; 

?>
