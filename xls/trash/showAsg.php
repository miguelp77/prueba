<?php
	require_once('includes/misfunciones.php');
	$conn=@mysql_connect("localhost","root","p89er");
//  return $conn;
	$result = mysql_list_tables("Asgs");
	$base=$_POST['tabla'];
//	echo $base;
	$query="SELECT * FROM $base";
//	echo $query;
	$result =mysql_query($query)or $error_sql=mysql_error();
	echo $error_sql;
//	$number=mysql_num_rows($result);
//	$pag=$number/5; //Para la paginacion
//	$num=1; //Para la paginacion
//	$inicio=0+($num*5); //Para la paginacion
//	$fin=5+($num*5); //Para la paginacion
	$query= "SELECT * FROM $base ORDER BY Q_id ASC";// LIMIT $inicio,5";// LIMIT 0," .$pag."'";
	$result =mysql_query($query);
	$i=$inicio-1;
	while($Cuestiones= mysql_fetch_array($result)){
		echo "<div id='contenido'>";
		$i++;
		echo "<div id='ficha $i'>";
			echo "<div class='pregunta'>";
				echo "<span class=''>#".$Cuestiones['Q_id']."</span>[".$Cuestiones['Conceptos']."]<br/>	<div class='imagen1'>";
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
	echo	htmlentities(trim($Cuestiones['Enunciado']));
	echo "<form>";
	GetAnswers($Cuestiones['Cuestion_id']); 
	echo "</form></div>		
		<div class='respuestas'>";
	echo "</div></div></div></div><br/>";
	}
?>
