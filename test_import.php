<?php 
	session_start();
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');

	if(isset($_SESSION['db_name']))$db=$_SESSION['db_name'];
	else return false;
	conectar($db);
//Importar CUESTIONES y RESPUESTAS desde un archivo(.bdp) a una MATERIA seleccionada con TEMA unico
//AJAX desde import.js
	$unico=0;
//	$archivo=htmlspecialchars(trim($_POST['Archivo']));;
//	$Asig_id=htmlspecialchars(trim($_POST['Asignatura']));;	
	$archivo="se_ales_feb_99.bdp";
	$Asig_id=0;
	$lineas=file($archivo); // muestra el contenido de cada parte del array
//Creo TEMA UNICO en la MATERIA elegida

	$sql="INSERT INTO Temas (fk_idAsignatura,Nombre) VALUES ('$Asig_id','importado')";
//	$query = mysql_query($sql) or die(mysql_error()) ;
//	$th_id= mysql_insert_id();
	//$th_id es el identificador del TEMA unico utilizado en la IMPORTACION
	$i=0;
	$j=0;
	$enunciado=null;
	$semaforo=2;
	$pattern = '/[0-9]+\.+\-/'; //Enunciados
	$pattern2='/[a-h]+\)/'; //Respuestas
//	echo " Asignatura Id= ".$asignatura;
	foreach($lineas as $linea){

// Quito lineas en BLANCO		
		echo $linea." semaforo= ".$semaforo."<br />";
		if(strlen($linea)<2) continue;
//NO las QUITO
//		if(strlen($linea)<2) $linea="<br />";
// Comienzo de enunciado		
		$p1=0;
		if(preg_match($pattern, $linea)){
			$linea=preg_replace($pattern,'', $linea);
			$semaforo=0;
			$p1=1;
//			echo "enun"."<br />";
//			$i++;

		}

		if($semaforo==0 AND $p1==1){			
			$semaforo=1;
		}		
// Comienzo de NUEVA respuesta a la cuestion
		if(preg_match($pattern2, $linea)){
			if($enunciado) $semaforo=1;
			$linea=preg_replace($pattern2,'', $linea);
			$cuestion=$linea;
//			echo "respuesta"."<br />";
//			$j++;
			}
			

// Enunciado en VARIAS LINEAS			
		if($semaforo==0){ 
			$enunciado=$enunciado.$linea;
	
//			echo "Enunciado"."<br />";
		}
	echo " SEMAFORO= ".$semaforo."<br />";
//Añado ENUNCIADO a una nueva CUESTION de BBDD
		if($semaforo==1){
			$semaforo=2;
			$Cris="INSERT INTO Cuestiones (Asig_id,Enunciado) VALUES ('$Asig_id','$enunciado')";
//			$query = mysql_query($Cris) or die(mysql_error()) ;
//			$q_id= mysql_insert_id();
			$enunciado=null;
			}
//Añado RESPUESTAS a la CUESTION creada en la BBDD
		if($semaforo==2){ 
			$correcta=0;
	//		$accion="INSERT INTO Respuestas (Respuesta, Cuestion_id, Correcta,Porcentaje) VALUES ('$cuestion','$q_id','$correcta','-33')";
	//			mysql_query($accion) or die(mysql_error());	
			}
	}
//	mysql_close($conexion); // cierra la conexion con la base de datos
//	echo $i." preguntas importadas correctamente.<br /> Respuestas importadas: ".$j.".<br /> Origen: ".$archivo;
?>
