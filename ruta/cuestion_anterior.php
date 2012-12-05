<?php
	session_start();
//Next_Q Siguiente cuestion en orden	
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	$idQ=$_SESSION['idQ'];
	$db=$_SESSION['db_name'];
	conectar($db);

	$query="SELECT Cuestion_id FROM Cuestiones WHERE Cuestion_id < '$idQ' ORDER BY Cuestion_id DESC LIMIT 1";
	$result = mysql_query($query) or die(mysql_error());
//	mysql_fetch_array($result);
	$Yorch = mysql_fetch_array($result);
	if($Yorch[0]) $_SESSION['idQ']=(int)$Yorch[0];
	if(!$Yorch[0]){
		$query="SELECT Cuestion_id FROM Cuestiones WHERE Cuestion_id = (SELECT MAX(Cuestion_id) FROM Cuestiones)";
		$result = mysql_query($query) or die(mysql_error());
		$Yorch = mysql_fetch_array($result);
		$_SESSION['idQ']=(int)$Yorch[0];
	}
//	echo "jmjmm";

?>
