<?php
/*

 */
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
	
?>
