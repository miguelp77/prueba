<?php
	session_start();
	require_once('includes/basics.php');
	require_once('includes/cuestiones.inc');
	require_once('includes/db_tools.inc');
	require_once('includes/extras.php');
	
	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		conectar($db);
	}else{
		conectar("asg_admin");//redirect_to('admin_test.php');
		$_SESSION['db_name']="asg_admin";
	}
//	if(isset($_SESSION['idQ']))	$idQ=$_SESSION['idQ'];
	if(isset($_GET['id_otra'])){
		$idQ=$_GET['id_otra'];
		$_SESSION['idQ']=$idQ;
	//echo $idQ;
	}if(isset($_SESSION['idQ'])){ 
		$idQ=$_SESSION['idQ'];
	}
	
function destinos(){
	$link=connect_to_db();
	$db_list = mysql_list_dbs($link);
	echo "Copiar a: ";
//echo "<form action='asignatura_cambiar.php' method='post'>";
	echo "<form action='#'>";
	echo "<SELECT NAME='dbs' SIZE='1'>";
	while ($row = mysql_fetch_object($db_list)){
		//anulo el valor de phpmyadmin
		$nombre=$row->Database;
		$ok=str_begin($nombre,"asg_");
		echo $nombre;
		if($row->Database =="asg_admin") continue;
		if($row->Database ==$_SESSION['db_name']) continue;
//	if($row->Database =="phpmyadmin") continue;
		if($ok) echo "<OPTION VALUE='$row->Database' name='db_nueva'>". asg_name($row->Database)."</OPTION>";
	}
	echo "</SELECT> ";
//echo $row;

	echo "<input type=\"button\" name=\"copia\" value=\"Selecciona\">";
	echo "</form>";
}	
//	echo $idQ;
?>
<!DOCTYPE html>
<html>
<HEAD>
	<meta charset="UTF-8">
	<TITLE>cuestion_create</TITLE>

	<link rel=stylesheet href="../css/main.css" type="text/css">
<!--	<SCRIPT SRC="jsMath/easy/load.js"></SCRIPT>-->
<!--	<script type="text/javascript" SRC="mathjax/MathJax.js">
	MathJax.Hub.Config({extensions: ["tex2jax.js"],styleSheets: ["math.css"],jax: ["input/TeX","output/HTML-CSS"],displayAlign: "left",delayStartupUntil: "onload",messageStyle: "none",skipStartupTypeset: true,tex2jax: {inlineMath: [["$","$"],["$$(","$$)"]],displayMath: [['$$','$$'],['\\[','\\]'] ]}});//inlineMath: [["$","$"],["$$(","$$)"]],</script>
-->
<!--	<script src="../jquery/jquery-1.4.2.js" type="text/javascript"></script> -->

</HEAD>
<body>
<div id="ula_main">
	<div id="info3"><span id="hora"></span></div>
	<hr />
	<div class="low">
		<div class="css_btt_l" name="anterior"><a href="#" title="anterior">Anterior</a></div>	
		<div class="css_btt_l" name="nueva"><a href="#" title="nueva">Nueva</a></div>
		<div class="css_btt_l" name="duplicar"><a href="#" title="duplicar">Duplicar</a></div>		
		<div class="css_btt_l" name="copiar"><a href="#" title="copiar a otra asignatura">Copiar</a></div>		
		<div class="css_btt_l" name="borrar"><a href="#" title="borrar">Borrar</a></div>		
		<div class="css_btt_l" name="siguiente"><a href="#" title="siguiente">Siguiente</a></div>
		
		<div class="css_btt_r" name="compactar"><a href="#" title="compactar">Compactar</a></div>					
	<div class="clear"></div>
	<hr />
	</div>	

<?php 
//	depura();
//	echo id_explorer("Cuestiones");
	$ultima=cuantas_cuestiones();
	if(isset($_SESSION['idQ']))$current_q=$_SESSION['idQ'];
	else $current_q=1;
	$ini=$current_q;
//	$_SESSION['idQ']=1;
//	echo $ini.'---'.$ultima.'<br />';
	numero_de_cuestiones($ini,19,$ultima);
?>
<div class="clear"></div>
<div id="copiar">
	<hr />
	<?php
		destinos();
	?>
</div>
<div class="forms">
	<div class="clear">
<!--		Comment here! -->


<!--		Comment here! -->

	<div id='f_respuestas'>
	
		<form id="respuestas_form" action='#'><hr />
			<textarea name="answer" COLS=50 ROWS=2 id="answer" value=""></textarea><br />
			<label> ¿Respuesta correcta? Si<input type=radio id="its" name="its" value="1" /></label>
			<label> No <input type=radio name="its" id="its" value="0" checked /></label><br />
			<label> ¿Ultima respuesta? Si<input type=radio id="last" name="last" value="1" /></label>
			<label> No <input type=radio name="last" id="last" value="0" checked /></label><br />
			<input type="submit" name="submit_answer" Value="Guardar">				
		</form>
	</div>

	<div id='enun1'> <!-- Enunciado-->
		<form id="enum1_form" action='#'><hr />

			<textarea name="enun" COLS=60 ROWS=6 id="enun"></textarea><br />
			<input type="submit" name="submit_enum1" Value="Guardar">				
		</form>
	</div>
<!-- Eleccion de la imagen 1-->

	<div id='f_imagen1' style="width:900px;height:300px;overflow:auto;">
		<hr />
		<?php
			// $file_list=give_files('img');
			// echo '<select class="im_sel1" name="im1" size="1">';
			// foreach($file_list as $item){				
			// 	$cadena=$item['name'].'.'.$item['ext'];
			// 	echo '<option value="'.$cadena.' name="im1" >'.$cadena.'</option>';
			// 	if($item['ext']=='png'){
			// 		$total_items++;
			// 		$img_source[]=$cadena;
			// 	}
			// }
			// echo '</select>';
			// echo '<button name="im1">Seleccionar</button>';
			// $current=2;
			// echo '<div class="im1_wrap">';
			// echo '<img src="'.$img_source[$current].'" alt="Imagen" /><br>'.$img_source[$current].'</div>';
			
			// show_img('img/','jpg');
			print_r(read_db_img());
		?>
		<div class="clear"></div>
	</div>

<!-- Eleccion de la imagen 2-->

	<div id='f_imagen2'>
	<br />
		<?php
//				$file_list=give_files('img');
				echo '<select class="im_sel2" name="im2" size="1">';
					foreach($file_list as $item){				
						$cadena=$item['name'].'.'.$item['ext'];
						echo '<option value="'.$cadena.' name="im2" >'.$cadena.'</option>';
						if($item['ext']=='png'){
							$total_items++;
							$img_source[]=$cadena;
						}
					}
				echo '</select>';
				echo '<button name="im2">Seleccionar</button>';
//			echo '</form>';

			//$last_item=$total_items;
			$current=2;
			echo '<div class="im2_wrap">';
			echo '<img src="'.$img_source[$current].'" alt="Imagen" /><br>'.$img_source[$current].'</div>';
//			echo '<div class="wrap">';
//			echo '<img src="'.$img_source[$current].'" alt="Imagen" /><br />'.$img_source[$current].'</div>';
			echo '<div class="clear"></div>';
			?>
<!--	Por favor, seleccione un archivo para la imagen 2.
		<form id="img2_form" action='#'>
			<input name="img2" type="file" id="img2">
			<input type="submit" name="submit_img2" Value="Guardar">	
		</form>
	</div>
	</div>
	<hr />
-->


</div>
<!-- Aqui muestro las cosas -->		

	<div class='numero' name="<?php if(isset($_SESSION['idQ']))echo $idQ;?>">
		<span class="redondear"><?php if(isset($_SESSION['idQ'])) echo $idQ; ?></span>
	</div>
	<div class='clear'></div>


	<div id='imagen1'>
		<span class='resaltada'></span>
		<?php
			if(isset($_SESSION['idQ']) && GetImage($idQ)!=null){ 
				echo "<img class='im1' src='".GetImage($idQ)."' />";
				echo '<span class="del_im1" style="vertical-align: top"><img src="../img/cross.png" alt=""/></span>';
			}else echo "";
		
		?> 
	</div>
	<div class='clear'></div>
	<!-- <div id='contenido'> -->
		<div id='imagen2'>
			<span class='resaltada'></span><br />
		<?php 
			if(isset($_SESSION['idQ']) && GetImage2($idQ)!=null){
				echo '<span class="del_im2" style="vertical-align: top"><img src="../img/cross.png" alt=""/></span>';
				echo "<img class='im2' src='".GetImage2($idQ)."' />";
			}else echo "";
		?> 
		</div>
		<div id='enunciado'>
			<?php if(isset($_SESSION['idQ'])) echo GetEnunciado($idQ); ?>
		</div>
		<div class='clear'></div>
		<div id='respuestas'>
			<?php if(isset($_SESSION['idQ'])) GetAnswers_editor($idQ); ?>			
		</div>
	<div id="respuesta_edit">
		<hr />
		<form>
			<textarea rows="4" cols="48" id="respuesta_texto" name="respuesta_texto"></textarea><br />
			<input type="text" name="respuesta_porcentaje" size="6">	
			<label> ¿Respuesta correcta? Si<input type=radio class="correct" name="correct" value="1" /></label>
			<label> No <input type=radio name="correct" class="correct" value="0" /></label><br />			
			<input type="button" name="respuesta_editada" value="Guardar">
		</form>
	</div>
	<hr />
	<div id="botonera">
		<ul>
		  <li><span class="css_btt_l" name="edit"> <a href="#" title="Edit">Enunciado</a></span></li>
			<li><span class="css_btt_l" name="img1"> <a href="#f_imagen1" title="imagen 1" id="img1">Imagen 1</a></span></li>
	    <li><span class="css_btt_l" name="img2"> <a href="#" title="img2">Imagen 2</a></span></li>
	    <li><span class="css_btt_l" name="answer"> <a href="#" title="Answer">Respuestas</a></span></li>
		</ul>
	</div> 
	<hr />

	<div class="black rot">+</div>

	<div id="conceptos_resumen"><?php if(isset($idQ)){ $cad=to_title($idQ); echo $cad; } ?></div>
	<div id="conceptos_op">
		<br />
		<?php	if(isset($_SESSION['idQ'])) showConceptos($idQ); ?>
	</div>
	<?php 
		// $files=give_files('../img');
		// var_dump($files);
	?>
	</div>
	 <!--- Fin del contenido -->

<!--	fin de contedor. Esto quedaria en el pie del menu -->		
	</div>

	<script src="../js/cuestion.js" type="text/javascript"></script>


<!-- De aqui para abajo quedaria fuera del layout -->


</body>
<!--	<link rel=stylesheet href="css/math.css" type="text/css">	-->	
</html>
