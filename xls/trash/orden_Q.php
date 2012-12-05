<?php
	session_start();
	header ('Content-type: text/html; charset=utf-8');
	require_once('includes/misfunciones.php');
	$conexion = Conectar();	
	$orden=0;
	$inicio=1;
	$Irene="SELECT Cuestion_id FROM Cuestiones ";
	$query = mysql_query($Irene);
	while($Yorch= mysql_fetch_array($query)){
		$orden++;
		$Sara="UPDATE Cuestiones SET Q_id='$orden' WHERE Cuestion_id= '$Yorch[0]'";
		$result =mysql_query($Sara) or die(mysql_error());
//		echo $Yorch[0].'---> '.$orden.'<br />';	
		echo $Qid;
	}
?>
