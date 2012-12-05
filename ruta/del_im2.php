<?php
	session_start();
	require_once('includes/basics.php');
	conectar($_SESSION['db_name']);

//	$imagen = htmlspecialchars(trim($_POST['imagen']));
	$q_id = $_SESSION['idQ'];
//Verifica la anchura de la imagen		
//	list($width, $height, $type, $attr) = getimagesize($imagen);
//	if($width <= 800) {
	$sql="UPDATE Cuestiones SET Imagen_aux =NULL WHERE Cuestion_id=$q_id";
	$query=mysql_query($sql) or die(mysql_error());
?>
