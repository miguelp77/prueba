<?php
	session_start();
//Actualizo Enunciado de la cuestiones
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
//	require_once('includes/misfunciones.php');
	if(isset($_SESSION['db_name'])){
	$db=$_SESSION['db_name'];
	conectar($db);
	}
//	echo $db;
//	echo "Conectado a $db"."<br />";//ok
//	$conn = Conectar();	
	$enun =addslashes($_POST['enun']);

	if(strlen($enun)<0) unset($_SESSION['idQ']);
	if(!isset($_SESSION['idQ']) || empty($_SESSION['idQ']) || $_SESSION['idQ']==0 ){
//		echo "Nuevo enunciado > ".$enun;
		$sql="INSERT INTO Cuestiones (Enunciado,Imagen) VALUES ('$enun', NULL)";
//		echo "query > ". $sql;
		$query=mysql_query($sql) or die(mysql_error());
		$_SESSION['idQ']=mysql_insert_id();
//		echo "Fijar idQ>". $_SESSION['idQ'] ;	
	}else{
		$q_id=$_SESSION['idQ'];
//		unset($_SESSION['idQ']);
		$accion="UPDATE Cuestiones SET Enunciado = '$enun' WHERE Cuestion_id= $q_id";
		$query=mysql_query($accion) or die(mysql_error());
//		echo ">Modificada la $q_id "."$accion";
//			$_SESSION['idQ']=mysql_insert_id();
		}
//	echo $accion;	
// echo $_SESSION['idQ'];

?>
