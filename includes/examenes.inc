<?php
//OJO con usarla con basics.php
//Aqui define otro monitor() 
//Hay que depurarlo


//Devuelve el nombre del concepto segun su ID
	function conceptos_translate($idConcepto=NULL){
		if($idConcepto!=NULL){
			$sql="SELECT Nombre FROM Conceptos WHERE idConcepto='$idConcepto'";
			$query=mysql_query($sql) or die(mysql_error());
		 	$row=mysql_fetch_row($query);
		 	echo $row[0];
		}
	}
//Numero de elementos de una cadena	
	function conceptos_numero($string){
		$arr=explode(",",$string);
		return count($arr);
	}
//Nombre de los conceptos pasados por una cadena de IDs 
	function conceptos_lista($string){
		$arr=explode(",",$string);
		foreach ($arr as $key => $value){
			echo conceptos_translate($value);
		}
		echo "<br />";
	}
//Nombre de los conceptos de pasado por un array de IDs
	function conceptos_lista_array($arr){
		foreach ($arr as $key => $value){
			echo conceptos_translate($value);
			echo "<br />";
		}
	}
//ACTUALIZA el numero de conceptos que tiene una cuestion	
	function conceptos_update($idQ,$nConceptos=0){
		$sql="UPDATE Cuestiones SET Q_id ='$nConceptos' WHERE Cuestion_id='$idQ' ";
		$query=mysql_query($sql) or die(mysql_error());
	}
//	
	function conceptos_usados($string,$array){
		$arr=explode(",",$string);
		foreach ($arr as $key => $value){
			if(!in_array($value,$array)) array_push($array,$value);
		}
		if(strlen($string)<1)array_pop($array);
		return $array;
	}	
//Devuelve un array con los ID de las preguntas rnd	
	function preguntas(){
		$array=array();
		$sql="SELECT Cuestion_id FROM Cuestiones";
		$query=mysql_query($sql) or die(mysql_error());
		while($row=mysql_fetch_row($query)){
			array_push($array,$row[0]);
		}
		shuffle($array);
		return $array;
	}
//NO SE USA	
function listar_n($n){
		$array= preguntas();
		$i=0;
		array_unshift($array,"17");  //////why?
		array_unshift($array,"1");  //////why?
		$pregs=array();
	//	print_r($array);
		echo "<br />";	
		while($n>0){	
			$Q=array_shift($array);	
			array_push($pregs,$Q);
			$i++;
			$sql="SELECT * FROM Cuestiones WHERE Cuestion_id=$Q";
			$query=mysql_query($sql) or die(mysql_error());

			$row=mysql_fetch_assoc($query);
			//	echo $row['Cuestion_id']." => ".$row['Conceptos']."<br />"; 
				$idQ=$row['Cuestion_id'];
			
			echo "<div class='num' name='$idQ'></div>";
				echo "<hr /><b><div class='num'>".$i."</div></b>";

				echo GetEnunciado($idQ);
				echo "<img src='".GetImage($idQ)."' alt='' />" ;
			echo "<form>";
				echo GetAnswers($idQ);

			echo "<br /></form>";
			$n--;
			}	
			print_r($pregs);
}

function temas_conceptos(){
	$sql="SELECT * FROM Temas";// WHERE fk_idAsignatura='$idAsignatura'";
	$result1=mysql_query($sql);
	while($row1= mysql_fetch_object($result1)){
		$idTema=$row1->idTema;
		echo "<span class='tema' name='$idTema'><u>".$row1->Nombre."</u></span>".'<br />';
		$sql2="SELECT * FROM Conceptos WHERE fk_idTema='$idTema'";
		$result2=mysql_query($sql2);
		while ($row= mysql_fetch_object($result2)){
			echo '<li>';
			echo "<span class='caja_20' title=\"$row->Descripcion\">".$row->Nombre."</span>";
			echo "<input type=\"checkbox\" title =\"$row->Descripcion\" name=\"respuesta\" value=\"$row->idConcepto\"/>";
			echo '</li>';
		}
	}
}
function conceptos_en($idQ,$val=null){
	$sql="SELECT Conceptos FROM Cuestiones WHERE Cuestion_id=$idQ";
	$query=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_row($query);
		//	if($row[0]){
	echo "<b>Cuestion $idQ</b><br />";
	$arr=explode(",",$row[0]);
	foreach($arr as $key => $value){
		echo $value."<br />";
	}
	if(empty($row)) die();
	if(in_array($val,$arr)) echo "el valor $val esta";
	else echo "el valor $val no esta";
	echo "<br />";
}
//Definida en basics.php
/*
function alumno_listar(){
	$sql="SELECT Nombre,Apellidos,DNI,examenes,Alias,Psw FROM Alumnos";
	$query=mysql_query($sql) or die(mysql_error());
	while($row=mysql_fetch_row($query)){
		if(!isset($row[3]))$row[3]="vacio";
		echo "<spam title='$row[4] $row[5]'>".$row[0]." ".$row[1]." >".$row[3]."<</spam><br />";
	} 
}
*/
//Definida en basics.php
/*
function monitor(){
	$db=$_SESSION['db_name'];
	$sql="SELECT * FROM asg_admin.Alumnos WHERE asignatura= '$db'";
	$query=mysql_query($sql) or die(mysql_error());
	while($row=mysql_fetch_row($query)){
		echo "<hr />";
		echo "<spam class='alumno' title='user: $row[4] status: $row[6]'>";
		echo $row[1]."   ".$row[2]." <b>".$row[6]."</b></spam>";
	//	echo $row[8];
	}
}
*/ 
function n_examenes_max(){
	$sql="SELECT examenes FROM Alumnos";
	$query=mysql_query($sql);
	$max=0;
	while($row=mysql_fetch_row($query)){
		$ae=explode(",",$row[0]);
		$cae=count($ae);
		if($cae>$max) $max=$cae;
	}
	return $max;
}
function str_examenes($idA){
	$sql="SELECT examenes FROM Alumnos WHERE Alumno_id=$idA";
	$query=mysql_query($sql);	
	$row=mysql_fetch_row($query);
	return $row[0];
}

function examenesAsignados(){
	$sql="SELECT examenes FROM Alumnos";
	$query=mysql_query($sql);
	$row=mysql_fetch_assoc($query);
	$examenes=get_examenes($row['examenes']);
	if(strlen($examenes[0])>=1){
		echo '<u>Proximos examenes</u><br />';
		foreach($examenes as $val){
			$source_name=source_name($val);
			echo '<span class="marco2" title="'.$source_name.'">'.$val.'</span>';
			}	
	}
}

?>
