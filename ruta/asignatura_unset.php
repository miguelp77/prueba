<?php
session_start();
//No destruir.
//Necesitamos la sesion 'user'
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
//	$idQ=$_SESSION['idQ'];
//	$db=$_SESSION['db_name'];
//	conectar("asg_padre");
unset($_SESSION['idQ']);
unset($_SESSION['db_name']);
?>

