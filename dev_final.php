<?php
	session_start();		
//Librerias
	require_once('includes/cuestiones.inc');	
	require_once('includes/basics.php');
//	echo 'depura '.__LINE__.'<br />';
	require('includes/pdf_examen.inc');

	$datos=get_db();
	$idEx=$datos[2];
	$db=$datos[0];
//	show_arr($datos);
//	echo '<hr />';

	$con=conectar($db);
	if($con==null) 
//		redirect_to('public/sin_conexion.html');
//		echo $db;




?>

<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title></title>
	<script src="jquery/jquery-1.4.2.js"></script>
<style>
.nobreak {
    page-break-inside: avoid;
}
#cabeza{
	margin-left:1em;
	margin-right:1em;
	font-family:"Arial";
}
.bloque{
	float:left;
	height:160px;
	font-size: x-small;
	padding:0.5em;
	witdh:220px;
	margin-left:0.5em;
	margin-right:1em;
}
.datos{
	float:right;
	height:220px;
	font-size: x-small;
	padding:0.5em;
	witdh:220px;
}
.big{
	font-size: medium;
}
.small{
	font-size: xx-small;
	width:120px;
}
.clear{
	clear: both;
}
.line{
	border:1px solid gray;
}
</style> 

</head>
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
	</script>
<body>
<div class="rojo"></div>
<?php 

		$examen=your_examen($idEx);

		ex_head($examen['fk_Alumno_id'],$examen['start'],$examen['idExamen']);
		echo "<div class='clear'></div><br /><hr /><br />";
		if($examen['orden']!=null){
			ex_body($examen['preguntas'],$examen['orden'],$examen['respuestas']);
		}else echo 'No ha seleccionado NINGUNA respuesta <br />';

		echo 'Las respuestas resaltadas en negrita, son las repuestas correctas. Las respuestas subrayadas son las respuestas elegidas. Si una respuesta esta unicamente en negrita, es que ha sido respondida de manera correcta.<hr />';
		echo 'Impreso el '.date('G:i - d.m.Y').'<br />';

	?>	
</body>
<!--	<script src="js/final.js"></script> -->
</html>
