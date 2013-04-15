<?php
	session_start();
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		$conn=conectar($db);
	}else redirect_to('admin_test.php');
//Obtengo
	$idExamen=$_POST['idExamen'];
	// Recojo el grupo al que empujo el examen
	$grupo=$_POST['grupo'];
	// $grupos=array();

	// Leo los examenes que tiene el grupo
	$id_examenes=array();

	$sql="SELECT tipo FROM Grupos WHERE nombre = '$grupo' LIMIT 1";
	$query=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_row($query);

	if(strlen($row[0])>=1)
		$id_examenes = explode(',', $row[0]);
	
	print_r($id_examenes);
	// Lo pongo en la cabeza
	$id_examenes[]=$idExamen;

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

	if(is_array($alumnos)){
		foreach ($alumnos as $alumno) {
	//Obtengo los examenes que ya tiene asignados	
			echo $alumno.' - ';
			$examenes=get_examen($alumno);
			echo $examenes.' - ';
	//Le añado el nuevo
			$examenes[]=$idExamen;

	//Actualizo los examenes del alumno
			$examenes_str=implode(",", $examenes);
			echo $examenes_str.' - ';
			update_examen($alumno,$examenes_str);
		}
	}
	else{
		$examenes=get_examen($alumnos);
		$examenes[]=$idExamen;
		$examenes_str=implode(",", $examenes);
		update_examen($alumnos,$examenes_str);

	}

	mysql_close($conn);

?>
