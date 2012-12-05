<?php
	require_once('includes/misfunciones.php');
	$conn=Conectar();
//Obtengo
//	$id=$_POST['id'];
	$nombre=(string)$_POST['nombre'];
	$apellidos=(string)$_POST['apellidos'];
	$dni=(string)$_POST['dni'];
	$alias=(string)$_POST['alias'];
	$pass=(string)$_POST['pass'];
//Arreglo	
	$nombre=str_replace(" ","",$nombre);
	$apellidos=str_replace(" ","",$apellidos);
	$dni=str_replace(" ","",$dni);
	$alias=str_replace(" ","",$alias);
	$pass=str_replace(" ","",$pass);
//Compruebo valores de Alias y DNI existentes
	$alias_exist=array();
	$dni_exist=array();
	$sql="SELECT Alias FROM Admin";
	$query = mysql_query($sql) or die(mysql_error()) ;
	while($result=mysql_fetch_array($query)){
		array_push($alias_exist,$result[0]);
	}		
	$sql="SELECT Alias,DNI FROM Alumnos";
	$query = mysql_query($sql) or die(mysql_error()) ;
	while($result=mysql_fetch_array($query)){
		array_push($alias_exist,$result[0]);
		array_push($dni_exist,$result[1]);
	}		
	if(in_array($alias,$alias_exist)){ 
		$alias=generateUser(6,$alias);
	}
//	array_push($admins,$alias);		
	
//Los guardo
	$sql="INSERT INTO Alumnos (Nombre,Apellidos,DNI,Alias,Psw) VALUES ('$nombre','$apellidos','$dni','$alias','$pass')";
	$query=mysql_query($sql) or die(mysql_error());
	echo "Guardado!";
	mysql_close($conn);
?>
