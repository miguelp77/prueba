<?php
	session_start();
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');

	if($_GET['origen'])  
		$db_origen  = trim($_GET['origen']);
	if($_GET['destino']) 
		$db_destino = utf8_decode(trim($_GET['destino']));
	$db_destino = str_replace (" ","_",$db_destino);

	if($_GET['opciones'])  
		$opciones  = trim($_GET['opciones']);


connect_to_db();
db_clone($db_origen,$db_destino,$opciones);
//Cambio las credenciales
// update_alias();
?>