<?php
	session_start();
	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
$path = './includes';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
// ini_set('include_path',ini_get('include_path').':./includes:'); 
	include('basics.php');
	include ('db_tools.inc');
//print_r(get_included_files());
echo '<br />';

	/*
function old_monitor(){
	$db=$_SESSION['db_name'];
	$sql="SELECT * FROM asg_admin.Alumnos WHERE asignatura= '$db'";
	$query=mysql_query($sql) or die(mysql_error());
	while($row=mysql_fetch_row($query)){
		if($row[7]!=null){
			echo "<hr />";
			echo "<spam class='status: $row[8]'>";
			echo $row[2]." ".$row[3]." |<b> ".$row[6]."</b>| $row[7]</spam>";
		}
	} //He quitado utf8_encode de los nombres
}
function monitor(){	
		$db=$_SESSION['db_name'];
		$sql="SELECT * FROM asg_admin.Alumnos WHERE asignatura= '$db'";
		$query=mysql_query($sql) or die(mysql_error());
		while($row=mysql_fetch_row($query)){
			if($row[7]!=null AND date_compare($row[9])<2){
				echo "<hr />";
				echo "<spam class='status: $row[8]'>";
				echo $row[2]." ".$row[3]." |<b> ".$row[6]."</b>| $row[7] | $row[9]</spam>";
			}
		} //He quitado utf8_encode de los nombres
	}
function monitor_delete(){
	$db=$_SESSION['db_name'];
	$sql="DELETE FROM asg_admin.Alumnos WHERE asignatura= '$db'";
	$query=mysql_query($sql) or die(mysql_error());
}
*/
//monitor_delete();

//	$sql="UPDATE Alumnos SET examenes='' WHERE Alias='hilario'";
//	$query=mysql_query($sql) or die(mysql_error());
?>
<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<style>
.nobreak {
    page-break-inside: avoid;
}
	#cabeza{
		margin-left:3em;
		margin-right:3em;
		font-family:"Arial";
	}
	.bloque{
		float:left;
		height:160px;
		font-size: x-small;
		padding:0.5em;

	}
	.datos{
		margin-left:2em;
		float:left;
		height:100px;
		font-size: medium;
		padding:0.5em;
		width:240px;		
	}

	.big{
		font-size: medium;
	}
	.small{
		font-size: xx-small;
	}
	.clear{
		clear: both;
	}
	</style>
	<title></title>
	</head>
	<body>
	Depurando......<hr />
<?php

conectar('asg_mike77_bak_bak');
	$all_dates=Array();
	$sql="SELECT Fechas FROM Expedientes";
	$query=mysql_query($sql) or die (mysql_error());

	while($row=mysql_fetch_row($query)){
	//	echo $row[0];
		$dates=explode(",",$row[0]);
		foreach($dates as $value){
			$YMD=date('Y-m-d',strtotime($value));
			if(!in_array($YMD,$all_dates))array_push($all_dates,$YMD);
		}
	}
	$all_dates=sort_dates($all_dates);


	$sql="SELECT Fechas,idAlumno,notas,pruebas FROM Expedientes";
	$query1=mysql_query($sql) or die (mysql_error());
	while($row=mysql_fetch_row($query1)){
	//	echo $row[0];
		$dates=explode(",",$row[0]);
		$notas=explode(",",$row[2]);
		$pruebas=explode(",",$row[3]);
		foreach($all_dates as $value){
	//		$YMD=date('Y-m-d',strtotime($value));
	//echo $value;
		//	var_dump(in_array($value,$dates));
			if(!in_array($value,$dates)){ 
			//	echo $row[1].' No tiene la fecha '.$value.'<br />';
				$dates[]=$value;
				$notas[]='np';
				$pruebas[]=0;
			}

		}
//		$dates=sort_dates($dates);//		show_arr($dates);//		show_arr($notas);
//		$str_pruebas=implode(",",$pruebas);
//		$str_notas=implode(",",$notas);
//		$str_fechas=implode(",",$dates);
		$idA=$row[1];
//		$sql="UPDATE Expedientes SET pruebas='$str_pruebas',notas='$str_notas',Fechas='$str_fechas' WHERE `idAlumno`='$idA'";
//		$query=mysql_query($sql) or die(mysql_error());
//		foreach(sort_expedientes($dates,$pruebas,$notas) as $k=>$v){
//			echo '['.$k.'] => '.$v.'<br />';
//		}
	sort_expedientes($dates,$pruebas,$notas,$idA);
		unset($pruebas);
		unset($notas);
		unset($dates);
//		echo $sql;
		echo '<hr />';
	}
	
	
function sort_expedientes($dates,$pruebas,$notas,$idA){
	foreach($dates as $val){
		$mark=strtotime($val);
		$YMD=date('Y-m-d',$mark);
		$aux[]=$YMD;
	}
	asort($aux);
	foreach($aux as $k=>$val){
		$mark=strtotime($val);
		$DMY=date('d-m-Y',$mark);
		$aux1[]=$DMY;		
		$aux_pruebas[]=$pruebas[$k];
		$aux_notas[]=$notas[$k];
	}
//	show_arr($aux1);
//	show_arr($aux_pruebas);
//	show_arr($aux_notas);

		$str_pruebas=implode(",",$aux_pruebas);
		$str_notas=implode(",",$aux_notas);
		$str_fechas=implode(",",$aux1);
//		$idA=$row[1];
		$sql="UPDATE Expedientes SET pruebas='$str_pruebas',notas='$str_notas',Fechas='$str_fechas' WHERE `idAlumno`='$idA'";
		$query=mysql_query($sql) or die(mysql_error());

}

	

?>
</body>
</html>
