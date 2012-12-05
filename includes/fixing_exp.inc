<?php
//En basics.php
/*function get_fechas($idA=null){
	if($idA!=null){
		$sql="SELECT Fechas FROM Expedientes WHERE idAlumno=$idA";
		$query=mysql_query($sql) or die (mysql_error());
		$row=mysql_fetch_row($query);
//		var_dump($row[0]);
		if(strlen($row[0])!=0){
			 $fechas=explode(",",$row[0]);

		}
		else $fechas=null;
		return $fechas;
	}else return false;
}
function get_notas($idA=null){
	if($idA!=null){
		$sql="SELECT notas FROM Expedientes WHERE idAlumno=$idA";
		$query=mysql_query($sql) or die (mysql_error());
		$row=mysql_fetch_row($query);
		if(strlen($row[0])!=0) $notas=explode(",",$row[0]);
		else $notas[]=null;
		return $notas;
	}else return false;
}
function walk_idA_alumnos(){
	$sql="SELECT Alumno_id FROM Alumnos ORDER BY Apellidos";
	$query=mysql_query($sql) or die (mysql_error());
	while($row=mysql_fetch_row($query)){
		$idAl[]=$row[0];
	}	
	return $idAl;
}
function give_their_data($idA){
	$sql="SELECT Apellidos,Nombre,DNI FROM Alumnos WHERE Alumno_id=$idA LIMIT 1";
	$query=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_row($query);
	return $row;
}
function get_pruebas($idA=null){
	if($idA!=null){
		$sql="SELECT pruebas FROM Expedientes WHERE idAlumno=$idA";
		$query=mysql_query($sql) or die (mysql_error());
		$row=mysql_fetch_row($query);
		if(strlen($row[0])!=0) $pruebas=explode(",",$row[0]);
		else $pruebas[]=null;
		return $pruebas;
	}else return false;
}

* 
* 
* 
*/

function walk_idA_exp(){
	$sql="SELECT idAlumno FROM Expedientes ORDER BY idAlumno";
	$query=mysql_query($sql) or die (mysql_error());
	$idAl=Array();
	while($row=mysql_fetch_row($query)){
		$idAl[]=$row[0];
	}	
	if(count($idAl)>1) return $idAl;
	else return false;
}


function large_expediente(){
//Devuelve el idA con mas fechas
	$n_fechas=0;
	$max=0;
	$idA_max=0;
	$w=walk_idA_exp();
//	var_dump($w);
	if($w){
	//else return false;
		foreach($w as $idA){
			$n_fechas=count(get_fechas($idA));
//		echo '>'.$idA.'< tiene '. $n_fechas.'<br />';
			if($n_fechas>$max){
				$idA_max=$idA;
				$max=$n_fechas;
//			echo 'el max es '.$idA;
			}	
		}
	unset($w);
	}return $idA_max;
}
function check_and_fix($idA_max){
	$sql="SELECT Fechas FROM Expedientes WHERE idAlumno=$idA_max";
	$query=mysql_query($sql) or die (mysql_error());
	$row=mysql_fetch_row($query);
	$fechas=explode(",",$row[0]);// el array fechas contiene el numero maximo de fechas de las convocatorias.
	$n=count($fechas); 
	$alumnos=walk_idA_exp();
	$matriculados=walk_idA_alumnos();

	foreach($matriculados as $key=>$idA){
		$t=get_pruebas($idA);
		if($t[0]==null){
			$sql="INSERT INTO Expedientes (idAlumno) VALUE ('$idA')";
			$query=mysql_query($sql) or die(mysql_error());
			$fechas_de=Array();
			$notas_de=Array();
			$pruebas_de=Array();
			echo 'expediente creado!<br />';
		}else{
		$fechas_de=get_fechas($idA);
		$notas_de=get_notas($idA);
		$pruebas_de=get_pruebas($idA);
		}
//Tengo los datos
		$n_de=count($fechas_de);
		if($n==$n_de) continue;
		echo $idA.'---<br />';
				echo 'fechas<br />';
		show_arr($fechas);
		echo 'fechas del otro<br />';
		show_arr($fechas_de);		
		echo 'diferencia<br />';
//		$comp=array_diff_assoc($fechas,$fechas_de);
		$comp=array_diff($fechas,$fechas_de);
//		$comp2=array_diff($fechas_de,$fechas);
		show_arr($comp);
		echo '<hr />';


//		echo '....<br />';
		foreach($comp as $fcha){
			array_push($fechas_de,$fcha);
			array_push($notas_de,'np');
			array_push($pruebas_de,'---');
		}
			asort($fechas_de);
//		$fechas_de=array_reverse($fechas_de);
//		show_arr($fechas_de);
		foreach($fechas_de as $k=>$v){
			$new_fechas[]=$v;
			$new_notas[]=$notas_de[$k];
			$new_pruebas[]=$pruebas_de[$k];
		}
		foreach($new_fechas as $k=>$v){
//			echo $new_pruebas[$k].' el '.$v.' con nota '.$new_notas[$k].'<br />';
		}

//paso a string		
		$str_pruebas=implode(",",$new_pruebas);
		$str_notas=implode(",",$new_notas);
		$str_fechas=implode(",",$new_fechas);
//libero los arrays
		unset($pruebas_de);
		unset($notas_de);
		unset($fechas_de);
		unset($new_fechas);
		unset($new_notas);
		unset($new_pruebas);
		
		$sql="UPDATE Expedientes SET pruebas='$str_pruebas',notas='$str_notas',Fechas='$str_fechas' WHERE idAlumno= '$idA'";
		$query=mysql_query($sql) or die(mysql_error());
	}
}

function get_by_date($fecha=null){
	if($fecha!=null){
		$al=walk_idA_alumnos();
		foreach($al as $k=>$v){
			$datos=give_their_data($v);
			$al_fcha=get_fechas($v);
			$al_ntas=get_notas($v);
			foreach($al_fcha as $kf=>$fcha){
				if($fcha==$fecha){
						$nota[]=$al_ntas[$kf];
//					echo 'alumno '.$datos[0].' nota '.$al_ntas[$kf].'<br />';
				}
			}
		}
		unset($al);
		unset($nota);
		unset($al_fcha);
		unset($al_ntas);
		unset($datos);
	}

}

function array_options($array=null,$form='select_form',$name='name'){
	if($array!=null){
//Campos
	$select_tbl=$name.'_tbl';
	echo "<form name='$form' action='#'>";
	echo "<SELECT NAME='$select_tbl' SIZE='1'>";
	while ($array){
		$value=array_pop($array);
		echo "<OPTION VALUE='".$value."' name='".$name."'>".$value."</OPTION>";
	}
	echo "</SELECT> ";
	}
}

?> 
