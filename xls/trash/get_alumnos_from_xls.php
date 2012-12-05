<?php 
	error_reporting(E_ALL ^ E_NOTICE);
	require_once 'excel_reader2.php';
	require_once('includes/misfunciones.php');
	//$data = new Spreadsheet_Excel_Reader("example.xls");

	$conexion = Conectar();
	$asig=0; //Asignatura por defecto
	$nombre=null;$apellidos=null;$dni=null;
	$col_nombre='G';
	$col_dni='F';
	$fila=8;
	$archivo="xls/Alumnos.xls";


/*	function tolatin ($texto)
    {
        $texto = preg_replace($GLOBALS["varCaracteres"], $GLOBALS["varCaracteresHTML"], strtolower($nombre)); 
//        $texto = preg_replace($GLOBALS["varCaracteres"],$GLOBALS["varCaracteresHTML"], $texto); 
        return $texto;
    }
*/

//AJAX desde 
//	$unico=0;
//	$archivo=htmlspecialchars(trim($_POST['Archivo']));;
//	$Asig_id=htmlspecialchars(trim($_POST['Asignatura']));;	
	//Por defecto el archivo sera 
 // muestra el contenido de cada parte del array
	$excel = new Spreadsheet_Excel_Reader($archivo);

//DNI inscritos como alumnos
	$dnis=array();
	$sql="SELECT DNI FROM Alumnos";
	$query = mysql_query($sql) or die(mysql_error()) ;
	while($result=mysql_fetch_array($query)){
		array_push($dnis,$result[0]);
	}
//	print_r($dnis);
// Alias de Administradores inscritos
	$admins=array();
	$sql="SELECT Alias FROM Admin";
	$query = mysql_query($sql) or die(mysql_error()) ;
	while($result=mysql_fetch_array($query)){
		array_push($admins,$result[0]);
	}
	//print_r($admins);

	while($excel->val($fila,$col_nombre)){

		$nombre_apellido=htmlentities($excel->val($fila,$col_nombre));
		$dni=htmlentities($excel->val($fila,$col_dni));
// Lo pasamos a caracteres que comprendemos

		$nombre_apellido=to_human($nombre_apellido);
	//	$dni=tolatin($dni);

//		$nombre_apellido=utf8_decode($nombre_apellido);
//		$dni=utf8_decode($dni);
		
		$fila++;
		echo $nombre_apellido.", ".$dni."<br />";
		$line2=explode(",",$nombre_apellido);
		$nombre=(string)$line2[1];
		$apellidos=(string)$line2[0];
//	$dni=(string)$line[1];	
	$nombre=to_human($nombre);
	$apellidos=to_human($apellidos);
	
	$nombre=strtoupper($nombre);
	$apellidos=strtoupper($apellidos);

//	echo $nombre."<br />";
//	echo $apellidos."<br />";
//	echo $dni."<br />";
	$vocals=array(" ","-","A","E","I","O","U","Ñ");
	$cartas=str_replace($vocals,"",$apellidos);
//	echo $cartas."<br />";
	$pass=generatePassword(8,7);
	$alias=generateUser(8,$cartas);
	if(in_array($alias,$admins)){ 
		$alias=generateUser(8,$cartas);
	}
	array_push($admins,$alias);	
//	echo $pass;
//	echo "<hr />";
//			var_dump(in_array($dni,$dnis));//."<br />";
		if(!in_array($dni,$dnis)){ 
			$sql="INSERT INTO Alumnos (Nombre,Apellidos,DNI,Alias,Psw) VALUES ('$nombre','$apellidos','$dni','$alias','$pass')";
			$query = mysql_query($sql) or die(mysql_error()) ;

			if(!in_array($dni,$dnis)){
				$ids= mysql_insert_id();
				echo "Alias: [".$alias."] => ".$pass." <hr /> ";
			}
		}
	}
	unset($dnis);
?>
