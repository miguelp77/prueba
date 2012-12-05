<?php
	session_start();
//Next_Q Siguiente cuestion en orden	
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	$db=$_SESSION['db_name'];
	conectar($db);
	$alumnos=array();
	if(isset($_POST['packet'])){
		$alumnos=htmlspecialchars(trim($_POST['packet']));
		$alumnos=explode(",",$alumnos); //Lo paso a array
	}	
	if(isset($_POST['grupo'])){
		$grupo=$_POST['grupo']; //Nuevo grupo
	}
//Asigno a cada alumno su nuevo grupo
	foreach($alumnos as $a_id){
		$query="UPDATE Alumnos SET grupos='$grupo' WHERE Alumno_id='$a_id'";
		$result = mysql_query($query) or die(mysql_error());
	}
?>
