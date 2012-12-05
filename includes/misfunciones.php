<?php
function topdf($fuente,$destino){

	$fuente="http://localhost/pfc/".$fuente;
	$destino="~/pfc/img/local2.pdf";
	passthru("~/pfc/./wkhtmltopdf-i386 --javascript-delay 10000 ".$fuente." img/local2.pdf");
	echo "Done!";
	//Retrasamos para que le de tiempo a js a terminar
	//./wkhtmltopdf-i386 --javascript-delay 20000 http://www.mathjax.org/demos/tex-samples/ miguel.pdf 
}
function tex_to_png($my_eq,$eq_name){
		$my_file = "test.tex";
		$img_path= "~/pfc/img/";
		$img_path= $img_path . $eq_name . ".png";

		if(strlen($my_eq) == 0) 
			 $my_eq='-- imagen';
		passthru('cd ~/pfc');
	//echo passthru('dir');
//		$my_eq = "f(x) = \sqrt{1+x} \quad (x \ge -1 )";
		$FileHandle = fopen($my_file, 'w')
			or die("No puedo abrir el archivo");
		fwrite($FileHandle, $my_eq);
		fclose($FileHandle);
		
	//passthru('cd ~/pfc');
	$ok =	passthru("~/pfc/tex2im/./tex2im -o $img_path -z=1 ~/pfc/test.tex");
//echo ("~/pfc/tex2im/./tex2im -o $img_path -z=1 ~/pfc/test.tex");
//		passthru('~/pfc/tex2im/./tex2im -o "$img_path" -r "80x80" -z=1  ~/pfc/test.tex');
//	echo ("$img_path");	
//	echo "Done";
echo $ok;
//return $img_path . $ok;
}

function Conectar(){
//  $conn=@mysql_connect("localhost", "root", "p89er");
	$conn=@mysql_connect("localhost", "root", "hgm0686");
  mysql_select_db("asg_admin");
  return $conn;
}
function GetMateria($q_id){
//	Conectar();
//Tomo el id de la Asignatura a la que pertenece el id de Cuestion
	$request="SELECT Asig_id FROM Cuestiones WHERE Cuestion_id='$q_id'";
	$query=	mysql_query($request);
	$result=mysql_fetch_object($query);
//Tomo el Nombre de la Asignatura del id anterior
	$sql="SELECT Nombre FROM Materias WHERE idAsignatura=$result->Asig_id";
	$query=mysql_query($sql) or die(mysql_error());
	$result2=mysql_fetch_object($query);
	$name=$result2->Nombre;
	$_COOKIE["Nombre"]=$name;
	$_COOKIE['idAsig']=$result->Asig_id;
	$_SESSION['idAsig']=$result->Asig_id;
//	setcookie('idAsig',$result->Asig_id,3600);
//	echo 'Asignatura '.$result->Asig_id.' '.$result2->Nombre.'<br />';
}

function GetEnunciado($q_id=1){
	Conectar();
	//$Asig_id=$_COOKIE['Galle'];
//	$sql="SELECT Nombre FROM Materias WHERE idAsignatura=$Asig_id";
//	$query=mysql_query($sql);
//	$Nombre=mysql_fetch_object($query);
//	echo "Asignatura ".$Nombre->Nombre."<br />";
	$request="SELECT Enunciado,Asig_id FROM Cuestiones WHERE (Cuestion_id='$q_id')";
	$sql=	mysql_query($request);
	$result =mysql_fetch_array($sql);	
//	$sql="SELECT Nombre FROM Materias WHERE idAsignatura=$result[1]";
//	$query=mysql_query($sql);
//	$Nombre=mysql_fetch_object($query);
//	echo 'Asignatura '.$result[1].' '.$Nombre->Nombre.'<br />';
//	echo GetMateria($q_id);
	echo $result[0];
}

function GetRelativeNumber($q_id){
	Conectar();
	$Asig_id=$_COOKIE['Galle'];
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
//		$Asig_id=$_COOKIE['Galle'];
	$result="SELECT Imagen FROM Cuestiones WHERE Cuestion_id='$q_id'";
	$cuestiones =mysql_query($result);
	$cuestion=mysql_fetch_array($cuestiones);
	return $cuestion[0];
	
	}
function GetImage2($q_id){
	Conectar();
//	$Asig_id=$_COOKIE['Galle'];
	$result="SELECT Imagen_aux FROM Cuestiones WHERE (Cuestion_id='$q_id')";
	$cuestiones =mysql_query($result);
	$cuestion=mysql_fetch_array($cuestiones);
	echo $cuestion[0];
	}
function GetAnswers_editor($q_id){
	Conectar();
//	$Asig_id=$_COOKIE['Galle'];
	$_COOKIE['idQ']=$q_id;
	$query="SELECT * FROM Respuestas WHERE (Cuestion_id='$q_id') ORDER BY 'Resp_id' ASC";
	$result =mysql_query($query);
		//echo $q_id;
		echo '<ul class="abclist">';
	while($answer_row= mysql_fetch_array($result)){
		
		if ($answer_row['Correcta']== 1)
			{ 
	echo '<li><div class="'.$answer_row['Resp_id'].' ok">';
	echo '<img class="dcha" src="img/tick.png" />';
	echo $answer_row['Respuesta'];
		
		echo '<a href="#" class="botones'.$answer_row['Resp_id'].'" title="borrar" value="'.$answer_row['Resp_id'].'" ">
        <img src="./img/cross.png" alt=""/>
         </a>';
		echo '<a href="#" class="botones'.$answer_row['Resp_id'].'" title="editar" value="'.$answer_row['Resp_id'].'">
        <img src="./img/pencil.png" alt=""/>
         </a>';

					echo '</div></li>';
			continue;
		}
		echo '<li><div class="'.$answer_row['Resp_id'].'">';
			echo $answer_row['Respuesta'];
		//	echo '<img class="dcha" src="img/tick.gif" />';
		echo '<a href="#" class="botones'.$answer_row['Resp_id'].'" title="borrar" value="'.$answer_row['Resp_id'].'" ">
        <img src="./img/cross.png" alt=""/>
         </a>';
		echo '<a href="#" class="botones'.$answer_row['Resp_id'].'" title="editar" value="'.$answer_row['Resp_id'].'">
        <img src="./img/pencil.png" alt=""/>
         </a>';

					echo '</div></li>';
	}
	echo "</ul>";
	//$cuestion=mysql_fetch_array($cuestiones);
	//echo $cuestion['Imagen'];
	
	}
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
	
	//$cuestion=mysql_fetch_array($cuestiones);
	//echo $cuestion['Imagen'];
	
	}
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
}
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
function GetQ($num){
//Al final no hago paginacion
	$query='SELECT * FROM Cuestiones';
	$result =mysql_query($query);
	$number=mysql_num_rows($result);
	$pag=$number/5; //Para la paginacion
//	$num=1; //Para la paginacion
//	$inicio=0+($num*5); //Para la paginacion
//	$fin=5+($num*5); //Para la paginacion
	$query= "SELECT * FROM Cuestiones ORDER BY Q_id ASC";// LIMIT $inicio,5";// LIMIT 0," .$pag."'";
	$result =mysql_query($query);
	$i=$inicio-1;
	while($Cuestiones= mysql_fetch_array($result)){
		echo "<div id='contenido'>";
		$i++;
		echo "<div id='ficha $i'>";
			echo "<div class='pregunta'>";
		echo "<span class=''>#".$Cuestiones['Q_id']."</span><br/>
				<div class='imagen1'>";
		if ($Cuestiones['Imagen']!=""){
	 	echo '<img src="';
		echo $Cuestiones['Imagen'];
		echo '"/>';
		}
	echo "</div>
			<div class='clear'></div>
			<div class='imagen2'>";
	if ($Cuestiones['Imagen_aux']!=""){
		echo '<img src="';
		echo $Cuestiones['Imagen_aux'];
		echo '"/>';
		}
	echo" </div>
			<div class='enunciado'>";
	echo	$Cuestiones['Enunciado'];
	echo "<form>";
	GetAnswers($Cuestiones['Cuestion_id']); 
	echo "</form></div>		
		<div class='respuestas'>";
	echo "</div></div></div></div><br/>";

				
		}
}
function GetQs($num){
//Usada en showQs.php
	$query='SELECT * FROM Cuestiones';
	$result =mysql_query($query);
	$number=mysql_num_rows($result);
	$i=0;
	$matriz[$number];
	$query= "SELECT * FROM Cuestiones ORDER BY Q_id ASC ";// LIMIT 0," .$pag."'";
	$result =mysql_query($query);
	$numQ=3; //Nunmero de preguntas que quiero ver
	while($Cuestiones= mysql_fetch_array($result)){
		$matriz[]=$Cuestiones['Q_id']; //array con todos los Q_id de las cuestiones
		}
//	print_r ($matriz);
//	echo '<br />';
//Primera pregunta
		$aleatorio=rand(1,$number);
		$lista[]=$aleatorio;
	while ($numQ!==0) 
	{
		$aleatorio=rand(1,$number); //Tomo otra pregunta
	//Compruebo que no existe
		if( array_key_exists($aleatorio, $lista)) $i--;
	//La añado a la lista de preguntas
		$lista[]=$aleatorio;

		echo 'Pregunta #'.$i.' Cuestion '. $aleatorio;
		///AQUI EDITO
		$query= "SELECT * FROM Cuestiones WHERE Q_id='$aleatorio'";// LIMIT 0," .$pag."'";
		$result =mysql_query($query);
		while($Cuestiones= mysql_fetch_array($result))	
			{	
			echo "<div id='contenido'>";
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
			$i++;
		}
	$numQ--;
	}
	print_r($lista);
}

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
//Ordenar Cuestiones
function Orden_Q(){
	$conexion = Conectar();	
	$orden=0;
	$inicio=1;
	$Irene="SELECT Cuestion_id FROM Cuestiones ";
	$query = mysql_query($Irene);
	while($Yorch= mysql_fetch_array($query)){
		$orden++;
		$Sara="UPDATE Cuestiones SET Q_id='$orden' WHERE Cuestion_id= '$Yorch[0]'";
		$result =mysql_query($Sara) or die(mysql_error());
//		echo $Yorch[0].'---> '.$orden.'<br />';	
		echo $Qid;
		}
}


function showConceptos($idQ){
	$conn = Conectar();
//ASIGNATURA escogida anteriormente en una COOKIE	
//	$idAsignatura=($_COOKIE['Galle']);
	$Name=$_COOKIE['Nombre'];
	$idAsignatura=$_COOKIE['idAsig'];
//	$_COOKIE['idAsig']=$idAsignatura;
//if($idAsignatura=' ')exit;
//	echo "Hola ".$idAsignatura;
//Recorro los campos de la CUESTION mostrada
	$sql="SELECT * FROM Cuestiones WHERE Cuestion_id='$idQ'";
	$result=mysql_query($sql);	
//	echo 'galleta='.$idAsignatura.'<br />';
//Recorro los TEMAS de la ASIGNATURA
	$sql="SELECT * FROM Temas WHERE fk_idAsignatura='$idAsignatura'";
	$result1=mysql_query($sql);
//
	while ($row= mysql_fetch_object($result)){
		$a=$row->Conceptos;
//	print_r($row->Conceptos);//		print_r($a);//		echo gettype($a);//		echo " y despues ".gettype(unserialize($a))." ".unserialize($a);//	print_r($a);
//	echo "--";//	$a=unserialize($a);//	print_r($a);
	$Conceptos=explode(",",$a);
//	echo "Conceptos= ".gettype($Conceptos);//	print_r($Conceptos);
	}
	if ($Conceptos=='') die();
	echo '<pre>';
		echo '<b>'.$Name.'</b><br />';
	while($row1= mysql_fetch_object($result1)){
		$idTema=$row1->idTema;
		echo $row1->Nombre.'<br />';
		$sql2="SELECT * FROM Conceptos WHERE fk_idTema='$idTema'";
		$result2=mysql_query($sql2);
		while ($row= mysql_fetch_object($result2)){
		//	$a=$row->Conceptos;	//		echo "consulta ".gettype($a);//		$a=unserialize($a);//		echo gettype($a);
	//		echo $row->Nombre."  ".$row->idConcepto; //SOLO DEPURACION
	//		echo $row->Nombre; //COMENTADA POR DEPURACION	//	(n <= 1 ? " es" : " son")
			if(in_array($row->idConcepto,$Conceptos)){
		
				echo $row->Nombre;
				echo "<input type=\"checkbox\" title ='$row->Descripcion' value=\"$row->idConcepto\" checked/>";
				echo '<br />';		//	echo "Key exists!";
			}
			else{
				echo $row->Nombre;
				echo "<input type=\"checkbox\" title ='$row->Descripcion' value=\"$row->idConcepto\"/>";
				echo '<br />';
			}
		}
	}
	echo '</pre>'."<button class='setConcept'>Asignar</button>";		
}

function text_to_web($archivo){
	$lineas=file($archivo); // muestra el contenido de cada parte del array
	//	print_r($lineas);
	$i=0;
	$pattern = '/^[0-9]+\.+\-/'; //Enunciados
	$pattern2='/^[a-m]+\)/'; //Respuestas
	foreach($lineas as $linea){
		if(preg_match($pattern, $linea)){
			$i++;
			echo '<h3>Nueva pregunta '.$i.'</h3>';
			$linea=preg_replace($pattern,'', $linea);
			}
		if(preg_match($pattern2, $linea, $matches)){
			echo '<li></li>';
			}
					
			echo $linea;
	}
}

function SelMateria(){
	$conn=Conectar();
	$query="SELECT * FROM Materias";
	$result=mysql_query($query);
//	echo "<form method=\"post\" action='#'>";
	echo "<select name='Materia' id='Materia' SIZE='1' >";
	while ($row = mysql_fetch_object( $result ))
		{
	//anulo el valor de phpmyadmin
	//if($row->Database =="phpmyadmin") continue;
	   echo "<OPTION VALUE='$row->Nombre' ID='$row->idAsignatura'> $row->Nombre</OPTION>";
		}
	echo "</select> ";
	echo $row;
	echo "<input type='button' name='SelMateria' value='Seleccionar'/>";
	echo "<input type='text' id='Asig'/>";
	echo "<input type='button' name='newAsig' value='Añadir' />";
//	echo "</form>";
}

	function generatePassword($length=9, $strength=0) {
		$vowels = 'aeuy';
		$consonants = 'bdghjmnpqrstvz';
	if ($strength & 1) {
		$consonants .= 'BDGHJLMNPQRSTVWXZ';
	}
	if ($strength & 2) {
		$vowels .= "AEUY";
	}
	if ($strength & 4) {
		$consonants .= '23456789';
	}
	if ($strength & 8) {
		$consonants .= '@#$%';
	}
	$password = '';
	$alt = time() % 2;
	for ($i = 0; $i < $length; $i++) {
		if ($alt == 1) {
			$password .= $consonants[(rand() % strlen($consonants))];
			$alt = 0;
		} else {
			$password .= $vowels[(rand() % strlen($vowels))];
			$alt = 1;
		}
	}
	return $password;
}
function filtro_letras($cadena){
		return preg_replace("/[^a-zA-ZñÑ]/", "", $cadena);	
}
function generateUser($length=6, $user='aeuy') {
	$user .= 'aeuyab';
	$user=preg_replace("/[^a-zA-ZñÑ]/", "", $user);
	$consonants = '23456789';
	$ret = '';
	$alt = time() % 2;
	for ($i = 0; $i < $length; $i++) {
		if ($i > 2) {
			$ret .= $consonants[(rand() % strlen($user))];
			$alt = 0;
		} else {
			$ret .= $user[(rand() % strlen($user))];
			$alt = 1;
		}
	}
//	$regex  = '/[^a-zA-Z0-9_-]|anonymous|xxx|yyy/';
//	$oks='/[^a-zA-Z0-9_-]/';
//	$ret = preg_replace($regex, $oks, $ret); 
	//QUITO LOS ESPACIOS
	$ret=preg_replace("/\s+/", "", $ret);
	//QUITO LOS CARACTERES NO LATINOS
//	$ret=preg_replace("/[^a-zA-Z]/", "", $ret);
	return $ret;
	}

$acutes=array("&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&ntilde;","&NTILDE;");
$to_human = array ("á", "é", "í", "ó", "ú", "ñ", "ñ");
function to_human($cadena){
	$cadena=strtolower($cadena);
	$cadena=str_replace($GLOBALS["acutes"],$GLOBALS["to_human"],$cadena);
		
	return $cadena;
}
function redirect_to( $location = NULL ) {
  if ($location != NULL) {
    header("Location: {$location}");
    exit;
  }
}



?>
