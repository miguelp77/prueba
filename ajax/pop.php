<?php
session_start();
require_once('../includes/db_config.php');

function conectar($database=NULL){
	if ($database != NULL) {
		$conn=mysql_connect(DB_SERVER,DB_USER,DB_PASS);
//		$conn=@mysql_connect("localhost", "root", "p89er");
		mysql_select_db($database);
		$_SESSION['db_name']=$database;
	//	echo "Conectado a $database <br />";
		return $conn;  
  }
}

if(isset($_SESSION['db_name'])){ 
	$db_main=$_SESSION['db_name'];
	conectar($db_main);
}

function pop_order(){
//	conectar($_SESSION['db_name']);
	$sql="SELECT examenes FROM Alumnos LIMIT 1";
	$query = mysql_query($sql) or die(mysql_error());	
	$row=mysql_fetch_array($query);
	$array=explode(",",$row[0]);
	array_pop($array);
	$cad=implode(",",$array);
//	$balance="";
	echo $cad;
	$sql2="UPDATE Alumnos SET examenes='$cad'";
	$query2 = mysql_query($sql2) or die(mysql_error());	
	return $query2;
}

pop_order();

?>
