<?php
	session_start();
//Guardo el Drag&Drop
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	$db=$_SESSION['db_name'];
	conectar($db);
	$alumnos=array();
	if(isset($_POST['alumno'])){
		$aid=htmlspecialchars(trim($_POST['alumno']));
	}	
	if(isset($_POST['grupo'])){
		$grupo=htmlspecialchars(trim($_POST['grupo'])); //Nuevo grupo
	}
//Asigno a cada alumno su nuevo grupo
	$query="UPDATE Alumnos SET grupos='$grupo' WHERE Alumno_id='$aid'";
	$result = mysql_query($query) or die(mysql_error());

	echo $aid .' y '.$grupo;

?>
