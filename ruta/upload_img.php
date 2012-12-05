<?php 
	session_start();
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');

	if(isset($_SESSION['db_name']))$db=$_SESSION['db_name'];
	else return false;
	conectar('asg_admin');
//Importar CUESTIONES y RESPUESTAS desde un archivo(.bdp) a una MATERIA seleccionada con TEMA unico
//AJAX desde import.js
	$unico=0;
	$archivo=upload_file();

//Guardo la imagen en la base de datos
	$eq_exp='Imagen importada';
	$query="INSERT INTO Ecuaciones (eq_exp, eq_path) VALUES ('$eq_exp','$archivo')";
	$result =mysql_query($query) or die(mysql_error());
//	echo 'Imagen guardada como '.$archivo.'<br />';		
	$_SESSION['msg']='Imagen guardada como '.$archivo;
	redirect_to('admin_test.php');
	
function upload_file(){
	if ($_FILES["file"]["error"] > 0){
		echo "Error: " . $_FILES["file"]["error"] . "<br />";
  }
	if (file_exists("img/" . $_FILES["file"]["name"])){
//	echo $_FILES["file"]["name"] . " ya existe. Consulte con el administrador. ";
		return 'img/'.$_FILES["file"]["name"];
	}else{
		move_uploaded_file($_FILES["file"]["tmp_name"],"img/" . $_FILES["file"]["name"]);
		return 'img/'.$_FILES["file"]["name"];
	}	
}
?>
