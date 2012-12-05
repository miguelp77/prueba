<?php
	session_start();
//	header ('Content-type: text/html; charset=utf-8');
	require_once('includes/cuestiones_lib.php');
//	Orden_Q();
//Detectar si hay ASIGNATURA fijada
	
	if(isset($_COOKIE['asig'])){
		$asig=$_COOKIE['asig'];
	} else {
		echo "Temporal. Sin asignatura. ";
	}
	conectar();
/*	
	$Asig_select=$_COOKIE['Galle'];
	if (!isset($Asig_select)||empty($Asig_select)){//Sin Asignatura
		//Si no hay ninguna habra que seleccionar alguna.
		//header('Location:/pfc/conceptos.php');
	}
*/
//Si esta la 'Galle' la borro y redirijo	
$Qid=1;
?>

<!DOCTYPE html>
<html>
<HEAD>
	<TITLE>Cuestion_crear</TITLE>
	<link rel=stylesheet href="css/main.css" type="text/css">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
	<script src="jquery/jquery-1.4.2.js" type="text/javascript"></script>
	<script src="js/cuestion.js" type="text/javascript"></script>
</HEAD>
<body>
<div id="info"></div>

        
<div id="ula_main">

<div class='clear'></div>

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

<!--  		
	<div class='Numero' id="<?php //echo $Qid?>">
		<span class="redondear"><?php //echo GetNCuestion($Qid); ?></span>
	</div>
-->

<!--	INICIO ficha -->		
	<div class="ficha">
<ul>
	<li><span class="css_btt_l" name="edit"> <a href="#" title="Edit">Enunciado</a> </span></li>
  <li><span class="css_btt_l" name="img1"> <a href="#" title="img1">Imagen 1</a> </span></li>
  <li><span class="css_btt_l" name="img2"> <a href="#" title="img2">Imagen 2</a> </span></li>
  <li><span class="css_btt_l" name="answer"> <a href="#" title="Answer">Respuestas</a> </span></li>
</ul>
<div class='clear'></div>
		<div class='Numero'>
			<?php echo GetEnunciado($Qid); ?>
		</div>		
		<div id='imagen1'>
			<span class='resaltada'></span>
			<img class="im1" src="<?php echo GetImage($Qid);?> " />
		</div>
<div class='clear'></div>
	<!-- <div id='contenido'> -->
		<div id='imagen2'>
			<span class='resaltada'></span><br />
			<img class="im2" src="<?php echo GetImage2($Qid);?> " />					
		</div>
		<div id='enunciado'>
				<?php echo GetEnunciado($Qid); ?>
		</div>
		<div id='respuestas'>respuestas
				<?php GetAnswers_editor($Qid); ?>
		</div>

	</div>
	<?php echo showConceptos($Qid); ?>
<!--	FIN ficha -->		

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
<!--
/* <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

<p><input type="Submit" value="Submit" name="submit"></p>
</form>
*/
-->

