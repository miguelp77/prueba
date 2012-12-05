<?php
require_once('includes/db_config.php');

include("class.phpmailer.php");
include("class.smtp.php");
//Errores 
error_reporting(E_ALL);
ini_set('display_errors','On');
//Para hacer el backup
$archivo=backup_tables(DB_SERVER,DB_USER,DB_PASS,'asg_mike77_bak_bak');
//Para hacer la restauracion
//$file='db_backup_22Apr185356_asg_mike77_bak_bak.sql';
//$reto=import_db(DB_SERVER,DB_USER,DB_PASS,$file,'asg_mike77_no');
if($archivo>0){ 
//	send_email_to('paniagua.miguel@gmail.com','Backup de la base de datos','Copia de la base de datos hecha!',$archivo);;
//}else{
	echo 'Error! '.filesize($archivo).'<br />';
}else echo 'ok';


function import_db($host,$user,$pass,$file,$name='asg_import_name'){
	$link = mysql_connect($host,$user,$pass);
//Arreglo las variables
	$path_file="backups/$file";
//Crear la base
//	$previo="DROP DATABASE `$name`";
//	$accion=mysql_query($previo) or die(mysql_error());
	$crear="CREATE DATABASE `$name` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci";
	$accion = mysql_query($crear);// or die('>'.$crear.'<br />'.mysql_error());
//	if($accion) echo 'Creada<br />';
	echo '<hr />';
	var_dump($accion);
	echo 'errno > ';
	echo mysql_errno();
	echo '<hr />';
//Elegirla
	mysql_select_db($name,$link);
//Pillar del archivo	

	$sql = explode(";",file_get_contents($path_file));// Que ocurre si las db contiene un ';'
//Hace las querys menos los DROP
	foreach($sql as $query){
		$query=trim($query);
		if(!strncmp('DROP',$query,4)) continue;
		if(strlen($query)==0) break;
//		echo '> '.$query.'<hr />';
		mysql_query($query) or die(mysql_error());
	}

}

function restore_db($host,$user,$pass,$file,$name='asg_import_name'){
	$link = mysql_connect($host,$user,$pass);
//Arreglo las variables
	$path_file="backups/$file";
//NO Crear la base
//	$crear="CREATE DATABASE `$name` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci";
//	$accion = mysql_query($crear) or die(mysql_error());
//Elegirla
	mysql_select_db($name,$link);
//Pillar del archivo	
	$sql = explode(";",file_get_contents($path_file));// 
	foreach($sql as $query){
	//	mysql_query($query) or die(mysql_error());
		$query=trim($query);
//		if(!strncmp('DROP',$query,4)) continue;
		if(strlen($query)==0) break;
		mysql_query($query) or die(mysql_error());
	}
}

/* backup the db OR just a table */
function backup_tables($host,$user,$pass,$name,$tables = '*'){
//	echo $host,$user,$pass,$name;
	$link = mysql_connect($host,$user,$pass);
	mysql_select_db($name,$link);
	//get all of the tables
	if($tables == '*'){
		$tables = array();
		$result = mysql_query('SHOW TABLES');
		while($row = mysql_fetch_row($result)){
			$tables[] = $row[0];
		}
	}
	else{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
//	var_dump($tables);
$return='';
	//cycle through
	foreach($tables as $table){
		$result = mysql_query('SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);
		$return.= 'DROP TABLE '.$table.';';
		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) {
			while($row = mysql_fetch_row($result)){
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++){
					$row[$j] = addslashes($row[$j]);
//					$row[$j] = preg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	
	//save file
//	echo 'Voy a grabar en el disco '.$name.'<br />';
//	$handle = fopen('db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
	$handle = fopen('backups/db_bak.sql','w');
	if(!$handle) echo timeStamp().'¡Error! Fallo al abrir el archivo.<br /> ';
//	var_dump($return);
	$err=fwrite($handle,$return);
	if(!$err) echo timeStamp().'¡Error! Fallo al escribir el archivo.<br /> ';	
	$err=fclose($handle);
	if(!$err) echo timeStamp().'¡Error! Fallo al cerrar el archivo.<br />';	

	$archivo='backups/'.$name.'_bak_'.timeFile().'.sql';
//	echo 'Copia de respaldo en '.$archivo.'<br />';
	$copy = copy('backups/db_bak.sql',$archivo);
	if(!$copy) echo timeStamp().'¡Error! Fallo al copiar el archivo.<br /> ';	
	return $archivo;
}

function timeStamp(){
	echo date('[d/M--H:i:s]').' -- ';
}
function timeFile(){
	return date('dM_His');
}

?>
