<?php
	session_start();

	require_once('includes/cuestiones.inc');
	require_once('includes/db_tools.inc');

	$db=$_SESSION['db_name'];
	conectar($db);
	if(strlen($db)>1) conectar($db);
	else redirect_to("index.php");
	
	$idQ=$_SESSION['idQ'];
	if (!isset($idQ)||empty($idQ)){//No hay ID de Cuestion
		echo "Nueva"."<br />";;
//		$_SESSION['idQ']=get_next_id('Asg_Tema_1');
//		$idQ=$_SESSION['idQ'];
	
/*$Asig_select=$_COOKIE['Galle'];
	if (!isset($Asig_select)||empty($Asig_select)){//Sin Asignatura
		//Si no hay ninguna habra que seleccionar alguna.
		//header('Location:/pfc/conceptos.php');
	}
*/	
//Si esta la 'Galle' la borro y redirijo

//NO HACE FALTA NADA DE ESTO PARA CREAR UNA CUESTION
?>
<!DOCTYPE html>
<html>
<HEAD>
	<TITLE>QCreator</TITLE>

	<link rel=stylesheet href="css/main.css" type="text/css">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
<!--	<SCRIPT SRC="jsMath/easy/load.js"></SCRIPT>-->

	<script src="jquery/jquery-1.4.2.js" type="text/javascript"></script>
		
	<script src="js/cuestion.js" type="text/javascript"></script>
</HEAD>
<body>
<div id="ula_main">
<div id="info"><span id="hora"></span></div>

<div id="botonera">
	<ul>
	  <li><span class="css_btt_l" name="edit"> <a href="#" title="Edit">Enunciado</a> </span></li>
		<li><span class="css_btt_l" name="img1"> <a href="#" title="img1">Imagen 1</a> </span></li>
    <li><span class="css_btt_l" name="img2"> <a href="#" title="img2">Imagen 2</a> </span></li>
    <li><span class="css_btt_l" name="answer"> <a href="#" title="Answer">Respuestas</a> </span></li>
	</ul>
</div> 

<div class="forms">
	<div class="clear">
<!--		Comment here! -->
	<div id='f_respuestas'>
	
		<form id="respuestas_form" action='#'><hr />
			<textarea name="answer" COLS=50 ROWS=2 id="answer" value=""> </textarea><br />
			<label> ¿Respuesta correcta? Si<input type=radio id="its" name="its" value="1" /></label>
			<label> No <input type=radio name="its" id="its" value="0" checked /></label><br />
			<label> ¿Ultima respuesta? Si<input type=radio id="last" name="last" value="1" /></label>
			<label> No <input type=radio name="last" id="last" value="0" checked /></label><br />
			<input type="submit" name="submit_answer" Value="Guardar">				
		</form>
	</div>

	<div id='enun1'> <!-- Enunciado-->
		<form id="enum1_form" action='#'><hr />
			<textarea name="enun" COLS=50 ROWS=6 id="enun"></textarea>
			<input type="submit" name="submit_enum1" Value="Guardar">				
		</form>
	</div>
	<div id='f_imagen1'>
		<hr />
		Por favor, seleccione un archivo para la imagen 1.
		<form id="img1_form" action='#'>
			<input name="img1" type="file" id="img1">
			<input type="submit" name="submit_img1" Value="Guardar">	
		</form>
	</div>
	<div id='f_imagen2'>
	<hr />
	Por favor, seleccione un archivo para la imagen 2.
		<form id="img2_form" action='#'>
			<input name="img2" type="file" id="img2">
			<input type="submit" name="submit_img2" Value="Guardar">	
		</form>
	</div>
	</div>
	<hr />
</div>
<!-- Aqui muestro las cosas -->		

	<div class='numero' name="<?php echo $idQ;?>">
		<span class="redondear"><?php echo $idQ; ?></span>
	</div>
	<div class='clear'></div>
	<div id='imagen1'>
		<span class='resaltada'></span>
		<?php 
			if(GetImage($idQ)!=null) 
				echo "<img class='im1' src='".GetImage($idQ)."' />";
			else echo "imagen 1";
		?> 
	</div>

	<div class='clear'></div>
	<!-- <div id='contenido'> -->
		<div id='imagen2'>
			<span class='resaltada'></span><br />
		<?php 
			if(GetImage2($idQ)!=null)
				echo "<img class='im2' src='".GetImage2($idQ)."' />";
			else echo "imagen 2";
		?> 
<!--			<img class="im2" src="<?php null//echo GetImage2($Qid);?> " /> -->
		</div>
		<div id='enunciado'>
			<?php if($idQ) echo GetEnunciado($idQ); ?>
		</div>
		<div id='respuestas'>
		
<!--			<div class="ficha"><?php //GetAnswers_editor($Qid); ?></div> -->
		
		</div>
	<!-- </div> -->


<!--	fin de contedor. Esto quedaria en el pie del menu -->		

	</div>
	 <!--- Fin del contenido -->
	<?php 
//		echo '<b>'.$materia.'</b>';
//		showConceptos($Qid); ?>
	
	<div id="pie">JAR</div>
	</div>

<!-- De aqui para abajo quedaria fuera del layout -->
</body>
</html>
