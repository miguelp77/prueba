<?php
	session_start();
//Actualizo Enunciado de la cuestiones
	require_once('includes/misfunciones.php');
	$conn = Conectar();	

	$enun = htmlspecialchars(trim($_POST['enun1']));
	$q_id = htmlspecialchars(trim($_POST['Cuestion_id']));  

	if(empty($_SESSION['idQ'])){
		$accion="INSERT INTO Cuestiones (Enunciado) VALUE ('$enum')";	
		$query=mysql_query($accion) or die(mysql_error());
		$_SESSION['idQ']=mysql_insert_id();
//	echo $enun;
		}else{
			$q_id=$_SESSION['idQ'];
			$accion="UPDATE Cuestiones SET Enunciado = '$enun' WHERE Cuestion_id= '$q_id'";
			$query=mysql_query($accion) or die(mysql_error());
			$_SESSION['idQ']=mysql_insert_id();
		}
//	echo $accion;	


?>
