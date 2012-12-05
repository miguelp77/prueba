<?php
	session_start();
//Actualizo el Nombre de los TEMAS
//	header ('Content-type: text/html; charset=utf-8');
	require_once('includes/db_tools.inc');
//	require_once('includes/misfunciones.php');
//	$db=$_SESSION['db_name'];
	conectar('asg_admin');
	$idAdmin = htmlspecialchars(trim($_POST['idAdmin']));  
//	$idAdmin = 1;
	$_SESSION['idAdmin']=$idAdmin;
	$sql="SELECT Nombre,Apellidos,Alias,Psw FROM asg_admin.Admin WHERE Admin_id = $idAdmin";
	$query=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_assoc($query);

//	$row[0]=trim($row[0]);
//	$row[1]=trim($row[1]);
	
	$codeado=json_encode($row);
	echo $codeado;
//	print_r(json_decode($codeado));
//	echo join(",",$row);
?>
