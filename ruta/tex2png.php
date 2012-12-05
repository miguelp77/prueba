<?php
	session_start();
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	require_once('includes/cuestiones.inc');	
	require_once('includes/extras.php');
	require_once('includes/exp_pag.php');	
?>

	<link rel=stylesheet href="../css/main.css" type="text/css">		
	<script src="../jquery/jquery-1.4.2.js" type="text/javascript"></script>
	<script src="../js/expresion.js?v1.1" type="text/javascript"></script>
<!-- Expresion de ejemplo-->
<!-- $$x = {-b \pm \sqrt{b^2-4ac} \over 2a}.$$ -->
<div id="ula">
<!-- Crear ecuaciones -->		
	<button id="crear_img">Expresion</button>
<!-- Subir imagenes -->
	<button id="up_img">Subir</button>
	<div class="clear"></div><br />

	<div id="archivo">
		<form action="upload_img.php" method="post" enctype="multipart/form-data">
			<input type="file" id="img" name="file"/>
			<input type="submit" name="submit" value="subir" id="subir" />
		</form>
	</div>
	
	<div id="eq">
		<span>Ecuacion</span><br />
		<textarea name="eq" cols=80 rows=1></textarea><br /></br />
		Ejemplo: <i>$$x = {-b \pm \sqrt{b^2-4ac} \over 2a}$$ </i><br />
		<button id="c_img">Crear</button>
		Imagen Creada	
		<div id="img_created">
			<img src="../img/cross.png" />  
			<br/></br/>
		</div>	
		<div id="res_name"></div>
		<div id="img_name_form">
			<input type="text" title="ImgSave">
			<span class="css_button"><A title='SaveImg' href='#'>Guardar</A></span>
		</div>
		<div class="clear"></div>
	</div>	

	<span class="black" name="show" title="Mostrar/Ocultar">+</span>
	<div class="clear"></div>
	<hr />
<!-- Botones de nav de la paginacion -->
	<div id='img_name' style="width:900px;height:300px;overflow:auto;">
	<div class="clear"></div>
	<br />
	<div id="eq_desc">
		Descripcion de la imagen <br />
		<textarea name="desc_area" cols=80 rows=1></textarea>
		<span class="css_btt_cont" title="" name="img_desc_save"><a href="#">Grabar</a></span>
		<div id="exp"></div>
	</div>
	<div id="img_expr" class="right2" ></div>	
	
	<?php
//		Este es el otro modo
		echo '<div class="im1_wrap">';
		echo '<img src="'.$img_source[$current].'" alt="Imagen" /><br>'.$img_source[$current];
//		echo $item['des'];
		echo '</div>';
		$img_info=get_img_info();
//		$file_list=give_files('img');
		echo '<select class="im_sel1" name="im1" size="1">';
//		foreach($file_list as $item){				
		foreach($img_info as $item){				
			$cadena=$item['path'];
			echo '<option value="'.$item['id'].'" name="im1">'.$cadena.'</option>';
		}
		echo '</select>';

		$current=2;
	?>
	<div class="clear"></div>

	<div class="diez"></div>
		<div class="img_nav">
			<span class="css_btt" name="descripcion">Descripcion</span>
			<span class="css_btt" name="expresion">Expresion</span>
		</div> <!-- Fin de botones de nav -->
	
	</div>
</div>