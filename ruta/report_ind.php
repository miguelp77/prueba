<?php
session_start();
require_once('includes/db_config.php');
//include('../includes/GoogChart.class.php');
require_once('ajax/reports.inc');

?>

<!DOCTYPE HTML>
<html lang="es-ES">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Highlighter Test</title>
  <!--[if IE]><script language="javascript" type="text/javascript" src="../excanvas.js"></script><![endif]-->

  
  <link rel="stylesheet" type="text/css" href="../js/jquery.jqplot.css" />
  <link rel="stylesheet" type="text/css" href="../js/examples.css" />
  <!-- BEGIN: load jquery -->
  <script language="javascript" type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
  <!-- END: load jquery -->

  
  <!-- BEGIN: load jqplot -->
  <script language="javascript" type="text/javascript" src="../js/jquery.jqplot.js"></script>
  <script language="javascript" type="text/javascript" src="../js/plugins/jqplot.dateAxisRenderer.js"></script>
  <script language="javascript" type="text/javascript" src="../js/plugins/jqplot.highlighter.js"></script>
  <script language="javascript" type="text/javascript" src="../js/plugins/jqplot.cursor.js"></script>
	<script type="text/javascript" src="../js/plugins/jqplot.canvasTextRenderer.min.js"></script>
	<script type="text/javascript" src="../js/plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>
	<script type="text/javascript" src="../js/plugins/jqplot.pointLabels.min.js"></script>  
	<script type="text/javascript" src="../js/plugins/jqplot.trendline.min.js"></script>
  <!-- END: load jqplot -->


<script language="javascript" type="text/javascript">

$(document).ready(function(){	
/*function replace(arrayName,replaceTo, replaceWith)
{
  for(var i=0; i<arrayName.length;i++ )
  {  
    if(arrayName[i]==replaceTo)
      arrayName.splice(i,1,replaceWith);          
  }        
}*/
	$.jqplot.config.enablePlugins = true; // on the page before plot creation.
	var datos=[];
	var x=[];		//Representacion de la combinacion
	var media=[];
	var maximo=0;				//Maximo numero de pruebas
	var cosPoints = [];
	var arr=new Array(); //Combinacion
	var arr1=new Array();	//Pruebas
	var arr2=new Array(); //Notas
	var arr_t=new Array();
	$.ajax({
		type: "POST",
		url: "../ajax/data_ind.php",
		success: function(data){
//			console.log(data)
			var str='';
			arr=data.split(",");
			while(arr.length !=0){
				var chk=arr.shift();
				chk=chk.replace(/~/gi,",");
				datos.push(chk);
				str=datos.join(",");
				arr_t=str.split(",");
				arr_t[1]=arr_t[1].replace(/\n/gi,"");
				arr_t[1]=parseInt(arr_t[1]);
				arr1.push(arr_t[0]); //Pruebas
				arr2.push(arr_t[1]); //Notas
				datos.pop();
			} //Fin del while
			var valor=0;
			for (i in arr1){
				var y=[];
				datos = arr1[i]; //Coordenada X
				y.push(datos);
				datos = arr2[i]; //Coordenada Y
				y.push(datos);
				maxi=parseInt(arr1[i]);
				valor=valor+parseInt(arr2[i]);
				x.push(y); //Combinacion de coordenadas
			} //fin del for
			valor=(valor/(parseInt(i)+1));
			maximo=parseInt(i)+1.1;
			for(i in arr1){
				media.push(valor);
			}//fin del for
		},//Fin del success
		complete: function(){
//			console.log(arr2);
			plot1 = $.jqplot('chart1', [arr2,media], {  
			series:[
				{label: 'Notas',showMarker:true},
				{label:'media', lineWidth:1, showMarker:false,
					pointLabels:{show:false}}],
			axes:{
				xaxis:{
					max:maximo,label:'Pruebas',autoscale: false},
				yaxis:{min:-0.2, max:10.2,autoscale: true}},
			legend:{show: true,location: 'nw',},
			cursor: {showTooltip: false,},
			}); //Fin del plot1
			//plot2 Fechas

			plot2 = $.jqplot('chart2', [x], {
			//  title:'Por fechas.',
				gridPadding:{right:35},
				axes:{
					xaxis:{renderer:$.jqplot.DateAxisRenderer,
						tickOptions:{formatString:'%#d %b,%y'}, //%y
			 //  tickInterval:'1 week'
					}
				},
				series:[{lineWidth:4, markerOptions:{style:'square'}}]
			});//Fin del plot2
		}//Fin del Complete
	});//Fin de AJAX
});//Fin del ready
</script>

<style>

.izq{float:left;}
.dcha{float:right;}
.nobreak {page-break-inside: avoid;}
.clear{clear: both;}
/*body{font-family:"Lucida Console";font-size:small;background:#eeeeee;}*/
p{font-size:small;clear:both;	} 
.fld{display:none;margin-left:1em;width:6em;float:left;}
.fecha{display:block;}
.line{border-bottom:0.1em solid;}
.big{	margin-top:2em;font-size:medium;color:#444444;background:#ffffff;}
</style> 


</head>
<body>
<div class="rojo"></div>

<?php 
	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		conectar($db);
	}
//	$asg='asg_mike_10';
//	$con=conectar($db);
	
//	$a = array('green', 'red', 'yellow');
//$b = array('avocado', 'apple', 'banana');
//$c = array_combine($a, $b);
//print_r($c);
//	cabeza();
//	expediente();
	$idA=$_POST['idA'];
	$_SESSION['idA2']=$idA;
//	$datos_ind=get_data($idA);

?>	

<div id="chart1" class="plot" style="width:500px;height:300px;"></div>
<div id="chart2" class="plot" style="width:500px;height:300px;"></div>


</body>
<script src="../js/final.js"></script>
</html>
