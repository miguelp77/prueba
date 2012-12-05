<?php
	session_start();
	if (isset($_SESSION['db_name']))unset($_SESSION['db_name']);
//	session_destroy();
	header ('Content-type: text/html; charset=utf-8');
	iconv_set_encoding('internal_encoding', 'utf-8');  
	require_once('includes/db_tools.inc');
	
	$Nombre = utf8_decode(trim($_POST['Nombre']));//Nombre de la asignatura
//	$Nombre = trim($_POST['Nombre']);//Nombre de la asignatura
	$Nombre = str_replace (" ","_",$Nombre);

	$Creador = $_SESSION['user'];
	$Alumnos=1;//Numero de alumnos en esta asignatura
//	echo $_SESSION['db_name']."aaa";	
//	echo "Con a db"."<br />";
	connect_to_db();
//	echo $Nombre;
//$Nombre=mysql_real_escape_string($Nombre);
//$Nombre=utf8_encode($Nombre);
//	echo "crear nueva base de datos > asg_$Nombre"."<br />";
	$db= db_create($Nombre);
	echo 'db='.$db.'|';
	if($db){
		echo "conecto a la nueva"."<br />";
		conectar($db);
		echo "Conectado"."<br />";
		if(create_struct())	
			echo "creo la estructura"."<br />";
			$_SESSION['db_name']=$db;
			echo "session fijada"."<br />";
	}
	else echo "error";

	if(isset($_SESSION['db_name'])) echo $_SESSION['db_name'];
	unset($_SESSION['idQ']);
//	$sql_insert="INSERT INTO Materias (Nombre,Creador,Alumnos) VALUES ('$Nombre','$Creador','$Alumnos')";
//	$query = mysql_query($sql_insert) or die(mysql_error());
//	echo mysql_insert_id();

?>
