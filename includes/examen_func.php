<?php
function topdf($fuente,$destino){
	$fuente="http://localhost/pfc/".$fuente;
	if (!isset($destino))$destino="~/pfc/img/local2.pdf";
	passthru("~/pfc/./wkhtmltopdf-i386 ".$fuente." img/local2.pdf");
	echo "Done!";
}
function tex_to_png($my_eq,$eq_name){
	$my_file = "test.tex";
	$img_path= "~/pfc/img/";
	$img_path= $img_path . $eq_name . ".png";
	if(strlen($my_eq) == 0) 
		$my_eq='-- imagen';
	passthru('cd ~/pfc');
	$FileHandle = fopen($my_file, 'w')
		or die("No puedo abrir el archivo");
	fwrite($FileHandle, $my_eq);
	fclose($FileHandle);
	$ok =	passthru("~/pfc/tex2im/./tex2im -o $img_path -z=1 ~/pfc/test.tex");
//echo ("~/pfc/tex2im/./tex2im -o $img_path -z=1 ~/pfc/test.tex");
//		passthru('~/pfc/tex2im/./tex2im -o "$img_path" -r "80x80" -z=1  ~/pfc/test.tex');
//	echo ("$img_path");	
//	echo "Done";
return $img_path . $ok;
}

function GetEnunciado($q_id){
	Conectar();
	$request="SELECT Enunciado FROM Cuestiones WHERE Cuestion_id='$q_id'";
	$sql=	mysql_query($request);
	$result =mysql_fetch_array($sql);	
	echo $result[0];

}

function GetRelativeNumber($q_id){
	Conectar();
	$result="SELECT Cuestion_id FROM Cuestiones WHERE Cuestion_id= '$q_id' ";
	$cuestiones =mysql_query($result);
	$cuestion=mysql_fetch_array($cuestiones);
	echo $cuestion[0];
	
	}
function GetNCuestion($q_id){
	Conectar(); 
	$result="SELECT Q_id FROM Cuestiones WHERE Cuestion_id= '$q_id' ";
	$cuestiones =mysql_query($result);
	$cuestion=mysql_fetch_array($cuestiones);
	return $cuestion[0];
// Recibe el identificador autoincrementado. Devuelve el identificador 
// ordenado. 	
	}
function GetImage($q_id){
	Conectar();
	$result="SELECT Imagen FROM Cuestiones WHERE Cuestion_id= '$q_id' ";
	$cuestiones =mysql_query($result);
	$cuestion=mysql_fetch_array($cuestiones);
	return $cuestion[0];
	
	}
	
function GetImage2($q_id){
	Conectar();
	$result="SELECT Imagen_aux FROM Cuestiones WHERE Cuestion_id= '$q_id' ";
	$cuestiones =mysql_query($result);
	$cuestion=mysql_fetch_array($cuestiones);
	echo $cuestion[0];
	}
//Respuestas
function GetAnswers($q_id){
	Conectar();
	$LastId = 0;
	$query = "SELECT * FROM Respuestas WHERE Cuestion_id= '$q_id' ORDER BY 'Resp_id' ASC";
	$result = mysql_query($query);
	echo '<ul class="abclist '.$q_id.'">';
	while($answer_row= mysql_fetch_array($result)){
			if ($answer_row['Ultima']==1){
			$LastOne = $answer_row['Respuesta'];
			$LastId = $anwer_row['Resp_id'];
			//	echo "kuku";
				continue;
			}

			echo '<li>';
			echo '<input type=radio id="its" name="its" value="',$answer_row['Resp_id'], '"/>';
			echo $answer_row['Respuesta'];
			echo '</li>';
		//	echo '<img class="dcha" src="img/tick.gif" />';
		$n=$q_id;
	//SCRIPT Desordeno respuestas
	echo "<script >  $('ul.abclist.'+$n+' li').shuffle(); </script>";
	}
	//Coloco la ultima posibilidad
	if($LastId !== 0) echo '<li><input type="radio" id="its" name="its" value="'.$LastId.'"/>'.$LastOne.'</li>';
	echo "</ul>";
}
/*	
function GetEq($num){
	//$conn = Conectar();
	
	//Conectar();
	$query='SELECT * FROM Ecuaciones';
	$result =mysql_query($query);
	$number=mysql_num_rows($result);
	$pag=$number/5;

	$inicio=0+($num*5);
	$fin=5+($num*5);
//	echo $inicio."-".$fin;
	$query= "SELECT * FROM Ecuaciones ORDER BY eq_id ASC LIMIT $inicio,5";// LIMIT 0," .$pag."'";
	$result =mysql_query($query);
	//echo mysql_num_rows($result);
//	$Ecuaciones=mysql_fetch_array($result);
//	echo "<div id='imagenes'>";
	$i=$inicio-1;
	while($Ecuaciones= mysql_fetch_array($result))
		{
			$i++;
			echo "<div class='imgtext'>";//.$Ecuaciones['eq_exp']." -- -- ".$i."</div>";
			
			
			echo"<div class='pngs'>"."<input type='radio' name='oo'>"."<img class='redondear ".$i."' src=".$Ecuaciones['eq_path']." title=".$Ecuaciones['eq_path']."/>"."</div>";
			echo "<div class='imginfo'>"." Expresion: ".$Ecuaciones['eq_exp']. "<br/>";
			echo "  Archivo: ".$Ecuaciones['eq_path'];
			echo "</div></div>";
			if(($i%1)==0) echo "<br/>";
		}

/*	echo "<br />".$number. " imagenes en ".intval($pag)." paginas";
	echo "<br />".$inicio;
	echo "<br />".$fin;
*/	
/*}*/
/*
function Paginas(){
	$conn = Conectar();
	$i=0;
	//Conectar();
	$query='SELECT * FROM Ecuaciones';

	$result =mysql_query($query);
	$number=mysql_num_rows($result);
	$pag=$number/5;
	//$inicio=0+($num*5);
	//$fin=5+($num*5);
	if (($number%5)==0) $pag=$pag-1;
	for($j=0;$j<=$pag;$j++)
		{
			if($j==0)
				echo "<span class='paginaa'>".$j."</span>";
			if($j!=0)
				echo "<span class='pagina'>".$j."</span>";
		}
}
*/
/*
function GetQ($num){
//Sin usar, al final no hago paginacion
	$query='SELECT * FROM Cuestiones';
	$result =mysql_query($query);
	$number=mysql_num_rows($result);
	$pag=$number/5;
//	$num=1;
	$inicio=0+($num*5);
	$fin=5+($num*5);
	$query= "SELECT * FROM Cuestiones ORDER BY Q_id ASC LIMIT $inicio,5";// LIMIT 0," .$pag."'";
	$result =mysql_query($query);

	$i=$inicio-1;

	while($Cuestiones= mysql_fetch_array($result))
		{
		echo "<div id='contenido'>";
		$i++;
		echo "<div class='ficha'>
				<div id='pregunta'>
				<span class=''>#".$Cuestiones['Q_id']."</span><br/>
				<div id='imagen1'>";
		if ($Cuestiones['Imagen']!=""){
	 	echo '<img src="';
		echo $Cuestiones['Imagen'];
		echo '"/>';
		}
	echo "</div>
			<div class='clear'></div>
			<div id='imagen2'>";
	if ($Cuestiones['Imagen_aux']!=""){
		echo '<img src="';
		echo $Cuestiones['Imagen_aux'];
		echo '"/>';
		}
	echo" </div>
			<div id='enunciado'>";
	echo	$Cuestiones['Enunciado'];
	GetAnswers($Cuestiones['Cuestion_id']); 
	echo "</div>		
		<div id='respuestas'>";
	echo "</div></div></div></div><br/>";

				
		}
}
*/
function MakeEx(){
//Usada en showQs.php examene.php
	$conn = Conectar();
	$query='SELECT * FROM Cuestiones';
	$result =mysql_query($query);
	$number=mysql_num_rows($result);
	$i=0; 
	$query= "SELECT * FROM Cuestiones ORDER BY Q_id ASC ";// Elijo los Q_id
	$result =mysql_query($query);
	$numQ=9; //Nunmero de preguntas que quiero ver
	if(isset($_COOKIE["Examen"])){
		echo "El examen fue creado anteriormente";
	}
//Primera pregunta
	$aleatorio=rand(1,$number);
	$lista[]=$aleatorio;
	while ($numQ!==0){
		$aleatorio=rand(1,$number); //Tomo otra pregunta
	//Compruebo que no existe 	//La añado a la lista de preguntas
		if(in_array($aleatorio, $lista)){		 
			$numQ++;
			}
		else{ 
			$lista[]=$aleatorio;
			}
	$numQ--;
	}
	//Array a serie
	$serie=serialize($lista);
	$_SESSION['examen']=$serie;
	return $serie;
		if(!isset($_COOKIE["Examen"]))
			$_COOKIE("Examen",$serie);
}
function Examen($ex){
	Conectar();
//	echo $_COOKIE["USER"];
//	echo ' tu identificador de examen es '.$_COOKIE["ID"];
//	$examen=$_SESSION['SS_examen'];
	echo $_SESSION['SS_examen'];
//	if(!$exp) echo 'kk';
	$examen=$ex;//$_COOKIE["Examen"];
	$lista=unserialize($examen);
//	print_r($lista);
	echo '<div class="page">';
	foreach($lista as $name => $value){
		$query= "SELECT * FROM Cuestiones WHERE Q_id='$value'";// LIMIT 0," .$pag."'";
		$result =mysql_query($query) or die();
		while($Cuestiones= mysql_fetch_array($result)){	
				$i++;
				if(($i-1)%3==0 && $i>1){
					echo '<div class="page-break" ></div>';
					}
				echo "<div class='ficha'><div id='pregunta'><span class=''>#".$i."</span><br/><div id='imagen1'>";
				if ($Cuestiones['Imagen']!=""){
		 			echo '<img src="'.$Cuestiones['Imagen'].'"/>';
					}
				echo "</div><div class='clear'></div><div id='imagen2'>";
				if ($Cuestiones['Imagen_aux']!=""){
					echo "<img src='".$Cuestiones['Imagen_aux']."'/>";
					}
				echo"</div><div id='enunciado'>".$Cuestiones['Enunciado'];
				GetAnswers($Cuestiones['Cuestion_id']); 
				echo "</div><div id='respuestas'></div></div></div><br/>";
				}
			}
		echo '<div class="clear" id="pie">Departamento de Teoría de la Señal y Comunicaciones</div></div>';
		$serie=serialize($lista);
		$unserie=unserialize($serie);
}
/*
function Cuestiones(){
	$conn = Conectar();
	$i=0;
	//Conectar();
	$query='SELECT * FROM Cuestiones';
	$result =mysql_query($query);
	$number=mysql_num_rows($result);
	$pag=$number/5;
	//$inicio=0+($num*5);
	//$fin=5+($num*5);
	if (($number%5)==0) $pag=$pag-1;
	for($j=0;$j<=$pag;$j++)
		{
			if($j==0)
				echo "<span class='PagQs'>".$j."</span>";
			if($j!=0)
				echo "<span class='PagQ'>".$j."</span>";
		}
}
*/
function showConceptos(){
	$conn = Conectar();
	$idAsignatura=($_COOKIE['Galle']);
//	echo 'galleta='.$idAsignatura.'<br />';
	$query1="SELECT * FROM Temas WHERE fk_idAsignatura='$idAsignatura'";
	$result1=mysql_query($query1);
	echo '<pre>';
	while($row1= mysql_fetch_object($result1)){
		$idTema=$row1->idTema;
		echo $row1->Nombre.'<br />';
		$query="SELECT * FROM Conceptos WHERE fk_idTema='$idTema'";
		$result=mysql_query($query);
		while ($row= mysql_fetch_object($result)){
			echo "<input type=\"checkbox\" value=\"$row->Nombre\"/>";
			echo $row->Nombre;
			echo '<br />';
		}
	}
	echo '</pre>';		
}

?>
