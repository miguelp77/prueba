<?php
	require_once('includes/misfunciones.php');
	$conn=Conectar();
//Obtengo los datos
	$id=$_POST['id'];
	$nombre=(string)$_POST['nombre'];
	$apellidos=(string)$_POST['apellidos'];
	$dni=(string)$_POST['dni'];
	$alias=(string)$_POST['alias'];
	$pass=(string)$_POST['pass'];
	$alias=str_replace(" ","",$alias);
	$pass=str_replace(" ","",$pass);
//Compruebo los datos, que en teoria solo hay 1
	$sql="SELECT * FROM Alumnos WHERE Alumno_id=$id";	
	$query=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_array($query);		
	if(strlen($nombre)==0) $nombre=$row['Nombre'];
	if(strlen($apellidos)==0) $apellidos=$row['Apellidos'];
	if(strlen($dni)==0) $dni=$row['DNI'];	
	if(strlen($alias)==0) $alias=$row['Alias'];	
	if(strlen($pass)==0) $pass=$row['Psw'];	
//	echo "borrado ".$id;
	$sql="UPDATE Alumnos SET Alias='$alias',Psw='$pass' WHERE Alumno_id = $id LIMIT 1";
	$query=mysql_query($sql) or die(mysql_error());
	echo "Actualizado!";
	mysql_close($conn);
?>
