<?php
	session_start();
//Next_Q Siguiente cuestion en orden	
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	$db=$_SESSION['db_name'];
	conectar($db);
	$alumnos=array();
	if(isset($_POST['packet'])){
		$alumnos=htmlspecialchars(trim($_POST['packet']));
		$alumnos=explode(",",$alumnos); //Lo paso a array
	}	
	if(isset($_POST['grupo'])){
		$grupo=$_POST['grupo']; //Nuevo grupo
	}
	if(isset($_POST['origen'])){
		$grupo_id=$_POST['origen']; // grupo origen
	}
	if(isset($_POST['operacion'])){
		$operacion=$_POST['operacion']; // copiar o mover
	}	
//Asigno a cada alumno su nuevo grupo 
//Antes de la modificiacion de ENERO2013
	// foreach($alumnos as $a_id){
	// 	$query="UPDATE Alumnos SET grupos='$grupo' WHERE Alumno_id='$a_id'";
	// 	$result = mysql_query($query) or die(mysql_error());
	// }
	//Mover

	// Si origen es empty mover, como copiar seran la misma operacion

	if($grupo_id=='empty') $operacion = 'copiar';

	// 	- Copiar en el nuevo grupo
		// 	-- Listar todos los alumnos y añadir si no esta
	if(isset($operacion)){
		$query = "SELECT asignados FROM Grupos WHERE nombre='$grupo'";
		$result = mysql_query($query) or die(mysql_error());
		$row = mysql_fetch_row($result);

		// 	-- Si no esta en grupo lo copio

		// if(count($gs)==0) {
		if(strlen($row[0])<1) {
			$al=$alumnos;
		}
		else{
			$gs=explode(',', $row[0]);
			$al=array_merge($gs,$alumnos);
		}
		// $al es igual a todos alumnos que tiene el grupo mas lo que se manipulan
		$al=array_unique($al);
		// Los alumnos estan inscritos una sola vez en el grupo
		$asignados=implode(',', $al);
		// Lo convierto en string para almacenarlo
		$query = "UPDATE Grupos SET asignados='$asignados' WHERE nombre='$grupo'";
		$result = mysql_query($query) or die(mysql_error());
		// echo '<El grupo> '.$grupo.' <se ha actualizado con estos> '.$asignados.' <alumnos> ';
		//El grupo ha sido actualizado con los alumnos 
		$destino=$grupo;
	// - Eliminar del antiguo grupo
		if($operacion =='mover'){
			$gg=$grupo;
			$grupo=nombre_del_grupo($grupo_id);
			// Si el nombre del grupo de destino es distinto al original se elimina el alumno del grupo
			if($grupo != $gg) borrar_del_grupo($grupo_id,$alumnos);
		}
	// Actualizo cada uno de los alumnos	
		foreach ($alumnos as $alumno) {
				actualizar_alumno($operacion,$alumno,$grupo,$destino);
			}	
	}

function borrar_del_grupo($grupo_id,$movidos){
	// Borra los alumnos seleccionados del grupo cuando se mueven
	$query = "SELECT asignados FROM Grupos WHERE grupo_id='$grupo_id'";
	$result = mysql_query($query) or die(mysql_error());
	$row = mysql_fetch_row($result);
	
	$gs=explode(',', $row[0]);
	if(count($gs)==0) $al='';

	$actualiza=array_diff($gs, $movidos);
	$actualizado=implode(',', $actualiza);
	// echo ' actualiza ='.$actualizado;
	$query = "UPDATE Grupos SET asignados='$actualizado' WHERE grupo_id='$grupo_id'";
	$result = mysql_query($query) or die(mysql_error());
	// echo 'Actualizo los asignados a un grupo '.$query;

	return $result;

}
function alumno_grupos($alumno){
	// Obtiene los grupos de un alumno	
	$query = "SELECT grupos FROM Alumnos WHERE Alumno_id='$alumno'";
	$result = mysql_query($query) or die(mysql_error());
	$row = mysql_fetch_row($result);	
	// echo 'Obtengo los los grupos de un alumno '.$query;
//Arreglo los grupos
	if(strlen($row[0])==0) $gs=array();
	else $gs=explode(',', $row[0]);
	return $gs;
}		


function actualizar_alumno($operacion,$alumno,$grupo_nombre,$destino){
	// Actualiza elos grupos de un alumno
		// operacion: Mover o Copiar
		// alumno: id del alumno
		// grupo_nombre: nombre del grupo origen
		// destino: nombre del grupo destino

		// el grupo origen se mete dentro del Grupo final
		$grupo[]=$grupo_nombre;
		// echo ' grupo final --> ';
		// var_dump($grupo);
		// echo ' <fin de grupo final> ';
	// print_r($grupo);
	switch ($operacion) {
		// 
		case 'copiar':
			//Obtengo los grupos del alumno
			$grupos_del_alumno = alumno_grupos($alumno);
			//Si no tiene grupos le introduzco el grupo origen
			if(count($grupos_del_alumno)==0) $al=$grupo;
			// en caso contrario le añado el grupo_nombre
			else{
				$al=array_merge($grupos_del_alumno,$grupo);
				$al=array_unique($al);
			}

			$asignados=implode(',', $al);			
			// echo ' <copiar> asignados = '.$asignados;
		
			break;
		
		case 'mover':
			# code...
			$grupos_del_alumno = alumno_grupos($alumno);
			// echo 'OOOOO ->';
			// print_r($grupo_nombre);
			if(in_array($grupo_nombre, $grupos_del_alumno)) {
			// $actualiza=array_diff($grupos_del_alumno, $grupo);
			// $asignados=implode(',', $actualiza);
			
				if(($key = array_search($grupo_nombre, $grupos_del_alumno)) !== false) {
	    		unset($grupos_del_alumno[$key]);
				}
				if(count($grupos_del_alumno)==0) $grupos_del_alumno[]=$destino;
				$asignados = implode(',', $grupos_del_alumno);

				// echo ' <mover> asignados = '.$asignados;
			}else{
				$asignados = $destino;
			}
			break;
		
		default:
			# code...
			break;
	}
		$query = "UPDATE Alumnos SET grupos='$asignados' WHERE Alumno_id='$alumno'";
			// echo $query;
		$result = mysql_query($query) or die(mysql_error());

}


?>
