<?php
	session_start();
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	$db=$_SESSION['db_name'];
	conectar($db);
	$table="Cuestiones";
	$conceptos=array();
	$cuestiones=array();
	$unico=array();
	$sin_concepto=array();
	$listado=array();
	$MAX=1;
function get_conceptos($valor){
	global $MAX;
	$sql="SELECT * FROM Cuestiones";// WHERE Q_id=$idQ"
	$query=mysql_query($sql);
	while($row=mysql_fetch_array($query)){
//		echo "Cuestion: ".$row['Cuestion_id']." con ".$row['Conceptos']."<br />";
		$MAX = (strlen($row['Conceptos'])>$MAX) ? strlen($row['Conceptos']) : $MAX;
//		echo $MAX."<br />";
		if(strlen($row['Conceptos'])==$valor ){
			array_push($GLOBALS["conceptos"],$row['Conceptos']);
			array_push($GLOBALS["cuestiones"],$row['Cuestion_id']);

//			echo $row['Cuestion_id']." tiene ".$row['Conceptos']." = ".strlen($row['Conceptos'])."<br />";
		}
	}

}

function makeit($numQ=9){
	$i=0; 
	$query= "SELECT * FROM Cuestiones ORDER BY Q_id ASC ";// Elijo los Q_id
	$result =mysql_query($query);
	$number=mysql_num_rows($result);
//	$numQ=9; //Nunmero de preguntas que quiero ver
//	if(isset($_COOKIE["Examen"])){
//		echo "El examen fue creado anteriormente";
//	}
//Primera pregunta
	$aleatorio=rand(1,$number);
	$lista[]=$aleatorio;
	while ($numQ!==0){
		$aleatorio=rand(1,$number); //Tomo otra pregunta
	//Compruebo que no existe 	//La añado a la lista de preguntas
		if(in_array($aleatorio, $lista)){		 
			$numQ++;
			}
		else{ 
			$lista[]=$aleatorio;
			}
	$numQ--;
	}
	//Array a serie
	$serie=serialize($lista);
	$_SESSION['examen']=$serie;
	return $serie;
//		if(!isset($_COOKIE["Examen"]))
//			$_COOKIE("Examen",$serie);
}


/////////////////////////
$cp=array();
echo "HOLA"."<br />";

$maximo=1;
while($maximo<=$MAX){
	get_conceptos($maximo);
//$unico=$cuestiones;
//	echo $MAX."<br />";
	
	print_r($cuestiones);
	echo "<br />";
	$maximo=$maximo+2;
}
echo "<hr />";
ksort($cuestiones);
echo sizeof($cuestiones)."<br />";
echo "<hr />";
//echo print_r($conceptos)."<br />";
foreach($conceptos as $kk=>$value){
echo 	$cuestiones[$kk]."="."--".$value."<br />";
	$unico= explode(",",$value);
	foreach($unico as $value){
		//echo 	$value."<br />";
		$temp=array_pop($unico);
		if(!in_array($temp,$listado))array_push($listado,$temp);
	}
}
print_r($listado);
echo "<hr />";
print_r(asort($listado));
echo "<hr />";

while ($listado){
	$idC=array_pop($listado);	
	$sql="SELECT Nombre FROM Conceptos WHERE idConcepto=$idC";
	$query=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_array($query);
	echo $row[0]."<input type='checkbox' name='$idC'/>"."<br />";
}
empty($listado);
echo "<hr />";
foreach($conceptos as $k=>$value){
//echo 	$value."<br />";
	$unico= explode(",",$value);
	echo 	"_____";
	foreach($unico as $key=>$valor){
		echo 	$k."-".$valor."<br />";
		//$temp=array_pop($unico);
		if($valor==3)array_push($listado,$cuestiones[$k]);
	}
}
	
echo "<hr />";
ksort($listado);
print_r($listado);
echo "<hr />";
//get_conceptos(0);
//echo sizeof($cuestiones)."<br />";
/*	print_r($cuestiones);
echo "<hr />";
	print_r($conceptos);	
echo "ARRAY"."<br />";
	echo "<hr />";
	$cp=makeit(3);
//	foreach($cp as $key => $value){
//		echo $value."<br />";
//	}
	var_dump($cp);
	echo $cp."<br />";
	echo "<hr />";
$rand_keys = array_rand($conceptos, 3);
for($i=0;$i<3;$i++){
	$sql="SELECT * FROM Cuestiones WHERE Cuestion_id=$rand_keys[$i]";
	$query=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_array($query);
	echo $row['Cuestion_id']." - ".$row['Enunciado']."<br />";
}
/*


$input = array("Neo", "Morpheus", "Trinity", "Cypher", "Tank");
$rand_keys = array_rand($input, 3);
echo $input[$rand_keys[0]] . "\n";
echo $input[$rand_keys[1]] . "\n";
echo $input[$rand_keys[2]] . "\n";
*/
/*
print_r($conceptos);
echo "Cuestiones"."<br />";
print_r($cuestiones);
echo "<br />";
while($total=array_pop($cuestiones)){
	echo "<hr />";
	$cp=array_pop($conceptos);
	echo $cp."<br />";
	//var_dump($cp);
	$cp=explode(",",$cp);
	foreach($cp as $key => $valores){
		echo $valores."<br />";
		}
	echo "<br />";
	}
*/
?>
