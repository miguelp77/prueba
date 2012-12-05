<?php
session_start();
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
//Conecto a la BBDD
	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		conectar($db);
	}else{
	echo "Sin base."."<br />"; //Aqui habria que redirigir
	}
//Errores para la depuracion
error_reporting(1);
//
if($db=='asg_admin'){
	unset($db);
	echo 'Conexion sin alumnos.Conectese a una asignatura.';
}else{
	
	check_alumnos();
	check_examenes();
	check_alumnos();
	
}
function check_alumnos(){
	$sql="SELECT examenes FROM Alumnos";
	$query=mysql_query($sql);
	while($row=mysql_fetch_assoc($query)){
		$examenes=get_examenes($row['examenes']);
		foreach($examenes as $k=>$val){
			echo $k.'-'.$val;
			echo '<br />';
		}
		echo '<hr />';
	}
}
function check_examenes(){
	$sql="SELECT examenes FROM Alumnos";
	$query = mysql_query($sql) or die(mysql_error());	
	while($row=mysql_fetch_array($query)){
		$array=explode(",",$row[0]);
		foreach($array as $k=>$value){
			if($value==''){
				unset($array[$k]);
				echo 'Eliminado';
				echo '<br />';
			}
		}
	}
	$balance=implode(",",$array);

	$sql2="UPDATE Alumnos SET examenes='$balance'";
	$query = mysql_query($sql2) or die(mysql_error());	
}
?>
