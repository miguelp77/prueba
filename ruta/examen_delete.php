<?php
	session_start();
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		$conn=conectar($db);
	}else redirect_to('admin_test.php');
//Obtengo
	$idExamen = $_POST['idExamen'];
	$grupo    = $_POST['grupo'];

	// Leo los examenes que tiene el grupo
	$id_examenes=array();
	// Obtengo el array de examenes que tiene el grupo
	$id_examenes = list_ex_grupo($grupo);

	// $sql="SELECT tipo FROM Grupos WHERE nombre = '$grupo' LIMIT 1";
	// $query=mysql_query($sql) or die(mysql_error());
	// $row=mysql_fetch_row($query);
	// if(count($row[0])>=1)
	// $id_examenes = explode(',', $row[0]);

	// Elimino el id de examen del grupo
	foreach ($id_examenes as $key => $value) {
		if($value == $idExamen) unset($id_examenes[$key]);
	}

	var_dump($id_examenes);

	// Lo combierto en string para almacenarlos
	$tipos = implode(',', $id_examenes);

	// Actualizo los examenes del grupo
	$sql="UPDATE Grupos SET tipo='$tipos' WHERE nombre='$grupo' LIMIT 1";
	$query=mysql_query($sql) or die(mysql_error());

	unset($id_examenes);
	
	//Actualizo a los alumnos que pertenecen a ese grupo
	
	// Obtengo los alumnos del grupo
	$sql="SELECT asignados FROM Grupos WHERE nombre='$grupo' LIMIT 1";
	$query=mysql_query($sql) or die(mysql_error());

	$alumnos  = array();
	$examenes = array();
	
	while ($row=mysql_fetch_row($query)) {
		if(!empty($row[0])){
			if(strlen($row[0])<2) $alumnos = $row[0];
			else $alumnos = explode(",", $row[0]);
		}
	}
	// Se le asigna a cada alumno la prueba

	foreach ($alumnos as $alumno) {
	//Obtengo los examenes que ya tiene asignados	
		$examenes=get_examen($alumno);
	//Le añado el nuevo

	// Elimino el id de examen del alumno
	if(($key = array_search($idExamen, $examenes)) !== false) {
    unset($examenes[$key]);
	}


	//Actualizo los examenes del alumno
		$examenes_str=implode(",", $examenes);
		update_examen($alumno,$examenes_str);
	}


	mysql_close($conn);

?>
