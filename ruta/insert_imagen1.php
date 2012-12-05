<?php
	session_start();
	require_once('includes/basics.php');
	conectar($_SESSION['db_name']);

	$imagen = htmlspecialchars(trim($_POST['imagen']));
	$q_id = $_SESSION['idQ'];
//Verifica la anchura de la imagen		
	list($width, $height, $type, $attr) = getimagesize($imagen);
	if($width <= 800) {
		$accion="UPDATE Cuestiones SET Imagen ='$imagen' WHERE Cuestion_id='$q_id' ";
		mysql_query($accion) or die(mysql_error());
		return 'Ok' + $width;
	}
	else return 'NOk';
	
?>
