$(document).ready(function(){
	var ajax_load = "<img src='img/ajax-loader.gif' alt='loading...' />";  
////funciones para cuestion_create.php
	var idR=0;
//MathJax.Hub.Typeset();
	MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
//Opciones de EDICION
//Enunciado
	$('.css_btt_l[name=edit]').click(function(){
		var idQ=$('.redondear').text();
		$.ajax({
			url: "enunciado_get.php",
			success: function(data){
				var enunciado = data;
				$('#enun').val(enunciado);
				$('#enun1').toggle();
			}
		});
	});
//Update ENUNCIADO
	$('#enum1_form').submit(function(){
		var enun1 = $('#enun').attr('value');
		enun1=encodeURIComponent(enun1);
		$.ajax({
			type: "POST",
			url: "enunciado1.php",
			data: "enun= "+ enun1,
			success: function(){
				$('#ula_main').html(ajax_load).load('cuestion_create.php');
			}
		});
		return false;
	});
//Copiar
	$('.css_btt_l[name=copiar]').click(function(){
		$('#copiar').toggle();
	});	
//IMAGEN 1
	$('.css_btt_l[name=img1]').click(function(){
		$('#f_imagen1').toggle();
	});
/*	$('#img1').fancybox({
				'titlePosition'		: 'inside',
				'transitionIn'		: 'none',
				'transitionOut'		: 'none'
			});
*/
//Seleccion de imagen 1
$("select[name=im1]").change(function () {
	var str = "";
	$(".im_sel1 option:selected").each(function () {
		str = $(this).text() + " ";
	});
	$('.im1_wrap').empty().html('<img src="'+str+'" alt="Imagen" /><br>'+str);
}).change();
//Fijar la imagen 1
$('button[name=im1]').click(function(){
	var imagen= $(".im_sel1 option:selected").text();
	$.ajax({
		type: "POST",
		url: "insert_imagen1.php",
		data: "imagen="+ imagen ,
		success: function(data){
			if(data !='NOk'){ 
//				$('#imagen1').empty()
			$('#ula_main').html(ajax_load).load('cuestion_create.php');
//				$('#f_imagen1').toggle();
//				$('#ula_main').load('cuestion_create.php');
			}
			else{ 
				alert('Imagen demasiado grande. Dimension maxima 800x500.');
			}
		}
	});
	return false;
});    


/*	
//Fijar la IMAGEN 1
$('#img1_form').submit(function(){
	var Cuestion_id =  $('.Numero').attr('id');
	var imagen = 'img/' + $('#img1').attr('value');
	$.ajax({
		type: "POST",
		url: "insert_imagen1.php",
		data: "imagen="+ imagen ,
		success: function(data){
			if(data !='NOk'){ 
				$('#imagen1').empty()
					.append('<img src='+imagen+' />').slideDown('slow');
				$('#f_imagen1').toggle();
//				$('#ula_main').load('cuestion_create.php');
			}
			else{ 
				alert('Imagen demasiado grande. Dimension maxima 800x500.');
			}
		}
	});
	return false;
});    
*/

// IMAGEN 2


$('.css_btt_l[name=img2]').click(function(){
	$('#f_imagen2').toggle();
});	
//Seleccion de imagen 2
$("select[name=im2]").change(function () {
	var str = "";
	$(".im_sel2 option:selected").each(function () {
		str = $(this).text() + " ";
//		console.log(str);
	});
   //$("div").text(str);
	$('.im2_wrap').empty().html('<img src="'+str+'" alt="Imagen" /><br>'+str);
//		str='';
}).change();
//Fijar la imagen 2
$('button[name=im2]').click(function(){
	var imagen= $(".im_sel2 option:selected").text();
	$.ajax({
		type: "POST",
		url: "insert_imagen2.php",
		data: "imagen="+ imagen ,
		success: function(data){
			if(data !='NOk'){ 
				$('#ula_main').html(ajax_load).load('cuestion_create.php');
			}
			else{ 
				alert('Imagen demasiado grande. Dimension maxima 290x300.');
			}
		}
	});
	return false;
});    

/*
$('#img2_form').submit(function(){
	var Cuestion_id =  $('.Numero').attr('id');
	var imagen = 'img/' + $('#img2').attr('value');
	$.ajax({
		type: "POST",
		url: "insert_imagen2.php",
		data: "imagen="+ imagen ,
		success: function(data){
			if(data !='NOk'){ 
//				$('#f_imagen1').hide(500);
				$('#imagen2').empty()
					.append('<img src='+imagen+' />').slideDown('slow');
			$('#f_imagen2').toggle();
//				$('#ula_main').load('cuestion_create.php');
			}
			else{ 
				alert('Imagen demasiado grande. Dimension maxima 290x300.');
			}
		}
	});
	return false;
});    
*/
//Botones de RESPUESTAS (CrUD)
//    CREAR RESPUESTA
//MENU:: INSERTAR RESPUESTA	---------Crud
$('a[title=Answer]').click(function(){
	$('#f_respuestas').toggle('slow');
});	
$('#respuestas_form').submit(function(){
	var Cuestion_id  =  $('.numero').attr('id');
	var answer = $('#answer').attr('value');
	var its = $('#its:checked').attr('value');
	var last = $('#last:checked').attr('value');
	answer=encodeURIComponent(answer);
//	console.log("Leo del usuario "+answer);
	$.ajax({
		type: "POST",
		url: "respuesta.php",
		data: "Cuestion_id="+ Cuestion_id +"& answer="+ answer + "& correcta="+ its+ "& ultima="+ last,
		success: function(data){
	//		$('#f_respuestas').hide(1000);
	//		$('.new_respuestas').wrap('<div id="respuestas" />').remove();
	//		$('#respuestas').load('mostrar_respuestas_editable.php');
				$('#ula_main').empty().html(ajax_load).load('cuestion_create.php');	
		}
	});
	return false;
});    
//ELIMINAR RESPUESTA-----cruD
$('a[name=borrame]').click(function(){
	var answer_id = $(this).attr('value'); 
	var borrar= confirm('¿Eliminar permanentemente?');
//	console.log(borrar);
//	$('#accion').text("Borrado "+idTh);
//	console.log(answer_id);	
	if(borrar)
	$.ajax({
		type: "POST",
		url: "respuesta_borrar.php",
		data: "Cuestion_id="+ answer_id ,
		success: function(data){
			$('.'+answer_id).text('--');
//			$('.'+answer_id).empty();
		//	$('.'+answer_id).append(data);
		}
	});
	return false;
});    
//EDITAR RESPUESTA Ok------crUd
$('a[name=editar]').click(function(){
	var answer_id = $(this).attr('value'); 
	idR=answer_id;
//	var miglobal = 'global';
//	$('.editando').hide();
//	$('.botones'+answer_id).hide();
	$.ajax({
		type: "POST",
		url: "respuesta_get.php",
		data: "idR= "+ answer_id,
		success: function(data){
//console.log("Leo de la bbdd recien -> "+data);
			var arr=data.split("··");
			var respuesta = arr[0];

//			respuesta=decodeURIComponent(respuesta);
//console.log("Leo de la bbdd aft-deco -> "+respuesta);
			var correcta=parseInt(arr[1]);
			var porcentaje=arr[2];
			$('textarea[name=respuesta_texto]').val(respuesta);
			$('input[name=respuesta_porcentaje]').val(porcentaje);
			if(correcta===1) $('.correct[value=1]:radio').attr('checked',true);
			else $('.correct[value=0]:radio').attr('checked',true);
			$('#respuesta_edit').show();
		}
	});
});
//respuesta editada hacia la bbdd
$('input[name=respuesta_editada]').click(function(){
	var answer = $('#respuesta_texto').attr('value');
//console.log("Hacia la BBDD -> "+answer);
		answer=encodeURIComponent(answer);
//console.log("Hacia la BBDD aft-encode -> "+answer);		
	var its = $('.correct:checked').attr('value');
	var porcentaje = $('input[name=respuesta_porcentaje]').attr('value');
	$.ajax({
		type: "POST",
		url: "respuesta_editada.php",
		data: "idR="+ idR +"& answer="+ answer + "& correcta="+ its+ "& porcentaje="+ porcentaje,
		success: function(data){
			$('#ula_main').html(ajax_load).load('cuestion_create.php');
		}
	});
});	
//Porcentajes
$('.correct').change(function(){
	var right_opt = String($('.correct:checked').attr('value'));
	console.log(right_opt);
	if(right_opt==='1') $('input[name=respuesta_porcentaje]').val('100');
	else $('input[name=respuesta_porcentaje]').val('-33');
});



//Nueva CUESTION
$('a[title=nueva]').click(function(){
//	console.log('click');
	$('#ula_main').toggle('slow');			
	$.ajax({
		url:"cuestion_nueva.php",
		success: function(){ 
			$('#ula_main').empty();		
			$('#ula_main').html(ajax_load).load('cuestion_create.php');
			$('#ula_main').toggle('slow');			
		}
	});				
});
//Copiar CUESTION
$('input[name=copia]').click(function(){
//	var borrar= confirm('Eliminar permanentemente?');
//	if(borrar)
	var destino=$('option:selected').val();
	$.ajax({
		type: "POST",
		data: "destino="+destino,
		url:"cuestion_copiar.php",
		success: function(){ 
			$('#ula_main').empty();		
			$('#ula_main').html(ajax_load).load('cuestion_create.php');
		}
	});				
});

//Duplicar CUESTION
$('a[title=duplicar]').click(function(){
//	var borrar= confirm('Eliminar permanentemente?');
//	if(borrar)
	$.ajax({
		url:"cuestion_duplicar.php",
		success: function(){ 
			$('#ula_main').empty();		
			$('#ula_main').html(ajax_load).load('cuestion_create.php');
		}
	});				
});

//Eliminar CUESTION
$('a[title=borrar]').click(function(){
	var borrar= confirm('¿Eliminar permanentemente?');
	if(borrar)
	$.ajax({
		url:"cuestion_borrar.php",
		success: function(){ 
			$('#ula_main').empty();		
			$('#ula_main').html(ajax_load).load('cuestion_create.php');
		}
	});				
});
//Anterior CUESTION
$('a[title=anterior]').click(function(){
	var Cuestion_id  =  numero();
//	console.log('click'+Cuestion_id);
	$.ajax({
		url:"cuestion_anterior.php",
		success: function(){ 
			$('#ula_main').empty();		
			$('#ula_main').html(ajax_load).load('cuestion_create.php');
		}
	});				
});
//Siguiente CUESTION
$('a[title=siguiente]').click(function(){
	var Cuestion_id  =  numero();
//	console.log('click'+Cuestion_id);
	$.ajax({
		url:"cuestion_siguiente.php",
		success: function(){ 
			$('#ula_main').empty();		
			$('#ula_main').html(ajax_load).load('cuestion_create.php');
		}
	});				
});
//Compactar la BASE DE DATOS de CUESTIONES
$('a[title=compactar]').click(function(){
//	console.log('compactando');
	$.ajax({
		url:"cuestion_compactar.php",
		success: function(){ 
			$('#ula_main').empty();		
			$('#ula_main').html(ajax_load).load('cuestion_create.php');
		}
	});				
});
// class='cuestion'
//$("a[title^='conceptos']").click(function(){
$(".cuestion").click(function(){
	var otra = $(this).attr('name');
	$('#ula_main').empty().html(ajax_load);
	$.ajax({
		type: "GET",		
		url:"cuestion_otra.php",
		data: "id_otra="+ otra,
//		beforeSend:function(){
//			$('#ula_main').empty().html(ajax_load);
//		}; 
		success: function(){ 
			$('#ula_main').empty();	//Asi elimino los antiguos trigger de js que haya	
			$('#ula_main').html(ajax_load).load('cuestion_create.php');
		}
	});				
});

///Modificacion 30mayo
//////////Borrar imagen 1
$('.del_im1').click(function(){
	var borrar= confirm('¿Eliminar permanentemente?');
	if(borrar)
	$.ajax({
		type: "POST",
		url: "del_im1.php",
		success: function(data){
			$('#ula_main').html(ajax_load).load('cuestion_create.php');
		}
	});
	return false;

});
//////////Borrar imagen 2
$('.del_im2').click(function(){
	var borrar= confirm('¿Eliminar permanentemente?');
	if(borrar)
	$.ajax({
		type: "POST",
		url: "del_im2.php",
		success: function(data){
			$('#ula_main').html(ajax_load).load('cuestion_create.php');
		}
	});
	return false;
});

///Fin de modificacion30mayo


/////MODIFICACION each()



//////////////////
//Miscelanea
/////////////Miscelanea
//Checkboxes
/*function countChecked() {
	var n = $("input[type=checkbox]:checked").length;
//	$("#pie").text(n +(n <= 1 ? " concepto" : " conceptos") + (n <= 1 ? " es" : " son") + (n <= 1 ? " seleccionado" : " seleccionados"));
	$('#pie').html($("input[type=checkbox]:checked").val());
}
//countChecked();
$(":checkbox").click(countChecked);
*/
//////////////////////////////////Works!!!!
//Añade CONCEPTOS a cada CUESTION
var packet=new Array();

function updateChecks() {         
	var allVals = [];  
  $('input[type=checkbox]:checked').each(function() {
		allVals.push($(this).val());
	});
//     $('#pie').add(allVals);
//	console.log(allVals);
   packet=allVals;
  }
 //  updateTextArea();
   $(':checkbox').click(updateChecks);
   
$('button.setConcept').click(function(){
//	var Cuestion_id  =  $('.Numero').attr('id');
//	Cuestion_id=jQuery.trim(Cuestion_id);
	$('#ula_main').html(ajax_load);
	$.ajax({
		traditional: true,
		type: "POST",
		url: "Qset_Concepts.php",
		data: "Ccs="+packet,
		success: function(data){
			$('#ula_main').empty();		
			$('#ula_main').html(ajax_load).load('cuestion_create.php');
//			$('#pie').html(data)
		}
	});
	return false;
});

function numero(){
	var idQ =  $('.numero').text();
	idQ = idQ.replace(/^\s*|\s*$/g,"");
	return idQ;
}

$('span[class=tema]').click(function(){
//	var Cuestion_id  =  $('.Numero').attr('id');
//	Cuestion_id=jQuery.trim(Cuestion_id);
	updateChecks();
	var Tema = $(this).attr('name');
	$.ajax({
		traditional: true,
		type: "POST",
		url: "Qset_Concepts.php",
		data: "Tema="+Tema+"& Ccs="+packet,
		success: function(data){
	//		$('checkbox').html(data)
//			console.log(data);
			var arr=data.split(",");
			while(arr.length !=0){
				var chk=arr.shift();
//				console.log(chk);
				$('input[name='+chk+']').attr('checked',true);
//			$(':checkbox]').is(':checked')
			}		
		}
	});
	return false;
});
$('.rot').click(function(){
	var estado=$(this).text();
	if(estado=='\+'){
		$('#conceptos_op').show('slow');
		$(this).text('-');
		$('#conceptos_resumen').hide();
	}
	else{
		$('#conceptos_op').hide('slow');	
		$(this).text('+');
		$('#conceptos_resumen').show();
	}
});
//TimeTracker();
//Fin de READY
});
function TimeTracker(){
 console.time("MyTimer");
 for(x=5000; x > 0; x--){}
 console.timeEnd("MyTimer");
}

