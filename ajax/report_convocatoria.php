<?php
session_start();

require_once('../includes/db_config.php');
require_once('reports.inc');
	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		$link=conectar($db);
	}else redirect_to("admin_test.php");
?>

<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title>Resumen: Asignatura</title>
	<script type="text/javascript">
    if (jQuery) {  
    alert('jQuery is loaded!');  
    }  
    }  
    </script>	
	<script src="../jquery/jquery-1.4.2.js"></script>
	<script src="../js/jquery.tools.min.js"></script>
<!--	<script type="text/javascript" src="js/jquery.mousewheel.js"></script>
	<script type="text/javascript" src="js/jquery.jscrollpane.min.js"></script>
	<link type="text/css" href="ajax/jquery.jscrollpane.css" rel="stylesheet" media="all" />
-->
	<link rel="stylesheet" href="../ajax/report.css" type="text/css">
	<link rel="stylesheet" href="../css/main.css" type="text/css">
</head>

<body>
<?php
if($db!='asg_admin')
	echo '<div id="head"><div class="rojo"></div>
<span class="underl dcha" name="orden">Ordenar</span>
<span class="underl dcha" name="completar">Completar</span>

<div class="ctrl">
	<p class="underl tog">Ocultar</p>
	<p style="display: none" class="tog">Mostrar</p>
</div>
<div class="ctrlado">
	<input type="checkbox" name="opcional" value="fecha" disabled="disabled"/>Fecha
	<input type="checkbox" name="opcional" value="total"/>Total de cuestiones
	<input type="checkbox" name="opcional" value="correctas"/>Correctas
	<input type="checkbox" name="opcional" value="falladas"/>Falladas 
	<input type="checkbox" name="opcional" value="sin_responder"/>Sin responder
	<input type="checkbox" name="opcional" value="tiempo"/>Tiempo
	<input type="checkbox" name="opcional" value="nota"/>Nota<br />
	</div>
	<hr />
	<div id="checkss"></div></div>';

	if($db=='asg_admin'){
		unset($db);
		echo 'Conexion sin alumnos.Conectese a una asignatura.';
	}else	{
		echo '<div class="scroll-panel">';
		echo '<div class="lista">';
		expediente();
		echo " ----- </div></div></div>";
echo '<div id="btt_expedientes">';
echo '<span class="css_btt" name="orden" title="Completar convocatorias. No presentados.">Completar</span>';
//echo '<span class="css_btt " name="completar" title="Completar convocatorias. No presentados.">Completar</span>';
echo '</div>';
	}


?>	

</body>
	<script src="../js/final.js?ver1.2"></script>
<script>
$(function(){
	$('.scroll-panel').scrollable();
});
</script>


</html>
