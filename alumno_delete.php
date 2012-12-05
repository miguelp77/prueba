<?php
session_start();
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		$conn=conectar($db);
	}else redirect_to('admin_test.php');
	$id=$_POST['id'];
//	echo "borrado ".$id;
	$sql="DELETE FROM `Alumnos` WHERE `Alumno_id` = $id LIMIT 1";
	$query=mysql_query($sql);
	echo "borrado";
mysql_close($conn);
?>
