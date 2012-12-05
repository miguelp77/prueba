<?php
	require_once('includes/misfunciones.php');
	$conn=Conectar();
	$id=$_POST['id'];
//	echo "borrado ".$id;
	$sql="DELETE FROM `Alumnos` WHERE `Alumno_id` = $id LIMIT 1";
	$query=mysql_query($sql);
	echo "borrado";
//mysql_close($conn);
?>
