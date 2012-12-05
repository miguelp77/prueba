<?php
	session_start();
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		$conn=conectar($db);
	}else redirect_to('admin_test.php');
//Obtengo los datos
	$id=$_POST['id'];
	$nombre=(string)htmlspecialchars(trim($_POST['nombre']));
	$apellidos=(string)htmlspecialchars(trim($_POST['apellidos']));
	$dni=(string)$_POST['dni'];
	$alias=(string)$_POST['alias'];
	$pass=(string)$_POST['pass'];
//UTF8
//$nombre=to_utf8($nombre);
//$apellidos=to_utf8($apellidos);
	$resp=0;
	$no_change=0;
	$alias=trim($alias);
	$pass=trim($pass);
//	$dni=str_replace(" ","",$dni);
	$dni=trim($dni);
//Compruebo los datos, que en teoria solo hay 1
	$sql="SELECT * FROM Alumnos WHERE Alumno_id=$id";	
	$query=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_array($query);		
//Busco el cambio
	if($row['Alias']!=$alias) $no_change +=1;
	if($row['Psw']!=$pass) $no_change +=2;
//echo $no_change;
//Relleno los campos borrados
	if(strlen($nombre)==0) $nombre=$row['Nombre'];
	if(strlen($apellidos)==0) $apellidos=$row['Apellidos'];
	if(strlen($dni)<3) $dni=$row['DNI'];	
//	if($alias==$row['Alias']) $no_change++;
	if(strlen($alias)==0) $alias=$row['Alias'];
//	if($pass==$row['Psw']) $no_change++;	
	if(strlen($pass)==0) $pass=$row['Psw'];	
//	echo "borrado ".$id;
	if($no_change>=1){
		$resp=check_alumno($alias,$pass);	
//	echo 'resp='.$resp;
		$no_change=$resp;
//		echo $resp;
	}
	if($resp==0){
		$sql="UPDATE Alumnos SET Nombre='$nombre',Apellidos='$apellidos',DNI='$dni',Alias='$alias',Psw='$pass' WHERE Alumno_id = $id LIMIT 1";
		$query=mysql_query($sql) or die(mysql_error());
		echo "ok";
	}
//$_SESSION['mssg']="Usuarios iguales. Ya existe al menos ".$no_change;

	mysql_close($conn);
?>
