<?php
	require_once('../includes/db_config.php');
//require_once('../includes/db_tools.inc');

function conectar($database=NULL){
	if ($database != NULL) {
		$conn=mysql_connect(DB_SERVER,DB_USER,DB_PASS);
		mysql_select_db($database);
		return $conn;  
  }
}

	$con=conectar('asg_mike77_bak_bak');
	$idEx=10;
	$array=array();
$array=stats_preguntas($idEx);
foreach($array as $a){
	echo $a.'<br>';
}
//Devuelve el N_preguntas,Correctas,Falladas,Sin responder,Nota
function stats_preguntas($idEx){
	$sql="SELECT preguntas,respuestas FROM Examenes WHERE idExamen=$idEx";
	$query=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_row($query);
	
	$preguntas=explode(",",$row[0]);
	$respuestas=explode(",",$row[1]);

	$n_preguntas=count($preguntas);
	$correctas=0;
	$sin_respuesta=0;
	$falladas=0;
	foreach($respuestas as $resp){
		$sql="SELECT Correcta FROM Respuestas WHERE Resp_id=$resp";
		$query=mysql_query($sql);
		$row=mysql_fetch_row($query);
		if($row[0]==1){ 
			$correctas++;
			continue;
		}
		if(preg_match('/[a-z]/',$resp)){
			$sin_respuesta++;
			continue;
		}
		if($row[0]==0){
			$falladas++;
			continue;
		}

		
	}
	$result=($correctas*100)+($falladas*(-33));
	$result=$result/($n_preguntas*10);
	$array=array($n_preguntas,$correctas,$falladas,$sin_respuesta,$result);
	return $array;
/*
 	echo 'Numero de examen: '.$idEx.'<br />';
	echo 'Numero de preguntas: '.$n_preguntas.'<br />';
	echo 'Numero de correctas: '.$correctas.'<br />';
	echo 'Numero de falladas: '.$falladas.'<br />';
	echo 'Numero de sin responder: '.$sin_respuesta.'<br />';
	echo 'Resultado '.$result.'<br />';
*/
}
?>

