<?php

require_once('../includes/db_config.php');
//include('../includes/GoogChart.class.php');
require_once('reports.inc');
//require_once('../includes/db_tools.php');

function get_notas($idA){
	$sql="SELECT notas FROM Expedientes WHERE idAlumno='$idA' ";
	$query=mysql_query($sql) or die (mysql_error());
	$row=mysql_fetch_row($query);
	$datas=explode(",",$row[0]);
	//	$a = array('green', 'red', 'yellow');
$b = array('avocado', 'apple', 'banana');
	return $datas;
}
function get_pruebas($idA){
	$sql="SELECT pruebas FROM Expedientes WHERE idAlumno='$idA' ";
	$query=mysql_query($sql) or die (mysql_error());
	$row=mysql_fetch_row($query);
	$datas=explode(",",$row[0]);
	return $datas;
	
}
function get_dates($idA){
	$sql="SELECT Fechas FROM Expedientes WHERE idAlumno='$idA' ";
	$query=mysql_query($sql) or die (mysql_error());
	$row=mysql_fetch_row($query);
	$datas=explode(",",$row[0]);

//	foreach($datas as $key=>$value){
//		echo 'dato: '.$key.'>>>>>'.$value.'<br />';
//	}	
	$a = array('green', 'red', 'yellow');
//$b = array('avocado', 'apple', 'banana');
	return $datas;
}

function get_data($idA){
//	$fechas=array();
//	$notas=array();
//	var_dump(get_dates($idA));
//	echo get_dates($idA);
	$fechas=get_pruebas($idA);
	$notas=get_notas($idA);
	array_shift($fechas);
	array_shift($notas);
	$comb=array_combine($fechas,$notas);
//	print_r ($comb);
//	echo '<br />';
//	print_r ($fechas);
//	echo '<br />';
//	print_r ($notas);
//	echo '<br />';
	foreach($comb as $key=>$value){
		echo 'dato: '.$key.' => '.$value.'<br />';
	}
}

?>

<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title>Resumen: Asignatura</title>
  <link rel="stylesheet" type="text/css" href="js/jquery.jqplot.css" />
  <script language="javascript" type="text/javascript" src="jquery/jquery-1.4.2.js"></script>	
	<script type="text/javascript" src="js/plugins/jqplot.dateAxisRenderer.min.js"></script>
	<script type="text/javascript" src="js/plugins/jqplot.canvasTextRenderer.min.js"></script>
	<script type="text/javascript" src="js/plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
	<script type="text/javascript" src="js/plugins/jqplot.highlighter.min.js"></script>
	<script type="text/javascript" src="js/plugins/jqplot.cursor.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){	
	$.jqplot.config.enablePlugins = true; // on the page before plot creation.
	line1=[['23-May-08', 578.55], ['20-Jun-08', 566.5], ['25-Jul-08', 480.88], ['22-Aug-08', 509.84],
    ['26-Sep-08', 454.13], ['24-Oct-08', 379.75], ['21-Nov-08', 303], ['26-Dec-08', 308.56],
    ['23-Jan-09', 299.14], ['20-Feb-09', 346.51], ['20-Mar-09', 325.99], ['24-Apr-09', 386.15]];
	plot1 = $.jqplot('chart1', [line1], {
    title:'Data Point Highlighting',
    axes:{
      xaxis:{
				renderer:$.jqplot.DateAxisRenderer,
        rendererOptions:{tickRenderer:$.jqplot.CanvasAxisTickRenderer},
        tickOptions:{
          formatString:'%b %#d, %Y', 
          fontSize:'10pt', 
          fontFamily:'Tahoma', 
          angle:-30
        }
       },
      yaxis:{tickOptions:{formatString:'$%.2f'}}
    },
    highlighter: {sizeAdjust: 7.5},
    cursor: {show: false}
	});
});
</script>

<style>

.izq{
	float:left;
}
.dcha{
	float:right;
}
.nobreak {
    page-break-inside: avoid;
}
.clear {
	clear: both;
}
/*body{
	font-family:"Lucida Console";
	font-size:small;
	background:#eeeeee;

}*/
p{
/*	font-family:"Lucida Console"; */
	font-size:small;
	clear:both;	
} 
.fld{
	display:none;
	margin-left:1em; 
	width:6em;
	float:left;
}
.fecha{
	display:block;
}
.line{
border-bottom:0.1em solid;
}
.big{
	margin-top:2em;
	font-size:medium;
	color:#444444;
	background:#ffffff;
	
}
</style> 


</head>
<body>
<div class="rojo"></div>

<?php 
	$asg='asg_mike_10';
	echo "Informes<br />";
	$con=conectar($asg);
//	$a = array('green', 'red', 'yellow');
//$b = array('avocado', 'apple', 'banana');
//$c = array_combine($a, $b);
//print_r($c);
//	cabeza();
//	expediente();
	$idA=5;
	get_data($idA);

?>	
<div id="chart1" class="plot" style="width:500px;height:300px;"></div>
<!-- <iframe src='test_pdf.pdf'></iframe> -->
<!--<embed src='test_pdf.pdf' width='800' height='375'></embed> -->
</body>
	
	<script src="js/final.js"></script>

</html>
