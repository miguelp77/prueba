<?php
	require_once('../includes/db_config.php');
//require_once('../includes/db_tools.php');

function conectar($database=NULL){
	if ($database != NULL) {
		$conn=mysql_connect(DB_SERVER,DB_USER,DB_PASS);
		mysql_select_db($database);
		return $conn;  
  }
}
	$con=conectar('asg_mike_10');

	$sql="SELECT examenes,Alumno_id FROM Alumnos";
	$query = mysql_query($sql) or die(mysql_error());	
	$comun=array();
	$max=0;
	while($row=mysql_fetch_array($query)){
		$array=explode(",",$row[0]);
		if(count($array)>$max)$max=count($array);
	}
	echo 'maximo='.$max;
	$min=$max;
	$sql="SELECT examenes,Alumno_id FROM Alumnos";
	$query = mysql_query($sql) or die(mysql_error());	
	while($row=mysql_fetch_array($query)){
		$array=explode(",",$row[0]);
		if(count($array)<$min)$min=count($array);
		if(count($array)==1 and strlen($array[0]==0)) $min=0;
//		$comun=array_diff($array,$comun);
	}
	echo '--minimo='.$min.'<br />';
	$sql="SELECT examenes,Alumno_id FROM Alumnos";
	$query = mysql_query($sql) or die(mysql_error());	
	while($row=mysql_fetch_array($query)){
		$array=explode(",",$row[0]);
//			echo count($array);
//		$i=0;
		while(count($array)>$min){
			echo 'entro array='.count($array).' y min='.$min.'<br />';
			$pop=array_pop($array);
//					$i++;
			echo 'salgo con'.count($array).'y min '.$min.'<br />';
			push_expediente($row[1],666);
			update_expediente($row[1],'np');
				
		}
		$balance=implode(",",$array);
//	$balance="";
//	echo 'Reduccion->'.$balance;
		$sql2="UPDATE Alumnos SET examenes='$balance' WHERE Alumno_id='$row[1]'";
		$query2 = mysql_query($sql2) or die(mysql_error());	
//			var_dump($array);
//			echo 'Quito '.$i.' a '.$row[1].'<br />';
	}
	
//		echo $row[0].'-'.count($array).'<br />';
	
//	echo $max;
//	$balance=implode(",",$comun);
//	$balance="";
//	echo 'Reduccion->'.$balance.'eee';
//	$sql2="UPDATE Alumnos SET examenes='$balance'";
//	$query2 = mysql_query($sql2) or die(mysql_error());	
///	$sql="SELECT * FROM Alumnos";
//	$query=mysql_query($sql);
//	$count_expedientes=mysql_num_rows($query); 
//	echo $count_expedientes;

function push_expediente($idA,$numero_examen){
	
	$sql="SELECT pruebas,notas,Fechas FROM Expedientes WHERE idAlumno='$idA' ";
//	echo $idA;
	$query=mysql_query($sql) or die (mysql_error());
	$row=mysql_fetch_row($query);
	$pruebas=explode(",",$row[0]);
//	$notas=explode(",",$row[1]);
	$fechas=explode(",",$row[2]);
	$hoy=time();
	$fecha=date('d-m-Y',$hoy);
	array_push($fechas,$fecha);
	array_push($pruebas,$numero_examen);
	
	$dates=implode(",",$fechas);
	$tests=implode(",",$pruebas);
//	echo $dates;
	
	$sql2="UPDATE Expedientes SET pruebas='$tests',Fechas='$dates' WHERE idAlumno=$idA";
	$query=mysql_query($sql2) or die (mysql_error());
}
function update_expediente($idA,$nota='np'){
		$sql="SELECT notas FROM Expedientes WHERE idAlumno='$idA' ";
		$query=mysql_query($sql) or die (mysql_error());
		$row=mysql_fetch_row($query);
		$notas=explode(",",$row[0]);
		array_push($notas,$nota);
		$results=implode(",",$notas);
		$sql2="UPDATE Expedientes SET notas='$results' WHERE idAlumno=$idA";
		$query=mysql_query($sql2) or die (mysql_error());
}	
?>
