<?php
	session_start();
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		$conn=conectar($db);
	}else redirect_to('admin_test.php');
//Obtengo
	//$idAlumno=$_POST['idAlumno'];
	$examenes=array();
	$idAlumno=1;
	$sql="SELECT examenes FROM Alumnos WHERE Alumno_id=$idAlumno";
	$query=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_row($query);
//		echo $row[0]."<br />";
		$examenes=explode(",",$row[0]);
		if($examenes[0]!=null){
			foreach ($examenes as $key => $value){
//				echo $value."<br />";
			}
			$pop=array_pop($examenes);
	$stack= join(",",$examenes);
	$sql2="UPDATE Alumnos SET examenes='$stack' WHERE Alumno_id=$idAlumno LIMIT 1";
	$query2=mysql_query($sql2) or die(mysql_error());		
	echo $pop;
//	echo "<hr />";
	}else echo false;

	mysql_close($conn);

?>
