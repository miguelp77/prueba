<?php
	session_start();
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
//Conexion
	if(isset($_SESSION['db_name'])){
	$db=$_SESSION['db_name'];
	conectar($db);
	}
//funcion
	$alumnos=Alumnos_ids();
	foreach($alumnos as $idA){
		$tiene_expediente=exist_expediente($idA,$alumnos);
		if(!$tiene_expediente) create_expediente($idA);
	}
?>
