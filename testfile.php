<?php
session_start();		
//Depura
ini_set('display_errors', 1);
error_reporting(E_ALL);
//Librerias
	require_once('includes/basics.php');
//BBDD
	$db=$_SESSION['db_name'];
	$link=conectar($db);

	$grupo_a=array('0');
	$grupo=join($grupo_a,',');
	var_dump($grupo);
	$gr=explode(',',$grupo);
	var_dump($gr);
//	echo $gr[1];
				$i=0;
				$p_num=0;
	$al=walk_idA_alumnos();//de Alumnos
	foreach($gr as $group){
	echo 'Grupo '.$group.'<hr />';	
		foreach($al as $k=>$v){
				$datos=give_their_data($v);
//				print_r($datos) .'<br />';				
				$al_fcha=get_fechas($v);
//				print_r($al_fcha).'<br />';
				$al_ntas=get_notas($v);
//				print_r($al_ntas).'<br />';
				$presentados_ids=array(0);

				foreach($al_fcha as $kf=>$fcha){
					if($fcha=='11-12-2011' && $datos[3]==$group){
						$nota[]=$al_ntas[$kf];
//					echo 'alumno '.$datos[0].' nota '.$al_ntas[$kf].'<br />';
						$i++;

//						$presentados_ids[]=$datos[2];
//						$presentados_ids[]=$v;
						if($i%2) echo "<div class=\"clear colorme\">";
						else echo "<div class=\"clear colorme odd\">";
						echo '<span class="c15">'.$datos[0].','.$datos[1].'</span>';
						echo '<span class="c15">'.$datos[2].'</span>';
						echo '<span class="c15">'.$datos[3].'</span>';
						echo '<span class="campo"> </span>';
						echo '<span class="c15">'.$al_ntas[$kf].'</span>';
						echo '</div>';
						if(!in_array($v,$presentados_ids))$presentados_ids[]=$v;
						$p_num++;
					}
				}
			}
		}
?>

