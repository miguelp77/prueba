<?php 
	require_once('includes/misfunciones.php');
	$conexion = Conectar();

//AJAX desde 
//	$unico=0;
//	$archivo=htmlspecialchars(trim($_POST['Archivo']));;
//	$Asig_id=htmlspecialchars(trim($_POST['Asignatura']));;	
	//Por defecto el archivo sera 
	$lineas=file("alumnos.txt"); // muestra el contenido de cada parte del array
	$asig=0; //Asignatura por defecto

	$dnis=array();
	$sql="SELECT DNI FROM Alumnos";
	$query = mysql_query($sql) or die(mysql_error()) ;
	while($result=mysql_fetch_array($query)){
		array_push($dnis,$result[0]);
	}
//	print_r($dnis);
	$admins=array();
	$sql="SELECT Alias FROM Admin";
	$query = mysql_query($sql) or die(mysql_error()) ;
	while($result=mysql_fetch_array($query)){
		array_push($admins,$result[0]);
	}
	//print_r($admins);

	$nombre=null;$apellidos=null;$dni=null;
	foreach($lineas as $linea){
//		echo "<b>".$linea."</b><br />";
		$line=explode(";",$linea);
		$line2=explode(",",$line[0]);
	//	$apellidos=$elementos[0];
		
//		echo $line2[0]." <br /> ".$line2[1]." <br /> ".$line[1]."<hr />";	 
	$nombre=(string)$line2[1];
	$apellidos=(string)$line2[0];
	$dni=(string)$line[1];	
	$nombre=strtoupper($nombre);
	$apellidos=strtoupper($apellidos);

//	echo $nombre."<br />";
//	echo $apellidos."<br />";
//	echo $dni."<br />";
	$vocales=array(" ","-","A","E","I","O","U");
	$cartas=str_replace($vocales,"",$apellidos);
//	echo $cartas."<br />";
	$pass=generatePassword(6,7);
	$alias=generateUser(6,$cartas);
	if(in_array($alias,$admins)){ 
		$alias=generateUser(6,$cartas);
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
