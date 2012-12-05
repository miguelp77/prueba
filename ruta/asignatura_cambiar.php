<?php
	session_start();
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');


	if($_POST['base_nueva'])
		$db_nueva=trim($_POST['base_nueva']);
	
	if(isset($_SESSION['db_name'])) 
		unset($_SESSION['db_name']);
	
//	$_SESSION['db_name']=$db_nueva;	
		$db_nueva=parse_utf8($db_nueva);

	$_SESSION['db_name']=$db_nueva;	
	if(isset($_SESSION['idQ']))
		unset($_SESSION['idQ']);
	
	conectar($db_nueva);
	purge_respuestas();
	
	echo $_POST['base_nueva'];
//redirect_to($_SERVER['http_referrer']);


?>
