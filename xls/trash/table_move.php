<?php
	session_start();
	header ('Content-type: text/html; charset=utf-8');
	$conn=@mysql_connect("localhost","root","p89er");
  mysql_select_db("Asignatura");
	$tabla=$_POST['tabla'];
	$sql=('RENAME TABLE Asignatura.'.$tabla.' TO Asgs.'.$tabla);
///////////Mueve la tabla a la base de datos Asgs	
	$query=mysql_query($sql) or $error_sql=mysql_error();
	if(substr($error_sql,0,5)=='Table'){
		$sql_drop=('drop table Asgs.'.$tabla);
		$query=mysql_query($sql_drop);
		$sql=('RENAME TABLE Asignatura.'.$tabla.' TO Asgs.'.$tabla);
		$query=mysql_query($sql) or $error_sql=mysql_error();
//		echo $error_sql;
	}
	
?>
