<?php
	session_start();
	require_once('includes/exp_pag.php');	
	if(isset($_POST['imagen']))
		$idEq=$_POST['imagen'];
	else $idEq=primera_img();
	
	if(!isset($_POST['desc']))
		$desc="sin descripcion";
	else $desc=$_POST['desc'];
	
	$update=update_desc($idEq,$desc);
	echo $update;
?>
