<?php
//Actualizo el Nombre de los TEMAS
	require_once('includes/misfunciones.php');
	$conn = Conectar();
	$idCc = htmlspecialchars(trim($_POST['idConcepto']));  
//	$Nombre= htmlspecialchars(trim($_POST['NewConcepto']));  
	
	$query="DELETE FROM Conceptos WHERE idConcepto= '$idCc'";
	$result =mysql_query($query) or die(mysql_error());
//	echo "id: ".$idTh." Tema: ".$Tema;
//	if($result) echo $Nombre;
//echo (mysql_affected_rows()) ? "-- Actualizada.<br />" : "-- Sin cambios. <br />"; 

?>
