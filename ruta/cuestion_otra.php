<?php
	session_start();
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		$conn=conectar($db);
	}
	$idQ=(int)htmlspecialchars(trim($_GET['id_otra']));
	$_SESSION['idQ']=$idQ;
	mysql_close($conn);
?>
