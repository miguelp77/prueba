 <html>
 <head>
 	<TITLE>QCreator - Creando</TITLE>
<!--	<script src="jsMath/easy/load.js"></script>
	<script src="jquery/jquery-1.4.2.js" type="text/javascript"></script>
-->
 <style>
	
 .bloque1,.bloque2,.bloque3,.bloque4{
		border: dotted black;padding:1em; display:none;}
 .SmallBotones{width:100px; float:left;}
 #contenido1{display:block;visibility:hide;}
 .vacio {color:red; display:inline; }
 .btt{cursor:pointer;}
  #showit{float:right; margin:1em;}
  </style>
	<script src="jquery/jquery-1.4.2.js" type="text/javascript"></script>
	<script src="includes/Qnew.js" type="text/javascript"></script>
 </head>  
<body>
	<p>Rellene el formulario</p>
	<span class="little_btt btt" title="Imagen1" name="SEnun1">Enunciado</span>
	<span class="little_btt btt" title="Imagen1" name="SRimg1">Imagen 1</span>	
	<span class="little_btt btt" title="Imagen1" name="SRimg2">Imagen 2</span>
	<div id='showit'> Preview </div>	
	
	<div id='enun'>Enunciado de la cuestión.
		<form id="enum1_form" action='#'><br>
			<textarea name="Newenun" COLS=50 ROWS=6 id="Newenun"></textarea>
			<div class='vacio'></div>	
		</form>
		<div class='botones'>
			<span class="little_btt btt" title="Recogerlo" name="Enun1">Recoger</span>
			<span class="little_btt btt" title="SEnunciado">Guardar</span>				
			<span class="little_btt btt" title="Vista preliminar" name="VEnun">Ver</span>				
		</div>
	</div>
	
	<div id='f_img1'>
	Por favor, seleccione un archivo para la imagen 1.
	<form id="img1_form" action='#'><br>
		<input name="Simg1" type="file" id="Simg1">
		<div class='SmallBotones1'>
			<span class="little_btt btt" title="Imagen1" name="Rimg1">Recoger</span>
			<span class="little_btt btt" title="GImagen1">Guardar</span>				
			<span class="little_btt btt" title="VImagen1">ver</span>				
		</div>
	</form>
	</div>
	
	<div id='f_img2'>
	Por favor, seleccione un archivo para la imagen 1.
	<form id="img2_form" action='#'><br>
		<input name="Simg2" type="file" id="Simg2">
		<div class='SmallBotones2'>
			<span class="little_btt btt" title="Imagen2" name="Rimg2">Recoger</span>
			<span class="little_btt btt" title="GImagen2">Guardar</span>				
			<span class="little_btt btt" title="VImagen2">ver</span>				
		</div>
	</form>
	</div>
	
	<div class='clear' ></div>
	<div id='imagen1' class='bloque1'>
			imagen 1
	</div>

	<div class='clear' ></div>
	<div id='contenido' class='bloque'>
		<div id='imagen2' class='bloque2'>
			Imagen 2 <br />
		</div>
	<div id='enunciado' class='bloque3'>
	<!--	"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum." -->
	</div>
	<div class='clear' ></div>
	<div class='Numero'> </div>

</body>
</html>
