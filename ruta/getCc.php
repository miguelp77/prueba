<?php
	session_start();
//Actualizo el Nombre de los TEMAS
//	header ('Content-type: text/html; charset=utf-8');
	require_once('includes/db_tools.inc');
//	require_once('includes/misfunciones.php');
	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		conectar($db);
	}
	
	$idCc = $_POST['idConcepto'];  
//	$Nombre= htmlspecialchars(trim($_POST['NewConcepto']));  
	
	$sql="SELECT Nombre,Descripcion FROM Conceptos WHERE idConcepto= '$idCc'";
	$query =mysql_query($sql) or die(mysql_error());
//	echo "id: ".$idTh." Tema: ".$Tema;
	$row=mysql_fetch_row($query);
	echo join(",",$row);
//echo (mysql_affected_rows()) ? "-- Actualizada.<br />" : "-- Sin cambios. <br />"; 

?>
