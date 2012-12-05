<?php

function conectar($database=NULL){
	if ($database != NULL) {
		$conn=mysql_connect(DB_SERVER,DB_USER,DB_PASS);
		mysql_query("SET NAMES utf8");
		$db_selected=mysql_select_db($database);
		if (!$db_selected) {
			die ('ERROR! '.$database.' : ' . mysql_error());
		}
		return $conn;  
  }
}
function get_db(){
	$link=conectar('asg_admin');
	$sql="SELECT asignatura FROM Alumnos WHERE status='Impreso' LIMIT 1";
	$query=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_row($query);
	if($row){
		mysql_close($link);
		return $row[0];
	}else{
			mysql_close($link);
			return false;
		} 
}
function asg_name($db=null){
	if($db!=null){
		$asig=str_replace("asg_","",$db);
		$asig=str_replace("_"," ",$asig);
		$asig=utf8_decode($asig);		
		return $asig;
	}
}
function redirect_to( $location = NULL ) {
  if ($location != NULL) {
    header("Location: {$location}");
    exit;
  }
}

function cabeza(){
	echo '<div class="ctrl">
		<p class="tog">Ocultar</p>
		<p style="display: none" class="tog">Mostrar</p>
	</div>
	<div class="ctrlado">
	<input type="checkbox" name="opcional" value="fecha" disabled="disabled"/>Fecha
	<input type="checkbox" name="opcional" value="total"/>Total de cuestiones
	<input type="checkbox" name="opcional" value="correctas"/>Correctas
	<input type="checkbox" name="opcional" value="falladas"/>Falladas 
	<input type="checkbox" name="opcional" value="sin_responder"/>Sin responder
	<input type="checkbox" name="opcional" value="tiempo"/>Tiempo
	<input type="checkbox" name="opcional" value="nota"/>Nota<br />
	</div>
	<hr /><div id="checkss"></div>';
}	
function en_texto($nota){
	if($nota==-10) return 'No presentado';	
	if($nota<=4.9) return 'suspenso';
	if($nota>=5 and $nota<6.9 ) return 'Aprobado';
	if($nota>=7 and $nota<9 ) return 'notable';
	if($nota>=9) return 'sobresaliente';
}
function listame($fecha){
	$db=$GLOBALS['db'];
	$sql="SELECT * FROM asg_admin.Alumnos WHERE DATE(Fecha)='$fecha'";
	$query=mysql_query($sql) or die(mysql_error());
		echo '<spam class="campo">'.'Apellidos, Nombre'.'</spam>';
		echo '<spam class="campo wd5">'.'Nota'.'</spam>';
		echo '<spam class="campo w10">'.'Calificación'.'</spam>';		
		echo '<div class="clear"><hr /></div>';
	echo '<table>';
	while($row=mysql_fetch_assoc($query)){
		echo '<tr><td><spam class="campo">'.$row['Apellidos'].','. $row['Nombre'].'</spam> ';
		echo '<spam class="campo wd5">'.$row['Nota'].'</spam> ';
		echo '<spam class="campo wd10">'.en_texto($row['Nota']).'</spam></td></tr>';
	}
	echo '</table><br />';
}
//asg_mike77_bak_bak
function get_fechas($asig){
		$fechas=array();
		$mysql_fechas=array();
		$sql="SELECT Fecha FROM asg_admin.Alumnos WHERE asignatura='$asig'";
		echo '<br />';
		$query=mysql_query($sql) or die(mysql_error());
		while($row=mysql_fetch_row($query)){
			$phpdate = strtotime($row[0]);
			$fecha=date('d-m-Y',$phpdate);
			if(!in_array($fecha,$fechas))array_push($fechas,$fecha);
		}	
	return $fechas;
}
function get_asignaturas(){
//		$db=$GLOBALS['db'];
		$asignaturas=array();
		$sql="SELECT asignatura FROM asg_admin.Alumnos";
		$query=mysql_query($sql) or die(mysql_error());
		while($row=mysql_fetch_row($query)){
			if(!in_array($row[0],$asignaturas))array_push($asignaturas,$row[0]);
//			echo $fecha.'<br />';
		}	
	return $asignaturas;
}
function presentacion_expediente($idA){
	static $counter=1;
	$sql1="SELECT Nombre,Apellidos,DNI FROM Alumnos WHERE Alumno_id=$idA";
	$query1=mysql_query($sql1) or die (mysql_error());
	$row=mysql_fetch_row($query1);
	$exp=expediente_info($idA);
//Preparo los arrays
	$pruebas=explode(",",$exp[2]);
	$notas=explode(",",$exp[3]);
	$fechas=explode(",",$exp[4]);
	$n = 1;
	$media = 0;
	$testme=nota_media($notas);
	$rollo="roll".$idA;

//	echo '<span class="clear"></span><hr />';
	echo "<span class='black' name='$rollo' title='toggle'>+</span>";
		echo '<span class="report_head" name="'.$idA.'"><b>'.$row[1].','.$row[0].' DNI: '.$row[2].'</b>';
		echo '<span class="underl small"> grafica </span>';
		echo '<span class="dash dcha" >'.'Nota media:'.$testme.'</span><br /></span><br />';
	echo "<div class='$rollo'>";

	
	foreach($pruebas as $key=>$exa){
//		if($exa=='---')continue;
		if($exa==NULL) continue;
		$n=$key;
		$info="No presentado";
		if($exa!='---' && $exa!='0'){
			$stats=stats_preguntas($exa);
			$dur=stats_tiempo($exa);
			$info="Correctas: $stats[1] Falladas: $stats[2] Sin responder: $stats[3] Tiempo $dur";
		}else{
			$info="No presentado";
			$stats=array('0','0','0','0');
			$dur=0;
		}

		if(isset($notas[$n]))
			if($notas[$n]=='np') $not='np';
			else $not=(float)$notas[$n];	
		$media +=floatval($not);
	
			
		echo '<div class="line" title='.$info.' name="'.$n.'">';
			echo '<span class="fld fecha" name="'.$n.'">'.$fechas[$n].'</span>';
//			if(isset($stats)){
			echo '<span class="fld total">'.$stats[0].'</span>';
			echo '<span class="fld correctas">'.$stats[1].'</span>';
			echo '<span class="fld falladas">'.$stats[2].'</span>';
			echo '<span class="fld sin_responder">'.$stats[3].'</span>';
			echo '<span class="fld tiempo">'.$dur.'</span>';
			echo '<span class="fld nota dcha"'.' name="'.$n.'">'.$not.'</span>';
//				echo '</div>';
		echo '</div><br />'; //Fin de line
//		echo '<span class="clear"></span>';
	}
	$counter++;
	if($n!=0)$media=$media/($n+1);
	$factor = pow(10, 2);
	$resultado=(round($media*$factor)/$factor);	

	echo '<div class="clear"></div>';
	echo '</div>'; //Fin de roll

//	echo 'media='.$resultado;

//	echo '<hr />';


//	echo '</div>';

}

function expediente_info($idA=null){
	$sql="SELECT * FROM Expedientes WHERE idAlumno=$idA";
	$query=mysql_query($sql) or die (mysql_error());
	$row=mysql_fetch_row($query);
	return $row;
}

function nota_media($notas){
	$count=0;
	$media=0;
	foreach($notas as $nota){
		if($nota=='np') $not=0;
		else $not=(float)$nota;	
		$media +=floatval($not);
		$count +=1;
	}
	return round($media/$count,2);
}
function formulario($valores,$boton){
	echo "Elija ";
	//echo "<form action='asignatura_cambiar.php' method='post'>";
	echo "<form action='#'>";
	echo "<SELECT NAME='$boton' SIZE='1'>";
	foreach($valores as $key=>$value){
//		echo $value;
		echo "<OPTION VALUE='$value' name='db_nueva'>". $value."</OPTION>";
	}
	echo "</SELECT> ";
	echo "<input type=\"button\" name=\"cambia\" value=\"Selecciona\">";
	echo "</form>";
}
function expediente(){
	$sql="SELECT idAlumno FROM Expedientes ";
	$query=mysql_query($sql) or die (mysql_error());
			echo '<div class="expedientes">';
	while($row=mysql_fetch_row($query)){
		
		presentacion_expediente($row[0]);

	}

}
function stats_tiempo($idEx){
	$sql="SELECT start,expire FROM Examenes WHERE idExamen=$idEx";
	$query=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_row($query);
	$inicio=strtotime($row[0]);
	$fin=strtotime($row[1]);
	return date('H:i:s',$fin-$inicio-3600);
}
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
		$sql="SELECT Correcta FROM Respuestas WHERE Resp_id='$resp'";
		$query=mysql_query($sql) or die(mysql_error());
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
//	$array=array(5,3,2,1,8);
	return $array;
}

function to_utf8($utf8=null){
	if($utf8!=null){
		$cadena=utf8_decode($utf8);		
		return $cadena;
	}
}
function from_utf8($cadena=null){
	if($cadena!=null){
		$utf8=utf8_encode($cadena);		
		return $utf8;
	}
}
function remove_null($array=null,$reemplazo=null){
	if($array!==null){
		foreach($array as $key=>$value){
			if($value==null){
				if($reemplazo==null) unset($array[$key]);
				else $array[$key]=$reemplazo;
			}
		}
	}
	ksort($array);
	$array=array_merge($array);
	return $array;
}
?>
