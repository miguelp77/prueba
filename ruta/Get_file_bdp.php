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
	$archivo=upload_file();
//	$archivo=htmlspecialchars(trim($_POST['Archivo']));;
//	$Asig_id=htmlspecialchars(trim($_POST['Asignatura']));;	
	$Asig_id=0;
//	echo $archivo;
	$lineas=file($archivo); // muestra el contenido de cada parte del array
//Creo TEMA UNICO en la MATERIA elegida
	$nombre=solo_archivo($archivo);
	$sql="INSERT INTO Temas (fk_idAsignatura,Nombre) VALUES ('$Asig_id','Importado')";
	$query = mysql_query($sql) or die(mysql_error()) ;
	$th_id= mysql_insert_id();
	$sql="INSERT INTO Conceptos (fk_idTema,Nombre) VALUES ('$th_id','$nombre')";
	$query = mysql_query($sql) or die(mysql_error()) ;
	$idConcepto= mysql_insert_id();
	//$th_id es el identificador del TEMA unico utilizado en la IMPORTACION
	$dep=0;
	$i=0;
	$j=0;
	$enunciado=null;
	$semaforo=2;
	$pattern = '/[0-9]+\.+\-/'; //Enunciados
	$pattern2='/[a-h]+\)/'; //Respuestas
//	echo " Asignatura Id= ".$asignatura;
	foreach($lineas as $linea){

// Quito lineas en BLANCO		

		if(strlen($linea)<2) continue;
//NO las QUITO
//		if(strlen($linea)<2) $linea="<br />";
// Comienzo de enunciado		
		
		$linea=str_replace("\\","\\\\",$linea);	//MathJax			
		if(preg_match($pattern, $linea)){
			$linea=preg_replace($pattern,'', $linea);
			if($semaforo==0){
		//		$semaforo=2;
				$Cris="INSERT INTO Cuestiones (Asig_id,Enunciado,Conceptos) VALUES ('$Asig_id','$enunciado','$idConcepto')";
				$query = mysql_query($Cris) or die(mysql_error()) ;
				$q_id= mysql_insert_id();
				$enunciado=null;
			//	$linea=null; //Febrero 2011
			}else $semaforo=0;
			
//			$i++;
		}
		
// Comienzo de NUEVA respuesta a la cuestion
		if(preg_match($pattern2, $linea)){
			if(strlen($enunciado)>3) $semaforo=1;
			$linea=preg_replace($pattern2,'', $linea);
			$cuestion=$linea;
//			$j++;
			}
// Enunciado en VARIAS LINEAS			
		if($semaforo==0 ){
		 $enunciado.=$linea;
		 
		}
//Añado ENUNCIADO a una nueva CUESTION de BBDD
		if($semaforo==1){
			$semaforo=2;
			$Cris="INSERT INTO Cuestiones (Asig_id,Enunciado,Conceptos) VALUES ('$Asig_id','$enunciado','$idConcepto')";
			$query = mysql_query($Cris) or die(mysql_error()) ;
			$q_id= mysql_insert_id();
			$enunciado=null;
		//	$linea=null; //Febrero 2011
			}
//Añado RESPUESTAS a la CUESTION creada en la BBDD
		if($semaforo==2){ 
			$correcta=0;
			$accion="INSERT INTO Respuestas (Respuesta, Cuestion_id, Correcta,Porcentaje) VALUES ('$cuestion','$q_id','$correcta','-33')";
				mysql_query($accion) or die(mysql_error());	
		//	$linea=null; $cuestion=null;	
		}
	}
	redirect_to('admin_test.php');
	
function upload_file(){
	if ($_FILES["file"]["error"] > 0){
		echo "Error: " . $_FILES["file"]["error"] . "<br />";
  }
	if (file_exists("bdp/" . $_FILES["file"]["name"])){
//	echo $_FILES["file"]["name"] . " ya existe. Consulte con el administrador. ";
		return 'bdp/'.$_FILES["file"]["name"];
	}else{
		move_uploaded_file($_FILES["file"]["tmp_name"],"bdp/" . $_FILES["file"]["name"]);
		return 'bdp/'.$_FILES["file"]["name"];
	}	
}
?>
