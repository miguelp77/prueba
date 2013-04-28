<?php
	session_start();
	require_once('raiz.php');
//	defined('FOLDER')   ? null : define("FOLDER", $_SERVER['DOCUMENT_ROOT']."/myapp/");
	// Funciona a partir de PHP 4.3.0
	// set_include_path('/usr/lib/pear');
	require_once(FOLDER. 'includes/db_tools.inc');

//	require_once(dirname(__FILE__).'/includes/includes_tools.inc');
	require_once(FOLDER.'includes/cuestiones.inc');	
//	require_once('includes/misfunciones.php');
	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		conectar($db);//	require_once('checkuser.php');
	}
	$ret='';
	if(isset($msg)) unset($msg);
		$msg = '';
//Conecto a la BBDD
	
connect_to_db();
	$exist=mysql_select_db("asg_admin");
//Para la instalacion
/*
	if(!$exist){
		db_create("asg_admin");
		conectar("asg_admin");
		create_admin();
		create_admin_alumnos();
	$msg = '';
  $msg .= 'No habia instancias en la base de datos.';
	}
*/
	conectar("asg_admin");
//	mysql_query("SET NAMES 'utf8'");
//	db_delete("asg_admin");
//Adquiero los datos del formulario - SANITY

	$user = htmlspecialchars(trim($_POST['alias']));
  $psw = htmlspecialchars(trim($_POST['pass']));

// Reemplazo cualquier caracter que no sea letra, numero o _(Guion bajo)
	 $user = preg_replace('/[\W]/','', $user);
	 $psw = preg_replace('/[\W]/','', $psw);

//Si no he recibido alguno de los campos lo pongo en msg
	$msg .= '<br />';
  $msg .= (strlen($user)>0) ? '' : 'Introduzca su nombre de usuario. ';
  $msg .= (strlen($psw)>0) ? '' : 'Introduzca contraseña. ';
//Busco el ALIAS en la TABLA Admin	
	$query="SELECT * FROM Admin WHERE Alias= '$user' LIMIT 1";
  $sql =mysql_query($query) or die(mysql_error());
  $result_adm =mysql_fetch_assoc($sql);
//	echo $result_adm['Psw'];
//echo $result_adm['Alias'];
	 
//Si existe el ALIAS en Admin y el password es correcto
  if($result_adm['Psw']==$psw && strlen($psw)){
  	date_default_timezone_set("Europe/Madrid");
  	$_SESSION['hora']=date('d/m/Y - H:i');
   	$_SESSION['user'] = $result_adm['Nombre'].' '.$result_adm['Apellidos'] ;
   	$_SESSION['msg']='';
   	$_SESSION['login_as']='admin';
//   	create_ecuaciones_table();
   	$ret='admin_test';
  }	

  if($result_adm['Psw']!=$psw AND strlen($psw)>0 AND strlen($user)>0 AND $result_adm){
   	unset($_SESSION['user']);
   	$msg ='Combinacion Usuario/Contraseña incorrecta';
  }
/**
*
* Usuario Alumno
* Comprueba si las credenciales son de un alumno
*
*/
$result='';
//Miro si es un ALUMNO  
	$link=connect_to_db();
	$db_list = mysql_list_dbs($link);
	while ($row = mysql_fetch_object($db_list)){
	//anulo el valor de phpmyadmin
		$bbdd=$row->Database;
		$ok=str_begin($bbdd,"asg_");
		if(!$ok) continue;
		$ok2=str_begin($bbdd,"asg_admin");
		if($ok2) continue;
	//	echo $bbdd."<br />";
//	if($row->Database =="phpmyadmin") continue;
	$sql="SELECT Alias FROM $bbdd.Alumnos LIMIT 1";
	$exist=mysql_query($sql);
	if(!$exist) continue;


//Recorro todas las BBDD hasta en busca del login
	$query="SELECT * FROM $bbdd.Alumnos WHERE Alias= '$user' LIMIT 1";
  $sql =mysql_query($query) or die(mysql_error());
	if(!$result_adm){ 
		$result =mysql_fetch_assoc($sql);
		$array_pass=Array();
		$cad=$result['Psw'].',lolo';
		$array_pass=explode(",",$cad);
		
//		var_dump($array_pass);
		if(in_array($psw,$array_pass)){
	//	if($result['Psw']===$psw && strlen($psw)>0){
			$pass_number=array_search($psw,$array_pass);
//			$ret="prueba";
//			$ret="instrucciones.php?as=".$pass_number;
			$ret="instrucciones2";

			unset($_SESSION['idAlumno']);
			unset($_SESSION['user']);			
//Fijo las variables de sesion
			$_SESSION['hora']=date('d/m/Y - H:i');
			$_SESSION['user'] = $result['Nombre'].' '.$result['Apellidos'] ;
			$_SESSION['idAlumno']=$result['Alumno_id'];
			$_SESSION['DNI']=$result['DNI'];
			$_SESSION['login_as']='alumno';
			$_SESSION['db_name']=$bbdd;
//Datos de la generacion del examen desde la fuente
			$fuente=examen_get_id($result['Alumno_id'],$bbdd);
			$duracion=duracion_get($fuente,$bbdd);
			$npreguntas=npreguntas_get($fuente,$bbdd);
// Datos del tipo de prueba
			$evaluable = es_evaluable($fuente,$bbdd);
			$dentro_fecha = check_dates($fuente,$bbdd);

			$show_nota = show_notas($fuente,$bbdd);
			// var_dump($dentro_fecha);
			if($dentro_fecha) $ret='instrucciones';
			if($_SESSION['msg']=='Sin examenes') $ret='../index';
//Relleno datos para la MONITORIZACION
			$nombre = $result['Nombre'];
			$apellidos = $result['Apellidos'];
			$DNI = $result['DNI'];
			$alias=$result['Alias'];
			$psw=$result['Psw'];
			$status="accediendo";
			$IP=ip2long(getIP());
			$asignatura=$bbdd;			
			$idA=$_SESSION['idAlumno'];
			$idMon=check_monitor($idA,$asignatura);
	
			if($idMon)$_SESSION['idAs']=$idMon; 
			else{
				$sql2="INSERT INTO asg_admin.Alumnos (idA,Nombre,Apellidos,DNI,asignatura,status) VALUES ('$idA','$nombre','$apellidos','$DNI','$asignatura','login')";
				$query2=mysql_query($sql2) or die(mysql_error());
// La variable de SESION  idAs es el identificador dentro de la monitorizacion
				$_SESSION['idAs']=mysql_insert_id(); 
			}
		$result=true;
		}		unset($array_pass);
	}	
}
  //  else{
 //  		unset($_SESSION['user']);
 // 	} 		
	if($result && $result['Psw']!=$psw AND strlen($psw)>0 AND strlen($user)>0){
  // 	unset($_SESSION['user']);
   	$msg ='Combinacion Usuario/Contraseña incorrecta';
	}
  if($result!=true AND !$result_adm ){
//		unset($_SESSION['user']);
		$msg = "Usuario no registrado. Contacte con el administrador.";
  } 		
 $_SESSION['msg']=$msg;
	echo $ret;
	
function check_monitor($idA,$asignatura){
	$sql="SELECT * FROM asg_admin.Alumnos WHERE (idA=$idA AND asignatura='$asignatura')";
	$query=mysql_query($sql) or die(mysql_error());
	$ret=false;
	while($row=mysql_fetch_row($query)){
		$str=strtotime($row[9]);
		$phpdate=date('d-m-Y-H',$str);
		$date_array=explode('-',$phpdate);
		$str2=mktime($date_array[3],0,0,$date_array[0],$date_array[1],$date_array[2]);
		$ahora=date('d-m-Y-H',time());
		$ahora_array=explode('-',$ahora);
		$redondeo=mktime($ahora_array[3],0,0,$ahora_array[0],$ahora_array[1],$ahora_array[2]);
		$op=$redondeo-$str2;
//		echo $phpdate.'...'.$op.'...'.$redondeo.'<br />';
			if($op==0) $ret=$row[0];
	}
	return $ret;
}	


?>
