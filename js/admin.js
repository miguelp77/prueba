$(document).ready(function() {
var ajax_load = "<img src='img/ajax-loader.gif' alt='loading...' />";  
/*
$.ajaxSetup ({
		cache: false
	});
*/
$('.css_btt[name=asignaturas]').click(function(){
	var tabla="Asgs";
//	console.log('ppp');
	$('#contenido').html(ajax_load).load('main_asg.php');
});
$('.black[name=read_asg]').click(function(){
	$('#contenido').html(ajax_load).load('asignatura_listar.php');
//		console.log('elegir');	
});

//notas
$('.css_btt[name=notas]').click(function(){
	var tabla="Asgs";
	$.ajax({
//		type: "POST",
		url: "convocatoria_listar.php",
//			data: "tabla=" + tabla,
		success: function(data){
			$('#contenido').html(data);
//				if(data) location.href =data+".php";				

//				else $('#contenido').append(data);//location.href ="index.php";
//				if(data.length<1)location.href ="index.php";
		}
	});
});

//alumnos

$('.css_btt[name=alumnos]').click(function(){
	var tabla="Asgs";
	$.ajax({
//		type: "POST",
		url: "alumnos_crud.php",
//			data: "tabla=" + tabla,
		success: function(data){
			$('#contenido').html(data);
//				if(data) location.href =data+".php";				

//				else $('#contenido').append(data);//location.href ="index.php";
//				if(data.length<1)location.href ="index.php";
		}
	});
});
$('.css_btt[name=db_check]').click(function(){
	var tabla="Asgs";
	$('#contenido').html(ajax_load).load('inicializar_bbdd.php');
/*	$.ajax({
		type: "POST",
		url: "ruta/use_table.php",
//			data: "tabla=" + tabla,
		success: function(data){
			$('#contenido').html(data);
//				if(data) location.href =data+".php";				

//				else $('#contenido').append(data);//location.href ="index.php";
//				if(data.length<1)location.href ="index.php";
		}
	});*/
});
$('.css_btt[name=expresiones]').click(function(){
	var tabla="Asgs";
	$.ajax({
		url: "tex2png.php",
		success: function(data){
			$('#contenido').html(ajax_load).html(data);
		}
	});
});
$('.css_btt[name=convocatoria]').click(function(){
//	var tabla="Asgs";
	$.ajax({
		url: "../ajax/report_convocatoria.php",
		success: function(data){
			$('#contenido').html(ajax_load).html(data);
		}
	});
});

//Esto de abajo no se si funciona
$('a[name^=Asg]').live('click',(function(){
	var Eleccion=$(this).attr('name');
//	console.log(Eleccion);
	$.ajax({
		type: 'POST',
		data:'tabla='+Eleccion,
//		url: 'ruta/showAsg.php',
		url: 'ruta/get_all_qs.php',
//		url: 'mio.php',
		success: function(data){
//			$('#contenido').html("<iframe id='localscene' name='localscene' src='get_all_qs.php' width='780px' height='600px' framespacing='0' border='0'></iframe>");// framespacing="0" scrolling="auto" border="0" style="position:absolute; left:726px; top:231px; width:216; height:250; z-index:5">
			$('#contenido').html(ajax_load).html(data);
//	location.href ="mio.php";
		}
	});	
}));
$('.css_btt[name=examenes]').click(function(){
	var tabla="Asgs";
	$('#contenido').html(ajax_load).load('examen_draft.php');
});
$('.css_btt[name=monitor]').click(function(){
	var tabla="Asgs";
	$('#contenido').html(ajax_load).load('monitor.php');
});

$('.black[title=Ocultar]').click(function(){
	$('#menu').hide('slow');
});
$('.black[title=Orientar]').click(function(){
	$('#menu').hide('slow');
	$('#menu2').toggle('slow');
});

$('.black[title=Mostrar]').click(function(){
	$('#menu').show('slow');
	$('#menu2').hide('slow');
});

//Shorcut Ctrl+Shift+X
$(document).keypress(function(e){
  //  var checkWebkitandIE=(e.which==26 ? 1 : 0);
//    var checkMoz=(e.which==88);
	var tecla = e.which;	
	switch (tecla)
	{
		case 88:
			$('#contenido').html(ajax_load).load('asignatura_listar.php');
			break;
		case 89:
			$('#contenido').html(ajax_load).load('main_asg.php');
			break;
		default:
			break;
	}

//    if (checkMoz)
//			$('#contenido').html(ajax_load).load('asignatura_listar.php');
});



//FIN

});

