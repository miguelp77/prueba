<?php
	session_start();
	header ('Content-type: text/html; charset=utf-8');
//	require_once('includes/misfunciones.php');
//	Conectar();
	$conn=@mysql_connect("localhost","root","p89er");
  mysql_select_db("Asignatura");
//  return $conn;
	///////////////////Muestra las tablas que cuelgan de Asignatura y que sean creadas como Asg_Nombre
	$result = mysql_list_tables("Asignatura");
	$num_rows = mysql_num_rows($result);
	for ($i = 0; $i < $num_rows; $i++) {
		if(substr(mysql_tablename($result, $i),0,4)=='Asg_'){
  	  echo "<br /><button name='exp' value='".mysql_tablename($result, $i)."'>Exportar</button><a href='#'>", mysql_tablename($result, $i), "</a>";
		}
	}
	
	/*
	//echo "<br />$i Tablas";
	$dime=mysql_query("SHOW TABLES");
	while($digo=mysql_fetch_assoc($dime)){
		echo '<br />';
		print_r($digo);
	}
	
	*/
?>
