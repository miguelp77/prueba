<?php
//$path = './includes';
//set_include_path(get_include_path() . PATH_SEPARATOR . $path);
//	include('basics.php');
//	print_r(get_included_files());
//echo '<br />';
//echo DB_NAME;

require_once('includes/db_config.php');


//require_once('includes/fixing_exp.inc');
//funciones basicas
function connect_to_db(){
	$conn=mysql_connect(DB_SERVER,DB_USER,DB_PASS);
//	echo "Conectado <br />";
	return $conn;  
}
function conectar($database=NULL){
	if ($database != NULL) {
		$conn=mysql_connect(DB_SERVER,DB_USER,DB_PASS);
//		$database=utf8_encode($database);
//		echo $database;

		mysql_query("SET NAMES utf8");
		$db_selected=mysql_select_db($database);
//		mysql_query("SET NAMES utf8");
		if (!$db_selected) {
			die ('ERROR! '.$database.' : ' . mysql_error());
		}
		$database=parse_utf8($database);
		$_SESSION['db_name']=$database;
		if(isset($_SESSION['old_db']) AND $_SESSION['db_name']==='asg_admin'){
			$_SESSION['db_name']=$_SESSION['old_db'];
			unset($_SESSION['old_db']);
		}
		return $conn;  
  }
}
function asg_name($db=null){
/* Devuelve el nombre de la asignatura, sin arreglo*/
	if($db!=null){
		$db=parse_utf8($db);
		$asig=str_replace("asg_","",$db);
		$asig=str_replace("_"," ",$asig);
//		$asig=utf8_encode($asig);		
		return $asig;
	}
}
function parse_utf8($cadena){
	$b=mb_detect_encoding($cadena, 'UTF-8', true); // Check si es UTF8
	if(!$b) $cadena=utf8_encode($cadena);
	return $cadena;
}
function check_UTF8($cadena){
	return mb_detect_encoding($cadena, 'UTF-8', true);
}

function generatePassword($length=9, $strength=2) {
	$vowels = 'aeiou';
	$consonants = 'bdghjmnpqrstvz';
	if ($strength & 1) {
		$consonants .= 'BDGHJLMNPQRSTVWXZ';
	}
	if ($strength & 2) {
		$vowels .= "AEUY";
	}
	if ($strength & 4) {
		$consonants .= '23456789';
	}
	if ($strength & 8) {
		$consonants .= '-';
	}
	$password = '';
	$alt = time() % 2;
	for ($i = 0; $i < $length; $i++) {
		if ($alt == 1) {
			$password .= $consonants[(rand() % strlen($consonants))];
			$alt = 0;
		} else {
			$password .= $vowels[(rand() % strlen($vowels))];
			$alt = 1;
		}
	}
//	$password=filtro_letras($password);
	return $password;
}
function generateUser($length=6, $user='aeiou') {
	$user=str_replace(' ','',$user);
	$user .= 'AEIOUXYZ';
	$numeros = '123456789';
//	mb_detect_encoding($user, "UTF-8") == "UTF-8" ? : $user=elimina_acentos("$user");	
	$rnd = time() % 9;
//	echo $rnd;
	$user=str_replace('?',$rnd,(elimina_acentos("$user")));
//	echo $user;
	$reto = "";
	$rnd = time() % 2;

	for ($i = 0; $i < $length; $i++) {
		$rnd=(rand() % strlen($user))%($length-2);
		if ($i > ($length-3)) {
			$reto .= $numeros[$rnd];
		}else{
			$l= "$user[$rnd]";
			$reto .= "$l";
		}
	}
	return $reto;
}

function filtro_letras($cadena){
		return preg_replace("/[^a-zA-ZñÑ]/", "", $cadena);	
}
function solo_archivo($cadena=null){
		if($cadena!=null){
			$sp=explode('/',$cadena);
			return array_pop($sp);
		}
	return false;
}

	$acutes=array("&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&ntilde;","&NTILDE;");
	$to_human = array ("á", "é", "í", "ó", "ú", "ñ", "ñ");

function to_human($cadena){
/*	
	$cadena=strtolower($cadena);
	$cadena=str_replace($GLOBALS["acutes"],$GLOBALS["to_human"],$cadena);
*/
	
	return $cadena;

}

function redirect_to( $location = NULL ) {
  if ($location != NULL) {
    header("Location: {$location}");
    exit;
  }
}

function del_cookie($cookie=NULL){
  if ($cookie != NULL) {
		setcookie($cookie,"", time()-3600);
	}
}
function get_cookie($cookie=NULL){
	  if ($cookie != NULL) {
	  	if(isset($_COOKIE[$cookie]))
				return $_COOKIE[$cookie];
		}
		return false;
}
function set_cookie($cookie=NULL, $valor=NULL){
	  if ($cookie != NULL) {
			setcookie($cookie, $valor, time()+3600);
		}
}

function show_cookies($cookie=NULL){
	  if ($cookie != NULL) {
			echo "<br />";
			foreach($_COOKIE as $key=>$value ){
				if($key!='PHPSESSID')
					echo $key." => ".$value."<br />";
			}
		}
}
function show_arr($array=null){
		if(is_array($array)){
		foreach($array as $key=>$value ){
			echo $key." => ".$value."<br />";
		}	
	}else echo 'Sin array!';
}
function show_sessions(){

	echo "SESSIONS<hr />";
	foreach($_SESSION as $key=>$value ){
		echo $key." => ".$value."<br />";
	}
}
function str_begin($string, $search){
    return (strncmp($string, $search, strlen($search)) == 0);
}

function MySQL_to_PHP($date){
	$phpdate = strtotime( $date );
	$mysqldate = date( 'd/m/Y - G:i' , $phpdate );
	return $mysqldate;	
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
function elimina_acentos($cadena){
	$tofind = " ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ";
	$replac = "1AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn";
	return utf8_encode((strtr(utf8_decode($cadena),utf8_decode($tofind),$replac)));
}
function getIp() {
	$ip = $_SERVER['REMOTE_ADDR'];
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }
  return $ip;
}
function depura(){	
	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
	echo '<hr />';
	echo "Depuracion:: COOKIES";
	echo '<hr />';
	show_cookies(1);
	echo '<hr />';
	echo "Depuracion:: SESSIONS";	
	echo '<hr />';
	show_sessions(1);
	echo '<hr />';
}
function incrustar_pdf($archivo){
	$opt="#toolbar=0&navpanes=0&scrollbar=0";
	$file='pdfs/'.$archivo.$opt;
	echo '<embed src="'. $file.'" width="650" height="550" href="'.$file.'"></embed>';
}

//Usadas en pdfprinter
function montar_pdfprinter($db=null,$opciones=null,$valores=null){
	$status='ready';
	$marca=marca();
	$rmks='0';
	if($db!=null){	
		$link=conectar('asg_admin');
		if($opciones=='notas'){
			$deco=json_decode($valores);
			$rmks=$deco[1];
			$valores=$deco[0];
		}
		$sql="INSERT INTO pdfprinter (status,BBDD,opciones,valores,marca,rmks) ";
		$sql .="VALUES ('$status','$db','$opciones','$valores','$marca','$rmks')";
		$query=mysql_query($sql) or die(mysql_error());
		return mysql_close($link);
	}else return false;
}

function get_pdfprinter(){
	$status='processing';
	$estado='ready';
	$marca=marca();
	$link=conectar('asg_admin');
		$sql="SELECT BBDD,idPDF,opciones,valores FROM pdfprinter WHERE status='$estado' LIMIT 1";
		$query=mysql_query($sql) or die(mysql_error());
		$row=mysql_fetch_row($query);	
		$sql="UPDATE asg_admin.pdfprinter SET status='$status',marca='$marca' WHERE idPDF= '$row[1]' LIMIT 1";
		$query=mysql_query($sql) or die(mysql_error());
	mysql_close($link);
	return $row;	
}

function close_pdfprinter($idPDF=null){
if($idPDF==null) return false;
	$link=conectar('asg_admin');
	$status='done!';
	$marca=marca();
	$sql="UPDATE asg_admin.pdfprinter SET status='$status',marca='$marca' WHERE idPDF= '$idPDF' LIMIT 1";
	$query=mysql_query($sql) or die(mysql_error());
	mysql_close($link);
}

function marca(){
	$mysqldate = date( 'Y-m-d - G:i:s' , time() );
	return $mysqldate;	
}

function listado_alumnos($db=null){
	if($db!=null){
		$link=conectar($db);	
		$sql="SELECT * FROM Alumnos ORDER BY Apellidos ASC";
		$query=mysql_query($sql);
			echo '<span class="c15">Apellidos,Nombre</span>';
			echo '<span class="campo">DNI</span>';
			echo '<span class="campo">Alias</span>';
			echo '<span class="campo">Contraseña</span>';		
			echo '<br /><hr />';
		$i=0;
		while($result=mysql_fetch_assoc($query)){
			$i++;
			if($i%2){
				echo "<div class=\"clear colorme\">";
			}
			else{
				echo "<div class=\"clear colorme odd\">";
			}			
			echo '<span class="c15">'.$result['Apellidos'].', '.$result['Nombre'].'</span>';
			echo '<span class="campo">'.$result['DNI'].'</span>';
			echo '<span class="campo">'.$result['Alias'].'</span>';
			echo '<span class="campo">'.$result['Psw'].'</span>';
			echo '</div>';
			
		}
	mysql_close($link);	
	}else return false;
}
function listado_notas($db=null,$fecha=null){
	$p_num=0; //numero de alumnos presentados	
	if($db!=null){
		$link=conectar($db);
		echo '<b><br />Alumnos presentados.<br /></b>';	
		echo '<hr />';		
		echo '<span class="c15">Apellidos,Nombre</span>';
		echo '<span class="c15">DNI</span>';
		echo '<span class="campo"></span>';
		echo '<span class="c15">Nota</span>';		
		echo '<br /><hr />';
		$i=0;
		$presentados_ids=Array();
	//	$np_ids=Array();
	//	$np_total=Array();
		if($fecha!=null){
			$al=walk_idA_alumnos();//de Alumnos
			foreach($al as $k=>$v){
				$datos=give_their_data($v);
				$al_fcha=get_fechas($v);
				$al_ntas=get_notas($v);
				if($al_fcha!=null) //Linea de depuracion
				foreach($al_fcha as $kf=>$fcha){
					if($fcha==$fecha){
						$nota[]=$al_ntas[$kf];
//					echo 'alumno '.$datos[0].' nota '.$al_ntas[$kf].'<br />';
						$i++;
//						$presentados_ids[]=$datos[2];
//						$presentados_ids[]=$v;
						if($i%2) echo "<div class=\"clear colorme\">";
						else echo "<div class=\"clear colorme odd\">";
						echo '<span class="c15">'.$datos[0].','.$datos[1].'</span>';
						echo '<span class="c15">'.$datos[2].'</span>';
						echo '<span class="campo"> </span>';
						echo '<span class="c15">'.$al_ntas[$kf].'</span>';
						echo '</div>';
						if(!in_array($v,$presentados_ids))$presentados_ids[]=$v;
						$p_num++;
					}
				}
			}
			$np_num=0;
		if(isset($nota)){	
			foreach($nota as $valor){
				if($valor=='np') $np_num++;
			}
		}
			$np_ids=array_diff($al,$presentados_ids);
//			echo '<b><br />Alumnos sin presentar<br /></b>';
			foreach($np_ids as $k=>$v){
		//				if(!in_array($datos[2],$np_ids))$np_ids[]=$datos[2];
		//				else continue;
						$datos=give_their_data($v);
						$i++;
						if($i%2) echo "<div class=\"clear colorme\">";
						else echo "<div class=\"clear colorme odd\">";
						echo '<span class="c15">'.$datos[0].','.$datos[1].'</span>';
						echo '<span class="c15">'.$datos[2].'</span>';
						echo '<span class="campo"> </span>';
						echo '<span class="c15">'.'---'.'</span>';
						echo '</div>';
						$p_num++;						
						$np_num++;
			}
		}
		echo '<br /><hr /><br />';
//		echo '<b>Alumnos presentados</b>: '.(count($presentados_ids)-$np_num).'<br />';
		echo '<b>Alumnos presentados</b>: '.($p_num-$np_num).'<br />';
		echo '<b>Alumnos no presentados</b>: '.$np_num.'<br />';
		echo '<b>Total</b>: '.(count($presentados_ids)).'<br />';
		mysql_close($link);
	}else return false;
		unset($al);
		unset($nota);
		unset($al_fcha);
		unset($al_ntas);
		unset($datos);
}


function files_name(){
	$sql="SELECT DNI,num_exam FROM asg_admin.Alumnos WHERE status='Corregido' LIMIT 1";
	$query=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_row($query);
	$today = date("jFy");                 // March 10, 2001, 5:16 pm
	if($row){
		$retorno=$row[0].'_'.$today.'_'.$row[1];
		return $retorno;
	}else
		return false;
}

//Llamo a la funcion para crear el PDF
function to_pdf($fuente='final.php',$destino=null){
	$origen="http://localhost/myapp/".$fuente;
	if($destino!=null){
		$destino =$destino.".pdf";
		passthru("./wkhtmltopdf-i386 --javascript-delay 7000 $origen pdfs/$destino");
		return true;
	}else return false;
}

function fast_pdf($fuente='final.php',$destino=null){
//ES NECESARIO CONFIGURAR LA RUTA $origen 
// El archivo debe de tener permisos de lectura y escritura
	$origen="http://localhost/myapp/".$fuente;
//	echo $origen;	
	if($destino!=null){
		$destino =$destino.".pdf";
		passthru("./wkhtmltopdf-i386 $origen pdfs/$destino");
		return true;
	}else return false;
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

function aqui($msg='< aquí',$line){
   echo "<br />Linea $line: $msg\n";  
}
function walk_idA_alumnos(){
	$sql="SELECT Alumno_id FROM Alumnos ORDER BY Apellidos";
	$query=mysql_query($sql) or die (mysql_error());
	while($row=mysql_fetch_row($query)){
		$idAl[]=$row[0];
	}	
	return $idAl;
}
function give_their_data($idA){
	$sql="SELECT Apellidos,Nombre,DNI,grupos FROM Alumnos WHERE Alumno_id=$idA LIMIT 1";
	$query=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_row($query);
	return $row;
}
function push_np($idA=null){
	if(exist_expediente($idA)){
		$sql="SELECT Fechas,notas,pruebas FROM Expedientes WHERE idAlumno=$idA";
		$query=mysql_query($sql) or die (mysql_error());
		$row=mysql_fetch_row($query);
//Los datos son
		$fecha=date('d-m-Y');
		$np='np';
		$prueba=0;
//Preparo los array fechas
		if(strlen($row[0])){
			$fecha_arr=explode(",",$row[0]);
			array_push($fecha_arr,$fecha);			
		}else $fecha_arr[]=$fecha;
//Preparo el array notas		
		if(strlen($row[1])){
			$np_arr=explode(",",$row[1]);
			array_push($np_arr,$np);			
		}else $np_arr[]=$np;
//Preparo el array pruebas		
		if(strlen($row[2])){
			$prueba_arr=explode(",",$row[2]);
			array_push($prueba_arr,$prueba);			
		}else $prueba_arr[]=$prueba;
//Preparo las cadenas para la BBDD
		$fechas=implode(",",$fecha_arr);
		$notas=implode(",",$np_arr);
		$pruebas=implode(",",$prueba_arr);
//Query
		$sql="UPDATE Expedientes SET Fechas='$fechas',notas='$notas',pruebas='$pruebas' WHERE idAlumno='$idA' LIMIT 1";
		$query=mysql_query($sql) or die(mysql_error());
		return true;
	}else return false;
}
function expediente_cima($idA=null){
	if(exist_expediente($idA)){
		$sql="SELECT Fechas,notas,pruebas FROM Expedientes WHERE idAlumno=$idA";
		$query=mysql_query($sql) or die (mysql_error());
		$row=mysql_fetch_row($query);
//Preparo los array fechas
		if(strlen($row[0])){
			$fecha_arr=explode(",",$row[0]);
			$fecha=array_pop($fecha_arr);			
			$valor[]=$fecha;
		}
//Preparo el array notas		
		if(strlen($row[1])){
			$np_arr=explode(",",$row[1]);
			$np=array_pop($np_arr);
			$valor[]=$np;			
		}
//Preparo el array pruebas		
		if(strlen($row[2])){
			$prueba_arr=explode(",",$row[2]);
			$prueba=array_push($prueba_arr);
			$valor[]=(int)$prueba;			
		}
		return $valor;
	}else return false;
}
function pop_expediente($idA=null){
	if(exist_expediente($idA)){
		$sql="SELECT Fechas,notas,pruebas FROM Expedientes WHERE idAlumno=$idA";
		$query=mysql_query($sql) or die (mysql_error());
		$row=mysql_fetch_row($query);
//Preparo los array fechas
		if(strlen($row[0])){
			$fecha_arr=explode(",",$row[0]);
			$fecha=array_pop($fecha_arr);			
			$valor[]=$fecha;
		}
//Preparo el array notas		
		if(strlen($row[1])){
			$np_arr=explode(",",$row[1]);
			$np=array_pop($np_arr);
			$valor[]=$np;			
		}
//Preparo el array pruebas		
		if(strlen($row[2])){
			$prueba_arr=explode(",",$row[2]);
			$prueba=array_pop($prueba_arr);
			$valor[]=(int)$prueba;			
		}
//Preparo las cadenas para la BBDD

		$fechas=implode(",",$fecha_arr);
		$notas=implode(",",$np_arr);
		$pruebas=implode(",",$prueba_arr);

		
//Query
		$sql="UPDATE Expedientes SET Fechas='$fechas',notas='$notas',pruebas='$pruebas' WHERE idAlumno='$idA' LIMIT 1";
		$query=mysql_query($sql) or die(mysql_error());
		return $valor;
	}else return false;
}
function show_expediente($idA=null){
	if(exist_expediente($idA)){
		echo '<hr />';
		echo 'pruebas <br />';
		if(get_pruebas($idA)>0)
		show_arr(get_pruebas($idA));
		echo 'notas <br />';
		if(get_notas($idA)>0)
		show_arr(get_notas($idA));
		echo 'fechas <br />';
		if(get_fechas($idA)>0)
		show_arr(get_fechas($idA));
	}else 'No tiene expediente!<br />';
	echo '<hr />';
}
function sort_dates($array){
	
	foreach($array as $val){
		$mark=strtotime($val);
		$YMD=date('Y-m-d',$mark);
		$aux[]=$YMD;
	}
	if(isset($aux)){
		sort($aux);
		foreach($aux as $val){
			$mark=strtotime($val);
			$DMY=date('d-m-Y',$mark);
			$aux1[]=$DMY;		
		}
		return $aux1;
	}else return false;

}

function get_all_dates(){
	$sql="SELECT Fechas FROM Expedientes";
	$query=mysql_query($sql) or die (mysql_error());
	$all=Array();
	while($row=mysql_fetch_row($query)){
		if(strlen($row[0])>0)$fechas=explode(",",$row[0]);
		foreach($fechas as $conv) 
			if(!in_array($conv,$all))array_push($all,$conv);
	}
	return $all;
}
function get_fechas($idA=null){
	if($idA!=null){
		$sql="SELECT Fechas FROM Expedientes WHERE idAlumno=$idA";
		$query=mysql_query($sql) or die (mysql_error());
		$row=mysql_fetch_row($query);
		if(strlen($row[0])>0)$fechas=explode(",",$row[0]);
		else return -1;
		return $fechas;
	}else return false;
}
function get_notas($idA=null){
	if($idA!=null){
		$sql="SELECT notas FROM Expedientes WHERE idAlumno=$idA";
		$query=mysql_query($sql) or die (mysql_error());
		$row=mysql_fetch_row($query);
		if(strlen($row[0])>0) $notas=explode(",",$row[0]);
		else return -1;
		return $notas;
	}else return false;
}
function get_pruebas($idA=null){
	if($idA!=null){
		$sql="SELECT pruebas FROM Expedientes WHERE idAlumno=$idA";
		$query=mysql_query($sql) or die (mysql_error());
		$row=mysql_fetch_row($query);
		if(strlen($row[0])>0) $pruebas=explode(",",$row[0]);
		else return -1;
		return $pruebas;
	}else return false;
}
function date_compare($date,$hoy=null){
	if($hoy==null){
		$hoy=date('Y-m-d');
	}
	$datetime1 = new DateTime($date);
	$datetime2 = new DateTime($hoy);
	$interval = date_diff($datetime1, $datetime2);
	return $interval->format('%a');	
}
function get_examenes($str){
	$examenes=explode(",",$str);
	return $examenes;
}
//Para los expedientes
function alumno_listar(){
	$sql="SELECT Nombre,Apellidos,DNI,examenes,Alias,Psw FROM Alumnos";
	$query=mysql_query($sql) or die(mysql_error());
	while($row=mysql_fetch_row($query)){
		if(!isset($row[3]))$row[3]="vacio";
		echo "<spam title='$row[4] $row[5]'>".$row[0]." ".$row[1]." >".$row[3]."<</spam><br />";
	
	} 
}

function examenes_pendientes_maximo(){
	$sql="SELECT examenes FROM Alumnos";
	$query=mysql_query($sql) or die(mysql_error());
	$m=0;
	while($row=mysql_fetch_row($query)){
		$ex=explode(",",$row[0]);
		$n=count($ex);
		if($n>$m) $m=$n;
	} 
	return $m;
}
function cuantos_examenes($idA){
	$sql="SELECT examenes FROM Alumnos WHERE Alumno_id=$idA";
	$query=mysql_query($sql) or die(mysql_error());
	$n=0;
	$row=mysql_fetch_row($query);
	$n=strlen($row[0]);
	if($n!=0){ 
		$ex=explode(",",$row[0]);
		$n=count($ex);
		unset($ex);
	}
	return $n;
}

function id_de_alumnos(){
	$sql="SELECT Alumno_id FROM Alumnos";
	$query=mysql_query($sql) or die(mysql_error());
	while($row=mysql_fetch_row($query)){
		$idA[]=$row[0];
	}
	return $idA;
}
function eliminar_una_prueba($idA){
	$sql="SELECT examenes FROM Alumnos WHERE Alumno_id=$idA";
	$query=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_row($query);		
	$len=strlen($row[0]);
	$arr=explode(",",$row[0]);
	array_pop($arr);
	if($len>=0) $nuevos=implode(",",$arr);	
	else return -1;
	$sql2="UPDATE Alumnos SET examenes='$nuevos' WHERE Alumno_id='$idA'";
	$query2 = mysql_query($sql2) or die(mysql_error());		
	$cuantos=count($arr);
	unset($arr);
	return $cuantos;
}
function examenes_pendientes_de($idA){
	$sql="SELECT Alumno_id FROM Alumnos WHERE Alumno_id=$idA";
	$query=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_row($query);
	$arr=explode(",",$row[0]);
	return $arr;
}

function server(){
	foreach($_SERVER as $k=>$v)
	echo $k.' :: '.$v.'<br />';
}
function monitor_viejo(){
	$db=$_SESSION['db_name'];
	$sql="SELECT * FROM asg_admin.Alumnos WHERE asignatura= '$db'";
	$query=mysql_query($sql) or die(mysql_error());
	while($row=mysql_fetch_row($query)){
		if($row[7]!=null){
			echo "<hr />";
			echo "<spam class='status: $row[8]'>";
			echo $row[2]." ".$row[3]." |<b> ".$row[6]."</b>| $row[7]</spam>";
		}
	} //He quitado utf8_encode de los nombres
}
function monitor(){	
		$db=$_SESSION['db_name'];
		$sql="SELECT * FROM asg_admin.Alumnos WHERE asignatura= '$db'";
		$query=mysql_query($sql) or die(mysql_error());
		while($row=mysql_fetch_row($query)){
			if($row[7]!=null AND date_compare($row[9])<2){
				echo "<hr />";
				echo "<spam class='status: $row[8]'>";
				echo $row[2]." ".$row[3]." |<b> ".$row[6]."</b>| $row[7] | $row[9]</spam>";
			}
		} //He quitado utf8_encode de los nombres
	}
function monitor_delete(){
	$db=$_SESSION['db_name'];
	$sql="DELETE FROM asg_admin.Alumnos WHERE asignatura= '$db'";
	$query=mysql_query($sql) or die(mysql_error());
}
//No se utiliza en monitor. En ninguna parte.
function monitor_alumno_listar(){
	$sql="SELECT Nombre,Apellidos,DNI,examenes,Alias,Psw FROM Alumnos";
	$query=mysql_query($sql) or die(mysql_error());
	while($row=mysql_fetch_row($query)){
		if(!isset($row[3]))$row[3]="vacio";
		echo "<spam title='$row[4] $row[5]'>".$row[0]." ".$row[1]." >".$row[3]."<</spam><br />";
	} 
}
function array_complete($origen=null,$actual=null,$notas=null){
	$a3=array_diff($origen,$actual);
	$total=Array();   
	$np=Array();   
	$count=count($a3)+count($actual);
	$k=0;
	while($count){
		if(array_key_exists($k,$a3)){
			$total[$k]=$a3[$k];
			$np[$k]='np';
		}else{
			$total[$k]=array_shift($actual);
			$np[$k]=array_shift($notas);
		}
		$count--;
    $k++;
	}
	$comb=array_combine($total,$np);
	return $comb;
}
//Grupos de alumnos
function get_grupos(){
	$arr=array();
	$sql='SELECT grupos FROM Alumnos';
	$query = mysql_query($sql) or die(mysql_error());	
	while($row=mysql_fetch_row($query)){
		if($row[0]==null) $row[0]='-';
		if(!in_array($row[0],$arr)) array_push($arr,$row[0]);
	}
	return $arr;
}

//Fin de grupos de alumnos


?>
