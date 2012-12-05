<?php
	session_start();
	header ('Content-type: text/html; charset=utf-8');
	require_once('includes/misfunciones.php');
	
	$conexion = Conectar();
	$idDesc=htmlspecialchars(trim($_POST['idDesc']));;

	$query="SELECT * FROM Conceptos WHERE idConcepto='$idDesc'";
	$result = mysql_query($query) or die(mysql_error());;
	while($Yorch= mysql_fetch_object($result)) // Descripcion del CONCEPTO
		echo $Yorch->Descripcion;
	
?>
