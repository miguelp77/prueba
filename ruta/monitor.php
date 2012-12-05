<?php
	session_start();
	//Next_Q Siguiente cuestion en orden	
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	require_once('includes/cuestiones.inc');	
	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		conectar($db);
	}else echo "Sin base."."<br />";//redirect_to("main_asg.php");
	


?>
<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	
	<link rel=stylesheet href="../css/main.css" type="text/css">
<!-- <script src="jquery/jquery-1.4.2.js"></script> -->
<!--	<script src="jquery/jquery-shuffle.js"></script> -->
	<script>
 $(document).ready(function() {
 	 $("#monitor").load("monitor_info.php");
   var refreshId = setInterval(function() {
      $("#monitor").load('monitor_info.php?randval='+ Math.random());
   }, 30000);
});
</script>
	<script src="../js/draft.js"></script> 
	<title>Monitor</title>
</head>
<body>


<?php




?>
<div class="total_info"></div>
<div class="small">Usuario | Estado | #Examen</div>
<div id="monitor"></div>
<hr />
<?php
//	purge_alumnos_info();
//	if(purge_alumnos_info()){

//		echo '<button name="Limpiar">Limpiar</button>';
//	}
	
/*
function to_pdf($fuente='final.php',$destino=null){
	$origen="http://localhost/home/".$fuente;
	if($destino!=null){
		$destino =$destino.".pdf";
		passthru("./wkhtmltopdf-i386 --javascript-delay 8000 http://localhost/home/final.php pdfs/$destino");
		return true;
	}else return false;
}

$result=to_pdf('final.php','testme');
*/
//var_dump($result);

?>
</body>
</html>


