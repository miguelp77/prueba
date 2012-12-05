<?php
	session_start();
//Restaurar la base de datos
	require_once('includes/db_tools.inc');
	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		conectar($db);
	}
	if($db!="asg_admin"){
	unset($_SESSION['idQ']);
	unset($_SESSION['db_name']);
//	db_clone($db);
//	db_delete($db);
//	add_field();
// create_examenes_table();

	}
?>
