<?php
	session_start();
	
//header("Content-type:application/pdf");
//header("Content-Disposition:attachment;filename='downloaded.pdf'");
	require_once('includes/db_tools.inc');
	require_once('includes/basics.php');
	require_once('includes/cuestiones.inc');	
	depura();
//	require_once('includes/misfunciones.php');
/*
	$base=$_SESSION['db_name'];
	echo $base.'<br />';
	$b=mb_detect_encoding($base,'utf-8',true); // false
//	var_dump($b);
	if($b){
		echo utf8_encode($base);
	}
		show_sessions();
*/

	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		$link=conectar($db);
	}
	

?>
<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title>Pruebas</title>
	<link rel="stylesheet" href="css/main.css" />

	</head>
	<body>
Pruebas
		<?php


//		depura();
$cadena='miguel paniagua leñeááááááá ';
//echo $cadena;

echo '<hr />';
huerfana_answer();
echo '<hr />';
echo '<br />';
//var_dump($link);

//		$db=$_SESSION['db_name'];
//		$link=conectar($db);
/*
$link=conectar('asg_admin');
$sql="SELECT * FROM Alumnos";
$query=mysql_query($sql) or die(mysql_error());
$invalidos=Array();
$in_status=Array();
$in_exa=Array();
$in_date=Array();

while ($row = mysql_fetch_object($query)){
	$estado=$row->status;
	$fecha=$row->Fecha;
	$idStatus=$row->Alumno_id;
	$examen=$row->num_exam;
	$st=$row->status;
	$nombre=$row->Apellidos;
	$nombre .=',';
	$nombre .=$row->Nombre;
	
//Arreglo de fecha	
	$phpdate=MySQL_to_PHP($fecha);
	$date=strtotime($fecha);
	$año=date('Y',$date);
	
//	if($año==='1970'){ //echo $idStatus.'->'.$estado.' año '.$año.'<br />';
	if($st!=='Impreso'){ //echo $idStatus.'->'.$estado.' año '.$año.'<br />';
		$invalidos[]=$idStatus;
		if($examen==NULL)$examen='--';
		$in_exa[]=$examen;
		$in_status[]=$st;
		$in_date[]=$año;
		$in_nombre[]=$nombre;
	}
}
echo 'Sin imprimir<hr />';
foreach($invalidos as $key=>$idS){
//	echo 'Borraria '. $idS.' con status: '.$in_status[$key].' y num_examen: '.$in_exa[$key].' del '.$in_date[$key].'<br />'; 
	echo "<div title='$in_date[$key]'>".$in_nombre[$key]."<span class='small'> con estado de <u>".$in_status[$key]."</u> </span><a href='#' class='rojo' name='$idS'>eliminar</a></div>";
}

//limpiar_monitorizacion($invalidos);
*/
function limpiar_monitorizacion($invalidos=null){
	foreach($invalidos as $idS){
		$sql="DELETE FROM asg_admin.Alumnos WHERE Alumno_id=$idS";
		$query=mysql_query($sql) or die(mysql_error());
	}
	echo '<br />Todos sin imprimir';
}
//	$alumnos=idAlumnos();
//	show_arr($alumnos);
//$bola=exist_expediente(9,$alumnos);
//var_dump($bola);
//if(!$bola) create_expediente(9);
//$alumnos=idAlumnos();
//show_arr($alumnos);



//$coco=replace_acute($cadena);
//echo generate(10,"$cadena");
//$s=$cadena;
//mb_detect_encoding($s, "UTF-8") == "UTF-8" ? $ret="$s": $ret='no';
/*
echo $ret;
echo utf8_encode($s);
echo utf8_decode($s);
echo "$s";
*/
//$opt="#toolbar=0&navpanes=0&scrollbar=0";
//$file='pdfs/'.'12312300_13February11_34.pdf'.$opt;

//readfile($file);

?>

	
	
	</body>
	</html>
