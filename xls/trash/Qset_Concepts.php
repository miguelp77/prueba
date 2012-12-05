<?php
	session_start();
	header ('Content-type: text/html; charset=utf-8');
	require_once('includes/misfunciones.php');
	
	$conexion = Conectar();
	$idQ=htmlspecialchars(trim($_POST['idQ']));;
	$Ccs=htmlspecialchars(trim($_POST['Ccs']));;
	// 	$Ccs=serialize($Ccs);
//var_dump($Ccs);
	$query="UPDATE Cuestiones SET Conceptos='$Ccs' WHERE Cuestion_id='$idQ'";
	$result = mysql_query($query) or die(mysql_error());;
	//echo $Ccs;
?>
