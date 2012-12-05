<?php
	session_start();
	require_once('includes/misfunciones.php');
/*
	unset($_SESSION['user']);
  unset($_SESSION['msg']);
  unset($_SESSION['login']);
*/
	//Destruyo todas las variables de session
	session_destroy();	
	session_start();
	unset($msg);
//Conecto a la BBDD
  $conn = Conectar();
//Adquiero los datos del formulario
  $user = htmlspecialchars(trim($_POST['alias']));
  $psw = htmlspecialchars(trim($_POST['pass']));
//Si no he recibido alguno de los campos lo pongo en msg
	$msg = '';
  $msg .= (strlen($user)>0) ? '' : 'Introduzca su nombre de usuario. ';
  $msg .= (strlen($psw)>0) ? '' : 'Introduzca contraseña. ';
//Busco el ALIAS en la TABLA Admin	
	$query="SELECT * FROM Admin WHERE Alias= '$user' LIMIT 1";
  $sql =mysql_query($query) or die(mysql_error());
  $result_adm =mysql_fetch_array($sql);
//Si existe el ALIAS en Admin y el password es correcto
  if($result_adm['Psw']==$psw && strlen($psw)){
  	$_SESSION['hora']=date('d/m/Y - H:i');
   	$_SESSION['user'] = $result_adm['Nombre'].' '.$result_adm['Apellidos'] ;
   	$_SESSION['msg']='';
   	$_SESSION['login_as']='admin';
   	$ret='admin';
  }	

  if($result_adm['Psw']!=$psw AND strlen($psw)>0 AND strlen($user)>0 AND $result_adm){
   	unset($_SESSION['user']);
   	$msg ='Combinacion Usuario/Contraseña incorrecta';
  }

//Miro si es un ALUMNO  
	$query="SELECT * FROM Alumnos WHERE Alias= '$user' LIMIT 1";
  $sql =mysql_query($query) or die(mysql_error());
	if(!$result_adm) $result =mysql_fetch_array($sql);
  if($result['Psw']==$psw && strlen($psw)>0){
	//  var_dump($result['Psw']);
	  $_SESSION['hora']=date('d/m/Y - H:i');
   	$_SESSION['user'] = $result['Nombre'].' '.$result['Apellidos'] ;
   	$_SESSION['msg']='';
   	$_SESSION['login_as']='alumno';
   	$ret='alumno';
   }	
 //  else{
 //  		unset($_SESSION['user']);
 // 	} 		
	if($result && $result['Psw']!=$psw AND strlen($psw)>0 AND strlen($user)>0){
   	unset($_SESSION['user']);
   	$msg ='Combinacion Usuario/Contraseña incorrecta';
	}
  if(!$result && !$result_adm ){
		unset($_SESSION['user']);
		$msg = "Usuario no registrado. Contacte con el administrador.";
  } 		
 	$_SESSION['msg']=$msg;
  echo $ret; 
?>
