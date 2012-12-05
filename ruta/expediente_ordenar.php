<?php
	session_start();
	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
//$path = './includes';
//set_include_path(get_include_path() . PATH_SEPARATOR . $path);
// ini_set('include_path',ini_get('include_path').':./includes:'); 
	include('includes/basics.php');
	include ('includes/db_tools.inc');
//Conexion
	if(isset($_SESSION['db_name'])){
	$db=$_SESSION['db_name'];
	conectar($db);
	}

	$all_dates=Array();
	$sql="SELECT Fechas FROM Expedientes";
	$query=mysql_query($sql) or die (mysql_error());

	while($row=mysql_fetch_row($query)){
	//	echo $row[0];
		
		if(strlen($row[0])>0)$dates=explode(",",$row[0]);
		
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
		if(strlen($row[0])>0)$dates=explode(",",$row[0]);
		if(strlen($row[2])>0)$notas=explode(",",$row[2]);
		if(strlen($row[3])>0)$pruebas=explode(",",$row[3]);
		
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

		$idA=$row[1];


	sort_expedientes($dates,$pruebas,$notas,$idA);
		unset($pruebas);
		unset($notas);
		unset($dates);
//		echo $sql;
//		echo '<hr />';
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
		$str_pruebas=implode(",",$aux_pruebas);
		$str_notas=implode(",",$aux_notas);
		$str_fechas=implode(",",$aux1);

		$sql="UPDATE Expedientes SET pruebas='$str_pruebas',notas='$str_notas',Fechas='$str_fechas' WHERE `idAlumno`='$idA'";
		$query=mysql_query($sql) or die(mysql_error());
}



?>
