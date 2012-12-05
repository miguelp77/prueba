<?php
	require_once('includes/misfunciones.php');
	function to_text($cadena,$tema){
//Primero: paso la cadena de conceptos a una array
//Segundo: Devuelvo una cadena con la traduccion de conceptos
//		print_r($cadena);
		$ret=array();
		$claves=explode(",",$cadena);
//		print_r($claves);
		$idTema=(int)$tema;
//		echo "<br />"."<br />";
		$valores=translate_idConcepts($idTema);
//		print_r($valores);
//		echo "<br />";
		foreach($claves as $key){
	//	echo $key."==".$valores[$key]."<br />";
		array_unshift($ret,$valores[$key]);
		}
//	print_r($ret);
	$vuelta=implode($ret,",");
	return $vuelta;
	//	array_unshift($pos,$result['idConcepto']);
	//	array_unshift($nombres,$result['Nombre']);
	//	$claves=array_combine($pos,$nombres);		
	}

	function translate_idConcepts($id){
		//Le damos un id de asignatura y nos devuelve 
		//un array con los nombres de los conceptos que maneja
		$connect=@mysql_connect("localhost","root","p89er");
		$to = mysql_list_tables("Asignatura");
		$pos=array();
		$nombres=array();
		$claves=array();
		$id= (int)$id;
			
//		$id=9;	
		$sql= "SELECT * FROM Conceptos WHERE fk_idTema=$id";// LIMIT $inicio,5";// LIMIT 0," .$pag."'";	 
		$query =mysql_query($sql)or $error_sql=mysql_error();
			echo $error_sql;
		while($result=mysql_fetch_array($query)){
//		foreach($result['idConcepto'] as $key => $value){
//			echo "($key)::::$value <br/ >";
//		}
//			echo $result['idConcepto']." == ".$result['Nombre']."<br />";
			array_unshift($pos,$result['idConcepto']);
			array_unshift($nombres,$result['Nombre']);
			$claves=array_combine($pos,$nombres);
		}
		$des=mysql_close($connect);
		return $claves;
	}
	
	
	$conn=@mysql_connect("localhost","root","p89er");
//Listado de las TABLAS que hay en las BBDD 'Asgs'
	$result = mysql_list_tables("Asgs");
//Selecciona la tabla de BBDD
	$base=$_POST['tabla'];
	
//TODA la informacion de la tabla seleccionada
//	$query="SELECT * FROM $base";
//	$result =mysql_query($query)or $error_sql=mysql_error();
//	echo $error_sql;
//Selecciono TODA la informacion de manera ORDENADA
	if(strlen($base)<1) $base="Asg_Default";
	$query= "SELECT * FROM $base ORDER BY Q_id ASC";// LIMIT $inicio,5";// LIMIT 0," .$pag."'";
//	$result =mysql_query($query);
//Puedo ver la clase de error
	$result =mysql_query($query)or $error_sql=mysql_error();
	echo $error_sql;
//	$i=$inicio-1; //Utilizado anteriormente para la paginacion
	$i=0;
//	$cuestiones= mysql_fetch_array($result);
//	$claves=translate_idConcepts($cuestiones['Conceptos']);
/*
	while($Cuestiones= mysql_fetch_array($result)){
		echo $Cuestiones['Q_id']."<br />";
		echo to_text($Cuestiones['Conceptos'],$Cuestiones['Asig_id'])."<br />";
	//	echo $Cuestiones['Conceptos']."<br />";
//		echo "Tema: ".$Cuestiones['Asig_id']."<br />";
//		to_text($Cuestiones['Conceptos'],$Cuestiones['fk_idTema'])."<br />";
//		echo $Cuestiones['Q_id']."<hr />";	
		
}
*/	
//	print_r($claves);
//	echo $base;

	while($Cuestiones= mysql_fetch_array($result)){
		$concepts=to_text($Cuestiones['Conceptos'],$Cuestiones['Asig_id']);
//		$claves=translate_idConcepts($Cuestiones['Conceptos']);
		echo "<div id='contenido'>";$i++;
			echo "<div id='ficha $i'>";
				echo "<div class='pregunta'>";
					echo "<span class=''>#".$Cuestiones['Q_id']."</span>[".$concepts."]<br/>	<div class='imagen1'>";
					if ($Cuestiones['Imagen']!=""){
					 	echo '<img src="';
						echo $Cuestiones['Imagen'];
						echo '"/>';
					}
			echo "</div> 
			<div class='clear'></div>
			<div class='imagen2'>";
				if ($Cuestiones['Imagen_aux']!=""){
					echo '<img src="';
					echo $Cuestiones['Imagen_aux'];
					echo '"/>';
				}
			echo" </div>
			<div class='enunciado'>";
		echo	$Cuestiones['Enunciado'];
		echo "<form>";
			GetAnswers($Cuestiones['Cuestion_id']); 
		echo "</form></div>		
		<div class='respuestas'>";
	echo "</div></div></div></div><br/>";
	}
	
	echo "Cuestiones de: ".$base.'';
?>
<SCRIPT SRC="mathjax/MathJax.js"></SCRIPT>
