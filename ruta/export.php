<?php
	session_start();
	require_once('includes/db_tools.inc');
	require_once('includes/cuestiones.inc');	
	if(isset($_SESSION['db_name'])){
		$base=$_SESSION['db_name'];
		// echo "Base seleccionada:<b> ".asg_name($base)."</b>";
		$db=$base;
		// $db=utf8_decode($db);	
	}

//Listar lo que se puede exportar
/*										db_tools.inc
	Crear Alumnos				create_alumnos_table()
	Crear Conceptos			create_conceptos_table()
	Crear cuestiones 		create_cuestiones_table()
	Crear Examenes			create_examenes_table()
	Crear Expedientes		create_expediente_table()
	Crear Fuentes 			create_fuente_table()
	Crear Grupos				
	Crear Respuestas 		create_respuestas_table()
	Crear Temas 				create_temas_table()

**create_struct() --> lanza todas menos Grupos

*/

function list_field_in_tables($db=NULL){
	//Devuelve el nombre de las tablas que hay en la instancia
	  $sql="SHOW TABLES FROM $db";
	  $query=mysql_query($sql) or die(mysql_error());
	// return $query;
	// while (	$row=mysql_fetch_row($query)) {
	// 	echo 'tabla: '.$row[0].'<br>';
	// }
	while($row=mysql_fetch_row($query)){

		$resultado = mysql_query("SELECT * FROM $row[0]");
		$campos    = mysql_num_fields($resultado);
		$filas     = mysql_num_rows($resultado);
		$tabla     = mysql_field_table($resultado, 0);
	// echo "Su tabla '" . $tabla . "' tiene " . $campos . " campos y " . $filas . " registro/s\n";
	// echo "La tabla tiene los siguientes campos:<br>";
		echo "CREATE TABLE IF NOT EXISTS '".$row[0]."' <br>(";
		for ($i=0; $i < $campos; $i++) {
	    $tipo     = mysql_field_type($resultado, $i);
	    $nombre   = mysql_field_name($resultado, $i);
	    $longitud = mysql_field_len($resultado, $i);
	    $banderas = mysql_field_flags($resultado, $i);
	    // echo " idExpediente INT UNSIGNED NOT NULL AUTO_INCREMENT, ";
	 		echo "$nombre $tipo $longitud $banderas ";
	 		if($i!=$campos-1) echo ", <br>";
	 		if($i==$campos-1) echo ")<br>";
	    // echo $tipo . " " . $nombre . " " . $longitud . " " . $banderas . "<br>";
		}
		mysql_free_result($resultado);
	}
	mysql_close();
}

function list_tables($db){

	$sql="SHOW TABLES FROM $db";
	$query=mysql_query($sql) or die(mysql_error());
	while($row=mysql_fetch_row($query)){
		$resultado = mysql_query("SELECT * FROM $row[0]");
		$tabla     = mysql_field_table($resultado, 0);
		$filas     = mysql_num_rows($resultado);
		$todo = $db.'.'.$tabla;
		echo "<input type='checkbox' value='$tabla'>".$todo.' con '.$filas. ' registros<br />';
	}
}



// $con=conectar($db);
$sql="CREATE TABLE new_tbl LIKE Alumnos";
// $query = mysql_query($sql) or die(mysql_error());

$sql="INSERT new_tbl SELECT * FROM Alumnos";
// $query = mysql_query($sql) or die(mysql_error());


// function create_struct 


	conectar($db);
	list_tables($db);
// db_clone($db);


//Seleccionar que se quiere exportar
	//Estrucutura
		//Temas
		//Conceptos
	//Preguntas
		//Cuestiones
		//Respuestas
		//Conceptos --> Estructura
	//Examenes (Guarda los resultados)
		//Fuentes (Generacion de pruebas)
	//Alumnos

//Crear una nueva instacia completa


//Realizar la importacion con la seleccion


//Completar los datos vacios a default





?>



<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>WorkAround</title>
</head>
<body>

Listar lo que se puede exportar



</body>
</html>