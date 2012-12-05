<?php
//SIEMPRE USAR CON

	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	require_once('includes/cuestiones.inc');	

	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		$con=conectar($db);
	}
	if( !isset($con) ) redirect_to('public/sin_conexion.php');
//Default
	$examen=1;


function cabecera(){
		$idA=$_SESSION['idAlumno'];
		$asg=ltrim($_SESSION['db_name'],"asg_");
		echo "<spam class='right2'><spam class='large'>".($_SESSION['user'])."</spam><br />DNI: <spam class='large'>".$_SESSION['DNI']."</spam></spam>";
		echo "Asignatura: <spam class='large'>".$asg."</spam>";
		echo "<br />";
		
}

function examen_mostrar($id){
//Duracion del examen 
	$sql="SELECT preguntas,duracion,numero FROM Fuentes WHERE idFuente=\"$id\"";
	$query=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_row($query);	
	$GLOBALS['duracion']=(int)$row[1];
//	$sql="SELECT preguntas,duracion,numero FROM Fuentes WHERE idFuente=\"$id\""; ////DEPURACION
//	$query=mysql_query($sql) or die(mysql_error());
//	$row=mysql_fetch_row($query);
//	echo $row[0]."<br />";
	$preguntas=$row[0];
//	$GLOBALS['duracion']=(int)$row[1];
	$n_preg=(int)$row[2];
//	$n_preg=7;
//	echo "id: ".$id." n_preg: ".$n_preg." preguntas: ".$preguntas."<br />";
	$quest=examen_show($preguntas,$n_preg,$id);
	return $quest;
}

function examen_show($preguntas,$n=5,$idFuente=null){

	//$n es el numero de preguntas que se quiere mostrar en la prueba
	if($n==0)$n=5;
	$i=0;
	$arr=explode(",",$preguntas);
	$num=count($arr);
//Barajo el array
	$arr_bak=$arr;
	shuffle($arr);
	while ($n < count($arr)){
		array_pop($arr);
	}	
	$quest=$arr;
	$quest_cad=join(",",$quest);
//Grabo la cookie en la BBDD
	if(get_cookie("examen"))
		$quest=explode(",",get_cookie("examen"));
	else{ 
//Esta es la que me da ERROR error
		
		set_cookie("examen", $quest_cad);
	//	echo 'kiki';
		examenes_push($quest_cad,$idFuente);
	}
	return $quest;
}

function cuerpo($quest){
	$marca=time();
	$i=0;
	cabecera();
	echo "Fecha: ".date('d-M-Y', $marca)."<br />";
	foreach($quest as $key => $value){
		$idQ=$value;
		$i++;
		echo "<div class='dina4_4'><hr /><b><div id='nonb' style='page-break-inside: avoid; height:auto; '><div id='$i' class='num' name='$i'>".$i."</div></b>";
		echo "<div class='img1'><img src='".GetImage($idQ)."' alt='' /></div>" ;
		echo "<br />";
		echo '<thead><div class="enunciado">'.GetEnunciado($idQ).'</div></thead>';
		echo "<div class='img2'><img src='".GetImage2($idQ)."' alt='' /></div>" ;
		echo "<form>";
		echo GetAnswers($idQ);
		echo "<div class='respondida' name='$idQ'></div>";
		echo "</form></div></div>";
		echo '<div class="clear"></div>';
		if($i%2==0){
			echo '<div style="page-break-after: always;"><span style="display: none;">&nbsp;</span></div>';
			echo '<div class="nodisplay">';
			echo cabecera().'</div>';
		}
	}
//	$idA=$_SESSION['idAlumno'];
	$idAs=$_SESSION['idAs'];
	chg_status($idAs,'Realizandose');
}
	
function ex_questions($preguntas){


}	
	
	
function correccion(){
	if(isset($_COOKIE['answers']))
	$cookie_respuesta=get_cookie("answers");
	else return false;//$cookie_respuesta="";
	$respuestas=explode(",",$cookie_respuesta);
	$porcentaje=0;
	$i=0;
	foreach ($respuestas as $key => $value)
	{
		$i++;
		if (str_begin($value, "sr")) continue;
		if (str_begin($value, "nr")) continue;
		$sql="SELECT Porcentaje FROM Respuestas WHERE Resp_id=$value LIMIT 1";
		$query=mysql_query($sql) or die(mysql_error());
		$row=mysql_fetch_row($query);
		$porcentaje +=(int)$row[0];
	}
	echo $i." preguntas ".$porcentaje." = ".$porcentaje/($i*10);
}
//Antes en prueba.php
function get_examen(){
	$idA=$_SESSION['idAlumno'];
	$idAs=$_SESSION['idAs'];
	$seg=1;
	$min=60*$seg;
	$hour=60*$min;
	$begin=time();
	$ahora=time();
	$fin=$begin+60*$min;

	chg_status($idAs,'getting');
	$id=examenes_pop($idA);
//echo 'get-'.$id;	
	if ($id!=false){ //Si no hay $id
		$sql="SELECT identificado FROM Fuentes WHERE idFuente=\"$id\"";
		$query=mysql_query($sql) or die(mysql_error());
		$row=mysql_fetch_row($query);	
		$examen=strtotime($row[0]);
	}
	return $id;
}	
function check_me(){
	if(get_cookie("idA")){
		$yo=get_cookie("idA");
		if($yo!=$_SESSION['idAlumno']){
			$idAs=$_SESSION['idAs'];
//			$sql="DELETE FROM `asg_admin`.`Alumnos` WHERE `Alumnos`.`Alumno_id` = $idAs";
//			$query=mysql_query($sql) or die(mysql_error());
			del_cookie("idA");
			del_cookie("examen");
			del_cookie("comienzo");				
			del_cookie("answers");
		 $_SESSION['msg']="Cambio de usuario. Realizado";
			redirect_to("index.php");
		}
	}else set_cookie("idA",$_SESSION['idAlumno']);	

}	
function examen_pre(){
//	echo 'jooo';
	$examen=get_cookie('examen');
//	var_dump($examen);
	$arr=array();
	if(!empty($examen)){
		$arr=explode(",",$examen);
		$n=count($arr);
		array_push($arr,$n);
		$examen=implode(",",$arr);
		return $examen;
	}else return null;
}
function rutina_examinar(){
	$idA=$_SESSION['idAlumno'];
	$idAs=$_SESSION['idAs'];
//Compruebo si hay examen previo
	$examen=examen_pre();

	if(empty($examen)){
		$id=get_examen();
		if($id==false){ 
//			$fecha_mysql = date('Y-m-d H:i:s');
			set_num_exam($idAs,0);
			chg_status($idAs,'sin_examen');
//			chg_nota($idA,0,$fecha_mysql);
			redirect_to('public/sin_examenes.html');
		}else $quest=examen_mostrar($id); //Mostrar el examen desde la fuente
	}else{ //Hay examen previo 
		$arr_ex=explode(",",$examen);
		$n=array_pop($arr_ex);
		$preguntas=implode(",",$arr_ex);
//	echo "mostrar $n preguntas de $preguntas"."<br />";
		$quest=examen_show($preguntas,$n);	
//		$GLOBALS['duracion']=duracion_get(15);		
	}
	chg_status($idAs,'respondiendo');
//El examen ha comenzado

if(!isset($_SESSION['duracion']))
	$_SESSION['duracion']=0;
	return $quest;
}
//Antes en prueba.php
//examen_mostrar($examen);
/*
	$arr=explode(",",$row[0]);
	$valores=explode(",",$val);
	if(empty($row)) die();
	foreach($valores as $key => $value){
		if(!in_array($idQ,$GLOBALS['back']) && in_array($value,$arr)){
			array_push($GLOBALS['back'],$idQ); 
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
		array_push($back,$row[0]);
	}
}
	
	if($rnd=="true") shuffle($back);
//	echo $rnd."++ ";

	/*
	foreach ($back as $key => $value)
	{
		echo $value." ";
	}
	*/
/*	
	echo "Preguntas"."<br />";
	echo join(",",$back)."<hr />";

$preguntas=join(",",$back);
if(examen_grabar($preguntas))echo "Grabado"."<br />";;
*/
?>
