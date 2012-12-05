<?php
	session_start();
	header ('Content-type: text/html; charset=utf-8');
	require_once('includes/misfunciones.php');
	$ahora=htmlspecialchars(trim($_POST['Ahora']));;

//Next_Q Siguiente cuestion en orden	
	$conexion = Conectar();	
	$query="SELECT Cuestion_id FROM Cuestiones WHERE Q_id > '$ahora' ORDER BY Cuestion_id ASC LIMIT 1";
	$result = mysql_query($query) or die(mysql_error());
//	mysql_fetch_array($result);
	$Yorch = mysql_fetch_array($result);
	if($Yorch[0])echo $Yorch[0];
	if(!$Yorch[0]) echo 1;	
?>
