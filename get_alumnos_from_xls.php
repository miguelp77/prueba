<?php 
	session_start();
	error_reporting(E_ALL ^ E_NOTICE);
	require_once 'excel_reader2.php';
	require_once('../includes/basics.php');
	require_once('../includes/db_tools.inc');
	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		$conn=conectar($db);
	}else redirect_to('admin_test.php');

	
	$asig=0; //Asignatura por defecto
	$nombre=null;$apellidos=null;$dni=null;
	$col_nombre='G';
	$col_dni='F';
	$fila=9;
//	$archivo="xls/viejo.xls";
	$archivo=upload_file();
	$archivo=solo_archivo($archivo);
	$archivo="xls/".$archivo;
	$excel = new Spreadsheet_Excel_Reader($archivo);
//echo '<br />';
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
	$sql="SELECT Alias FROM asg_admin.Admin";
	$query = mysql_query($sql) or die(mysql_error()) ;
	while($result=mysql_fetch_array($query)){
		array_push($admins,$result[0]);
	}
	//print_r($admins);

	while($excel->val($fila,$col_nombre)){

//		$nombre_apellido=htmlentities($excel->val($fila,$col_nombre));
		$nombre_apellido=($excel->val($fila,$col_nombre));
//		$dni=htmlentities($excel->val($fila,$col_dni));
		$dni=htmlspecialchars($excel->val($fila,$col_dni));
// Lo pasamos a caracteres que comprendemos
//echo $nombre_apellido.'<br />';
//		$nombre_apellido=to_human($nombre_apellido);
		$nombre_apellido=$nombre_apellido;//He quitado to_utf8
	//	$dni=tolatin($dni);
//echo '>>>'.$nombre_apellido.'<br />';
//		$nombre_apellido=utf8_decode($nombre_apellido);
//		$dni=utf8_decode($dni);
		
		$fila++;
//		echo $nombre_apellido.", ".$dni."<br />";
		$line2=explode(",",$nombre_apellido);
		$nombre=(string)$line2[1];
		$apellidos=(string)$line2[0];
//	$dni=(string)$line[1];	
//	$nombre=to_human($nombre);
//	$nombre=from_utf8($nombre);
//	$apellidos=to_human($apellidos);
//	$apellidos=from_utf8($apellidos);
//	echo "Nombre: ".$apellidos;
//	$nombre=strtoupper($nombre);
//	$apellidos=strtoupper($apellidos);

//	echo $nombre."<br />";
//	echo $apellidos."<br />";
//	echo $dni."<br />";
//DEPURACION	$vocals=array(" ","-","A","E","I","O","U","Ñ");
//DEPURACION	$cartas=str_replace($vocals,"",$apellidos);
//	echo $cartas."<br />";

//mb_detect_encoding($apellidos, "UTF-8") == "UTF-8" ? $ret="$apellidos": $ret='no';
//	$ret=elimina_acentos($ret);
//	echo $ret.'<br />';
	$pass=generatePassword(8,7);
	$alias=generateUser(8,$apellidos);
	if(in_array($alias,$admins)){ 
		$alias=generateUser(8,$cartas);
	}
	$alias=to_utf8($alias);
	array_push($admins,$alias);	
//	echo $pass;
//	echo "<hr />";
//			var_dump(in_array($dni,$dnis));//."<br />";
		if(!in_array($dni,$dnis)){ 
//		$sql="UPDATE Alumnos SET Nombre='$nombre',Apellidos='$apellidos',DNI='$dni',Alias='$alias',Psw='$pass' WHERE Alumno_id = $id LIMIT 1";

			$sql="INSERT INTO Alumnos (Nombre,Apellidos,DNI,Alias,Psw) VALUES ('$nombre','$apellidos','$dni','$alias','$pass')";
			$query = mysql_query($sql) or die(mysql_error()) ;
//				echo $sql.'<hr />';
			if(!in_array($dni,$dnis)){
				$ids= mysql_insert_id();
//				echo "Alias: [".$alias."] => ".$pass." <hr /> ";
			}
		}
	}
	unset($dnis);
//	echo $excel->dump();
	$_SESSION['msg']='Archivo '.$archivo.' importado correctamente';
	redirect_to('admin_test.php');

function upload_file(){
	if ($_FILES["file"]["error"] > 0){
		echo "Error: " . $_FILES["file"]["error"] . "<br />";
  }
  else
  {
 // echo "Upload: " . $_FILES["file"]["name"] . "<br />";
 // echo "Type: " . $_FILES["file"]["type"] . "<br />";
 // echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
 // echo "Stored in: " . $_FILES["file"]["tmp_name"];
  }
  
  
	if (file_exists("xls/".$_SESSION['db_name'] . $_FILES["file"]["name"])){
//	echo $_FILES["file"]["name"] . " ya existe. Consulte con el administrador. ";
		return 'xls/'.$_SESSION['db_name'].$_FILES["file"]["name"];
	}else{
		move_uploaded_file($_FILES["file"]["tmp_name"],"xls/".$_SESSION['db_name'] . $_FILES["file"]["name"]);
		return 'xls/'.$_SESSION['db_name'].$_FILES["file"]["name"];
	}	
}
?>
