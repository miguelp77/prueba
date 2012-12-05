<?php
	session_start();
	require_once('includes/db_tools.inc');
	$db=$_SESSION['db_name'];
	$idQ=$_SESSION['idQ'];	
	conectar($db);
	if($idQ>=1){
	$sql="DELETE FROM Cuestiones WHERE Cuestion_id=$idQ";
	$query=mysql_query($sql) or die (mysql_error());
	$sql="DELETE FROM Respuestas WHERE Cuestion_id=$idQ";
	$query=mysql_query($sql) or die (mysql_error());

	$query="SELECT Cuestion_id FROM Cuestiones WHERE Cuestion_id = (SELECT MAX(Cuestion_id) FROM Cuestiones)";
	$result = mysql_query($query) or die(mysql_error());
	$Yorch = mysql_fetch_array($result);
	$_SESSION['idQ']=(int)$Yorch[0];
	//	unset($_SESSION['idQ']);
	}
	
?>
