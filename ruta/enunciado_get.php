<?php
	session_start();
//Obtengo Enunciado de la cuestiones
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
//	require_once('includes/misfunciones.php');
	if(isset($_SESSION['db_name'])){
	$db=$_SESSION['db_name'];
	conectar($db);
	}
	if(isset($_SESSION['idQ'])){
		$idQ=$_SESSION['idQ'];
		$accion="SELECT Enunciado FROM Cuestiones WHERE Cuestion_id= $idQ";
		$query=mysql_query($accion) or die(mysql_error());
		$row=mysql_fetch_row($query);
		$enunciado = join("",$row);
//		$enunciado=str_replace("\\","\\\\",$enunciado);
		echo $enunciado;
	}else{echo "Enunciado";}
?>
