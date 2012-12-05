<?php
function get_db(){
	$link=conectar('asg_admin');
	$sql="SELECT asignatura,Alumno_id,num_exam FROM Alumnos WHERE status='Corregido' LIMIT 1";
	$query=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_row($query);
	if($row){
		$id=$row[1];
		$_SESSION['idAs']=$id;
		chg_status($id,'Impreso');
		mysql_close($link);
		return $row;
	}else{
			mysql_close($link);
			return false;
		} 
}

function your_examen($idEx=null){
	if ($idEx!=null){
		$sql="SELECT * FROM Examenes WHERE idExamen=$idEx ";
//		$sql="SELECT * FROM Examenes WHERE idExamen=8 ";
		$query=mysql_query($sql) or die(mysql_error());	
		$row=mysql_fetch_assoc ($query);
		return $row;
	}
}
//Devuelve el contenido de un archivo
function leer($archivo){
		$handle = fopen($archivo, "r");
		$lectura = fread($handle, filesize($archivo));
		fclose($handle);	
		return $lectura;
}

//Cabecera del examen	
function ex_head($fk_Alumno_id=null,$date,$idEx){
	if($fk_Alumno_id!=null){
/*		$sql="SELECT * FROM asg_admin.Alumnos WHERE num_exam=$idEx LIMIT 1";
		$query=mysql_query($sql) or die(mysql_error());
		$row=mysql_fetch_row($query);

		echo "Fecha: ".MySQL_to_PHP($date)."<br /><u>Datos</u>: ".$row[3].", ".$row[2]." <u>DNI</u>:".$row[4].'<br />Calificacion:'.$row[5]."<hr />";
	*/
	$universidad="UNIVERSIDAD DE ALCALÁ";
	$centro="Escuela Politécnica Superior";
	$titulacion="Ingeniería técnica de Telecomunicación";
	$dpto="Departamento de Teoría de la Señal y Comunicaciones";
	$especialidad="Especialidad";

	$sql="SELECT * FROM asg_admin.Alumnos WHERE num_exam=$idEx LIMIT 1";
	$query=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_row($query);
	
	$apellidos=$row[3];
	$nombre=$row[2];
	$dni=$row[4];
	$fecha=MySQL_to_PHP($date);
	$asignatura=asg_name($row[8]).' bla bla bla blaaaa';
	$calificacion=$row[5];

	echo "<div id=\"cabeza\">";
//Logo	
	echo "<div class=\"bloque\">";	
	echo "<img height='90%' src='UAH.jpg' />";	
	echo "</div>";
	echo "<div class=\"bloque\">";
//Universidad
	echo "<div class='bloque small'>";
	echo $universidad.'<hr />';
	echo $centro.'<br />';
	echo $titulacion.'<br />';
	echo $dpto.'<br />';
	echo "</div>";
//Datos	
	echo "<div class=\"datos\">";	
	echo "<b>Apellidos:</b> $apellidos<hr />";
	echo "<b>Nombre:</b> $nombre<hr />";
	echo "<b>DNI:</b> $dni<hr />";
	echo "<b>Especialidad:</b> $especialidad<hr />";
	echo "<b>Fecha:</b> $fecha<hr />";
	echo "<b>Asignatura:</b>"; 
	echo $asignatura."<hr />";
	echo '<div class="clear"></div>';
	echo "<span class='big'><b>Calificacion: </b> $calificacion</span></div>";		
	echo "</div>";
	}
}
//Desarrollo del examen
//Enunciados
function get_enunciado($pregunta=null){
	if($pregunta!=null){	
		$sql="SELECT Enunciado,Imagen,Imagen_aux FROM Cuestiones WHERE Cuestion_id=$pregunta LIMIT 1";
		$query=mysql_query($sql) or die(mysql_error());
		$row=mysql_fetch_row($query);
		return $row;
	}
}

//Respuestas
function get_respuestas($respuesta=null){
	if($respuesta!=null){
		$sql="SELECT Respuesta,Correcta FROM Respuestas WHERE Resp_id=$respuesta LIMIT 1";
		$query=mysql_query($sql) or die(mysql_error());
		$row=mysql_fetch_row($query);
		return $row;
	}
}
////?????? NO RECUERDO PENDIENTEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE
function parse_opciones($opciones=null){
//		show_arr($opciones);
	if($opciones!=null){
//		echo 'PARSE OPCIONES<br />';
		foreach($opciones as $key=>$value){
//Quito los SR
			if(str_begin($value,"sr")){
				unset($opciones[$key]);
			}
		}
//Agrupo las Respuestas
		$a=0;
		foreach($opciones as $key=>$value){					
			if(str_begin($value,"nr")){
				$a++;
			}
			$array[$a][]=$value;
		}
	return $array;
	}
}
//Cuerpo del examen
function ex_body($preguntas=null,$orden=null,$respuestas=null){
	if($orden!=null){
		$opts=explode(",",$orden);
		$opciones=parse_opciones($opts);
		$elegidas=explode(",",$respuestas);
	}
	if($preguntas!=null){
		$pregs=explode(",",$preguntas);
		$a=0;
		echo '<tr>';
		foreach($pregs as $key=>$value){
			$enun=get_enunciado($pregs[$key]);
			$a++;
			//echo $pregs[$key]."<br />";
		echo '<td><div class="nobreak">';
			echo $a."<br />";	
			echo $enun[0]."<br />";
			if(strlen($enun[1])>0) echo "<img src=\"$enun[1]\" alt=\"$enun[1]\" /><br />";
			if(strlen($enun[2])>0) echo "<img src=\"$enun[2]\" alt=\"$enun[2]\" /><br />";
			echo '<ol type="a">';
			foreach($opciones[$a] as $key=>$value){
				if(str_begin($value,'nr')){ 
				  echo 'Sin responder';
				}else {
					$resp=get_respuestas($value);
					if(in_array($value,$elegidas)){
						if($resp[1]) echo "<u><li></u><spam id=\"$value\" title=\"$resp[1]\"><b>$resp[0]</b></spam></li>";
						else echo "<li><spam id=\"$value\" title=\"$resp[1]\"><b>$resp[0]</b></spam></li>";
					}else{
						if($resp[1]) echo "<li><spam id=\"$value\" title=\"$resp[1]\"><u>$resp[0]</u></spam></li>";
						else echo "<li><spam id=\"$value\" title=\"$resp[1]\">$resp[0]</spam></li>";
					}
				}
			//	show_arr($opciones[$key]);
			}
			echo '</ol>';
			echo '<hr />';
			echo '</div></td>';
			unset($enun);
						
		}
		echo '</tr>';
	}
}
//Ultimo examen hecho por el alumno
function last_examens($idA=null){
	if ($idA!=null){
		$sql="SELECT idExamen,start,status FROM Examenes WHERE fk_Alumno_id=$idA ";
		$query=mysql_query($sql) or die(mysql_error());	
		while($row=mysql_fetch_row($query)){
			$res=$row;
		}	
		echo "<a href='' id='$res[0]'>".$res[1]."</a><hr />";
	}
}


function your_examens($idA=null){
	if ($idA!=null){
		$sql="SELECT idExamen,start,status FROM Examenes WHERE fk_Alumno_id=$idA ";
		$query=mysql_query($sql) or die(mysql_error());	
		while($row=mysql_fetch_row($query)){
			echo "<a href='#' id='$row[0]'>".$row[1]."</a><hr />";
		}	
	}
}

?>
