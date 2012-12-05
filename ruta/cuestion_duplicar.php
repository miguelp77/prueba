<?php
	session_start();
	require_once('includes/db_tools.inc');
	$db=$_SESSION['db_name'];
	$idQ=$_SESSION['idQ'];	
	conectar($db);
//	purge_respuestas();
	if($idQ>=1){
//Todos los campos de la cuestion
		$sql="SELECT * FROM Cuestiones WHERE Cuestion_id=$idQ";
		$query=mysql_query($sql) or die(mysql_error());
		$row=mysql_fetch_row($query);
		foreach($row as $key=>$value) 
			$row[$key]=addslashes($value);
//Añado una nueva cuestion con los campos de la anterior	
		$sql2 ="INSERT INTO `Cuestiones` (`Asig_id`, `Enunciado`, `Imagen`, `Imagen_aux`, `Q_id`, `Conceptos`) VALUES ";
		$sql2 .=" ($row[1],'$row[2]','$row[3]','$row[4]','$row[5]','$row[6]')";
//DEPURACION
//		echo $sql2;
//		echo '<br />';
		$query2=mysql_query($sql2) or die(mysql_error());
//Tomo su nuevo id
		$newId=mysql_insert_id();
//$newId=100;
//Ahora cojo todos las respuestas asociadas a la anterior cuestion
		$sql3="SELECT * FROM Respuestas WHERE Cuestion_id=$idQ";
		$query3=mysql_query($sql3) or die(mysql_error());
		while($row3=mysql_fetch_row($query3)){		
			foreach($row3 as $key=>$value) $row3[$key]=addslashes($value);
	
			$sql4="INSERT INTO `Respuestas` (`Respuesta`, `Cuestion_id`, `Correcta`, `Ultima`, `Porcentaje`) VALUES";
			$sql4 .= '(\''.$row3[1].'\','.$newId.','.$row3[3].','.$row3[4].','.$row3[5].')';
			
//			echo $sql4;
//			echo '<br />';
			$query4=mysql_query($sql4) or die(mysql_error());		
		}
	}
	
?>
