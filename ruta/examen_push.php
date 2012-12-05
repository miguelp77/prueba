<?php
	session_start();
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		$conn=conectar($db);
	}else redirect_to('admin_test.php');
//Obtengo
	$idExamen=$_POST['idExamen'];
	$examenes=array();
	
	$sql="SELECT examenes,Alumno_id FROM Alumnos";
	$query=mysql_query($sql) or die(mysql_error());
	while($row=mysql_fetch_row($query)){
		$id=$row[1];
		if(empty($row[0])){
			$examen_str=$idExamen;
		}else{
			$examenes=explode(",",$row['0']);
			array_push($examenes,$idExamen);
			$examen_str=implode(",",$examenes);
		}
			$sql3="UPDATE Alumnos SET examenes='$examen_str' WHERE Alumno_id=$id LIMIT 1";
			$query3=mysql_query($sql3) or die(mysql_error());
	}		
//	echo "Guardado!";
	mysql_close($conn);
?>
