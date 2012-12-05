<?php
	session_start();
	require_once('includes/db_tools.inc');
//	require_once('includes/misfunciones.php');
	$db=$_SESSION['db_name'];
	conectar($db);
	

	$idDesc=htmlspecialchars(trim($_POST['idDesc']));;

	$query="SELECT * FROM Conceptos WHERE idConcepto='$idDesc'";
	$result = mysql_query($query) or die(mysql_error());;
	while($Yorch= mysql_fetch_object($result)) // Descripcion del CONCEPTO
		echo $Yorch->Descripcion;
	
?>
