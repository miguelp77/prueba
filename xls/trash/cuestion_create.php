<?php
	session_start();
	header ('Content-type: text/html; charset=utf-8');
	require_once('includes/misfunciones.php');
//	Orden_Q();
//Detectar si hay ASIGNATURA fijada
	conectar();
//	$sql="SELECT LAST_INSERT_ID();";
//	$query=mysql_query($query);
	
$idQ=$_SESSION['idQ'];
	$Asig_select=$_COOKIE['Galle'];
	if (!isset($Asig_select)||empty($Asig_select)){//Sin Asignatura
		//Si no hay ninguna habra que seleccionar alguna.
		//header('Location:/pfc/conceptos.php');
	}
	
//Si esta la 'Galle' la borro y redirijo

//NO HACE FALTA NADA DE ESTO PARA CREAR UNA CUESTION

/*
	$sql="SELECT * FROM Materias WHERE idAsignatura='$Asig_select'";
	$result=mysql_query($sql) or die(mysql_error());//(header('Location:/pfc/conceptos.php'));
		//	conceptos.php
	$row= mysql_fetch_object($result);
	$materia=$row->Nombre;
//	echo $Asig_select;
//	setcookie('Galle', "", time()-3600); //Esto borra la COOKIE
	
//Detectar si hay Cuestion que representar
	$Qid=$_REQUEST['QQ'];
	if (!isset($Qid)||empty($Qid))//Cuestion vacio
	{
		$_SESSION["mensaje"]="<h1>Sin nuemero de cuestion</h1>";
			echo $_SESSION["mensaje"];
		$Qid=0;//Fuerzo la primera, que deberia existir.
	}	
	*/
?>
<!DOCTYPE html>
<html>
<HEAD>
	<TITLE>QCreator</TITLE>
<!--	<link rel=stylesheet href="estilos/style.css" type="text/css">-->
	<link rel=stylesheet href="css/main.css" type="text/css">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
<!--	<SCRIPT SRC="jsMath/easy/load.js"></SCRIPT>-->
<!--<script src="jquery/jquery.url.js" type="text/javascript"></script> -->
<!--	<script src="jquery/jquery.url_toolbox.js" type="text/javascript"></script>--> 
<!--	<script src="jquery/jquery.url_toolbox.js" type="text/javascript"></script> -->
	<script src="jquery/jquery-1.4.2.js" type="text/javascript"></script>
	<script src="jquery/jquery.hoveraccordion.min.js" type="text/javascript"></script>
	<script src="jquery/jquery.timers.js" type="text/javascript"></script>
	<script src="js/cuestion.js" type="text/javascript"></script>
</HEAD>
<body>

<div id="info"><?php echo $_SESSION['idQ'];?> - user - <span id="hora"></span></div>

<!-- NO NECESITO EL MENU
<div id='contenedor'>
  <div id='menu'>
	 	<span class="css_button"><a href="#" title="Pre" name="Pre">Anterior</a></span>
	  <span class="css_button"><a href="#" title="Sig" name="Sig">Siguiente</a></span>
    <ul id="identifier">
      <li><a href="#">Cuestiones</a>
      <ul>

         <li><span class="css_button"><a href="#" title="Delete">Borrar</a></span></li>
         <li><span class="css_button"><a href="#" title="Nueva">Nueva</a></span></li>
         <li><span class="css_button"><a href="#" title="Separacion">Split</a></span></li>
         <li><span class="css_button"><a href="#" title="Ordenar">Ordenar</a></span></li>
          <li><span class="css_button"><a href="gestor_bd.html" title="Gestor">Gestor</a></span></li>                 
      </ul>
      </li>
      <li><a href="#">Edicion</a>
        <ul>
          <li><span class="css_button"> <a href="#" title="Edit">Enunciado</a> </span></li>
          <li><span class="css_button"> <a href="#" title="img1">Imagen 1</a> </span></li>
          <li><span class="css_button"> <a href="#" title="img2">Imagen 2</a> </span></li>
          <li><span class="css_button"> <a href="#" title="Answer">Respuestas</a> </span></li>
        </ul>
      </li>
      <li><a href="#">Listados</a>
        <ul>
          <li><span class="css_button"> <a href="showQs.php" id="QView">Cuestiones</a> </span></li>
          <li><span class="css_button"> <a href="showpng.php" id="EqView">Ecuaciones</a> </span></li>
          <li><span class="css_button"> <a href="#" id="StView">Alumnos</a> </span></li>
          <li><span class="css_button"> <a href="#" >--</a> </span></li>
        </ul>
      </li>
    </ul>

  </div>
-->
        <ul>
          <li><span class="css_btt_l" name="edit"> <a href="#" title="Edit">Enunciado</a> </span></li>
          <li><span class="css_btt_l" name="img1"> <a href="#" title="img1">Imagen 1</a> </span></li>
          <li><span class="css_btt_l" name="img2"> <a href="#" title="img2">Imagen 2</a> </span></li>
          <li><span class="css_btt_l" name="answer"> <a href="#" title="Answer">Respuestas</a> </span></li>
        </ul>
<div id="ula_main">
<!--		Comment here! -->
	<div id='f_respuestas'>
		<form id="respuestas_form" action='#'><br>
			<textarea name="answer" COLS=50 ROWS=6 id="answer" value=""> </textarea>
			<label> ¿Respuesta correcta? Si<input type=radio id="its" name="its" value="1" /></label>
			<label> No <input type=radio name="its" id="its" value="0" checked /></label>
			<label> ¿Ultima respuesta? Si<input type=radio id="last" name="last" value="1" /></label>
			<label> No <input type=radio name="last" id="last" value="0" checked /></label>
			<input type="submit" name="submit_answer" Value="Guardar">				
		</form>
	</div>

	<div id='enun1'> <!-- Enunciado-->
		<form id="enum1_form" action='#'><br>
			<textarea name="enun" COLS=50 ROWS=6 id="enun"><?php GetEnunciado($Qid); ?></textarea>
			<input type="submit" name="submit_enum1" Value="Guardar">				
		</form>
	</div>
	<div id='f_imagen1'>
		Por favor, seleccione un archivo para la imagen 1.
		<form id="img1_form" action='#'><br>
			<input name="img1" type="file" id="img1">
			<input type="submit" name="submit_img1" Value="Guardar">	
		</form>
	</div>
	<div id='f_imagen2'>
	Por favor, seleccione un archivo para la imagen 2.
		<form id="img2_form" action='#'><br>
			<input name="img2" type="file" id="img2">
			<input type="submit" name="submit_img2" Value="Guardar">	
		</form>
	</div>

<!--  -->		
	<div class='Numero' id="<?php echo $_SESSION['idQ'];?>">
		<span class="redondear"><?php //echo GetNCuestion($Qid); ?></span>
	</div>
	<div class='clear'></div>
	<div id='imagen1'>
		<span class='resaltada'>imagen 1</span>
		<img class="im1" src="<?php //echo GetImage($Qid);?> " />
	</div>

	<div class='clear'></div>
	<!-- <div id='contenido'> -->
		<div id='imagen2'>
			<span class='resaltada'>Imagen 2 </span><br />
			<img class="im2" src="<?php //echo GetImage2($Qid);?> " />					
		</div>
		<div id='enunciado'>
			<?php echo GetEnunciado($idQ); ?>
		</div>
		<div id='respuestas'>
		
			<div class="ficha"><?php //GetAnswers_editor($Qid); ?></div>
		
		</div>
	<!-- </div> -->


<!--	fin de contedor. Esto quedaria en el pie del menu -->		

	</div>
	 <!--- Fin del contenido -->
	<?php 
//		echo '<b>'.$materia.'</b>';
//		showConceptos($Qid); ?>

	</div>
	
	<div id="pie">JAR</div>
<!-- De aqui para abajo quedaria fuera del layout -->
</body>
</html>
