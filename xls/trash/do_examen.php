<?php
	session_start();
	header ('Content-type: text/html; charset=utf-8');
	require_once('includes/examen_func.php');
//	$examen = htmlspecialchars(trim($_POST['Examen']));//Nombre del Tema
	$exa=$_COOKIE['Examen'];
	echo $exa;
	print_r($exa);
	if(isset($exa)) echo Examen($exa);
	else echo "<h2>No hay examen.</h2> Consulte con el administrador de la sesión";
?>

