<?php
session_start();
//Next_Q Siguiente cuestion en orden	
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	require_once('includes/fixing_exp.inc');
//	$idQ=$_SESSION['idQ'];
	$db=$_SESSION['db_name'];
	conectar($db);
//	conectar("asg_padre");
?>
<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title></title>
<!--	<script type="text/javascript" src="js/db_lista.js"></script> -->
<style>
.campo{float:left;width:6em;font-size:medium;text-align:left;margin-left:1em;}
.c15{float:left;width:14em;font-size:small;text-align:left;margin-left:1em;}
.nobreak{page-break-inside:avoid;}
li{margin-left:0em;}
li.nr{margin-left:1.5em;padding:0.5em;}
ul{list-style: none;margin:0;padding:0;}
.clear{clear:both;}
.colorme{color:#000;margin-botom:1em;border-bottom:1px dashed #ddd;}
.dcha{float:right;}
.odd{color:blue;}
/*body{color:#444444;background-color: beige;font-family:"Arial", Monospace;}*/
#pie{}
#container {min-height: 100%;margin-bottom: -36px;}
* html #container {height: 100%;}
#footer-spacer {height: 36px;}
#footer {height: 35px;}
html, body {height: 100%;}
body {margin: 0;padding: 0;}
#top {position: absolute;}

</style>
</head>
<body>

<h2>Listados de notas.</h2>
<p>Elija una convocatoria</p>
	<form name="input" action="print_notas.php" method="get">
	<?php
	
	$max=large_expediente();
		echo '<hr />';

//	$array=get_fechas($max);
	$array=get_all_dates();
	$array=sort_dates($array);
//	show_arr($array);
//	show_arr(sort_dates($array));

$convocatorias=Array();
if($array){
	foreach($array as $val){
		static $s=1;
		$phpdate=date('d-M-Y',strtotime($val));
		if(!in_array($phpdate,$convocatorias)) $convocatorias[]=$phpdate;
		//	else $convocatorias[]=$phpdate.'('.$s++.')';
		//$convocatorias[]=$phpdate;
	}
	array_options($convocatorias);	
echo '<span class="css_boton" name="notas_lista">Consultar</span><br />';
	$grupos = get_grupos();
//	print_r($grupos);
	foreach($grupos as $g){
		echo '<input type="checkbox" name="opcional" value="'.$g.'"/>'.$g;
	}
}else echo 'No hay convocatorias realizadas';		

unset($convocatorias);
unset($array);

//	db_options($db,'Apellidos','Alumnos');
	//get_by_date('03-03-2011');
//aqui('termina de mostrar el select_form',__LINE__);
//	listado_notas($db,'03-03-2011');
	
	?>


<script src="../js/notas.js?1.1.3" type="text/javascript"></script>


</body>

</html>
