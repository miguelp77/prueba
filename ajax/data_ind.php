<?php 
session_start();
require_once('../includes/db_config.php');
//include('../includes/GoogChart.class.php');
require_once('reports.inc');
//require_once('../includes/db_tools.php');

function get_notas($idA){
	$sql="SELECT notas FROM Expedientes WHERE idAlumno='$idA' ";
	$query=mysql_query($sql) or die (mysql_error());
	$row=mysql_fetch_row($query);
	$datas=explode(",",$row[0]);
	return $datas;
}
function get_pruebas($idA){
	$sql="SELECT pruebas FROM Expedientes WHERE idAlumno='$idA' ";
	$query=mysql_query($sql) or die (mysql_error());
	$row=mysql_fetch_row($query);
	$datas=explode(",",$row[0]);
	return $datas;
	
}
function get_dates($idA){
	$sql="SELECT Fechas FROM Expedientes WHERE idAlumno='$idA' ";
	$query=mysql_query($sql) or die (mysql_error());
	$row=mysql_fetch_row($query);
	$datas=explode(",",$row[0]);
	foreach($datas as $key=>$value){
		$YMD=date('Y-m-d',strtotime($value));
		$datas[$key]=$YMD;
	}	
	$a = array('green', 'red', 'yellow');
	return $datas;
}

function get_data($idA){
	$fechas=get_dates($idA);
	$notas=get_notas($idA);

	if($fechas[0]==null)array_shift($fechas);
	if($notas[0]==null)array_shift($notas);

	$ant=0;
	foreach($fechas as $key=>$value){
		if($value==$ant) $fechas[$key]=$ant+$key;
		$ant=$fechas[$key];
	}
//No recuerdo para que lo hice
/*
	foreach($notas as $key=>$value){
//		if($value=="np") $fechas[$key]=0;

	}
*/ 	
	$comb=array_combine($fechas,$notas);
	$arr=array();
	$cad='';
	$ant=0;

	foreach($comb as $key=>$value){
		if($value=='np') $value=0;
		if($key=='0') $key=$ant;
		array_push($arr,''.$key.'~'.$value.'');
		$ant=$key;
	}

	$cad=join(",",$arr);
	echo $cad;
}

	$asg=$_SESSION['db_name'];
	$con=conectar($asg);

	$idA2=$_SESSION['idA2'];
	$datos_ind=get_data($idA2);

?>	
