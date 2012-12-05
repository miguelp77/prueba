<?php
session_start();		
//Depura
ini_set('display_errors', 1);
error_reporting(E_ALL);
//Librerias
	require_once('includes/cuestiones.inc');	
	require_once('includes/basics.php');
//BBDD
	$db=$_SESSION['db_name'];
	$opciones='notas';
//Seleccion de grupos	
	if(isset($_POST['grupos']))$grupos=$_POST['grupos'];
		else $grupos='all';
	if($grupos=='undefined'){
		$g=get_grupos();
		$todosGrupos=implode(',', $g);
		$grupos=$todosGrupos;
	} 
//Nombre de la tabla - Fecha
	if(isset($_POST['name_tbl']))$valores=$_POST['name_tbl'];
		else $valores='02-Dec-2012';
 	echo 'valores= '.$valores.' - db= '.$db.'<br />';
//Conversion del valor fecha
	$as_time=strtotime($valores);
//	echo $as_time;
	$valores=date('d-m-Y',$as_time);
//Creo el array y lo paso a JSON
	$array=array($valores,$grupos);
	$rmks=json_encode($array);	

	$mount=montar_pdfprinter($db,$opciones,$rmks);
	echo ' Montar :: '.$mount.'<br />';
	$nombre_archivo='notas';
	$result=fast_pdf('pdfprinter.php',$nombre_archivo);
	echo ' fast_pdf = '.$result.'<br />';
	$_SESSION['db_name']=$db;

?>


<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title>Alumnos</title>
	<link rel="stylesheet" href="../css/main.css" type="text/css">
</head>
<body>
<div id="#contenido">
<?php
	if($result) incrustar_pdf('notas.pdf');
//show_sessions();
?>


</div>
</body>
</html>
