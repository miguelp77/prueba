<?php 
	session_start();
	require_once('includes/examen_func.php');
	$value="miguel"; //Lo tomo del login
	setcookie("ID", session_id(), time() + 3600);
	setcookie("USER",$value,time() + 3600);
//	$ex=MakeEx();
//esto fija el examen
//		if(isset($_COOKIE["Examen"])) $ex= $_COOKIE["Examen"];
//	else{
		$ex=MakeEx();
//		setcookie("Examen",$ex);
//		$_SESSION['SS_examen']=$ex;
//	}
//	if(!isset($_SESSION['SS_examen'])) $_SESSION['SS_examen']=$ex;
?>
<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<link rel=stylesheet href="css/examen_css.css" type="text/css">
	<script src="jquery/jquery-1.4.2.js" ></script>
	<script src="jquery/jquery-shuffle.js" type="text/javascript"></script>	
	<script src="jquery/jquery.countdown.js" type="text/javascript"></script>	
	<script type="text/javascript" src="jquery/jquery.cookie.js" ></script>
	<script src="js/examen.js" type="text/javascript"></script> 
	<TITLE>Examen</TITLE>	
</HEAD>
<body>
<div id="contenedor">
  <div id="info"><span id="cuenta"></span></div>
  <div id="menu"></div>
  <div id="contenido">
	<br /><br /><br />
	<br /><br /><br />
	<h2>Preguntas</h2>
			<?php 
				echo Examen($ex); 
			?>
	<br />
<!--	</div>	-->
	</div>
</div>

</body>

