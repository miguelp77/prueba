<?php
	session_start();
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		$conn=conectar($db);
	}else redirect_to('admin_test.php');
//Variables
	$idExamen=$_POST['idExamen'];
	$examenes=array(); //
	$arr=array(); //
// Consulto los EXAMENES asignados por cada ALUMNO 
	$sql="SELECT examenes,Alumno_id FROM Alumnos";
	$query=mysql_query($sql) or die(mysql_error());
	while($row=mysql_fetch_row($query)){
		$id=$row[1]; //ALUMNO
		if(empty($row[0])){
			//$examen_str=$idExamen;
			continue; // NO HAY EXAMENES
		}else{ //HAY EXAMENES
			$examen_str=str_replace($idExamen,"",$row['0']); //Elimino de la cadena	
			$arr=explode(",",$examen_str); // lo paso a ARRAY
			foreach($arr as $i){
				$i = trim($i); // elimino los espacios en blanco del array 
        if(!empty($i)) array_push($examenes,$i); //Si tiene contenido lo pusheo a examenes
   		} 
			$examen_str=implode(",",$examenes);// Lo paso a CADENA
			while(!empty($examenes)) array_pop($examenes); //Vacio el array
			
	//		$examenes=array_replace($examenes, $idExamen);
	//		array_push($examenes,$idExamen);
//			$examen_str=implode(",",$examenes);
		}
			$sql3="UPDATE Alumnos SET examenes='$examen_str' WHERE Alumno_id=$id LIMIT 1";
			$query3=mysql_query($sql3) or die(mysql_error());
	}		
//	echo "Guardado!";
	mysql_close($conn);
?>
