<?php
require_once('includes/cuestiones.inc');
require_once('includes/db_tools.inc');
session_start();
//	set_cookie('miguel','miguel');
//	set_cookie('miguel','lala');
//		del_cookie('miguel');	
//	setcookie('miguel',"", time()-3600);
//	$_COOKIE['miguel']="miguel";
//	setcookie('miguel',"", time()-3600);
//	echo $_COOKIE['miguel'];
//	$_COOKIE['miguel']=" paniagua";
//	echo $_COOKIE['miguel'];

//echo $_COOKIE['miguel'];
//print_r($_COOKIE);
//SelMateria();
//echo GetNCuestion(1);
//print_r($_COOKIE);
// 
// set_asigntatura("ParcHis");
// echo "<br />";
//print_r($_COOKIE);
//GetMateria(1);
//del_cookie('asignatura');

show_cookies(1);
//echo "<br />";

//foreach($_COOKIE as $key=>$value ){
//	echo $key." => ".$value."<br />";
//}
//$nombre="mmmm";
//echo str_begin("cda","cad");
//$nombre = "asg_".$nombre;
//echo $nombre."<br />";

Conectar("asg_padre");

//echo db_delete("asg_miguel");


//echo db_create("padre");
//	$db="asg_padre";

//echo db_create("madre");
//echo create_struct();
/*
echo create_cuestiones_table();
echo create_respuestas_table();
echo create_alumnos_table();
echo create_materias_table();
echo create_conceptos_table();
echo create_respuestas_table();
echo create_temas_table();
*/
//defined('TABLA') ? null : define("TABLA", "Asignatura");
//define("DB", "asg_miguel");
//DEF_ TABLA "Asignatura";

$_SESSION['db_main']="Asignatura";
Conectar("asg_miguel");
//	show_tables(DB);
	//lista("Alumnos");
$destino="asg_miguel";
//create_alumnos_table();
//copiar_tabla($destino,"Alumnos");
show_tables($destino);
lista("Alumnos");
//	define("DB", "asg_miguel");
//	lista("Alumnos");
Conectar("Asignatura");
echo "<hr />";
//lista("Alumnos");
echo "<hr />";
	$result = mysql_list_tables("Asignatura");
	$num_rows = mysql_num_rows($result);
	for ($i = 0; $i < $num_rows; $i++) {
		if(substr(mysql_tablename($result, $i),0,4)=='temp'){
  	  echo "<br /><button name='exp' value='".mysql_tablename($result, $i)."'>Exportar</button><a href='#'>", mysql_tablename($result, $i), "</a>";
		}
	}
?>
