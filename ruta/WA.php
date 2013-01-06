<?php
	session_start();
?>
<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>WorkAround</title>
</head>
<body>

<?php
	require_once('includes/db_tools.inc');
	require_once('includes/cuestiones.inc');	
	// $conn=mysql_connect(DB_SERVER,DB_USER,DB_PASS);
	// connect_to_db();
	
//	echo ALTER TABLE contacts ADD email VARCHAR(60);
// 	foreach ($_SESSION as $key => $value) {
// 		echo $value;
// 		echo '<br>';
// 	}
// echo "-_-";
if(isset($_SESSION['db_name'])){
		$base=$_SESSION['db_name'];
		// echo "Base seleccionada:<b> ".asg_name($base)."</b>";
	}
	$db=$base;
	$db=utf8_decode($db);	
	// $result = mysql_list_tables($db) or die(mysql_error());
	// $num_rows = mysql_num_rows($result);

	// $tabla = mysql_tablename($result, 0);

//Añadir el campo grupos a la tabla Alumnos
		// anadir_grupos_en_alumnos($tabla);
//Añadir a pdfprinter el campo rmks
	// anadir_rmks_pdfprinter($tabla);

	// inspecciona_tabla($tabla);
function pdfprinter(){
	$status='processing';
	$estado='ready';
	$marca=marca();
	$link=conectar('asg_admin');
		$sql="SELECT BBDD,idPDF,opciones,valores,rmks ";
		$sql .= "FROM pdfprinter ";
		// $sql .= "WHERE status='$estado' ";
		// $sql .= "LIMIT 1";
		$query=mysql_query($sql) or die(mysql_error());
		while($row=mysql_fetch_row($query)){
			  print_r($row);
        echo '<br />';
		 $sql="UPDATE asg_admin.pdfprinter SET status='$status',marca='$marca' WHERE idPDF= '$row[1]' LIMIT 1";
		 // $query=mysql_query($sql) or die(mysql_error());
		}	
	mysql_close($link);
	return $row;	
}

 pdfprinter();

function list_notas($db=null,$fecha=null,$rmks=null){
	$p_num=0; //numero de alumnos presentados	
	if($db!=null){
		$link=conectar($db);
		echo '<br /><b>Alumnos presentados.</b><br />';	
		echo '<hr />';		
		echo '<span class="c15">Apellidos,Nombre</span>';
		echo '<span class="c15">DNI</span>';
		echo '<span class="campo"></span>';
		echo '<span class="c15">Nota</span>';		
		echo '<br /><hr />';
// Comienza el loop
		$i=0;
		$presentados_ids=Array(); // IDs de los presentados
		// $miembros= Array();	// A que grupo pertenece cada ID
	//	$np_ids=Array();
	//	$np_total=Array();
		if($fecha!=null){
			// $al=walk_idA_alumnos();//de Alumnos

//Inicio de grupo
		$grupos=array();
		// var_dump($rmks);		
		if($rmks!=null){
			$grupos=explode(',',$rmks);
		}
		// var_dump($grupos);		
//Fin de grupo
		//Relleno los grupos
	// var_dump($al);
	// $ggg= give_their_data("2");
	// echo $ggg[3];
		// foreach ($al as $id) {
		// 	if($id[3] == )
		// }
	// foreach($grupos as $grupo){
	// 	echo '<br>'.$grupo.' -> ';
	// 	print_r(group_members($grupo));
	// }
	echo "<br>";


		foreach($grupos as $grupo){
			echo '<span class="c15"><br />GRUPO: '.$grupo.'</span><br />';
			$mem_string = group_members($grupo);
			$al=explode(",", $mem_string);
			foreach($al as $k=>$v){
				$datos=give_their_data($v);
				$al_fcha=get_fechas($v);
				$al_ntas=get_notas($v);
				// echo 'depura ';
				// var_dump($v);
				// echo '<br>';
				// if($al_fcha!=null) //Linea de depuracion
				foreach($al_fcha as $kf => $fcha){
					if($fcha==$fecha && $datos[3]==$grupo){
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
			}			
			$np_num=0;
		if(isset($nota)){	
			foreach($nota as $valor){
				if($valor=='np') $np_num++;
			}
		}
			$np_ids=array_diff($al,$presentados_ids);
//			echo '<b><br />Alumnos sin presentar<br /></b>';
			if($i>100)
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

// RESUMEN
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


		// $dba=pdfprinter();
		// var_dump($dba);
		// foreach ($dba as $clave => $value) {
			// echo 'clave = '.$clave.' valor = '.$value.'<br />';	
		// }
	
		// list_notas('asg_mike_10','10-03-2011','dummy,qqqqqqqq,test');

// list_notas($db,$opciones,)



















?>

</body>
</html>