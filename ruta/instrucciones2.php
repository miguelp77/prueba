<?php
	/**
	*
	* Intrucciones examen
	* Aqui comienza la prueba. Con el tipo de prueba que haya escogido el alumno
	*
	*
	*/
	session_start();		
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	require_once('includes/cuestiones.inc');	
	// Las funciones se han llevado a basics.php

	// if(get_cookie("examen")) redirect_to("prueba.php");
	// if(!isset($_SESSION['db_name'])) redirect_to("../index.php");
/**
*
* Duracion
* Obtiene la duracion de la prueba
*/
	// duracion();

?>

<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<link rel="stylesheet" href="../css/test.css" type="text/css">	
	<meta charset="UTF-8">

	<title>Intrucciones</title>
	<script src="../jquery/jquery-1.4.2.js"></script>

</head>
<body>
	
	<div id="contenedor">
		<div id="cabecera"><?php echo "Asignatura <b>".asignatura_name()."</b><br /><h3>Instrucciones</h3>"; ?></div>
		<div id="contenido">
			Bienvenido <?php echo $_SESSION['user'];?>.
			<div id="info_msg">
				<p>El examen al que ha accedido es valido entre el <?php echo date('d-m-Y',strtotime($_SESSION['fecha_start']));?> y el <?php echo date('d-m-Y',strtotime($_SESSION['fecha_end']));?>. Contacte con su tutor para mas información.</p>
			</div>						
			<span class="fire" style="color:red;">Sin aceptar.</span>
			<br />
			<input type="checkbox" name="acepta" id="acepto" /> Acepto.
			<br /><button>Comenzar</button>
		</div>
	</div>
<?php
//	depura();
// $_SESSION['msg'] = 'El examen al que intento acceder estaba obsoleto.'
?>	
<script>
	$('.fire').hide();
	$('button').click(function(){
		var acepto=$('#acepto').is(':checked');

		if(acepto) window.location = "../index.php";
		else $('.fire').fadeIn('fast').fadeOut(2800);
	});
</script>

</body>
</html>
