<?php
	session_start();	
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	require_once('includes/cuestiones.inc');	
	require_once('examen_mostrar.php');	
// Display errors in production mode
//ini_set('display_errors', 1);

//Estan definidas iser & idAlumno	
	if(!isset($_SESSION['user'])) redirect_to("index.php");
	if(!isset($_SESSION['idAlumno'])) redirect_to("index.php");	
//Base de datos seleccionada. Conexion
	if(isset($_SESSION['db_name']))
	{
		$db=$_SESSION['db_name'];
		$con=conectar($db);
	}
	
	if($con==null) 
		redirect_to('public/sin_conexion.html');
	if($con=='asg_admin') 
		redirect_to('public/sin_conexion.html');	
	if(isset($_SESSION['msg']))
		unset($_SESSION['msg']);

//create_expediente_table();

//$nalumnos=cuantos_alumnos();
//$nexpedientes=cuantos_expedientes();
	$idA=$_SESSION['idAlumno'];
	$alumnos=idAlumnos();
	$tiene_expediente=exist_expediente($idA,$alumnos);
	if(!$tiene_expediente) create_expediente($idA);

//Comprueba el anterior login
	check_me();

//	rutina_examinar();
	$quest=rutina_examinar();
?>

<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/test.css" type="text/css">	
	<script src="jquery/jquery-1.4.2.js"></script>
	<script src="js/test.js"></script>
	
	<script type="text/javascript" SRC="mathjax/MathJax.js">
		MathJax.Hub.Config({
			extensions: ["tex2jax.js"],
			styleSheets: ["math.css"],
			jax: ["input/TeX","output/HTML-CSS"],
			displayAlign: "left",
			delayStartupUntil: "onload",
			messageStyle: "none",
			tex2jax: {
				inlineMath: [["$","$"],["$$(","$$)"]],
				displayMath: [['$$','$$'],['\\[','\\]'] ]
			}
		});
		MathJax.Hub.Register.StartupHook("End",function () {
			$('.curtain').removeAttr('id');
			$('.waiting').empty();
			cookieme();
			get_duration();
		});
	</script>

	<script src="jquery/jquery-shuffle.js"></script>
	<script src="jquery/jquery.cookie.js"></script>
	<script src="jquery/jquery.countdown.js"></script>

	<title>Test</title>
</head>
<body>
<div id="cortina" class="curtain">
	<div id="central" class="waiting curtain">
		<img src='img/ajax-loader(2).gif' alt='loading...' />
		<span class="centrado" style="color:#eee">Cargando examen...</span>
	</div>
</div>
	
	<div id="contenedor">
		<div id="contenido">
			<?php
				cuerpo($quest);
			?>
			<button name="boton">Finalizar</button>
			<div class="total_info"></div>
		</div>
	</div>
	<div id="info"></div>
	<div id="info2">
		<?php echo (($_SESSION['user']))."<br />".$_SESSION['DNI']; ?>
	</div>
	<div id="Calificacion"></div>
	<div class="clear"></div>
 

</body>
</html>


