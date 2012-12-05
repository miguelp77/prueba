<?php
	session_start();
	
//Next_Q Siguiente cuestion en orden	
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	require_once('includes/cuestiones.inc');	
	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		conectar($db);
	}	


?>
<div class="right2"><?php
	if(isset($db)){
//		echo "<u>Examenes apilados</u> <br />";
//		alumno_listar();
	}
	?></div>

<div class="status"><?php 	
	if(isset($db)){ 
		monitor(); 
	}
?></div>

