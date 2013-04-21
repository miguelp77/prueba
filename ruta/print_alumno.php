<?php
session_start();		
/**
*
* Imprimir lista de alumnos
* Imprime la lista de los alumnos apuntados en la asignatura
*
*/

//Librerias
	require_once('../includes/cuestiones.inc');	
	require_once('../includes/basics.php');

	$db=$_SESSION['db_name'];
	$opciones='listado';
	$valores='';
	$mount=montar_pdfprinter($db,$opciones,$valores);
	$nombre_archivo='listado';
	$result=fast_pdf('pdfprinter.php',$nombre_archivo);
	$_SESSION['db_name']=$db;
?>


<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title>Alumnos</title>
<link rel="stylesheet" href="css/main.css" type="text/css">
</head>
<body>
<div id="#contenido">
<?php
	if($result) incrustar_pdf('listado.pdf');
//show_sessions();
?>
</div>
</body>
</html>
