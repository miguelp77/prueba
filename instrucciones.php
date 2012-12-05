<?php
	session_start();		
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	require_once('includes/cuestiones.inc');	
	
	if(get_cookie("examen")) redirect_to("prueba.php");
	if(!isset($_SESSION['db_name'])) redirect_to("index.php");
	
	function sin_examenes($msg='#00'){
			$_SESSION['msg']='Sin examenes. Consulte al administrador '.$msg;
			redirect_to('index.php');
	}	
	function asignatura_name(){
		if($_SESSION['db_name']){
			$db=$_SESSION['db_name'];		
			$db=str_replace("asg_","",$db);
			$db=str_replace("_"," ",$db);
			return $db;
		}else{
			del_cookie('idA');
			sin_examenes('#02');
		}
	}
	function duracion(){
		if(isset($_SESSION['duracion']))
			return $_SESSION['duracion'];
		else sin_examenes('#01');
	}
	function numero(){
		if(isset($_SESSION['numero']) AND $_SESSION['numero']>0)
			return (int)$_SESSION['numero'];
		else return '--';
	}	
	
	function correcta(){
		$total=numero();
		if(is_int($total))return round((10/$total),2);
		else return $total;
	}
	function incorrecta(){
		$total=numero();
		if(is_int($total))return round((-3.3/$total),2);
		else return $total;	
	}
duracion();
?>

<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<link rel="stylesheet" href="css/test.css" type="text/css">	
	<meta charset="UTF-8">

	<title>Intrucciones</title>
	<script src="jquery/jquery-1.4.2.js"></script>

</head>
<body>
	
	<div id="contenedor">
		<div id="cabecera"><?php echo "Asignatura <b>".asignatura_name()."</b><br /><h3>Instrucciones</h3>"; ?></div>
		<div id="contenido">
			Bienvenido <?php echo $_SESSION['user'];?>.
			<p>Antes de comenzar lea las siguientes instruciones:</p>
			<li>La prueba tendra una duración de <b><?php echo duracion(); ?></b> minutos. Transcurrido este tiempo finalizara la prueba.</li>
			<li>Constara de <b><?php echo numero(); ?></b> cuestiones.</li>
			<li>Si no está conforme con ninguna respuesta, o quiere anular la respuesta, marque: <p><input type="radio" name="" id="" disabled="disabled"/>No responder. </p></li>
			<p>Valor de las respuestas sobre 10:</p>
			<ul>
			<li>Correcta <?php echo correcta(); ?> puntos.</li>
			<li>Incorrecta <?php echo incorrecta(); ?> puntos.</li>
			<li>Sin respuesta/No responder 0 puntos.</li><br />
			</ul>
			<p>La prueba puede tardar unos segundos en presentarse. El tiempo comenzara una vez finalizada la carga.</p>						
			<span class="fire" style="color:red;">Sin aceptar.</span>
			<br />
			<input type="checkbox" name="acepta" id="acepto" /> He leido las instrucciones.
			<br /><button>Comenzar</button>
		</div>
	</div>
<?php
//	depura();

?>	
<script>
	$('.fire').hide();
	$('button').click(function(){
		var acepto=$('#acepto').is(':checked');
	//	console.log(acepto);
//		if(acepto) window.location = "prueba.php";
		if(acepto) window.location = "prueba";
		else $('.fire').fadeIn('fast').fadeOut(2800);
	});
</script>

</body>
</html>
