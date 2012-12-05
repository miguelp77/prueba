<?php
	session_start();
	require_once('includes/exp_pag.php');	
	if(!isset($_POST['imagen'])) return false;	
	else $i=$_POST['imagen'];
	$total=cuantas_img();
	$nn=$i;
	if($i>$total) $nn=$total;
	$ret=numero_de_img($nn,5,$total);
//	echo $ret;
?>
