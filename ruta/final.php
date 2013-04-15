<?php
	session_start();		
//Librerias
	require_once('includes/cuestiones.inc');	
	require_once('includes/basics.php');
//Obtenecion de datos del alumno
// Nombre de la asignatura
// ID del Alumno
// ID del Examen
//Devuelve un ARRAY
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
		$asignatura=asg_name($row[8]);
		$calificacion=$row[5];

	echo "<div id='cabeza'>";
	echo "<div class='bloque'>";	
	echo "<img height='34%' src='UAH.jpg' />";	
	echo '<div class="clear"></div>';

	echo $universidad.'<hr />';
	echo $centro.'<br />';
	echo $titulacion.'<br />';
	echo $dpto.'<br />';
	echo "</div><div class='datos'>";
	echo "<b>Apellidos:</b> $apellidos<br />";
	echo "<b>Nombre:</b> $nombre<br />";
	echo "<b>DNI:</b> $dni<br />";
	echo "<b>Especialidad:</b> $especialidad<br />";
	echo "<b>Fecha:</b> $fecha<br />";
	echo "<b>Asignatura:</b> $asignatura<br />";
	echo "<b>Calificacion: </b> <span class='big'>$calificacion</span></div>";	
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
	if($opciones!=null){
		foreach($opciones as $key=>$value){
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
			echo '<div class="borde">'.$a."</div><br />";	
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
			echo '<br />';
			echo '</div></td>';
			unset($enun);
						
		}
		echo '</tr>';
		echo '<hr /><br />';
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

	$datos=get_db();
	$idEx=$datos[2];
	$db=$datos[0];
	//	$db='asg_mike77_bak_bak';
	$con=conectar($db);
	if($con==null) 
		redirect_to('public/sin_conexion.html');


function your_examen($idEx=null){
	if ($idEx!=null){
		$sql="SELECT fk_Alumno_id,start,status,orden,preguntas,respuestas FROM Examenes WHERE idExamen=$idEx ";
		$query=mysql_query($sql) or die(mysql_error());	
		$row=mysql_fetch_assoc($query);
		return $row;
//		while($row=mysql_fetch_row($query)){
//			echo "<a href='#' id='$row[0]'>".$row[1]."</a><hr />";
//		}	
	}
}

?>

<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title></title>
	<script src="jquery/jquery-1.4.2.js"></script>
<style>
.nobreak {
    page-break-inside: avoid;
}
	#cabeza{
		margin-left:3em;
		margin-right:3em;
		font-family:"Arial";
	}
	.bloque{
		float:left;
		height:160px;
		font-size: x-small;
		padding:0.5em;

	}
	.datos{
		margin-left:2em;
		float:left;
		height:100px;
		font-size: medium;
		padding:0.5em;
		width:240px;		
	}
	.borde{
		border: solid 1px #999;
		padding:0.2em;
		marging:0.2em 0 0.2em 0;
		color:#666;
	}

	.big{
		font-size: medium;
	}
	.small{
		font-size: xx-small;
	}
	.clear{
		clear: both;
	}

</style> 

</head>
<script type="text/javascript" SRC="mathjax/MathJax.js">
	
	MathJax.Hub.Config({
		extensions: ["tex2jax.js"],
  	styleSheets: ["math.css"],
  	 jax: ["input/TeX","output/HTML-CSS"],
  	displayAlign: "left",
  	 delayStartupUntil: "onload",
  	 messageStyle: "none",
    tex2jax: {
    	inlineMath: [["$","$"],["$$(","$$)"]],
    	displayMath: [['$$','$$'],['\\[','\\]'] ]
    }
  });
	</script>
<body>
<div class="rojo"></div>
<?php 

	$examen=your_examen($idEx);

//	ex_head($examen['fk_Alumno_id'],$examen['start'],$examen['idExamen']);
	ex_head($examen['fk_Alumno_id'],$examen['start'],$idEx);
	echo "<div class='clear'></div><hr />";
	if($examen['orden']!=null){
		ex_body($examen['preguntas'],$examen['orden'],$examen['respuestas']);
	}else echo 'No ha seleccionado NINGUNA respuesta <br />';
//	echo "<hr />";
//	echo "ARRAY_____"."<br />";
	//show_arr($examen); 
/*$bi=array();
$bi[0][0]=1;
echo $bi[0][0];
*/
//last_examens(7);
//	$mysqldate = date( 'd/m/Y', $phpdate );
//	echo $mysqldate."<br />";	
//	echo date("Y",$phpdate)."<br />";
//	echo "lllo".$examen['fk_Alumno_id'];
	echo 'Las respuestas resaltadas en negrita, son las repuestas correctas. Las respuestas subrayadas son las respuestas elegidas. Si una respuesta esta unicamente en negrita, es que ha sido respondida de manera correcta.<hr />';
	echo 'Impreso el '.date('G:i - d.m.Y').'<br />';
//	file_put_contents('test_pdf.pdf', ob_get_clean()); 
	 

//		conectar('asg_admin');
 

?>	

<!-- <iframe src='test_pdf.pdf'></iframe> -->
<!--<embed src='test_pdf.pdf' width='800' height='375'></embed> -->
</body>
	<script src="js/final.js"></script>

</html>
