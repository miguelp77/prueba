<?php
	session_start();
//fuente_del php Elimina una Fuente. 
// Las Fuentes contienen el numero de las cuestiones
// se tomaran de manera aleatoria para generar los examenes	
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	require_once('includes/cuestiones.inc');	
	$db=$_SESSION['db_name'];
	conectar($db);
	$idFuente=$_POST['idFuente'];
//	$numero=$_POST['numero'];
//	$rnd=$_POST['rnd'];
	
////// Borro de los examenes la Fuente 
	$idExamen=$idFuente;
	$examenes=array();
	$arr=array();
	$sql="SELECT examenes,Alumno_id FROM Alumnos";
	$query=mysql_query($sql) or die(mysql_error());
	while($row=mysql_fetch_row($query)){
		$id=$row[1];
		if(empty($row[0])){
			//$examen_str=$idExamen;
			continue;
		}else{
			$examen_str=str_replace($idExamen,"",$row['0']);	
			$arr=explode(",",$examen_str);
			foreach($arr as $i){
				$i = trim($i);
        if(!empty($i)) array_push($examenes,$i);
   		} 
			$examen_str=implode(",",$examenes);
	//		$examenes=array_replace($examenes, $idExamen);
	//		array_push($examenes,$idExamen);
//			$examen_str=implode(",",$examenes);
		}
			$sql3="UPDATE Alumnos SET examenes='$examen_str' WHERE Alumno_id=$id LIMIT 1";
			$query3=mysql_query($sql3) or die(mysql_error());
	}		
//	echo "Guardado!";
	/////////////////////////
	
fuente_eliminar($idFuente);	


?>
