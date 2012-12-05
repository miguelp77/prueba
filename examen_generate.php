<?php
	session_start();
	
//Next_Q Siguiente cuestion en orden	
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	require_once('includes/cuestiones.inc');	
	$db=$_SESSION['db_name'];
	conectar($db);

//Traduce el valor de un ID de concepto por su nombre	
	function conceptos_translate($idConcepto=NULL){
		if($idConcepto!=NULL){
			$sql="SELECT Nombre FROM Conceptos WHERE idConcepto='$idConcepto'";
			$query=mysql_query($sql) or die(mysql_error());
		 	$row=mysql_fetch_row($query);
		 	echo $row[0];
		}
	}
//Numero de elementos de una cadena	
	function conceptos_numero($string){
		$arr=explode(",",$string);
		return count($arr);
	}
//Obtiene un array de la cadena que se le pasa
	function conceptos_lista($string){
		$arr=explode(",",$string);
		foreach ($arr as $key => $value)
		{
			echo conceptos_translate($value);
		}
		echo "<br />";
	}
	function conceptos_lista_array($arr){
		foreach ($arr as $key => $value)
		{
			echo conceptos_translate($value);
			echo "<br />";
		}
	}
//ACTUALIZA el numero de conceptos que tiene una cuestion	
	function conceptos_update($idQ,$nConceptos=0){
		$sql="UPDATE Cuestiones SET Q_id ='$nConceptos' WHERE Cuestion_id='$idQ' ";
		$query=mysql_query($sql) or die(mysql_error());
//		echo "Cuestion. ".$idQ." conceptos: ".$nConceptos."<br />";		
	}
	function conceptos_usados($string,$array){
		$arr=explode(",",$string);
		foreach ($arr as $key => $value)
		{
			if(!in_array($value,$array))
				array_push($array,$value);
		}
		if(strlen($string)<1)array_pop($array);
		return $array;
	}	
	
	function preguntas(){
		$array=array();

		$sql="SELECT Cuestion_id FROM Cuestiones";
		$query=mysql_query($sql) or die(mysql_error());
		while($row=mysql_fetch_row($query)){
			array_push($array,$row[0]);
		}
		shuffle($array);
		return $array;
	}
	
	
	function listar_n($n){
		$array= preguntas();
		$i=0;
		array_unshift($array,"17");
		array_unshift($array,"1");
		$pregs=array();
	//	print_r($array);
		echo "<br />";	
		while($n>0){	
			$Q=array_shift($array);	
			array_push($pregs,$Q);
			$i++;
			$sql="SELECT * FROM Cuestiones WHERE Cuestion_id=$Q";
			$query=mysql_query($sql) or die(mysql_error());

			$row=mysql_fetch_assoc($query);
			//	echo $row['Cuestion_id']." => ".$row['Conceptos']."<br />"; 
				$idQ=$row['Cuestion_id'];
			
			echo "<div class='num' name='$idQ'></div>";
				echo "<hr /><b><div class='num'>".$i."</div></b>";

				echo GetEnunciado($idQ);
				echo "<img src='".GetImage($idQ)."' alt='' />" ;
			echo "<form>";
				echo GetAnswers($idQ);

			echo "<br /></form>";
			$n--;
			}	
			print_r($pregs);
}
function temas_conceptos(){

	$sql="SELECT * FROM Temas";// WHERE fk_idAsignatura='$idAsignatura'";
	$result1=mysql_query($sql);
	while($row1= mysql_fetch_object($result1)){
		$idTema=$row1->idTema;
		echo "<span class='tema' name='$idTema'>".$row1->Nombre."</span>".'<br />';
		$sql2="SELECT * FROM Conceptos WHERE fk_idTema='$idTema'";
		$result2=mysql_query($sql2);
		while ($row= mysql_fetch_object($result2)){
			echo $row->Nombre." ".$row->idConcepto;
			echo "<input type=\"checkbox\" title ='$row->Descripcion' name=\"$row->idConcepto\" value=\"$row->idConcepto\"/>";
			echo '<br />';
		}
	}
}
function conceptos_en($idQ,$val=null){
	$sql="SELECT Conceptos FROM Cuestiones WHERE Cuestion_id=$idQ";
	$query=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_row($query);
		//	if($row[0]){
	echo "<b>Cuestion $idQ</b><br />";
	$arr=explode(",",$row[0]);
	foreach($arr as $key => $value){
		echo $value."<br />";
	}
	if(empty($row)) die();
	if(in_array($val,$arr)) echo "el valor $val esta";
	else echo "el valor $val no esta";
	echo "<br />";
}
/*
//		$nCs=conceptos_numero($row['Conceptos']);
		//echo ",,,".$nCs."<br />";
	//	if(strlen($row['Conceptos'])>0)conceptos_update($idQ,$nCs);//conceptos_lista($row['Conceptos']);
//	conceptos_lista($row['Conceptos']);
//	$array=conceptos_usados($row['Conceptos'],$array);
	//print_r($array);
	echo "ARRAY ";
	print_r($array);
	echo "<br />";
	conceptos_lista_array($array);
*/
?>
<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<script src="jquery/jquery-1.4.2.js"></script>
	<script src="jquery/jquery-shuffle.js"></script>
	<script src="js/test.js"></script>
	<title></title>
</head>
<body>
<div class="total_info"></div>
<?php

listar_n(3);	
temas_conceptos();
	echo "<hr />";
	$sql="SELECT Cuestion_id FROM Cuestiones";
	$query=mysql_query($sql) or die(mysql_error());
	while($row=mysql_fetch_row($query)){
		conceptos_en($row[0],5);
	}
?>
<div class="total_info"></div>
<button name="boton">Dimelo</button>
</body>
</html>


