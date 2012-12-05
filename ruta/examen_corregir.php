<?php
	session_start();
//Librerias
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	require_once('includes/cuestiones.inc');	
	if(isset($_SESSION['db_name']))$db=$_SESSION['db_name'];
	conectar($db);
	
//Respuestas durante el examen
	if(isset($_COOKIE['answers']))
		$cookie_respuesta=get_cookie("answers");
//Si no se ha respondido a nada ...
	else $cookie_respuesta='nr';
//Arreglo de la cookie de respuesta
	$respuestas=explode(",",$cookie_respuesta);
	$porcentaje=0;
	$i=0;
//Evaluo los resultados	
	foreach ($respuestas as $key => $value){
		$i++;
		if (str_begin($value, "sr")) continue;
		if (str_begin($value, "nr")) continue;
		$sql="SELECT Porcentaje FROM Respuestas WHERE Resp_id=$value LIMIT 1";
		$query=mysql_query($sql) or die(mysql_error());
		$row=mysql_fetch_row($query);
		$porcentaje +=(int)$row[0];
	}
//Representacion de la nota con 2 decimales
	$nota=$porcentaje/($i*10);
	$factor = pow(10, 2);
//Cambio el status del alumno
	$idA=get_cookie('idA');
	chg_status($idA,'finalizado');
//Recojo las cookies
	if(get_cookie("examen")) $examen=get_cookie("examen");
	if(get_cookie("answers")) $answers=get_cookie("answers");
	else $answers='nr';
	if(get_cookie("orden")) $orden=get_cookie("orden");
//	else $answers='nr';

//Actualizo la base de datos con el resultado
	$resultado=(round($nota*$factor)/$factor);	
	update_answers($examen,$idA,$resultado,$orden,$answers);
//Elimino las cookies
	if(get_cookie("examen"))del_cookie("examen");
	if(get_cookie("answers"))del_cookie("answers");
	if(get_cookie("orden"))del_cookie("orden");		
	if(get_cookie("comienzo")){
		del_cookie("comienzo");
	}
$calificacion=$resultado;
//echo '<spam class="small">Nota'; 
echo 'Su nota es '.$calificacion;//.'</spam>'; 

unset($_SESSION['duracion']);

$idA=$_SESSION['idAlumno'];
$fecha_mysql = date('Y-m-d H:i:s');
//echo $fecha_mysql;
//Actualizo el status e introduzco la calificacion en la BBDD
chg_status($idA,'Corregido');
chg_nota($idA,$calificacion,$fecha_mysql);
update_expediente($idA,$calificacion);
	//  purge_alumnos();

//Genero el nombre del archivo PDF

$nombre_archivo=files_name();
$result=to_pdf('final.php',$nombre_archivo);

session_destroy();
?>
