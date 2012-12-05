<?php
//Miro todas las bases en busca de Alumno

	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		conectar($db);//	require_once('checkuser.php');
	}
	
	

	$user="migua";
	$pass="migu";
	$resp=check_alumno($user,$pass);	
	
	echo "Existe: ".$resp;

?>
