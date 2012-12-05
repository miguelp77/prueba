<?php
	session_start();
//	session_destroy();

	require_once('includes/basics.php');
	conectar($_SESSION['db_name']);
	$imagen = htmlspecialchars(trim($_POST['imagen']));
	$q_id = $_SESSION['idQ'];
	list($width, $height, $type, $attr) = getimagesize($imagen);
	if($width <= 400) {
		$accion="UPDATE Cuestiones SET Imagen_aux ='$imagen' WHERE Cuestion_id='$q_id' ";
		mysql_query($accion) or die(mysql_error());
		return 'Ok' + $width;
	}
	else return 'NOk';

/*
require_once('includes/misfunciones.php');
	$conn = Conectar();
	$imagen = htmlspecialchars(trim($_POST['imagen']));
	$q_id = htmlspecialchars(trim($_POST['Cuestion_id']));  
	list($width, $height, $type, $attr) = getimagesize($imagen);
	if($width <= 320) {
		$accion="UPDATE Cuestiones SET Imagen_aux ='$imagen' WHERE Cuestion_id='$q_id' ";
		mysql_query($accion) or die(mysql_error());
		echo 'Ok' + $width;
	}
	else echo 'NOk';

 */

	
?>
