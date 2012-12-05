<?php
	session_start();
	require_once('includes/db_config.php');

	$conn=mysql_connect(DB_SERVER,DB_USER,DB_PASS);
//Listado de las TABLAS que hay en las BBDD 'Asgs'
//	$result = mysql_list_tables("Asgs");
function inicializar_bbdd(){
echo "<b>Bases de datos</b>"."<hr />";
//Prepara las bases de datos que se van a utilizar
//Base de datos para 
//Alumnos
	$exist=mysql_select_db("Alumnos");
//	var_dump($exist);
	if(!$exist){
		echo "Creando Alumnos";
		$sql="CREATE DATABASE Alumnos";
		$query = mysql_query($sql) or die(mysql_error());
		echo "...Hecho"."<br />";	
	}else echo "<b>Alumnos ya existe</b>"."<br />";
//Asgs. Listado de cuestiones de las Asignaturas	
	$exist=mysql_select_db("Asgs");
	if(!$exist){
		echo "Creando Asignatuaras como Asgs";
		$sql="CREATE DATABASE Asgs";
		$query=mysql_query($sql) or die(mysql_error());
		echo "...Hecho"."<br />";	
	}else echo "<b>Asgs ya existe</b>"."<br />";	
//Asignatura. Gestion general.
	$exist=mysql_select_db("Asignatura");
	if(!$exist){
		echo "Creando base de datos PRINCIPAL como Asignatura";
		$sql="CREATE DATABASE Asignatura";
		$query=mysql_query($sql) or die(mysql_error());
		echo "...Hecho"."<br />";	
	}else echo "<b>Asignatura ya existe</b>"."<br />";	
//Creo las Tablas que se van a necesitar inicialmente
echo "<hr /><b>Tablas:Asignatura</b>"."<hr />";
	$tabla="Asignatura";
	$result = mysql_list_tables($tabla);
	$num_rows = mysql_num_rows($result);
	for ($i = 0; $i < $num_rows; $i++) {
		if(mysql_tablename($result, $i)){
  	  $tabla=(string)mysql_tablename($result, $i);
  	  $sql="SELECT COUNT(*) FROM $tabla";
  	  $query=mysql_query($sql);
			$rcount=mysql_result($query,0);  
			$sql = "SELECT * FROM $tabla";
			$query = mysql_query($sql);
			$columns = mysql_num_fields($query);
			$names=array();
			$j=0;
  //	  echo $tabla." - - [".$rcount ."] registros<br />";
				while($j<$columns){
				$name=mysql_field_name($query,$j);
				array_push($names,$name);
				$j++;
			}
			$name=implode($names," | "); 
  	  echo "<b>".$tabla."</b> - - [".$rcount ."] registros <br /><h4>". $name."</h4>";
		}
	}
echo "<hr /><b>Tablas:Asgs</b>"."<hr />";
	$tabla="Asgs";
	$result = mysql_list_tables($tabla);
	$num_rows = mysql_num_rows($result);
	for ($i = 0; $i < $num_rows; $i++) {
		if(mysql_tablename($result, $i)){
  	  $tabla=(string)mysql_tablename($result, $i);
  	  $sql="SELECT COUNT(*) FROM $tabla";
  	  $query=mysql_query($sql);
			$rcount=mysql_result($query,0); 
			$sql = "SELECT * FROM $tabla";
			$query = mysql_query($sql);
			$columns = mysql_num_fields($query);
			$names=array();
			$j=0;
			while($j<$columns){
				$name=mysql_field_name($query,$j);
				array_push($names,$name);
				$j++;
			}
			$name=implode($names,"|"); 
  	  echo "<b>".$tabla."</b> - - [".$rcount ."] registros <br /><h4>". $name."</h4>";
		}
	}
echo "<hr /><b>Tablas:Alumnos</b>"."<hr />";
	$tabla="Alumnos";
	$result = mysql_list_tables($tabla);
	$num_rows = mysql_num_rows($result);
	for ($i = 0; $i < $num_rows; $i++) {
		if(mysql_tablename($result, $i)){
  	  $tabla=(string)mysql_tablename($result, $i);
  	  $sql="SELECT COUNT(*) FROM $tabla";
  	  $query=mysql_query($sql);
			$rcount=mysql_result($query,0); 
			$sql = "SELECT * FROM $tabla";
			$query = mysql_query($sql);
			$columns = mysql_num_fields($query);
			$names=array();
			$j=0;
			while($j<$columns){
				$name=mysql_field_name($query,$j);
				array_push($names,$name);
				$j++;
			}
			$name=implode($names,"|"); 
  	  echo "<b>".$tabla."</b> - - [".$rcount ."] registros <br /><h4>". $name."</h4>";
		}
	}
}


?>
<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title>Checking</title>
	<link rel="stylesheet" href="css/main.css" />
</head>
<body>
<!-- <div id="contenedor"> -->
<div id="cabecera"><h2>Comprobando la base de datos.</h2></div>
<?php
	inicializar_bbdd();
?>
	<!-- </div> -->
</body>
</html>
