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


function get_db(){
	$link=conectar('asg_admin');
//	$fecha_mysql = date('Y-m-d H:i:s');
//echo $fecha_mysql;
	$sql="SELECT asignatura FROM Alumnos WHERE status='Impreso' LIMIT 1";
	$query=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_row($query);
	if($row){
		mysql_close($link);
		return $row[0];
	}else{
			mysql_close($link);
			return false;
		} 
}
function asg_name($db=null){
	if($db!=null){
		$asig=str_replace("asg_","",$db);
		$asig=str_replace("_"," ",$asig);
		$asig=utf8_decode($asig);		
		return $asig;
	}
}
//	$db=get_db();
//	$con=conectar($db);

	
function cabeza(){
	
	echo 'Alumnos examinados <br /><hr />';
}	
function en_texto($nota){
	if($nota==-10) return 'No presentado';	
	if($nota<=4.9) return 'suspenso';
	if($nota>=5 and $nota<6.9 ) return 'Aprobado';
	if($nota>=7 and $nota<9 ) return 'notable';
	if($nota>=9) return 'sobresaliente';
}
function listame($fecha){
	$db=$GLOBALS['db'];
//	$sql="SELECT * FROM asg_admin.Alumnos WHERE asignatura='$db' AND DATE('Fecha')='2011-01-13'";
//	$sql="SELECT * FROM asg_admin.Alumnos WHERE (select date('Fecha'))='2011-01-13 *'";
//	echo $fecha;
	$sql="SELECT * FROM asg_admin.Alumnos WHERE DATE(Fecha)='$fecha'";
	$query=mysql_query($sql) or die(mysql_error());
		echo '<spam class="campo">'.'Apellidos, Nombre'.'</spam>';
		echo '<spam class="campo wd5">'.'Nota'.'</spam>';
		echo '<spam class="campo w10">'.'Calificación'.'</spam>';		
		echo '<div class="clear"><hr /></div>';
	echo '<table>';
	while($row=mysql_fetch_assoc($query)){
		echo '<tr><td><spam class="campo">'.$row['Apellidos'].','. $row['Nombre'].'</spam> ';
		echo '<spam class="campo wd5">'.$row['Nota'].'</spam> ';
		echo '<spam class="campo wd10">'.en_texto($row['Nota']).'</spam></td></tr>';
	}
	echo '</table><br />';
}
//asg_mike77_bak_bak
function get_fechas($asig){
		$fechas=array();
		$mysql_fechas=array();
		$sql="SELECT Fecha FROM asg_admin.Alumnos WHERE asignatura='$asig'";
		
//		echo $sql;
		echo '<br />';
		$query=mysql_query($sql) or die(mysql_error());
		while($row=mysql_fetch_row($query)){
			
			$phpdate = strtotime($row[0]);
			$fecha=date('d-m-Y',$phpdate);
			
//			$format_d=date('Y-m-d',$phpdate);
			
//			if(!in_array($format_d,$mysql_fechas))array_push($mysql_fechas,$format_d);
			if(!in_array($fecha,$fechas))array_push($fechas,$fecha);
//			echo $fecha.'<br />';
		}	
	return $fechas;
//	return $mysql_fechas;
}
function get_asignaturas(){
//		$db=$GLOBALS['db'];
		$asignaturas=array();
		$sql="SELECT asignatura FROM asg_admin.Alumnos";
		$query=mysql_query($sql) or die(mysql_error());
		while($row=mysql_fetch_row($query)){
			
			if(!in_array($row[0],$asignaturas))array_push($asignaturas,$row[0]);
//			echo $fecha.'<br />';
		}	
	return $asignaturas;
}

?>

<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title></title>
	<script src="../jquery/jquery-1.4.2.js"></script>
<style>
.nobreak {
    page-break-inside: avoid;
}
.clear {
	clear: both;
}
.campo{
	float:left;

	width:20em;
	font-size: medium;
	text-align:left;
	margin:0.3em;
}
.wd8{
		width:8em;

}
.wd10{
		width:10em;

}
.wd5{
		width:5em;
}
tr:nth-child(even){
    margin: 1em;
    padding: 4px;
    background-color: #dee;
}

tr:nth-child(odd){
    border-width: 0px 0px 0 0;
    margin: 1em;
    padding: 4px;
 }
.red{
		background:#f11;
	}
.green{
		background:#2ee;
}	
</style> 

</head>

<body>
<div class="rojo"></div>
<?php 
	
//	cabeza();

//$fechas=get_fechas('asg_mike77_bak_bak');
//	echo '<br />';
//	var_dump($fechas);	
//		foreach($fechas as $key=>$value ){
//			echo $key." => ".$value."<br />";
//		}	
//	$asignaturas=get_asignaturas();
//	formulario($asignaturas,'boton');
	
//	formulario($fechas,'boton');
//	foreach($fechas as $fecha ){
//	$fecha=$fechas[1];
//	echo $fecha;
//	$fecha=strtotime($fecha);
//	$fecha=date('Y-m-d',$fecha);
//	listame($fecha,$asg);
	echo "------------------------------<br />";
	$con=conectar('asg_mike77_bak_bak');
//	if($con==null) 
//		redirect_to('../public/sin_conexion.html');
//	$arr=array();
//	$arr=get_expediente(8);
	expediente();
////	presentacion_expediente(8);

	/*
	echo 'PIE DE PAGINA.<hr />';
	echo 'Impreso el '.date('G:i - d.m.Y').'<br />';
*/
//	file_put_contents('test_pdf.pdf', ob_get_clean()); 
/*
 	echo 'Fechas <br />';
	foreach($fechas as $key=>$value ){
			echo $key." => ".$value."<br />";
		}	
	echo 'Asignaturas <br />';
	foreach($asignaturas as $key=>$value ){
			echo $key." => ".$value."<br />";
		}	
*/
//		conectar('asg_admin');

function formulario($valores,$boton){
		
	echo "Elija ";
	//echo "<form action='asignatura_cambiar.php' method='post'>";
	echo "<form action='#'>";
	echo "<SELECT NAME='$boton' SIZE='1'>";
	foreach($valores as $key=>$value){
//		echo $value;
		echo "<OPTION VALUE='$value' name='db_nueva'>". $value."</OPTION>";
	}
	echo "</SELECT> ";
	echo "<input type=\"button\" name=\"cambia\" value=\"Selecciona\">";
	echo "</form>";
}
function expediente(){
		$sql="SELECT idAlumno FROM Expedientes ";
		$query=mysql_query($sql) or die (mysql_error());
		while($row=mysql_fetch_row($query)){
			presentacion_expediente($row[0]);
		}
			
		var_dump($row);
		
}
function stats_preguntas($idEx){
	$sql="SELECT preguntas,respuestas FROM Examenes WHERE idExamen=$idEx";
	$query=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_row($query);
	
	$preguntas=explode(",",$row[0]);
	$respuestas=explode(",",$row[1]);

	$n_preguntas=count($preguntas);
	$correctas=0;
	$sin_respuesta=0;
	$falladas=0;
	foreach($respuestas as $resp){
		$sql="SELECT Correcta FROM Respuestas WHERE Resp_id=$resp";
		$query=mysql_query($sql);
		$row=mysql_fetch_row($query);
		if($row[0]==1){ 
			$correctas++;
			continue;
		}
		if(preg_match('/[a-z]/',$resp)){
			$sin_respuesta++;
			continue;
		}
		if($row[0]==0){
			$falladas++;
			continue;
		}

		
	}
	$result=($correctas*100)+($falladas*(-33));
	$result=$result/($n_preguntas*10);
	$array=array($n_preguntas,$correctas,$falladas,$sin_respuesta,$result);
	return $array;
/*
 	echo 'Numero de examen: '.$idEx.'<br />';
	echo 'Numero de preguntas: '.$n_preguntas.'<br />';
	echo 'Numero de correctas: '.$correctas.'<br />';
	echo 'Numero de falladas: '.$falladas.'<br />';
	echo 'Numero de sin responder: '.$sin_respuesta.'<br />';
	echo 'Resultado '.$result.'<br />';
*/
}
function presentacion_expediente($idA){
		$sql1="SELECT Nombre,Apellidos,DNI FROM Alumnos WHERE Alumno_id=$idA";
		$query1=mysql_query($sql1) or die (mysql_error());
		echo '<hr />';
		$row=mysql_fetch_row($query1);
		echo '<b>'.$row[1].','.$row[0].' DNI: '.$row[2].'</b><br />';
		$sql="SELECT * FROM Expedientes WHERE idAlumno='$idA' ";
		$query=mysql_query($sql) or die (mysql_error());
		$row=mysql_fetch_row($query);
//		var_dump($row);
	$pruebas=explode(",",$row[2]);
	$notas=explode(",",$row[3]);
	$fechas=explode(",",$row[4]);
	$n=1;
//	var_dump($pruebas);
	$media =0;
	foreach($pruebas as $exa){
		if($exa==null)continue;
		$info="No presentado";
		if($exa!=666){
			$stats=stats_preguntas($exa);
			$info="Correctas: $stats[1] Falladas: $stats[2] Sin responder: $stats[3]";
		}
		$not=$notas[$n];
		$media +=floatval($notas[$n]);
		if($notas[$n]==null) $not='np';
		if($notas[$n]==null OR floor($notas[$n]<5)){

				echo '<div class="campo wd8 red" title="'.$info.'">'.$fechas[$n].'<spam class="campo ">'.$not.'</spam></div>';
			}
			else echo '<div class="campo wd8 green" title="'.$info.'">'.$fechas[$n].'<spam class="campo">'.$not.'</spam></div>';
		$n++;
	if($n%5==1)	echo '<div class="clear"></div>';
	}
	echo '<div class="clear"></div>';
	$n--;
	$media=$media/$n;
	$factor = pow(10, 2);
	$resultado=(round($media*$factor)/$factor);	
	echo 'media='.$resultado;
	echo '<hr />';
}



?>	

<!-- <iframe src='test_pdf.pdf'></iframe> -->
<!--<embed src='test_pdf.pdf' width='800' height='375'></embed> -->
</body>
	<script src="../js/final.js"></script>

</html>
