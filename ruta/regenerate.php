<?php
session_start();	
	require_once('includes/db_tools.inc');
		if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		conectar($db);
	}else{
	echo "Sin base."."<br />"; //Aqui habria que redirigir
	}
	regenerate();
?>
