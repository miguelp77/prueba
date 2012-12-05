<?php
	session_start();
//Actualizo Enunciado de la cuestiones
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');

function reindex($table,$indice){
	$sql="SELECT * FROM $table ORDER BY $indice ASC";
	$qry=mysql_query($sql);	
	$idx=0;
	$sql="ALTER TABLE $table AUTO_INCREMENT = 1";
	$query=mysql_query($sql) or die(mysql_error());	
	while($now=mysql_fetch_array($qry)){
		$idx++;
		$viejo=$now[0];
		$sql="UPDATE $table SET $indice=$idx WHERE $indice=$viejo";
		$query=mysql_query($sql) or die(mysql_error());	
		//$id=mysql_insert_id();
		echo $now[0]."-";
		if($table=="Cuestiones"){		
			$sql="UPDATE Respuestas SET Cuestion_id=$idx WHERE Cuestion_id=$viejo";
			$query=mysql_query($sql) or die(mysql_error());	
		//$id=mysql_insert_id();
		}
//	echo "Nuevo id= ".$id."<br />";
//	echo $accion;	
// echo $_SESSION['idQ'];
	}
	$sql="ALTER TABLE $table AUTO_INCREMENT = 1";
	$query=mysql_query($sql) or die(mysql_error());		
}

	$db=$_SESSION['db_name'];
	conectar($db);
	$idQ=$_SESSION['idQ'];
	unset($_SESSION['idQ']);

	reindex("Cuestiones","Cuestion_id");

	$sql="SELECT * FROM Cuestiones";
	$qry=mysql_query($sql);	
	$row=mysql_fetch_array($qry);
	$_SESSION['idQ']=$row[0];
	echo $row[0];
?>
