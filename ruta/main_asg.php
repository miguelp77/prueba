<?php
	session_start();
		require_once('includes/db_tools.inc');
	if(isset($_SESSION['db_name']) )$a = ($_SESSION['db_name']!="asg_admin") ? true : false;
	else $a=false;
//	if($a) echo $_SESSION['db_name'].'<br />';
// echo get_include_path();	
// echo "<hr />";
?>
<!DOCTYPE HTML>
<html lang="es-ES">
<head>
<!--	<script src="jquery/jquery-1.4.2.js" type="text/javascript"></script> -->
	<script src="../js/asignatura.js"></script> 
<script>
if(!window.jQuery)
{
   var script = document.createElement('script');
   script.type = "text/javascript";
   script.src = "..jquery/jquery-1.4.2.js";
   document.getElementsByTagName('head')[0].appendChild(script);
}
</script>

</head>
<body>
Asignaturas. <br />
	<?php 
		if(isset($_SESSION['db_name'])){
	//		if(!check_UTF8($_SESSION['db_name'])) 
	//			$_SESSION['db_name']=utf8_decode($_SESSION['db_name']);
			echo " Conectado a <b>".asg_name($_SESSION['db_name'])."</b>";
		}
	?>
<br /><br />
<div class="botones">

<?php		
	if(!$a) echo '<div class="campo css_btt" name="new_asg">Crear</div>';   
	if($a){
		echo '<div class="campo css_btt" name="unset_asg">Deseleccionar</div>';
		echo '<div class="campo css_btt" name="new_asg">Estructura</div>';
		echo	'<div class="campo css_btt" name="explore_asg">Explorar</div>'; 
		echo '<div class="campo css_btt" name="import_asg">Importar</div>';
	} 
	//if(!$a)	echo '<div class="campo css_btt_l" name="read_asg">Seleccionar</div> ';
?>
</div>
		<div class="clear"></div><br />
		<div id="archivo">
			<form action="Get_file_bdp.php" method="post" enctype="multipart/form-data">
				<input type="file" id="bdp" name="file"/>
	<!--		<div id="import"> -->
				<input type="submit" name="submit" value="Importar" />
	<!--			<input type="button" id="Importar" value="Importar"/> -->
	<!--		</div> -->
			</form>
		</div>
</body>
</html>
