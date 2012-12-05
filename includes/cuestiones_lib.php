<?php
//Incluyo funciones basicas
require_once('basics.php');
require_once('extras.php');

function set_asigntatura($asignatura){
	if ($asignatura != NULL) {
		set_cookie('asignatura',$asignatura);
   }
} 

//Muestra el nombre de la "MATERIA"
//A la que pertenece el ID de una CUESTION
function GetMateria($q_id){
//	Conectar();
//Tomo el id de la Asignatura a la que pertenece el id de Cuestion
	$request="SELECT Asig_id FROM Cuestiones WHERE Cuestion_id='$q_id'";
	$query=	mysql_query($request);
	$result=mysql_fetch_object($query);
//	echo $result->Asig_id."<br />";
//Tomo el Nombre de la Asignatura del id anterior
	$sql="SELECT Nombre FROM Materias WHERE idAsignatura=$result->Asig_id";
	$query=mysql_query($sql);
	$result2=mysql_fetch_object($query);
	$name=$result2->Nombre;
//	echo $name."<br />";
	$_COOKIE["Nombre"]=$name;
//Fijo SESSION y COOKIE idAsig 
	$_COOKIE['idAsig']=$result->Asig_id;
	$_SESSION['idAsig']=$result->Asig_id;
	echo $name;
}

function GetEnunciado($q_id,$bbdd=NULL){
	Conectar($bbdd);

	$request="SELECT Enunciado,Asig_id FROM Cuestiones WHERE (Cuestion_id='$q_id')";
	$sql=	mysql_query($request);
	$result =mysql_fetch_array($sql);	
	echo $result[0];
}
//Devuelve el ID unico de la cuestion
function GetRelativeNumber($q_id){
//	Conectar($bbdd);
//	$Asig_id=$_COOKIE['Galle'];
	$result="SELECT Cuestion_id FROM Cuestiones WHERE Cuestion_id= '$q_id' ";
	$cuestiones =mysql_query($result);
	$cuestion=mysql_fetch_array($cuestiones);
	return $cuestion[0];
}
//Devuelve el ORDEN de la cuestion
function GetNCuestion($q_id){
//	Conectar($bbdd);
	 
	$result="SELECT Q_id FROM Cuestiones WHERE Cuestion_id= '$q_id' ";
	$cuestiones =mysql_query($result);
	$cuestion=mysql_fetch_array($cuestiones);
	return $cuestion[0];
// Recibe el identificador autoincrementado. Devuelve el identificador 
// ordenado. 	
	}
function GetImage($q_id){
//	Conectar($bbdd);
//		$Asig_id=$_COOKIE['Galle'];
	$result="SELECT Imagen FROM Cuestiones WHERE Cuestion_id='$q_id'";
	$cuestiones =mysql_query($result);
	$cuestion=mysql_fetch_array($cuestiones);
	return $cuestion[0];
	
	}
function GetImage2($q_id=1){
//	Conectar($bbdd);
	$result="SELECT Imagen_aux FROM Cuestiones WHERE (Cuestion_id='$q_id')";
	$cuestiones =mysql_query($result);
	$cuestion=mysql_fetch_array($cuestiones);
	echo $cuestion[0];
	}
//Muestra las RESPUESTAS A UNA CUESTION
//con BOTONES de EDICION
function GetAnswers_editor($q_id=1){
//	Conectar($bbdd);
//	$Asig_id=$_COOKIE['Galle'];
	$_COOKIE['idQ']=$q_id;
	$query="SELECT * FROM Respuestas WHERE (Cuestion_id='$q_id') ORDER BY 'Resp_id' ASC";
	$result =mysql_query($query);
		//echo $q_id;
	echo '<ul class="abclist">';
	while($answer_row= mysql_fetch_array($result)){
		if ($answer_row['Correcta']== 1){ 
			echo '<li><div class="'.$answer_row['Resp_id'].' ok">';
			echo $answer_row['Respuesta'];
			echo '<img class="dcha" src="img/tick.png" />';
			echo '<a href="#" class="botones'.$answer_row['Resp_id'].'" title="borrar" value="'.$answer_row['Resp_id'].'" ">
        <img src="./img/cross.png" alt=""/>
        </a>';
			echo '<a href="#" class="botones'.$answer_row['Resp_id'].'" title="editar" value="'.$answer_row['Resp_id'].'">
        <img src="./img/pencil.png" alt=""/>
        </a>';
			echo '</div></li>';
			continue;
		}
		echo '<li><div class="'.$answer_row['Resp_id'].'">';
		echo $answer_row['Respuesta'];
		//	echo '<img class="dcha" src="img/tick.gif" />';
		echo '<a href="#" class="botones'.$answer_row['Resp_id'].'" title="borrar" value="'.$answer_row['Resp_id'].'" ">
        <img src="./img/cross.png" alt=""/>
         </a>';
		echo '<a href="#" class="botones'.$answer_row['Resp_id'].'" title="editar" value="'.$answer_row['Resp_id'].'">
        <img src="./img/pencil.png" alt=""/>
         </a>';
		echo '</div></li>';
	}
	echo "</ul>";
}
//Muestra las RESPUESTAS de 1 Cuestion
//Necesita libreria de shuffle	
function GetAnswers($q_id){
//	Conectar($bbdd);
	$LastId = 0;
	$query = "SELECT * FROM Respuestas WHERE Cuestion_id= '$q_id' ORDER BY 'Resp_id' ASC";
	$result = mysql_query($query);
	echo '<ul class="abclist '.$q_id.'">';
	while($answer_row= mysql_fetch_array($result)){
		if ($answer_row['Ultima']==1){
			$LastOne = $answer_row['Respuesta'];
			$LastId = $anwer_row['Resp_id'];
			//	echo "kuku";
	//			continue;
		}
	echo '<li>';
	echo '<input type=radio id="its" name="its" value="',$answer_row['Resp_id'], '"/>';
	echo $answer_row['Respuesta'];
	echo '</li>';
	//	echo '<img class="dcha" src="img/tick.gif" />';
	$n=$q_id;
	//SCRIPT Desordeno respuestas
	echo "<script >$('ul.abclist.'+$n+' li').shuffle(); </script>";
	}
	//Coloco la ultima posibilidad
	if($LastId !== 0) echo '<li><input type="radio" id="its" name="its" value="'.$LastId.'"/>'.$LastOne.'</li>';
	echo "</ul>";
	echo "<li><input type='checkbox' class='sin_respuesta' name='sin respuesta' value='No Responder' checked/>"."</li>";	
	//$cuestion=mysql_fetch_array($cuestiones);
	//echo $cuestion['Imagen'];
	
	}


//Muestra TODAS las CUESTIONES
function GetQ($num=1){
//Al final no hago paginacion
	$query= "SELECT * FROM Cuestiones ORDER BY Q_id ASC";// LIMIT $inicio,5";// LIMIT 0," .$pag."'";
	$result =mysql_query($query);
	$number=mysql_num_rows($result);
//	$pag=$number/5; //Para la paginacion
//	$num=1; //Para la paginacion
//	$inicio=0+($num*5); //Para la paginacion
//	$fin=5+($num*5); //Para la paginacion
	$i=0;
	while($Cuestiones= mysql_fetch_array($result)){
		echo "<div id='contenido'>";
		$i++;
		echo "<div id='ficha $i'>";
			echo "<div class='pregunta'>";
		echo "<span class=''>#".$Cuestiones['Q_id']."</span><br/>
				<div class='imagen1'>";
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
}
//Muestra CUESTIONES de manera aleatoria
function GetQs($numQ=4){
//Usada en showQs.php
//	Conectar();
	$query= "SELECT * FROM Cuestiones ORDER BY Q_id ASC ";// LIMIT 0," .$pag."'";
	$result =mysql_query($query);
	$number=mysql_num_rows($result);
	$i=0;
	$matriz[$number];
//$numQ=5; //Nunmero de preguntas que quiero ver
	while($Cuestiones= mysql_fetch_array($result)){
		$matriz[]=$Cuestiones['Q_id']; //array con todos los Q_id de las cuestiones
		}
//	print_r ($matriz);
//	echo '<br />';
//Primera pregunta
		$aleatorio=rand(1,$number);
		$lista[]=$aleatorio;
	while ($numQ!==0) 
	{
		$aleatorio=rand(1,$number); //Tomo otra pregunta
	//Compruebo que no existe
		if( array_key_exists($aleatorio, $lista)) $i--;
	//La añado a la lista de preguntas
		$lista[]=$aleatorio;

		echo 'Pregunta #'.$i.' Cuestion '. $aleatorio;
		///AQUI EDITO
		$query= "SELECT * FROM Cuestiones WHERE Q_id='$aleatorio'";// LIMIT 0," .$pag."'";
		$result =mysql_query($query);
		while($Cuestiones= mysql_fetch_array($result))	
			{	
			echo "<div id='contenido'>";
			echo "<div class='ficha'>
				<div id='pregunta'>
				<span class=''>#".$Cuestiones['Q_id']."</span><br/>
				<div id='imagen1'>";
			if ($Cuestiones['Imagen']!=""){
	 			echo '<img src="';
				echo $Cuestiones['Imagen'];
				echo '"/>';
				}
			echo "</div>
				<div class='clear'></div>
				<div id='imagen2'>";
			if ($Cuestiones['Imagen_aux']!=""){
				echo '<img src="';
				echo $Cuestiones['Imagen_aux'];
				echo '"/>';
				}
			echo" </div>
					<div id='enunciado'>";
			echo	$Cuestiones['Enunciado'];
			GetAnswers($Cuestiones['Cuestion_id']); 
			echo "</div>		
				<div id='respuestas'>";
			echo "</div></div></div></div><br/>";
			$i++;
		}
	$numQ--;
	}
/*
	foreach($lista as $key => $value){
		$q_index=$key+1;
		echo "Pregunta ". $q_index." = ".$value.'<br />';
	}
*/
//	print_r($lista);
}

//Ordenar Cuestiones
function Orden_Q(){
//Ordena las cuestiones dentro de la 
//tabla Cuestiones en el campo $Q_id
	$conexion = Conectar($bbdd);	
	$orden=0;

	$Irene="SELECT Cuestion_id FROM Cuestiones ";
	$query = mysql_query($Irene);

	while($Yorch= mysql_fetch_array($query)){
		$orden++;
		$Sara="UPDATE Cuestiones SET Q_id='$orden' WHERE Cuestion_id= '$Yorch[0]'";
		$result =mysql_query($Sara) or die(mysql_error());
//		echo $Yorch[0].'---> '.$orden.'<br />';	
//		echo $Qid;
		}
}


function showConceptos($idQ){
	$conn = Conectar($bbdd);
	$Name=$_COOKIE['Nombre'];
	$idAsignatura=$_COOKIE['idAsig'];
//Recorro los campos de la CUESTION mostrada
	$sql="SELECT * FROM Cuestiones WHERE Cuestion_id='$idQ'";
	$result=mysql_query($sql);	
//Recorro los TEMAS de la ASIGNATURA
	$sql="SELECT * FROM Temas WHERE fk_idAsignatura='$idAsignatura'";
	$result1=mysql_query($sql);
//Por cada CUESTION
	while ($row= mysql_fetch_object($result)){
//$a tiene la CADENA DE CONCEPTOS de la CUESTION
		$a=$row->Conceptos;
//$Conceptos es un ARRAY con los CONCEPTOS		
		$Conceptos=explode(",",$a);
	}
	if ($Conceptos=='') die();
//Nombre de la ASIGNATURA	
	echo '<pre><b>'.$Name.'</b><br />';
//Por cada TEMA de la ASIGNATURA
	while($row1= mysql_fetch_object($result1)){
//tomo el ID del TEMA
		$idTema=$row1->idTema;
		echo $row1->Nombre.'<br />';
		$sql2="SELECT * FROM Conceptos WHERE fk_idTema='$idTema'";
		$result2=mysql_query($sql2);
//Por cada TEMA recorro los CONCEPTOS que tiene		
		while ($row= mysql_fetch_object($result2)){
//Si el CONCEPTO es del ARRAY lo muestro seleccionado
			if(in_array($row->idConcepto,$Conceptos)){
				echo $row->Nombre;
				echo "<input type=\"checkbox\" title ='$row->Descripcion' value=\"$row->idConcepto\" checked/>";
				echo '<br />';		//	echo "Key exists!";
			} else {
// Si el CONCEPTO no esta en el ARRAY lo muestro sin marcar
				echo $row->Nombre;
				echo "<input type=\"checkbox\" title ='$row->Descripcion' value=\"$row->idConcepto\"/>";
				echo '<br />';
			}
		}
	}
	echo '</pre>'."<button class='setConcept'>Asignar</button>";		
}

function text_to_web($archivo){
	$lineas=file($archivo); // muestra el contenido de cada parte del array
	//	print_r($lineas);
	$i=0;
	$pattern = '/^[0-9]+\.+\-/'; //Enunciados
	$pattern2='/^[a-m]+\)/'; //Respuestas
	foreach($lineas as $linea){
		if(preg_match($pattern, $linea)){
			$i++;
			echo '<h3>Nueva pregunta '.$i.'</h3>';
			$linea=preg_replace($pattern,'', $linea);
			}
		if(preg_match($pattern2, $linea, $matches)){
			echo '<li></li>';
			}
					
			echo $linea;
	}
}

function SelMateria(){
	$conn=Conectar($bbdd);
	$query="SELECT * FROM Materias";
	$result=mysql_query($query);
//	echo "<form method=\"post\" action='#'>";
	echo "<select name='Materia' id='Materia' SIZE='1' >";
	while ($row = mysql_fetch_object( $result ))
		{
	//anulo el valor de phpmyadmin
	if($row->Nombre =="") continue;
	   echo "<OPTION VALUE='$row->Nombre' ID='$row->idAsignatura'> $row->Nombre</OPTION>";
		}
	echo "</select> ";
	echo $row;
	echo "<input type='button' name='SelMateria' value='Seleccionar'/>";
	echo "<input type='text' id='Asig'/>";
	echo "<input type='button' name='newAsig' value='Añadir' />";
//	echo "</form>";
}




?>
