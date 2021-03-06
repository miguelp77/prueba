<?php
//SIEMPRE USAR CON basics.php
// require_once('include/basics.php');
require_once('basics.php');

if(isset($_SESSION['db_main'])) $db_main=$_SESSION['db_main'];


function db_create($nombre='asg_default'){
	if(!str_begin($nombre,"asg_")){
		$nombre = "asg_".$nombre;
	}
	$exist=mysql_select_db($nombre);
//	var_dump($exist);
	if(!$exist){
		$msg = "Creando ".$nombre;
		$sql="CREATE DATABASE `$nombre` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci";
		$query = mysql_query($sql) or die(mysql_error());
		$msg.= "...Hecho.<br />";
		echo $msg;	
		return utf8_encode($nombre);	
	}else false;//return "<b>$nombre ya existe</b>"."<br />";
//	return $msg;
}

//DROP DATABASE `asg_miguel`
function db_delete($nombre=NULL){
	if(str_begin($nombre,"asg_")){
		$exist=mysql_select_db($nombre);
//	var_dump($exist);
		if($exist){
		//	$msg = "Eliminando ".$nombre;
			$sql="DROP DATABASE `$nombre`";
			$query = mysql_query($sql) or die(mysql_error());
		//	$msg.= "...Hecho"."<br />";	
		}else false;
	}else false;
	return true; 
}
function db_list(){
	$link=connect_to_db();
	$db_list = mysql_list_dbs($link);

//echo "<form action='asignatura_cambiar.php' method='post'>";
	echo "<form name='select_form' action='#'>";
		echo "<SELECT NAME='dbs' SIZE='1'>";
		while ($row = mysql_fetch_object($db_list)){
	//anulo el valor de phpmyadmin
			$nombre=$row->Database;
			$ok=str_begin($nombre,"asg_");
//	echo $nombre;
			if($row->Database =="asg_admin") continue;
		  if($ok) echo "<OPTION VALUE='".parse_utf8($row->Database)."' name='db_nueva'>". asg_name($row->Database)."</OPTION>";
		}
		echo "</SELECT> ";
//echo $row;
	echo "</form>";

}

function show_tables($db=NULL){
	echo "<hr />";
//	echo $db;
// Hay que decodificarlo para que funcione 
// las instrucciones de sql	
	$db=utf8_decode($db);	
	$result = mysql_list_tables($db) or die(mysql_error());
//	echo $db;
//	echo '<br />';
//	var_dump($result);
//	echo '<br />';
	$num_rows = mysql_num_rows($result);
	
	for ($i = 0; $i < $num_rows; $i++) {
		if(mysql_tablename($result, $i)){
			$db=(string)mysql_tablename($result, $i);
			$sql="SELECT COUNT(*) FROM `$db`";
			$query=mysql_query($sql);
			$rcount=mysql_result($query,0);  
			$sql = "SELECT * FROM `$db`";
			$query = mysql_query($sql);
			$columns = mysql_num_fields($query);
			$names=array();
			$j=0;
		  //	  echo $tabla." - - [".$rcount ."] registros<br />";
			while($j<$columns){
				$name=mysql_field_name($query,$j);
				array_push($names,$name);
				$j++;
			}
			$campos=implode($names," | "); 
		if($db!="Admin") echo "<dfn>".$db."</dfn> - - [".$rcount ."] registros "."<input type='button' value='Vaciar' name='vaciar' class='".$db."' /><input type='button' value='Explorar' name='explorar' class='".$db."' /><br /><h4>". $campos."</h4>";
		else echo "<dfn>".$db."</dfn> - - [".$rcount ."] registros <br /><h4>". $campos."</h4>";
		}
	}
}

function delete_table($tabla){
	
	$sql="SELECT * FROM $tabla LIMIT 1";
	$exist=mysql_query($sql);
	if($exist){
		$sql="DROP TABLE $tabla"; 
		$exist=mysql_query($sql);
//		echo "borrado $tabla<br />";
	}
	return false;
}
function create_expediente_table(){
	$sql="SELECT idExpediente FROM Expedientes";
	$exist=mysql_query($sql);
	if(!$exist){
		$sql = "CREATE TABLE IF NOT EXISTS `Expedientes` (";
		$sql .= " idExpediente INT UNSIGNED NOT NULL AUTO_INCREMENT, ";	
		$sql .= " idAlumno INT UNSIGNED NOT NULL, ";
		$sql .= " pruebas TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL, ";
		$sql .= " notas TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL, ";
		$sql .= " Fechas TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL, ";
		$sql .= " PRIMARY KEY (idExpediente)";
		$sql .= " )";
		$sql .= " CHARACTER SET utf8 COLLATE utf8_spanish_ci"; 

		return $query = mysql_query($sql) or die(mysql_error());
	}
}


function create_temas_table(){
	$sql="SELECT Nombre FROM Temas";
	$exist=mysql_query($sql);
	if(!$exist){
		$sql = "CREATE TABLE IF NOT EXISTS `Temas` (";
		$sql .= " idTema INT UNSIGNED NOT NULL AUTO_INCREMENT, ";	
		$sql .= " fk_idAsignatura INT(11) DEFAULT '0' NOT NULL, ";
		$sql .= " Numero TINYINT(4) NULL, ";
		$sql .= " Nombre TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL, ";
		$sql .= " PRIMARY KEY (idTema)";
		$sql .= " )";
		$sql .= " CHARACTER SET utf8 COLLATE utf8_spanish_ci"; 

		return $query = mysql_query($sql) or die(mysql_error());
	}
}

function create_respuestas_table(){
	$sql="SELECT Respuesta FROM Respuestas";
	$exist=mysql_query($sql);
	if(!$exist){
		$sql = "CREATE TABLE IF NOT EXISTS `Respuestas` (";
		$sql .= " Resp_id INT UNSIGNED NOT NULL AUTO_INCREMENT, ";	
		$sql .= " Respuesta TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL, ";
		$sql .= " Cuestion_id INT UNSIGNED DEFAULT '0' NOT NULL, ";
		$sql .= " Correcta TINYINT(1) DEFAULT '0' NOT NULL, ";
		$sql .= " Ultima TINYINT(1) DEFAULT '-1' NOT NULL, ";
		$sql .= " Porcentaje TINYINT(4) DEFAULT '100' NOT NULL, ";
		$sql .= " PRIMARY KEY (Resp_id)";
		$sql .= " )";
		$sql .= " CHARACTER SET utf8 COLLATE utf8_spanish_ci"; 

		return $query = mysql_query($sql) or die(mysql_error());
	}
}

function create_fuente_table(){

	$sql="SELECT idFuente FROM Fuentes";
	$exist=mysql_query($sql);
	if(!$exist){
		$sql = "CREATE TABLE IF NOT EXISTS `Fuentes` (";
		$sql .= " idFuente INT UNSIGNED NOT NULL AUTO_INCREMENT, ";	
		$sql .= " identificado DATETIME NULL, ";
		$sql .= " created VARCHAR(50) NULL, ";
		$sql .= " preguntas TEXT NULL, ";			
		$sql .= " duracion tinyint(4) DEFAULT NULL,";			
		$sql .= " nombre varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL, ";
		$sql .= " numero tinyint(4) DEFAULT NULL, ";
//		$sql .= " status TINYINT NULL, ";
		$sql .= " PRIMARY KEY (idFuente)";
		$sql .= " ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci";

		return $query = mysql_query($sql) or die(mysql_error());
	}
}

function create_examenes_table(){

	$sql="SELECT idExamen FROM Examenes";
	$exist=mysql_query($sql);
	if(!$exist){
		$sql = "CREATE TABLE IF NOT EXISTS `Examenes` (";
		$sql .= " `idExamen` int(10) unsigned NOT NULL AUTO_INCREMENT, ";	
		$sql .= " `fk_Alumno_id` int(10) unsigned DEFAULT NULL, ";
		$sql .= " `IP` int(20) NOT NULL DEFAULT '0', ";	
		$sql .= " `orden` text COLLATE utf8_spanish_ci, ";	
		$sql .= " `expire` datetime DEFAULT NULL, ";	
		$sql .= " `preguntas` text COLLATE utf8_spanish_ci, ";	
		$sql .= " `respuestas` text COLLATE utf8_spanish_ci, ";	
		$sql .= " `resultado` decimal(4,2) DEFAULT NULL, ";	
		$sql .= " `start` datetime DEFAULT NULL, ";	
		$sql .= " `done` datetime DEFAULT NULL, ";	
		$sql .= " `status` tinyint(4) DEFAULT NULL, ";	
		$sql .= " PRIMARY KEY (`idExamen`)";	
		$sql .= " )ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ";	

		return $query = mysql_query($sql) or die(mysql_error());
	}
}

function create_conceptos_table(){

	$sql="SELECT Nombre FROM Conceptos";
	$exist=mysql_query($sql);
	if(!$exist){
		$sql = "CREATE TABLE IF NOT EXISTS `Conceptos` ( ";
		$sql .= " `idConcepto` int(10) unsigned NOT NULL AUTO_INCREMENT, ";	
		$sql .= " `fk_idTema` int(10) unsigned NOT NULL DEFAULT '0', ";
		$sql .= " `Nombre` text COLLATE utf8_spanish_ci NOT NULL, ";
		$sql .= " `Descripcion` text COLLATE utf8_spanish_ci NOT NULL, ";
		$sql .= " `Valor` int(11) DEFAULT '0', ";		
		$sql .= " PRIMARY KEY (`idConcepto`) ";
		$sql .= " )";
		$sql .= " ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci"; 

		return $query = mysql_query($sql) or die(mysql_error());
	}
}

function create_alumnos_table(){

	$sql="SELECT Nombre FROM Alumnos";
	$exist=mysql_query($sql);
	if(!$exist){
		$sql = "CREATE TABLE IF NOT EXISTS `Alumnos` (";
		$sql .= " `Alumno_id` int(10) unsigned NOT NULL AUTO_INCREMENT, ";
		$sql .= " `Nombre` text COLLATE utf8_spanish_ci NOT NULL, ";
		$sql .= " `Apellidos` text COLLATE utf8_spanish_ci NOT NULL, ";
		$sql .= " `DNI` varchar(14) COLLATE utf8_spanish_ci NOT NULL, ";
		$sql .= " `Alias` varchar(20) COLLATE utf8_spanish_ci NOT NULL, ";
		$sql .= " `Psw` varchar(20) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'pass', ";
		$sql .= " `status` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL, ";
		$sql .= " `examenes` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL, ";		
		$sql .= " `grupos` varchar(120) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0', ";		
		$sql .= "  PRIMARY KEY (`Alumno_id`) ";
		$sql .= " ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci";
		return $query = mysql_query($sql) or die(mysql_error());
	}
}		

function create_cuestiones_table(){
	$sql="SELECT Enunciado FROM Cuestiones";
	$exist=mysql_query($sql);
	if(!$exist){
		$sql = "CREATE TABLE IF NOT EXISTS `Cuestiones` (";
		$sql .= " `Cuestion_id` int(10) unsigned NOT NULL AUTO_INCREMENT, ";
		$sql .= " `Asig_id` tinyint(4) NOT NULL DEFAULT '0', ";
		$sql .= " `Enunciado` text COLLATE utf8_spanish_ci NOT NULL, ";
		$sql .= " `Imagen` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL, ";
		$sql .= " `Imagen_aux` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL, ";
		$sql .= " `Q_id` int(10) unsigned NOT NULL, ";
		$sql .= " `Conceptos` text COLLATE utf8_spanish_ci NOT NULL, ";
		$sql .= " PRIMARY KEY (`Cuestion_id`) ";
		$sql .= " ) "; 
		$sql .= " ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ";
		return $query = mysql_query($sql) or die(mysql_error());
	}
}
function create_pdfprinter(){

	$sql="SELECT idPDF FROM pdfprinter";
	$exist=mysql_query($sql);
	if(!$exist){
		$sql = "CREATE TABLE IF NOT EXISTS `pdfprinter` ( ";
		$sql .= " `idPDF` int(10) unsigned NOT NULL AUTO_INCREMENT, ";	
		$sql .= " `status` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL, ";
		$sql .= " `BBDD` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL, ";
		$sql .= " `opciones` text COLLATE utf8_spanish_ci NOT NULL, ";
		$sql .= " `valores` text COLLATE utf8_spanish_ci NOT NULL, ";
		$sql .= " `marca` datetime NOT NULL, ";		
		$sql .= " PRIMARY KEY (`idPDF`) ";
		$sql .= " )";
		$sql .= " ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci"; 

		return $query = mysql_query($sql) or die(mysql_error());
	}
}


//Copia una cuestion
//Utilizada en cuestion_duplicar.php
/*
function dup_cuestion($idQ=null){
	if($idQ!=null){
		$sql="SELECT * FROM Cuestiones WHERE Cuestion_id=$idQ";
		$query=mysql_query($sql) or die(mysql_error());
		$row=mysql_fetch_row($query2);
		$sql2 ="INSERT INTO `Cuestiones` (`Asig_id`, `Enunciado`, `Imagen`, `Imagen_aux`, `Q_id`, `Conceptos`) VALUES ";
		$sql2 .="($row[1],$row[2],$row[3],$row[4],$row[6]";
		return $query=mysql_query($sql) or die(mysql_error());
	}
}
*/

//Crea tablas en la BBDD de la asignatura
function create_struct(){
	create_alumnos_table();
	create_conceptos_table();
	create_cuestiones_table();
//	create_ecuaciones_table();
//	create_admin();
	create_examenes_table();
	create_fuente_table();
	create_respuestas_table();
	create_temas_table();
	create_expediente_table();
	return true;
}
//Elimina todas las tablas y las vuelve a crear
function db_reset(){
	delete_table("Alumnos");
//	delete_table("Ecuaciones");
	delete_table("Conceptos");
	delete_table("Cuestiones");
	delete_table("Fuentes");
	delete_table("Temas");
	delete_table("Respuestas");
	delete_table("Examenes");
	create_struct();
}

function add_field($tabla=null,$campo=null,$tipo=null){
	$sql="ALTER TABLE Alumnos ADD examenes VARCHAR(50) NULL";
	$query = mysql_query($sql) or die(mysql_error());
}
/**

Objeto Alumnos

***/



/**

Prueba

***/
function db_clone($origen,$destino=null,$opciones=null){

	if($destino==null) $destino=$origen."_bak";
//	$destino='asg_test';

	if(strlen($opciones)>1)
		$opciones = explode(',', $opciones);

	$sql="CREATE DATABASE $destino";
	$query = mysql_query($sql) or die(mysql_error());
	$sql="ALTER DATABASE $destino DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci";
	$query = mysql_query($sql) or die(mysql_error());

	// $result = mysql_list_tables($origen);
	$origen = utf8_decode($origen);
	$sql = "SHOW TABLES FROM $origen";
	$result = mysql_query($sql) or die(mysql_error());

	$num_rows = mysql_num_rows($result);

	for ($i = 0; $i < $num_rows; $i++) {
		if(mysql_tablename($result, $i)){
			$table_name=(string)mysql_tablename($result, $i);
			// echo $table_name;
			$tabla_origen=$origen.".".$table_name;
			$tabla_destino=$destino.".".$table_name;  
			// echo ' > '.$tabla_destino.'<br />';
			$sql="CREATE TABLE $tabla_destino LIKE $tabla_origen"; 
			$query = mysql_query($sql) or die(mysql_error());

			$sql="INSERT INTO $tabla_destino SELECT * FROM $tabla_origen" ;
			if(in_array($table_name, $opciones))
				$query = mysql_query($sql) or die(mysql_error());
		}
	}
}
/*


*/

function backup_tables($host,$user,$pass,$name,$tables = '*')
{
  
  $link = mysql_connect($host,$user,$pass);
  mysql_select_db($name,$link);
  
  //get all of the tables
  if($tables == '*')
  {
    $tables = array();
    $result = mysql_query('SHOW TABLES');
    while($row = mysql_fetch_row($result))
    {
      $tables[] = $row[0];
    }
  }
  else
  {
    $tables = is_array($tables) ? $tables : explode(',',$tables);
  }
  //cycle through
  foreach($tables as $table)
  {
    $result = mysql_query('SELECT * FROM '.$table);
    $num_fields = mysql_num_fields($result);
    
    $return.= 'DROP TABLE '.$table.';';
    $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
    $return.= "\n\n".$row2[1].";\n\n";
    
    for ($i = 0; $i < $num_fields; $i++) 
    {
      while($row = mysql_fetch_row($result))
      {
        $return.= 'INSERT INTO '.$table.' VALUES(';
        for($j=0; $j<$num_fields; $j++) 
        {
          $row[$j] = addslashes($row[$j]);
          $row[$j] = ereg_replace("\n","\\n",$row[$j]);
          if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
          if ($j<($num_fields-1)) { $return.= ','; }
        }
        $return.= ");\n";
      }
    }
    $return.="\n\n\n";
  }
  
  //save file
  $handle = fopen('db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
  fwrite($handle,$return);
  fclose($handle);
}


/*NO funciona
function db_clone($origen,$destino=null){

	if($destino==null) $destino=$origen."_bak";

	$sql="CREATE DATABASE $destino";
	$query = mysql_query($sql) or die(mysql_error());
	$sql="ALTER DATABASE $destino DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci";
	$query = mysql_query($sql) or die(mysql_error());

	$result = mysql_list_tables($origen);
	$num_rows = mysql_num_rows($result);
	for ($i = 0; $i < $num_rows; $i++) {
		if(mysql_tablename($result, $i)){
			$table_name=(string)mysql_tablename($result, $i);
			$tabla_origen=$origen.".".$table_name;
			$tabla_destino=$destino.".".$table_name;  
			$sql="INSERT INTO $tabla_destino SELECT * FROM $tabla_origen" ;
			$query = mysql_query($sql) or die(mysql_error());
		}
	}
}
*/
/*
function table_copy($bbdd=NULL,$tabla=NULL){
	return copiar_tabla($bbdd=NULL,$tabla=NULL);
}
function copiar_tabla($bbdd=NULL,$tabla=NULL)
{
	if($tabla!=NULL){
		conectar($_SESSION['db_main']);
		echo create_alumnos_table();
		$sql="INSERT INTO $bbdd.$tabla SELECT * FROM $db.$tabla";
		return $query = mysql_query($sql) or die(mysql_error());
	}
}
*/
function lista($tabla){
		$sql="SELECT * FROM $tabla";
		$query=mysql_query($sql) or die (mysql_error());
		while($row=mysql_fetch_array($query)){
			echo "[".implode(" | ",$row)."]";
		//	foreach($row as $key=>$value ){
		//		echo $value." | ";
		//	}
			echo "<br />";
		}
}

function re_index($tabla,$index){
	$sql="SELECT * FROM $table";
	$qry=mysql_query($sql);	
	$idx=0;
		$sql="ALTER TABLE $table AUTO_INCREMENT = 1";
		$query=mysql_query($sql) or die(mysql_error());	
	while($now=mysql_fetch_array($qry)){
		$idx++;
		$viejo=$now[0];
		$sql="UPDATE $table SET $index=$idx WHERE $index=$viejo";
		$query=mysql_query($sql) or die(mysql_error());	
		$id=mysql_insert_id();
//	echo "Nuevo id= ".$id."<br />";
		echo $id;
	}	
}


function id_links($table='Cuestiones'){
	//<a href ="admin_test.php" target ="showframe">Frame a</a>
	$sql="SELECT * FROM $table ORDER BY Cuestion_id";
	$query=mysql_query($sql);	
	$i=1;
	while($row=mysql_fetch_array($query)){
	echo "<a class='marco' href='cuestion_create.php?id_otra=$row[0]' target='showframe'>".$row[0]."</a>";

		$i++;	
	}
}

function create_admin($user="admin",$pass="admin"){
	$sql="SELECT Admin_id FROM Admin";
	$exist=mysql_query($sql);
	if(!$exist){
		$sql = "CREATE TABLE Admin (";
		$sql .= " Admin_id TINYINT(4)  NOT NULL AUTO_INCREMENT, ";	
		$sql .= " Nombre VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL, ";
		$sql .= " Apellidos VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL, ";
		$sql .= " Alias VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL, ";
		$sql .= " Psw VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL, ";
		$sql .= " PRIMARY KEY (Admin_id)";
		$sql .= " )";
		$sql .= " CHARACTER SET utf8 COLLATE utf8_spanish_ci"; 
		$query = mysql_query($sql) or die(mysql_error());
		$sql="INSERT INTO Admin (Nombre,Alias,Psw) VALUES ('$user','$user','$pass')";
		return $query = mysql_query($sql) or die(mysql_error());
	}else {
		return false;
	}

}	

function create_expresiones(){
	$sql= "CREATE TABLE IF NOT EXISTS `Ecuaciones` (";
	$sql .= " `eq_id` int(11) NOT NULL AUTO_INCREMENT, ";
	$sql .= " `eq_exp` text COLLATE utf8_spanish_ci NOT NULL, ";
	$sql .= " `eq_path` varchar(255) COLLATE utf8_spanish_ci NOT NULL, ";
	$sql .= " `eq_des` text COLLATE utf8_spanish_ci, ";
	$sql .= " PRIMARY KEY (`eq_id`)";
	$sql .= " ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci";
	$query = mysql_query($sql) or die(mysql_error());
}

function create_admin_alumnos(){
	$sql="SELECT Admin_id FROM Admin";
	$exist=mysql_query($sql);
	if(!$exist){
		$sql2 = "CREATE TABLE IF NOT EXISTS `Alumnos` (";
	 	$sql2 .= "`Alumno_id` mediumint(9) NOT NULL AUTO_INCREMENT,";
		$sql2 .= "`idA` tinyint(4) NOT NULL,";
		$sql2 .= "`Nombre` text COLLATE utf8_spanish_ci NOT NULL,";
		$sql2 .= "`Apellidos` text COLLATE utf8_spanish_ci NOT NULL,";
		$sql2 .= "`DNI` varchar(14) COLLATE utf8_spanish_ci NOT NULL,";
		$sql2 .= "`Nota` decimal(4,2) NOT NULL,";
		$sql2 .= "`status` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,";
		$sql2 .= "`num_exam` tinyint(4) DEFAULT NULL,";
		$sql2 .= "`asignatura` mediumtext COLLATE utf8_spanish_ci,";
		$sql2 .= "`Fecha` datetime NOT NULL,";
		$sql2 .= "PRIMARY KEY (`Alumno_id`)";
		$sql2 .= ") CHARSET=utf8 COLLATE=utf8_spanish_ci";
		$query = mysql_query($sql2) or die(mysql_error());
	}
}


function check_alumno($alias=null,$pass=null){	
	if($alias==null || $pass==null) return false;
	$link=connect_to_db();
	$db_list = mysql_list_dbs($link);
	$i=0;
	while ($row = mysql_fetch_object($db_list)){
	//anulo el valor de asg_admin
		$bbdd=$row->Database;
		$ok=str_begin($bbdd,"asg_");

		if(!$ok) continue;
		if($bbdd=='asg_admin') continue;

/*
		$sql="SELECT Alias FROM $bbdd.Alumnos LIMIT 1";
		$exist=mysql_query($sql);
		if(!$exist) continue;
*/
	//Recorro todas las BBDD hasta en busca del login
		$query="SELECT * FROM $bbdd.Alumnos WHERE Alias= '$alias'";
		$sql =mysql_query($query) or die(mysql_error());
		while($row=mysql_fetch_assoc($sql)){
//		echo $row['Alias'].$row['Psw'].'<br />';
			if($alias==$row['Alias'] && $pass==$row['Psw']){
				$i++;
//				echo $i;	
			}
		}	
	}
return $i;
}
function check_admin($alias=null,$pass=null){	
	if($alias==null || $pass==null) return false;
	$link=connect_to_db();
	$db_list = mysql_list_dbs($link);
	$i=0;
//		echo $alias."/".$pass;
	//anulo el valor de asg_admin
	if(check_alumno($alias,$pass)) return false;

	$query="SELECT * FROM asg_admin.Admin WHERE Alias= '$alias'";
	$sql =mysql_query($query) or die(mysql_error());
		while($row=mysql_fetch_assoc($sql)){
//		echo $row['Alias'].$row['Psw'].'<br />';
			if($alias==$row['Alias'] && $pass==$row['Psw']){
				$i++;
//				echo $i;	
			}
		}	

return $i;
}

//EXPERIMENTO
function purge_alumnos_info(){
	$sql = "SELECT num_exam,Alumno_id FROM asg_admin.Alumnos";
	$query = mysql_query($sql) or die(mysql_error());	
	$borrar=Array();
	while($row=mysql_fetch_row($query)){
		if(!isset($row[0])){
			array_push($borrar,$row[1]);
//			echo $row[0].'--'.$row[1].'<br />';
//		
		}
	}
	foreach($borrar as $value){
		$sql="DELETE FROM asg_admin.Alumnos WHERE Alumno_id=$value";
		$query =mysql_query($sql) or die(mysql_error());
	}
return false;
}

function next_source($alumno){
	$sql="SELECT examenes FROM Alumnos WHERE Alumno_id=$alumno LIMIT 1";
	$query = mysql_query($sql) or die(mysql_error());	
	$row=mysql_fetch_array($query);
	$array=explode(",",$row[0]);
	$last=end($array);
	return $last;
}

//Todos los alumnos tienen fuentes unicas
function source_balance(){
	$sql="SELECT examenes FROM Alumnos";
	$query = mysql_query($sql) or die(mysql_error());	
	$comun=array();
	while($row=mysql_fetch_array($query)){
		$array=explode(",",$row[0]);
		foreach($array as $value){
			if($value!=''){
				if(!in_array($value,$comun)) array_push($comun,$value);
			}
		}
	}
	$balance=implode(",",$comun);
	echo ' >Pila de fuentes: '.$balance;
	$sql2="UPDATE Alumnos SET examenes='$balance'";
//	$query2 = mysql_query($sql2) or die(mysql_error());	
}
//Todos los alumnos tienen el maximo numero de examenes
function source_reduce(){
	$sql="SELECT examenes FROM Alumnos";
	$query = mysql_query($sql) or die(mysql_error());	
	$comun=array();
	while($row=mysql_fetch_array($query)){
		$array=explode(",",$row[0]);
		$comun=array_diff($array,$comun);
	}
	$balance=implode(",",$comun);
//	$balance="";
	echo 'Reduccion->'.$balance;
	$sql2="UPDATE Alumnos SET examenes='$balance'";
//	$query2 = mysql_query($sql2) or die(mysql_error());	
}
function source_minified(){
	$sql="SELECT examenes FROM Alumnos";
	$query = mysql_query($sql) or die(mysql_error());	
//	$comun=array();
	$min=100;
	while($row=mysql_fetch_array($query)){
		$array=explode(",",$row[0]);
		$count=count($array);
		if($count<$min) {
				$min=$count;
				$minimo=implode(",",$array);
		}
//		echo $min.'<br />';
	}
//	$balance="";
	echo 'fuentes-> '.$minimo.'<br />';
	$sql2="UPDATE Alumnos SET examenes='$minimo'";
//	$query2 = mysql_query($sql2) or die(mysql_error());	
}
function source_maximise(){
	$sql="SELECT examenes FROM Alumnos";
	$query = mysql_query($sql) or die(mysql_error());	
//	$comun=array();
	$max=0;
	while($row=mysql_fetch_array($query)){
		$array=explode(",",$row[0]);
		$count=count($array);
		if($count>$max) {
				$max=$count;
				$maximo=implode(",",$array);
		}
//		echo $min.'<br />';
	}
//	$balance="";
	echo 'fuentes-> '.$maximo.'<br />';
	$sql2="UPDATE Alumnos SET examenes='$maximo'";
//	$query2 = mysql_query($sql2) or die(mysql_error());	
}
//function source_nps(){
	
//}
function source_name($source){
	$sql="SELECT nombre FROM Fuentes WHERE idFuente='$source' LIMIT 1";
	$query=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_array($query);
	return $row[0];
	
}
function cuantos_expedientes(){
	$sql="SELECT * FROM Expedientes";
	$query=mysql_query($sql);
	$count_expedientes=mysql_num_rows($query); 
	return $count_expedientes;
}
function cuantos_alumnos(){
	$sql="SELECT * FROM Alumnos";
	$query=mysql_query($sql);
	$count_expedientes=mysql_num_rows($query); 
	return $count_expedientes;
}
function idAlumnos(){
	$alumnos=Array();
	$sql="SELECT idAlumno FROM Expedientes";
	$query=mysql_query($sql) or die (mysql_error());
	while($row=mysql_fetch_array($query)){
		$alumnos[]=$row[0];
	}
	return $alumnos;
	//
}
function Alumnos_ids(){
	$alumnos=Array();
	$sql="SELECT Alumno_id FROM Alumnos";
	$query=mysql_query($sql) or die (mysql_error());
	while($row=mysql_fetch_array($query)){
		$alumnos[]=$row[0];
	}
	return $alumnos;
	//	
}
function whois($idA){
	$sql="SELECT * FROM Alumnos WHERE Alumno_id='$idA' LIMIT 1";
	$query=mysql_query($sql) or die (mysql_error());
	$row=mysql_fetch_assoc($query);
	return $row;

}
function init_expedientes(){
	$sql="SELECT Alumno_id FROM Alumnos";
	$query=mysql_query($sql) or die (mysql_error());
	while($row=mysql_fetch_row($query)){
		$sql2="INSERT INTO Expedientes (idAlumno) VALUES ('$row[0]')"; 
		$query2=mysql_query($sql2) or die (mysql_error());
	}
}
function exist_expediente($idA){
	$alumnos=idAlumnos();
	return in_array($idA,$alumnos);
}
function create_expediente($idA){
	$sql="INSERT IGNORE INTO Expedientes (idAlumno) VALUE ('$idA')"; 
	$query=mysql_query($sql) or die (mysql_error());
}

function push_expediente($idA,$numero_examen){
//Inserto el numero de examen, y la fecha en el expediente	
	$sql="SELECT pruebas,notas,Fechas FROM Expedientes WHERE idAlumno='$idA' ";
	$query=mysql_query($sql) or die (mysql_error());
	$row=mysql_fetch_row($query);
	if(strlen($row[0])!=0) $pruebas=explode(",",$row[0]);
	else $pruebas=Array();
//	$notas=explode(",",$row[1]);
	if(strlen($row[2])!=0) $fechas=explode(",",$row[2]);
	else $fechas=Array();
	
	$hoy=time();
	$fecha=date('d-m-Y',$hoy);
	
	array_push($fechas,$fecha);
	array_push($pruebas,$numero_examen);
	
	$dates=implode(",",$fechas);
	$tests=implode(",",$pruebas);

	$sql2="UPDATE Expedientes SET pruebas='$tests',Fechas='$dates' WHERE idAlumno=$idA";
	$query=mysql_query($sql2) or die (mysql_error());
}
function update_expediente($idA,$nota='np'){
	$sql="SELECT notas FROM Expedientes WHERE idAlumno='$idA' ";
	$query=mysql_query($sql) or die (mysql_error());
	$row=mysql_fetch_row($query);
	if(strlen($row[0])!=0) $notas=explode(",",$row[0]);
	else $notas=Array();
	array_push($notas,$nota);
	$results=implode(",",$notas);
	$sql2="UPDATE Expedientes SET notas='$results' WHERE idAlumno=$idA";
	$query=mysql_query($sql2) or die (mysql_error());
}	
function get_expediente($idA){
		$sql="SELECT * FROM Expedientes WHERE idAlumno='$idA' ";
		$query=mysql_query($sql) or die (mysql_error());
		$row=mysql_fetch_row($query);
		return $row;
}
function presentacion_expediente($row){
	$pruebas=explode(",",$row[2]);
	$notas=explode(",",$row[3]);
	$fechas=explode(",",$row[4]);
	$n=0;
	foreach($pruebas as $valor){
		echo 'prueba: '.$pruebas[$n].'dia: '.$fechas[$n].'<br />';
		echo 'nota: '.$notas[$n];
		$n++;
	}
}

//	Expedientes SET pruebas='$balance'";
//		$sql="UPDATE $table SET $index=$idx WHERE $index=$viejo";

//ALTER TABLE `www` CHANGE `qqqwww` `qqqwww` VARCHAR(12) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
//ALTER TABLE `www` ADD PRIMARY KEY(`qqqwww`)
//ALTER DATABASE `asg_cris` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci 
//CREATE DATABASE `asg_cris` 
//RENAME TABLE `asg_miguel`.`www` TO `asg_cris`.`www` 
// DROP DATABASE `asg_miguel` ;

function a8(){
	echo 'AQUI<br />';
}

function db_options($db=null,$field=null,$table=null){
	if($db!=null)
		$link=conectar($db);
	$select_tbl='select_'.$table;
	$name_fld='name_'.$field;	
	$select_frm=$field.'_frm';
//Campos
	$sql="SELECT $field FROM $table";
	$query=mysql_query($sql) or die(mysql_error);
	
	echo "<form name='$select_frm' action='#'>";
	echo "<SELECT NAME='$select_tbl' SIZE='1'>";
	while ($row=mysql_fetch_object($query)){
		$value=$row->$field;
		echo "<OPTION VALUE='".$value."' name='".$name_fld."'>".$value."</OPTION>";
	}
	echo "</SELECT> ";
}
//Renueva los passwords de los alumnos
	function regenerate(){
		$sql="SELECT Alumno_id,Alias FROM Alumnos";
		$query=mysql_query($sql) or die(mysql_error());
		while($row=mysql_fetch_row($query)){
			$new_pass=generatePassword();

			$valid=check_alumno($row[1],$new_pass);
			if($valid==0)
				$sql_update="UPDATE Alumnos SET Psw='$new_pass' WHERE Alumno_id= '$row[0]'";
				$qry=mysql_query($sql_update) or die(mysql_error());
		}
	}
	function update_alias(){
		$sql="SELECT Alumno_id,Alias FROM Alumnos";
		$query=mysql_query($sql) or die(mysql_error());
		while($row=mysql_fetch_row($query)){
			$new_pass=generatePassword();
			$new_alias = generatePassword();
			$valid=check_alumno($new_alias,$new_pass);
			if($valid==0)
				$sql_update="UPDATE Alumnos SET Psw='$new_pass' WHERE Alumno_id= '$row[0]'";
				$qry=mysql_query($sql_update) or die(mysql_error());
		}
	}
//Sanear las entradas
function sanear($string=null){
	if($string!=null){
		$string=trim($string);	
		if(get_magic_quotes_gpc()){
			$string= stripslashes($string);
		}
		$string=mysql_real_escape_string($string);
		return $string;
	}
	return false;
}	
function purge_respuestas(){
	$sql="SELECT Resp_id,Cuestion_id FROM Respuestas ORDER BY Cuestion_id";
	$query=mysql_query($sql) or die(mysql_error());
	while($row=mysql_fetch_row($query)){
//		echo 'Cuestion_id= '.$row[1].'<br />';
		$sql="SELECT Cuestion_id FROM Cuestiones WHERE Cuestion_id=$row[1] LIMIT 1";
		$exist=mysql_query($sql);
		$valor=mysql_fetch_row($exist);
//		echo 'existe? '.$valor[0].'<br />';
		if($valor[0]) continue;
		else{
			$sql="DELETE FROM Respuestas WHERE Cuestion_id=$row[1] ";
			$delete=mysql_query($sql) or die(mysql_error());
			$n=mysql_affected_rows();
//			echo 'Borrada'.$row[1].' - '.$n.'<hr />';
		}
	}
}

function concon(){
	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		conectar($db);
	}else{
	echo "Sin base."."<br />"; //Aqui habria que redirigir
	}
}
/*

Gestion de examenes

*/

// Obtiene los examenes del alumno
function get_examen($alumno){
	$examenes = array();

	$sql="SELECT examenes FROM Alumnos WHERE Alumno_id = $alumno LIMIT 1";
	$query=mysql_query($sql) or die(mysql_error());
	while($row=mysql_fetch_row($query)){
		if(strlen($row[0])<1){
			return $examenes;
		}else{
			$examenes=explode(",",$row['0']);
		}
	}	
	return $examenes;
}

//Actualiza los examenes del alumno
function update_examen($alumno=null,$examenes_str=null){
	$sql="UPDATE Alumnos SET examenes='$examenes_str' WHERE Alumno_id=$alumno LIMIT 1";
	$query=mysql_query($sql) or die(mysql_error());	
}

// Obtiene los examenes que tiene asignado el grupo
function list_ex_grupo($grupo = null){
	//tipo es el tipo de examen
	$sql="SELECT tipo FROM Grupos WHERE nombre = '$grupo' LIMIT 1";
	$query=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_row($query);
	if(count($row[0])>=1)
	$id_examenes = explode(',', $row[0]);

	return $id_examenes;
}

/***

Gestion de grupos

***/
function show_groups(){


}
function Groups_org(){
	$grupo=null;

	$sql="SELECT * FROM Alumnos ORDER BY grupos ASC";
	$query=mysql_query($sql);
	$ii=0;

	echo '<div id="Grupos"><ul>';

	while($result=mysql_fetch_assoc($query)){
		$gg=$result['grupos'];
		if ($grupo != $result['grupos']){
			echo 'Grupo '. $result['grupos'].'<hr />'.'</ul>';
			echo '</div><div id="sorttable-'.$gg.'" zona="'.$gg.'">';
			echo '<ul class="sortable">';
		}
		$nEx=next_source($result['Alumno_id']);
		
		echo '<li class="naranja" id="'.$result['Alumno_id'].'">::'.$result['grupos'].'--'.$result['Alumno_id'].'<input type="checkbox" title ="'.$result['grupos'].'" name="'.$result['Alumno_id'].'" value="'.$result['Alumno_id'].'"/>';			
			echo " ".$result['Apellidos'].', '.$result['Nombre'].'</li>';
//			echo "<div class='css_btt_r' name=".$result['Alumno_id']." title='Cambiar'>Cambiar</div></spam>";
			$grupo = $result['grupos'];
		echo "<hr />";
	}
	echo '</ul></div>';
	echo '</div>';
	$grupos = get_grupos();
	
//Selector de grupo
	echo '<div class="dcha">';
	// echo ' Grupos ';
		echo "<form name='select_form' action='#'>";
		echo "<SELECT NAME='dbs' SIZE='1'>";
		foreach($grupos	as $g){
			echo "<OPTION VALUE='".$g."' name='send_to'>".$g."</OPTION>";
		}
		echo "</SELECT> ";

		echo "<div class='css_btt' name='mover' title='mover'>Mover a</div>";
//		// echo '<input type="button" name="mover" value="Mover">';
		// print_r($grupos);
		echo "</form>";	
}
function selectGroup(){
	$grupos = get_grupos();
//Selector de grupo
	echo '<div class="dcha">';
	// echo ' Grupos ';
		echo "<form name='select_form' action='#'>";
		echo "<SELECT NAME='dbs' SIZE='1'>";
		foreach($grupos	as $g){
			echo "<OPTION VALUE='".$g."' name='send_to'>".$g."</OPTION>";
		}
		echo "</SELECT> ";

		echo "<div class='css_btt' name='mover' title='mover'>Mover a</div>";
//		// echo '<input type="button" name="mover" value="Mover">';
		// print_r($grupos);
		echo "</form>";		
}
function chooseGroup($examen = 1){
	$grupos=getGroups();
	echo '<div class="dcha">';
		echo '<div class="selector">';
		// echo "<form name='select_form' action='#'>";
			echo "<SELECT class='grupo' id='selector".$examen."'' NAME='dbs' SIZE='1'>";
				foreach($grupos	as $g){
					echo "<OPTION VALUE='".$g."' name='send_to'>".$g."</OPTION>";
				}
			echo "</SELECT> ";
		// echo "</form>";		
		echo '</div>';
	echo '</div>';
}
function selectGroups(){
	$grupos=getGroups();
	echo '<div class="dcha">';
		echo "<form name='select_form' action='#'>";
		echo "<div class='css_btt' name='mover' title='mover'>Mover a</div>";
		echo "<div class='css_btt' name='copiar' title='copiar'>Copiar a</div>";
			echo "<SELECT NAME='dbs' SIZE='1'>";
				foreach($grupos	as $g){
					echo "<OPTION VALUE='".$g."' name='send_to'>".$g."</OPTION>";
				}
			echo "</SELECT> ";
		echo "</form>";		
	echo '</div>';
}
function nombre_del_grupo($grupo_id){

	$query="SELECT nombre FROM Grupos WHERE grupo_id='$grupo_id'";
	$result = mysql_query($query) or die(mysql_error());
	$row = mysql_fetch_row($result);
//	echo $query;
	return $row[0];
}


function Groups(){
	$grupo=null;
	
	$sql="SELECT * FROM Alumnos ORDER BY grupos ASC";
	$query=mysql_query($sql);
	$ii=0;

	echo '<div id="Grupos">';
		echo 'Grupos<hr />';
		echo '<div id="sorttable-a" zona="a">';
			echo '<ul class="Comienzosortable">';
			// echo '<ul class="sortable">';
	while($result=mysql_fetch_assoc($query)){
		$gg=$result['grupos'];
		$Nombre=$result['Nombre'];
		$Apellidos=$result['Apellidos'];
		$AId=$result['Alumno_id'];

		if ($grupo != $gg){
			echo '</ul></div><br />';
			echo '<div id="sorttable-'.$gg.'" zona="'.$gg.'"> Grupo '.$gg; 
			echo '<ul class="sortable">';
		}
		echo '<li class="naranja" id="'.$AId.'">';
			echo '::'.$gg.'--'.$AId.'<input type="checkbox" title ="'.$gg.'" name="'.$AId.'" value="'.$AId.'"/>';			
			echo " ".$Apellidos.', '.$Nombre;
		echo '</li>';
		$grupo = $result['grupos'];
	}

	echo '</ul></div>'; //Fin de sortTable
	echo '</div>'; //Fin de Grupos
	$grupos = get_grupos();
	
//Selector de grupo
	selectGroup();
}
function viewGroup(){
	$sql = "SELECT * FROM Grupos";
	$qry = mysql_query($sql);

	while ($row=mysql_fetch_assoc($qry)){
		echo '<div class="tag">'.$row['nombre'];
		// echo "<div class='css_btt dcha' name='".$row['grupo_id']."'>Gestion</div>";
		echo '</div><hr />';
		echo "<div class='grupo'>";
			if(strlen($row['asignados'])>0) listGroup($row['asignados'],$row['grupo_id']);
		echo"</div>";
	}
	alumnos_sin_grupo();
	selectGroups();
}
function listGroup($asignados,$origen){
	$arr=explode(',', $asignados);
	echo '<ul>';
	foreach ($arr as $key => $value) {
		$row=whois($value);
		echo "<li class='row'>";
			echo "<input type='checkbox' name='$origen' value='".$row['Alumno_id']."'/>  ";
			echo $row['Nombre'].', '.$row['Apellidos'].'<br />';		
		echo "</li>";
	}
	echo '</ul>';
	echo '<br />';
}

function alumnos_sin_grupo(){
	$sql="SELECT * FROM Alumnos WHERE grupos LIKE '0'";

	$qry = mysql_query($sql) or die(mysql_error());
	
	// $row = mysql_fetch_row($qry);
	// echo $sql;
	// if(!$row) exit();
	// var_dump($row);
	if ($qry==true){ 
		echo '<div class="tag">'.'Sin grupo'.'</div><hr />';	
		echo '<ul>';
		while($row = mysql_fetch_row($qry)){
			echo "<li class='row'>";
			echo "<input type='checkbox' name='empty' value='".$row[0]."'/>  ";
			echo $row[1].', '.$row[2].'<br />';		
			echo "</li>";	
		}	
	echo '</ul>';
	echo '<hr />';
	}
}



?>
