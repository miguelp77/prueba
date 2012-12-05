<?php
	session_start();
	
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	require_once('includes/cuestiones.inc');	
	$db=$_SESSION['db_name'];
	conectar($db);
	
	$conceptos=$_POST['conceptos'];
	$numero=$_POST['numero'];
	$duracion=$_POST['duracion'];
	$nombre=$_POST['nombre'];
	$rnd=$_POST['rnd'];
	$back=array();
	$copy=array();
function conceptos_en($idQ,$val=null){
	$sql="SELECT Conceptos FROM Cuestiones WHERE Cuestion_id=$idQ";
	$query=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_row($query);
		//	if($row[0]){
	$arr=explode(",",$row[0]);
	$valores=explode(",",$val);
	if(empty($row)) die();
	foreach($valores as $key => $value){
		if(!in_array($idQ,$GLOBALS['back']) && in_array($value,$arr)){
			if(ready_question($idQ)) array_push($GLOBALS['back'],$idQ); 
		}
	}
}

if($conceptos!="todos"){
	$sql="SELECT Cuestion_id FROM Cuestiones";
	$query=mysql_query($sql) or die(mysql_error());
	while($row=mysql_fetch_row($query)){
		conceptos_en($row[0],$conceptos);
	}
}else{	
	$sql="SELECT Cuestion_id FROM Cuestiones";
	$query=mysql_query($sql) or die(mysql_error());
	while($row=mysql_fetch_row($query)){
		if(ready_question($row[0])){
			array_push($back,$row[0]); //Si tengo correcta, la añado
			echo $row[0].' tiene correcta.<br />';
		}
	}
}
	if($rnd=="true") shuffle($back);


//	echo "Preguntas"."<br />";
//	echo join(",",$back)." tomadas de $numero en $numero<hr />";

$preguntas=join(",",$back);
//if(examen_grabar($preguntas,$numero))echo "Grabado"."<br />";
//	$sql="alter table Fuentes add numero TINYINT";
//	$query=mysql_query($sql) or die(mysql_error());
examen_grabar($preguntas,$numero,$duracion,$nombre);
?>
