<?php
	session_start();
require_once('includes/db_tools.inc');
require_once('includes/cuestiones.inc');	
//	require_once('includes/misfunciones.php');
	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		conectar($db);//	require_once('checkuser.php');
	}
	unset($msg);
function getIp() {
	$ip = $_SERVER['REMOTE_ADDR'];
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }
  return $ip;
}

//Conecto a la BBDD
	$ret='';
//	echo "hola";
//	conectar("asg_admin");
	connect_to_db();
	$exist=mysql_select_db("asg_admin");
	conectar("asg_admin");
	create_alumnos_table();
//	db_delete("asg_admin");
//Adquiero los datos del formulario
  $user = 'abad';
	$psw = 'abad';
//  $user = htmlspecialchars(trim($_POST['alias']));
//  $psw = htmlspecialchars(trim($_POST['pass']));
//Si no he recibido alguno de los campos lo pongo en msg
//Busco el ALIAS en la TABLA Admin	
	$query="SELECT * FROM Admin WHERE Alias= '$user' LIMIT 1";
  $sql =mysql_query($query) or die(mysql_error());
  $result_adm =mysql_fetch_array($sql);
//	echo $result_adm['Psw'];
//echo $result_adm['Alias'];
	 
//Si existe el ALIAS en Admin y el password es correcto
  if($result_adm['Psw']==$psw && strlen($psw)){
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

$result='';
//Miro si es un ALUMNO  

	$link=connect_to_db();
	$db_list = mysql_list_dbs($link);
	while ($row = mysql_fetch_object($db_list)){
	//anulo el valor de phpmyadmin
		$bbdd=$row->Database;
		$ok=str_begin($bbdd,"asg_");
		if(!$ok) continue;
	//	echo $bbdd."<br />";
//	if($row->Database =="phpmyadmin") continue;
	$sql="SELECT Alias FROM $bbdd.Alumnos LIMIT 1";
	$exist=mysql_query($sql);
	if(!$exist) continue;


//Recorro todas las BBDD hasta en busca del login
	$query="SELECT * FROM $bbdd.Alumnos WHERE Alias= '$user' AND Psw= '$psw' LIMIT 1";
  $sql =mysql_query($query) or die(mysql_error());
	if(!$result_adm){ 
		$result =mysql_fetch_assoc($sql);
		if($result['Psw']==$psw && strlen($psw)>0){
	//  var_dump($result['Psw']);
		print_r($result);
		echo $bbdd."<br />";
			unset($_SESSION['idAlumno']);
			unset($_SESSION['user']);			
			$_SESSION['hora']=date('d/m/Y - H:i');
			$_SESSION['user'] = $result['Nombre'].' '.$result['Apellidos'] ;

			$_SESSION['idAlumno']=$result['Alumno_id'];
			$_SESSION['DNI']=$result['DNI'];
			$_SESSION['login_as']='alumno';
			$ret="prueba";
			$_SESSION['db_name']=$bbdd;
			$fuente=examen_get_id($result['Alumno_id'],$bbdd);
			echo $fuente."<br />";
			$duracion=duracion_get($fuente,$bbdd);
			echo $duracion."<br />";
			$_SESSION['duracion']=$duracion;
//			echo $result['Nombre'];
			
//			echo $_SESSION['user'];
//	$sql="alter table Alumnos change fk_idAsignatura status varchar (10)";
//	$query=mysql_query($sql) or die(mysql_error());
	
		$result=true;
		}
	}	
}

	echo $ret;
?>
