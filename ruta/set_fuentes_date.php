<?php
	session_start();
//Next_Q Siguiente cuestion en orden	
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	$db=$_SESSION['db_name'];
	conectar($db);
/**
*
* Guardar Fechas
* Guardo la fecha de inicio y fin de la prueba
*
*/
	$error=false;

	if(isset($_POST['start_date'])){
		$start_date=$_POST['start_date'];
	}
	if(isset($_POST['end_date'])){
		$end_date=$_POST['end_date'];
	}	
	if(isset($_POST['examen'])){
		$examen=$_POST['examen'];
	}else{
		$error=true;
	}	

	$start_date = strtotime( $start_date);
	$start_date = date( 'Y-m-d', $start_date );
	$end_date = strtotime( $end_date);
	$end_date = date( 'Y-m-d', $end_date );


	$query = 	"UPDATE Fuentes ";
	// $query .= "SET start_date=FROM_UNIXTIME($start_date),end_date=FROM_UNIXTIME($end_date) ";
	$query .= "SET start_date='$start_date',end_date='$end_date' ";
	$query .= "WHERE idFuente='$examen'";
	// echo $query;
	$result = mysql_query($query) or die(mysql_error());
	echo $result;


?>
