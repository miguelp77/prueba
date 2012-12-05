<?php
	require_once('../includes/exp_pag.php');	
	if(!isset($_POST['imagen'])) $i=1;	
	else $i=$_POST['imagen'];
	$total=cuantas_img();
	$nn=$i*5;
	$ret=numero_de_img($nn,5,$total);
	echo $ret;
?>
