<?php
	session_start();

	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	require_once('includes/cuestiones.inc');	
	require_once('includes/extras.php');
	require_once('includes/exp_pag.php');	
//	echo $_SESSION['db_name'];
//	$db="asg_admin";

//	$_SESSION['old_db']=$_SESSION['db_name'];
//	$conn=conectar($db);
	
	

	
//	$sentido = $_POST['sentido']; //ASC o DESC

?>
<HTML>
	<HEAD>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
		<link rel=stylesheet href="css/main.css" type="text/css">		
		<TITLE>TeX a Imagen</TITLE>
	<script src="jquery/jquery-1.4.2.js" type="text/javascript"></script>
	<script src="js/expresion.js" type="text/javascript"></script>
	</HEAD>
<body>
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
		<button id="c_img">Crear</button>
		Imagen Creada	
		<div id="img_created">
			<img src="img/cross.png" />  
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
		<div class="img_nav">
			<span class="css_btt" name="descripcion">Descripcion</span>
			<span class="css_btt" name="expresion">Expresion</span>
		</div> <!-- Fin de botones de nav -->
	<div class="clear"></div>
	<br />
	<div id="eq_desc">
		Descripcion de la imagen <br />
		<textarea name="desc_area" cols=80 rows=1></textarea>
		<span class="css_btt_cont" title="" name="img_desc_save"><a href="#">Grabar</a></span>
		<div id="exp"></div>
	</div>
	<div id="img_expr" class="right2" ></div>	
	<div class="clear"></div>
	
	<?php
//		Este es el otro modo
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
		echo '<div class="im1_wrap">';
		echo '<img src="'.$img_source[$current].'" alt="Imagen" /><br>'.$img_source[$current];
//		echo $item['des'];
		echo '</div>';
	?>
	
	</div>
<?php 
/*
 * COMENTO ESTO PARA HACER OTRO MODO DE INSPECCION DE IMAGENES
<!-- Wrap de las imagenes id:img_name -->	
	<div id="img_name">
<!-- Paginacion -->
		<div id="img_paginacion">
		<?
			$i=$_SESSION['imagen']/5;
//		echo $i;
			$total=cuantas_img();
			$n=$total/5;
			$nn=$i*5;
			$ret=numero_de_img($nn,5,$total);
		?>
	</div><!-- Paginacion: FIN -->
		<div class="clear"></div>
<!-- Botones de nav de la paginacion -->
		<div class="img_nav">
			<span class="css_btt" name="prev"><</span>
			<span class="css_btt" name="descripcion">Descripcion</span>
			<span class="css_btt" name="ruta">Ruta</span>
			<span class="css_btt" name="expresion">Expresion</span>
			<span class="css_btt" name="sig">></span>
		</div> <!-- Fin de botones de nav -->
		<div class="clear"></div>
		<hr />
<!-- Imagenes -->		
		<div id="eq_desc">
			Descripcion de la imagen <br />
			<textarea name="desc_area" cols=80 rows=1></textarea>
			<span class="css_btt_cont" name="img_desc_save"><a href="#">Grabar</a></span>
		</div>
		<div id="eq_ruta" class="">
			<span id="eq_img_img" ></span>
			<span class="clear"></span>
			<div id="img_ruta" class="right2" ></div><br />
			<span class="clear"></span>
			<div id="img_expr" class="right2" ></div>	
		</div> <!-- Imagenes: FIN -->		
	</div><!-- Wrap de la imagenes FIN-->
*/
?>
</div>
</body>

