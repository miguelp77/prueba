<?php
	session_start();
	header ('Content-type: text/html; charset=utf-8');
	require_once('includes/misfunciones.php');
	$conexion = Conectar();
//	$idA=$_COOKIE['Galle'];
	$idA=$_SESSION['idAsig'];
	$Creador = "Miguel";
//Obtengo el NOMBRE de la Asignatura	
	$sql_get="SELECT Nombre FROM Materias WHERE idAsignatura='$idA'";
	$query = mysql_query($sql_get) or die(mysql_error());
	$result= mysql_fetch_array($query);
	$Nombre=$result['Nombre'];
	$Nombre=str_replace(' ',"_",$Nombre);
	$Nombre='Asg_'.$Nombre;	
//	echo $Nombre.'<br />';
//	echo $_SESSION['idAsig'];
// Compruebo si la TABLA con ese Nombre ya existe
	$sql_check="SHOW TABLES LIKE '$Nombre'";
	$query_check=mysql_query($sql_check);
	if($query_check){//Existe Tabla con ese nombre
		$query=mysql_query("DROP TABLE IF EXISTS $Nombre")or die(mysql_error());
		$sql_create="CREATE TABLE $Nombre LIKE Cuestiones";
		$query = mysql_query($sql_create);// or die(mysql_error());
		mysql_query("truncate $Nombre");
		$sql_insert="insert into $Nombre select * from Cuestiones where Asig_id=$idA";
		$query_insert = mysql_query($sql_insert);// or die(mysql_error());
		$campos= mysql_affected_rows();
			//	CREATE TABLE student2 SELECT * FROM student WHERE class='Four'
/*		mysql_query("truncate $Nombre") or die(mysql_error());
		$sql_loop=("select * from Cuestiones where Asig_id='$idA'");
		$query_loop = mysql_query($sql_loop)or die(mysql_error());
		$sql_insert=("insert into '$Nombre' $sql_loop");// select * from Cuestiones where Asig_id=$idA");
		$query_insert = mysql_query($sql_insert)or die(mysql_error());
		$campos= mysql_affected_rows();
	*/	echo "Exportacion a '$Nombre'. $campos Cuestiones añandidos";
		
	//	echo 'Done!';
	}
	else{
			
		$sql_create="CREATE TABLE $Nombre LIKE Cuestiones";
		$query = mysql_query($sql_create);// or die(mysql_error());
		mysql_query("truncate $Nombre");
		$sql_insert="insert into $Nombre select * from Cuestiones where Asig_id=$idA";
		$query_insert = mysql_query($sql_insert);// or die(mysql_error());
		echo "No existe la tabla '$Nombre'. Se crea.";
		echo " $campos añandidos";
		
	}
	
//Creo una TABLA con el NOMBRE de la asignatura con la estructura de CUESTIONES
//	$sql_create="CREATE TABLE $Nombre LIKE Cuestiones";
//	$query = mysql_query($sql_create) or die(mysql_error());
		
//	$Irene="SELECT (Asig_id,Enunciado,Imagen,Imagen_aux) FROM Cuestiones WHERE Cuestion_id=1";
//	$sql_insert="INSERT INTO Materias (Nombre,Creador,Alumnos) VALUES ('$Nombre','$Creador','$Alumnos')";
//	$query = mysql_query($sql_insert) or die(mysql_error());
//	echo mysql_insert_id();
//	$result =mysql_query($Sara) or die(mysql_error());
	//$Yorch =mysql_affected_rows();	
	//echo $Yorch;
//	$Reto= mysql_insert_id();
//Ordeno los indices despues de introducir una cuestion nueva
/*
//Tal vez no se necesite
		$Irene="SELECT idAsignatura FROM Materias WHERE Nombre= '$Nombre'";
		$query = mysql_query($Irene);
		$Yorch= mysql_fetch_array($query);
//		echo $Yorch['idAsignatura'];
*/
//echo $msg;
?>
