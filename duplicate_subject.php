<?php
	session_start();
	require_once('includes/db_tools.inc');

/*

Clonar asignatura sin usuarios

*/

//Conceptos
//Cuestiones
//Examenes
//Expedientes
//Fuentes
//Respuestas
//Temas

//Obtengo el nombre de la base actual
	$actual = utf8_decode(trim($_SESSION['db_name']));
//La copia sera $actual-copia
	$copia=$actual.'-copia';

//Creo la estructura
	connect_to_db();
	$exist=mysql_select_db($copia);
	if(!$exist){	
		$copia=$copia+'-	
	}
	$db= db_create($copia);
	if($db){
		echo "conecto a la nueva"."<br />";
		conectar($db);
		echo "Conectado"."<br />";
		if(create_struct())	
			echo "creo la estructura"."<br />";
		$_SESSION['db_name']=$db;
		echo "session fijada"."<br />";
		echo $copia;	
	}
	else echo "error";
	
?>
