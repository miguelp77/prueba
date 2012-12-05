<?php
//	USAR SIEMPRE CON ('includes/db_tools.php');
function GetMateria($q_id){
	$request="SELECT Asig_id FROM Cuestiones WHERE Cuestion_id='$q_id'";
	$query=	mysql_query($request);
	$result=mysql_fetch_object($query);
//Tomo el Nombre de la Asignatura del id anterior
	$sql="SELECT Nombre FROM Materias WHERE idAsignatura=$result->Asig_id";
	$query=mysql_query($sql);
	$result2=mysql_fetch_object($query);
	$name=$result2->Nombre;

	$_COOKIE["Nombre"]=$name;
	$_COOKIE['idAsig']=$result->Asig_id;
	$_SESSION['idAsig']=$result->Asig_id;
}

function GetEnunciado($q_id){
//	echo $q_id;
	$request="SELECT Enunciado FROM Cuestiones WHERE Cuestion_id=$q_id";
	$sql=	mysql_query($request) or die(mysql_error());
	$result =mysql_fetch_row($sql);	
	return $result[0];
}

function GetRelativeNumber($q_id){
/*	Conectar();
	$Asig_id=$_COOKIE['Galle'];
	$result="SELECT Cuestion_id FROM Cuestiones WHERE Cuestion_id= '$q_id' ";
	$cuestiones =mysql_query($result);
	$cuestion=mysql_fetch_array($cuestiones);
	echo $cuestion[0];
*/	
	}
function GetNCuestion($q_id){
/*	Conectar();
*/	 
	$result="SELECT Q_id FROM Cuestiones WHERE Cuestion_id= '$q_id' ";
	$cuestiones =mysql_query($result);
	$cuestion=mysql_fetch_array($cuestiones);
	return $cuestion[0];
// Recibe el identificador autoincrementado. Devuelve el identificador 
// ordenado. 	
	}
function GetImage($q_id){
	
	$result="SELECT Imagen FROM Cuestiones WHERE Cuestion_id='$q_id'";
	$cuestiones =mysql_query($result);
	$cuestion=mysql_fetch_array($cuestiones);
	return $cuestion[0];
	
	}
function GetImage2($q_id){

	$result="SELECT Imagen_aux FROM Cuestiones WHERE Cuestion_id='$q_id'";
	$cuestiones =mysql_query($result);
	$cuestion=mysql_fetch_array($cuestiones);
	return $cuestion[0];
	}
function GetAnswers_editor($q_id){
//	Conectar();
//	$Asig_id=$_COOKIE['Galle'];
//	$_COOKIE['idQ']=$q_id;
	$query="SELECT * FROM Respuestas WHERE (Cuestion_id='$q_id') ORDER BY 'Resp_id' ASC";
	$result =mysql_query($query);
		//echo $q_id;
		echo '<ul class="abclist">';
	while($answer_row= mysql_fetch_assoc($result)){
		
		if ($answer_row['Correcta']== 1)
			{ 
	echo '<li><div class="'.$answer_row['Resp_id'].' ok" title="'.$answer_row['Porcentaje'].'%">';

	echo $answer_row['Respuesta'];
//	echo '<img class="" src="img/tick.png" />';		
	echo '<a href="#" class="botones'.$answer_row['Resp_id'].'" title="eliminar respuesta" name="borrame" value="'.$answer_row['Resp_id'].'" ">
        <img src="../img/cross.png" alt=""/>
         </a>';
		echo '<a href="#respuesta_edit" class="botones'.$answer_row['Resp_id'].'" title="editar respuesta" name="editar" value="'.$answer_row['Resp_id'].'">
        <img src="../img/pencil.png" alt=""/>
         </a>';//."[".$answer_row['Porcentaje']."]";
	echo '<img class="" src="../img/tick.png" />';
					echo '</div></li>';
			continue;
		}
		echo '<li><div class="'.$answer_row['Resp_id'].'" title="'.$answer_row['Porcentaje'].'%">';
		echo $answer_row['Respuesta'];
		//	echo '<img class="dcha" src="img/tick.gif" />';
		echo '<a href="#" class="botones'.$answer_row['Resp_id'].'" title="eliminar respuesta" name="borrame" value="'.$answer_row['Resp_id'].'" ">
        <img src="../img/cross.png" alt=""/>
         </a>';
		echo '<a href="#respuesta_edit" class="botones'.$answer_row['Resp_id'].'" title="editar respuesta" name="editar" value="'.$answer_row['Resp_id'].'">
        <img src="../img/pencil.png" alt=""/>
         </a>';//."[".$answer_row['Porcentaje']."]";

					echo '</div></li>';
	}
	echo "</ul>";
	//$cuestion=mysql_fetch_array($cuestiones);
	//echo $cuestion['Imagen'];
	
	}
function GetAnswers($q_id){
	$LastId = 0;
	static $idx=0;
	$idx++;
	$query = "SELECT * FROM Respuestas WHERE Cuestion_id= '$q_id' ORDER BY 'Resp_id' ASC";
	$result = mysql_query($query);
	echo '<div class="inv"><li><input type=radio id="its" name="its" value="sr'.$idx.'" checked/> Sin responder</li></div>';
	echo '<li class="nr"><input type=radio id="its" name="its" value="nr'.$q_id.'"/> No responder</li>';
	echo '<ul name="'.$q_id.'" class="abclist '.$q_id.'">';
	while($answer_row= mysql_fetch_array($result)){
			if ($answer_row['Ultima']==1){
				$LastOne = $answer_row['Respuesta'];
				$LastId = $anwer_row['Resp_id'];
//				echo "kuku";
				continue;
			}
			echo '<li>';
			echo '<input type=radio id="its" name="its" value="',$answer_row['Resp_id'], '"/>';
			echo $answer_row['Respuesta'];
			echo '</li>';
		//	echo '<img class="dcha" src="img/tick.gif" />';
		$n=$q_id;
	}
	echo "</ul>";
	//Coloco la ultima posibilidad
	echo "<script >  $('ul.abclist.'+$q_id+' li').shuffle(); </script>";	
	if($LastId !== 0) echo '<li><input type="radio" id="its" name="its" value="'.$LastId.'"/>'.$LastOne.'</li>';
	//$cuestion=mysql_fetch_array($cuestiones);
	//echo $cuestion['Imagen'];
	
	}
function get_n_answers($q_id){
	
	$query = "SELECT Resp_id,Porcentaje FROM Respuestas WHERE Cuestion_id= '$q_id' ORDER BY 'Resp_id' ASC";
	$result = mysql_query($query) or die(mysql_error());
	while($row=mysql_fetch_row($result)){
		$ids[]=$row[0];
		$porcent[]=$row[1];
	}
	$respuestas=array_combine($ids,$porcent);
//	$res=json_encode($respuestas);
	return $respuestas;
}



function GetQ($num){
//Al final no hago paginacion
	$query='SELECT * FROM Cuestiones';
	$result =mysql_query($query);
	$number=mysql_num_rows($result);
	$pag=$number/5; //Para la paginacion
//	$num=1; //Para la paginacion
//	$inicio=0+($num*5); //Para la paginacion
//	$fin=5+($num*5); //Para la paginacion
	$query= "SELECT * FROM Cuestiones ORDER BY Q_id ASC";// LIMIT $inicio,5";// LIMIT 0," .$pag."'";
	$result =mysql_query($query);
	$i=$inicio-1;
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
function GetQs($num){
//Usada en showQs.php
	$query='SELECT * FROM Cuestiones';
	$result =mysql_query($query);
	$number=mysql_num_rows($result);
	$i=0;
	$matriz[$number];
	$query= "SELECT * FROM Cuestiones ORDER BY Q_id ASC ";// LIMIT 0," .$pag."'";
	$result =mysql_query($query);
	$numQ=3; //Nunmero de preguntas que quiero ver
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
	print_r($lista);
}
/*
function Cuestiones(){
	$conn = Conectar();
	$i=0;
	//Conectar();
	$query='SELECT * FROM Cuestiones';
	$result =mysql_query($query);
	$number=mysql_num_rows($result);
	$pag=$number/5;
	//$inicio=0+($num*5);
	//$fin=5+($num*5);
	if (($number%5)==0) $pag=$pag-1;
	for($j=0;$j<=$pag;$j++)
		{
			if($j==0)
				echo "<span class='PagQs'>".$j."</span>";
			if($j!=0)
				echo "<span class='PagQ'>".$j."</span>";
		}
}
*/
//Ordenar Cuestiones
/*
function Orden_Q(){
	$conexion = Conectar();	
	$orden=0;
	$inicio=1;
	$Irene="SELECT Cuestion_id FROM Cuestiones ";
	$query = mysql_query($Irene);
	while($Yorch= mysql_fetch_array($query)){
		$orden++;
		$Sara="UPDATE Cuestiones SET Q_id='$orden' WHERE Cuestion_id= '$Yorch[0]'";
		$result =mysql_query($Sara) or die(mysql_error());
//		echo $Yorch[0].'---> '.$orden.'<br />';	
		echo $Qid;
		}
}
*/


function showConceptos($idQ){
//	$conn = Conectar();
//ASIGNATURA escogida anteriormente en una COOKIE	
//	$idAsignatura=($_COOKIE['Galle']);
	$idQ=$_SESSION['idQ'];
//	$Name=$_COOKIE['Nombre'];
//	$idAsignatura=$_COOKIE['idAsig'];
//	$_COOKIE['idAsig']=$idAsignatura;
//if($idAsignatura=' ')exit;
//	echo "Hola ".$idAsignatura;
//Recorro los campos de la CUESTION mostrada
	$sql="SELECT * FROM Cuestiones WHERE Cuestion_id='$idQ'";
	$result=mysql_query($sql);	
//	echo 'galleta='.$idAsignatura.'<br />';
//Recorro los TEMAS de la ASIGNATURA
	$sql="SELECT * FROM Temas";// WHERE fk_idAsignatura='$idAsignatura'";
	$result1=mysql_query($sql);
//
	while ($row= mysql_fetch_object($result)){
		$a=$row->Conceptos;
//	print_r($row->Conceptos);//		print_r($a);//		echo gettype($a);//		echo " y despues ".gettype(unserialize($a))." ".unserialize($a);//	print_r($a);
//	echo "--";//	$a=unserialize($a);//	print_r($a);
	$Conceptos=explode(",",$a);
//	echo "Conceptos= ".gettype($Conceptos);//	print_r($Conceptos);
	}
	if (empty($Conceptos)) die();
	echo '<pre>';
//		echo '<b>'.$Name.'</b><br />';
	while($row1= mysql_fetch_object($result1)){
		$idTema=$row1->idTema;
		echo "<span class='tema' name='$idTema'><b>".$row1->Nombre."</b></span>".'<br />';
		$sql2="SELECT * FROM Conceptos WHERE fk_idTema='$idTema'";
		$result2=mysql_query($sql2);
		while ($row= mysql_fetch_object($result2)){
		//	$a=$row->Conceptos;	//		echo "consulta ".gettype($a);//		$a=unserialize($a);//		echo gettype($a);
	//		echo $row->Nombre."  ".$row->idConcepto; //SOLO DEPURACION
	//		echo $row->Nombre; //COMENTADA POR DEPURACION	//	(n <= 1 ? " es" : " son")
			if(in_array($row->idConcepto,$Conceptos)){
		
				echo "<u>".$row->Nombre."</u>";
				echo "<input type=\"checkbox\" title ='$row->Descripcion' name=\"$row->idConcepto\" value=\"$row->idConcepto\" checked/>";
				echo '<br />';		//	echo "Key exists!";
			}
			else{
				echo $row->Nombre;
				echo "<input type=\"checkbox\" title ='$row->Descripcion' name=\"$row->idConcepto\" value=\"$row->idConcepto\"/>";
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

function get_next_id($table=NULL){
//	conectar("Asignatura");
//	echo $table."<br />";
//	mysql_list_tables("Asignatura");
//	$sql="SELECT * FROM $table";
//	$query=mysql_query($sql) or die(mysql_error());
//	while($row=mysql_fetch_array($query)){
//		echo $row[0]."<br />";
//	}
//		echo "<hr />";
		$r = mysql_query("SHOW TABLE STATUS LIKE '$table'");
		$row = mysql_fetch_array($r);
		$Auto_increment = $row['Auto_increment'];
		mysql_free_result($r);
		return $Auto_increment;
//	echo "<hr />";
//	$id=mysql_insert_id();
	
}

function examen_listar(){
	echo "<hr />";
	$sql="SELECT * FROM Fuentes ORDER BY idFuente DESC";
	$query=mysql_query($sql) or die(mysql_error());
	while($row=mysql_fetch_row($query)){
		
		$id=strtotime($row[1]);
		$local=date( 'd-m-Y [H:i]', $id );
		//echo '<div class="fuente_resaltada">';
		echo '<div class="resumen" name="'.$row[0].'">';
		echo "<span class='yellow'>$row[0]</span> - <b>$row[5]</b>"." seleccionadas por <b>".$row[2]."</b> el ".$local."<br /></div>";
		echo '<div class="todo '.$row[0].'">';		
		echo "Preguntas: ".$row[3]."  en grupos de ".$row[6]." por prueba<br />";
		if($row[4]>0) echo " con una duracion de  ".$row[4]." minutos<br />"; 
		echo "<button value='$row[0]' name='set_examen' title='Agregar fuente de examenes'>Empujar</button>";
		echo "<button value='$row[0]' name='del_examen' title='Eliminar fuente de examenes'>Sacar</button>";	
		echo "<button value='$row[0]' name='vanish_examen' title='Eliminar fuente de examenes'>Eliminar</button>";
		echo '</div>';
		echo '<hr />';
	}
}

//Eliminar Fuente

function fuente_eliminar($fuente=null){
	if($fuente!=null){
		$sql="DELETE FROM Fuentes WHERE idFuente=$fuente";
		$query=mysql_query($sql) or die(mysql_error());
		return $query;
	}
}

function examen_grabar($examen,$numero=5,$duracion=60,$nombre='Sin nombre!'){
	$created='default';
	if(isset($_SESSION['user'])) $created=$_SESSION['user'];
	$mysqldate =date( 'Y-m-d H:i:s', time());
		
	$identificado =$mysqldate;
//	echo $identificado;
	$sql="INSERT INTO Fuentes (preguntas,nombre,created,identificado,numero,duracion) VALUES ('$examen','$nombre','$created','$identificado','$numero','$duracion')";
	$query=mysql_query($sql) or die(mysql_error());
	return $query;
}
function cuantas_cuestiones(){
	$sql="SELECT * FROM Cuestiones ORDER BY Cuestion_id";
	$query=mysql_query($sql) or die(mysql_error());
	$count=mysql_num_rows($query);
	return $count;
}

function id_explorer($table){
	$no_correct=check_correcta();
	$sql="SELECT * FROM $table ORDER BY Cuestion_id";
	$query=mysql_query($sql);
	$count=mysql_num_rows($query);

//	$last_id=mysql_fetch_row($query);
//	$counts=mysql_affected_rows($last_id);
	$i=1;
	echo "<div class='marco'><<</div>";
	while($row=mysql_fetch_array($query)){
		if(in_array($row[0],$no_correct))
			echo "<div class='marco nok'><a href='#' name='".$row[0]."' title='cuestion ".$row[0]." no tiene correcta'>".$row[0]."</a></div>";
		else echo "<div class='marco'><a href='#' name='".$row[0]."' title='cuestion ".$row[0]."'>".$row[0]."</a></div>";
	//	if($i%20==0)echo '<div class="clear"></div>';
		$i++;	
	}
		echo "<div class='marco dcha'>>></div>";
		echo "<div class='marco dcha'>$count</div>";
	echo '<br /><br />';
//	echo '<div class="clear"></div>';
}
function chg_status($idA,$status=null){
	$db=$_SESSION['db_name'];
	$idAs=$_SESSION['idAs'];
	//	$sql="UPDATE Alumnos SET Nombre='$nombre',Apellidos='$apellidos',DNI='$dni',Alias='$alias',Psw='$pass' WHERE Alumno_id = $id LIMIT 1";
	$sql="UPDATE asg_admin.Alumnos SET status='$status' WHERE Alumno_id = $idAs LIMIT 1";
	$query=mysql_query($sql) or die(mysql_error());
	
}	
function chg_nota($idA,$nota=null,$fecha){
	$db=$_SESSION['db_name'];
	$idAs=$_SESSION['idAs'];
	$sql="UPDATE asg_admin.Alumnos SET Nota='$nota',Fecha='$fecha' WHERE Alumno_id = $idAs LIMIT 1";
	$query=mysql_query($sql) or die(mysql_error());
}	
function set_num_exam($idAs=null,$num_examen=null){
	
	if($idAs==null)
		$idAs=$_SESSION['idAs'];
	if($num_examen!=null){
		$sql="UPDATE asg_admin.Alumnos SET num_exam='$num_examen' WHERE Alumno_id=$idAs LIMIT 1";
		$query=mysql_query($sql) or die(mysql_error());
		return true;
	}	else return false;
//	echo $re;
}
function check_correcta(){
	$no_correct=array();
	$sql="SELECT Cuestion_id FROM Cuestiones";
	$query=mysql_query($sql) or die (mysql_error());
	while($row=mysql_fetch_row($query)){
		$sql="SELECT Correcta FROM Respuestas WHERE Cuestion_id=$row[0]";
		$query2=mysql_query($sql) or die(mysql_error());
		array_push($no_correct,$row[0]);
		while($res=mysql_fetch_row($query2))
		if($res[0]==1){
			array_pop($no_correct);		
		}
	}
	return $no_correct;
} 
function ready_question($idQ=null){
	if($idQ!=null){
		
		$sql="SELECT Correcta FROM Respuestas WHERE Cuestion_id=$idQ";
		$query=mysql_query($sql) or die(mysql_error());
		$bool=false;
		while($row=mysql_fetch_row($query)){
			if($row[0]==1) $bool=true;
		}
		return $bool;
	}
}

function huerfana_answer(){
	$cuestiones=Array();
	$respuestas=Array();
	$diff=Array();
	$sql="SELECT Cuestion_id FROM Respuestas";
	$query=mysql_query($sql) or die (mysql_error());
	while($row=mysql_fetch_row($query)){
		if(!in_array($row[0],$respuestas))array_push($respuestas,$row[0]);
	}
	$r=count($respuestas);
	$sql="SELECT Cuestion_id FROM Cuestiones";
	$query=mysql_query($sql) or die (mysql_error());
	while($row=mysql_fetch_row($query)){
		if(!in_array($row[0],$cuestiones))array_push($cuestiones,$row[0]);
	}	
	$c=count($cuestiones);
	if($r>$c) $diff=array_diff($respuestas,$cuestiones); //Este array sera el que se borrara
//	show_arr($diff);
	if(count($diff)>0){
		foreach($diff as $idC){
			$sql="DELETE FROM Respuestas WHERE Cuestion_id=$idC";
			$query=mysql_query($sql) or die (mysql_error());	
		}
	echo "Eliminadas las huerfanas";
	}else echo 'No hay huerfanas';
	unset($cuestiones);
	unset($respuestas);
	unset($diff);
}	
		
	

function examenes_push($preguntas,$status){
//OJO que status es el id de la fuente de origen
	$begin=time();
//	if(get_cookie("comienzo")) $begin=get_cookie("comienzo");
//	else set_cookie("comienzo", $begin);

	$comienzo=$begin;
	$fin=(int)$comienzo+(3600*24*7);//		CADUCA EN 1 SEMANA
	$start=date('Y-m-d H:i:s', $comienzo);
	$expire=date('Y-m-d H:i:s', $fin);
	$idAlumno=$_SESSION['idAlumno'];
	$IP=ip2long($_SERVER['REMOTE_ADDR']);
	$examen=$preguntas;

	
	$sql="INSERT INTO Examenes (fk_Alumno_id,IP,expire,preguntas,start,status) VALUES ('$idAlumno','$IP','$expire','$examen','$start','$status') ";
	$query=mysql_query($sql) or die(mysql_error());
	$idExamen=mysql_insert_id();
	$idAs=$_SESSION['idAs'];
	$_SESSION['estado']=set_num_exam($idAs,$idExamen);


 push_expediente($idAlumno,$idExamen);
//		echo "examenes"."<br />"; 
//		echo $idAlumno." IP: ";
//		echo long2ip($IP)."<br />";
//		echo "start at ".$start."<br />";
//		echo "contiene ".$examen."<br />";
}
function update_answers($examen=null,$idA,$nota,$orden=null,$answers=null){
		$begin=time();
		$expire=date('Y-m-d H:i:s', $begin);
	if($answers!=null){
		$status='Corregido';
		$sql="UPDATE Examenes SET respuestas='$answers',resultado='$nota',orden='$orden',expire='$expire' WHERE fk_Alumno_id=$idA AND preguntas='$examen' LIMIT 1";
		$query=mysql_query($sql) or die(mysql_error());		
		chg_status($idA,$status);
		return true;
	}
}


function examenes_pop($idA){
	$examenes=array();
	$idAlumno=$idA;
	$idAs=$_SESSION['idAs'];
	$sql="SELECT examenes FROM Alumnos WHERE Alumno_id=$idAlumno";
	$query=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_row($query);
	str_replace(",","",$row[0]);
//	echo $row[0];
	$examenes=explode(",",$row[0]);
//		foreach ($examenes as $key => $value){
//				echo ">>".$value."<br />";
//			}
//	array_shift($examenes);
	if($examenes[0]!=null){
//		foreach ($examenes as $key => $value){
//				echo $value."<br />";
//			}
		$fuente=array_pop($examenes);
		$stack= join(",",$examenes);
		$sql2="UPDATE Alumnos SET examenes='$stack' WHERE Alumno_id=$idAlumno LIMIT 1";
		$query2=mysql_query($sql2) or die(mysql_error());		
		return $fuente;
//	echo "<hr />";

	}else return false;
}

function examen_get_id($idA,$bbdd){
	$examenes=array();
	$idAlumno=$idA;
	$sql="SELECT examenes FROM $bbdd.Alumnos WHERE Alumno_id=$idAlumno";
	$query=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_row($query);
	str_replace(" ,","",$row[0]);
//	echo $row[0];
	$examenes=explode(",",$row[0]);
//		foreach ($examenes as $key => $value){
//				echo ">>".$value."<br />";
//			}
//	array_shift($examenes);
if($bbdd=='asg_admin') return false;
	if($examenes[0]!=null){
//		foreach ($examenes as $key => $value){
//				echo $value."<br />";
//			}
		$pop=array_pop($examenes);
//		$stack= join(",",$examenes);
//		$sql2="UPDATE Alumnos SET examenes='$stack' WHERE Alumno_id=$idAlumno LIMIT 1";
//		$query2=mysql_query($sql2) or die(mysql_error());		
		return $pop;
//	echo "<hr />";
	}else return false;

}

function duracion_get($id=null,$bbdd){
	if($id!=null){
		$sql="SELECT duracion FROM $bbdd.Fuentes WHERE idFuente=\"$id\" LIMIT 1";
		$query=mysql_query($sql) or die(mysql_error());
		$row=mysql_fetch_row($query);	
		if((int)$row[0]==null)(int)$row[0]=0;
		$_SESSION['duracion']=(int)$row[0];
		return (int)$row[0];	
	}
}
//preguntas
function npreguntas_get($id=null,$bbdd){
	if($id!=null){

		$sql="SELECT numero FROM $bbdd.Fuentes WHERE idFuente=\"$id\" LIMIT 1";
		$query=mysql_query($sql) or die(mysql_error());
		$row=mysql_fetch_row($query);	
		if((int)$row[0]==null)(int)$row[0]=0;
		$_SESSION['numero']=(int)$row[0];
		return (int)$row[0];	
	}
}
function examenes_show($id){
	$sql="SELECT * FROM Examenes";// WHERE idExamen=$id";
	$query=mysql_query($sql) or die(mysql_error());
	while($row=mysql_fetch_assoc($query)){
		echo "examen ".$row['idExamen']."<br />"; 
		echo "alumno: ".$row['fk_Alumno_id']." IP: ";
		echo long2ip($row['IP'])."<br />";
		echo "comienza en  ".$row['start']."<br />";
		echo "caduca   ".$row['expire']."<br />";
		echo "preguntas ".$row['preguntas']."<br />";
//idExamen | fk_Alumno_id | IP | created | expire | preguntas | respuestas | resultado | start | done | status	
		echo "<hr />";
	}

//	$begin=time();
//	if(get_cookie("comienzo")) $begin=get_cookie("comienzo");
//	else set_cookie("comienzo", $begin);
//	$begin=strtotime($begin);


//	$comienzo=$begin;
//	$fin=(int)$comienzo+(3600*24*7);//		CADUCA EN 1 SEMANA
//		$fin=strtotime($fin);
//	echo date('d-M-Y H:i:s',$comienzo)."-------".date('d-M-Y H:i:s',$fin);

//	$sql="ALTER TABLE Examenes CHANGE IP IP INT(20) DEFAULT '0' NOT NULL"; 
//	$query=mysql_query($sql) or die(mysql_error());
}
function numero_de_cuestiones($ini=0,$qty=5,$total){
	$last=0;
	$retro=$ini-5;
	$ava=$ini+5;
//No fwd/rwd mas de los limites	
	if($retro<=1) $retro=1;
	if($ava>=$total) $ava=$total;
	if($ini<=0) $ini=1;
	if($ini>=$total) $ini=$total;
//Resaltar las que no tienen respuesta correcta	
	$no_correct=check_correcta();
//	
	$dosmenos=$ini-3;
	if($dosmenos<=0)$dosmenos=0;
//Calculo el intervalo

	if($qty%2)
		$mitad=(int)($qty/2); //par
	else $mitad=($qty/2);
	$inicio=$ini-$mitad-1;
	$final=$ini+$mitad;
	if($inicio<=1){
		$inicio=0;
		$qty=$qty+1;
	}
	if($final>=($total-1)){
		$qty=$qty+2;
		$inicio=$total-$qty;
	}else	$qty=$qty+1;
	
//	$centro=$total-$ini;
	
//La primera es correcta??
	$sql="SELECT * FROM Cuestiones ORDER BY Cuestion_id LIMIT 1";	
	$query = mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_row($query);
	$primera=$row[0];
	$bool=0; //Sirve para ver si la primera tiene correcta o no
	if(in_array($row[0],$no_correct)) $bool=1;
//Pido las id de la cuestiones
//	$sql="SELECT * FROM Cuestiones ORDER BY Cuestion_id LIMIT $dosmenos,$qty";	
// Arreglo el inicio
	if($inicio<=0) $inicio=0;

	$sql="SELECT * FROM Cuestiones ORDER BY Cuestion_id LIMIT $inicio,$qty";	
	$query = mysql_query($sql) or die(mysql_error());

//Arrglo del comienzo
	if ($inicio>1){
		$title=to_title($primera);
//		$title='titulo';
		echo "<div class='marco'><a href='#' name='".$retro."' class='cuestion' title='cuestion ".$retro." no tiene correcta'>"."<<"."</a></div>";
		if ($bool) 	echo "<div class='marco nok'><a href='#' name='".$primera."' class='cuestion' title='conceptos : ".$title."'>".$primera."</a></div>";
		else echo "<div class='marco'><a href='#' name='".$primera."' class='cuestion' title='conceptos : ".$title."'>".$primera."</a></div>";
		echo '<div class="dots" >...</div>';
	}
	else echo "<div class='marco unable'><<</div>";

//	if ($ini>($qty-1)) echo '<div class="dots" >...</div>';	


	while($row=mysql_fetch_array($query)){
		$title= to_title($row[0]);
//		$title='titulo';
	//	echo $title;
		if(in_array($row[0],$no_correct))
			echo "<div class='marco nok'><a href='#' name='".$row[0]."' class='cuestion' title='cuestion ".$row[0]." no tiene correcta'>".$row[0]."</a></div>";
		else echo "<div class='marco'><a href='#' name='".$row[0]."' class='cuestion' title='conceptos : ".$title."'>".$row[0]."</a></div>";
		$last=$row[0];
	}
	$bool=0;
	if(in_array($total,$no_correct)) $bool=1;

	if($last<($total)){
		echo '<div class="dots"> ... </div>';
		if($bool) echo "<div class='marco nok'><a href='#' name='".$total."' class='cuestion' title='conceptos : ".$title." sin correcta'>".$total."</a></div>";
		else echo "<div class='marco'><a href='#' name='".$total."' class='cuestion' title='conceptos : ".$title."'>".$total."</a></div>";
				echo "<div class='marco'><a href='#' name='".$ava."' class='cuestion' title='cuestion ".$ava." '>".">>"."</a></div>";
	}else{
				echo '<div class="marco unable" name="mas5" title="fin">>></div>';
			}
//	return $last;
	echo "<div class='clear'></div>";

}
function to_title($idQ){
	$sql="SELECT Conceptos FROM Cuestiones WHERE Cuestion_id='$idQ'";
	$result=mysql_query($sql) or die(mysql_error());
	$conceptos_row=mysql_fetch_row($result);	
	return traduce_conceptos($conceptos_row[0]);
}
function get_conceptos($idQ){
//Devuelve los conceptos de una cuestion
	$sql="SELECT Conceptos FROM Cuestiones WHERE Cuestion_id='$idQ'";
	$result=mysql_query($sql) or die(mysql_error());
	$conceptos_row=mysql_fetch_row($result);	
	echo traduce_conceptos($conceptos_row[0]);
}

function traduce_conceptos($cadena){
//Devuelve los conceptos de una cuestion
	$conceptos_array=explode(",",$cadena);
	$pila=Array();
	foreach($conceptos_array as $valores){
		$sql="SELECT Nombre FROM Conceptos WHERE idConcepto='$valores'";
		$result=mysql_query($sql) or die(mysql_error());
		$nombre=mysql_fetch_row($result);	
		array_push($pila,$nombre[0]);
		$cad=join(",",$pila);
	}
	return $cad;
}
function contar_conceptos(){
	$sql="SELECT Conceptos FROM Cuestiones";// WHERE Cuestion_id=2";
	$result=mysql_query($sql) or die(mysql_error());
//	$got_them=Array();
	$got_them=contador_conceptos_init();
	while($row=mysql_fetch_row($result)){
		if(strlen($row[0])==0) continue;
		$them=explode(",",$row[0]);
		foreach($them as $value){
//			if(!isset($got_them[$value])) $got_them[$value]=0;
			$got_them[$value]=$got_them[$value]+1;
		}
	}	
	return $got_them;
}
function contador_conceptos_init(){
	$sql="SELECT idConcepto FROM Conceptos";// WHERE Cuestion_id=2";
	$result=mysql_query($sql) or die(mysql_error());
	while($row=mysql_fetch_row($result)){
		$got_them[$row[0]]=0;
	}	
	return $got_them;
}
function concepto_aparece_n_veces($idConcepto){
	$conceptos=contar_conceptos();
	echo $conceptos[$idConcepto];
}
function aparece_en($idConcepto){
	$sql="SELECT Conceptos,Cuestion_id FROM Cuestiones";// WHERE Cuestion_id=2";
	$result=mysql_query($sql) or die(mysql_error());	
	$ids=Array();
	while($row=mysql_fetch_row($result)){
		if(strlen($row[0])==0) continue;
		$them=explode(",",$row[0]);
		foreach($them as $value){
			if($value==$idConcepto) array_push($ids,$row[1]);
		}
	}
	return $ids;
}
function aparece_and($cadena){
	$sql="SELECT Conceptos FROM Cuestiones";// WHERE Cuestion_id=2";
	$result=mysql_query($sql) or die(mysql_error());	
	$ids=Array();
	$arr=explode(",",$cadena);
	if(!isset($arr[1])) return false;
	$val=array_pop($arr);
	$primero=aparece_en($val);
	while($val=array_pop($arr)){
		$sig=aparece_en($val);
		$sig=array_intersect($sig,$primero);
	}
	return $sig;
}



?>
