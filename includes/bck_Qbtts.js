$(document).ready(function(){
//	QCreator.php
	$('#identifier').hoverAccordion();
	if ($('span.pagina').text()==0) {
		$('span.pagina 0').css("color","white")		
			.css("font-size","x-large"); 
	}	
//Botones QCreator,php
//Opciones de CUESTIONES
$('a[name=Sig]').live('click',(function(){ 
//SIGUIENTE CUESTION
	var now=$('.redondear').text();
	var ahora=parseInt(now);
	$.ajax({
		type: "POST",
		url: "next_Q.php",
		data: "Ahora="+ ahora ,
		success: function(data){
			var sig=parseInt(data);
			window.self.location.href='QCreator.php?QQ='+sig;
		}
	});
	return false;
}));

$('a[name=Pre]').live('click',(function(){
 //ANTERIOR CUESTION
	var now=$('.redondear').text();
	var ahora=parseInt(now);
	$.ajax({
		type: "POST",
		url: "pre_Q.php",
		data: "Ahora="+ ahora ,
		success: function(data){
			var sig=parseInt(data);
			window.self.location.href='QCreator.php?QQ='+sig;				
		}
	});
	return false;
}));
//BORRAR CUESTION 
$('a[title=Delete]').click(function(){
//BORRAR
	var Cuestion_id  =  $('.Numero').attr('id');
	Cuestion_id=jQuery.trim(Cuestion_id);
		$.ajax({
		type: "POST",
		url: "Qdelete.php",
		data: "idQ="+ Cuestion_id,
		success: function(data){
			$('#contenido1').html(data)
		}
	});
	return false;
});
//NUEVA
$('a[title=Nueva]').click(function(){
//CREAR NUEVA CUESTION
/////////////////////*******Works!!!
//***************OJO!!!!********************Carga Qnew.php********
	$('#contenido1').fadeOut(500);
	$('#contenido1').queue(function(){
		$('#contenido1').empty().load('Qnew.php');		
		$('#contenido1').fadeIn(1000);
		$('#contenido1').show();	
		$(this).dequeue();
	});		
});
/////////////////////*******Works!!!
$('a[title=Ordenar]').click(function(){
//lanza orden_Q.php cuando se añade/elimina algo hay ORDENAR
$.ajax({
		type: "POST",
		url: "orden_Q.php",
	});
	return false;
});


//Opciones de EDICION
//Enunciado****Work!s!!
$('a[title=Edit]').click(function(){
//Desplegar Enunciado form
	$('#enun1').toggle(function(){
//		$(this).toggle();
	});	//$('#contenido').css("color","red");
});

$('#enum1_form').submit(function(){
// ACTUALIZAR ENUNCIADO en DDBB
//QCReator.php 
/////////////////////*******Works!!!
//Pulsando el boton Enviar del formulario 
	var Cuestion_id =  $('.Numero').attr('id');
	var enun1 = $('#enun').attr('value');
	$.ajax({
		type: "POST",
		url: "enunciado1.php",
		data: "Cuestion_id="+ Cuestion_id +"& enun1="+ enun1,
		success: function(){
			$('#enum1_form').hide(function(){$('div.success').fadeIn();});
		}
	});
	return false;
});

//IMAGEN 1
/////////////////////*******Works!!!
$('a[title=img1]').click(function(){
	$('#f_imagen1').toggle(function(){
		$(this).css("visibility","show");
		$('#imagen1').wrap('<div class="new" />').hide(1000);
	});	
});	
$('#img1_form').submit(function(){
	var Cuestion_id =  $('.Numero').attr('id');
	var imagen = 'img/' + $('#img1').attr('value');
	$.ajax({
		type: "POST",
		url: "insert_imagen1.php",
		data: "Cuestion_id="+ Cuestion_id +"& imagen="+ imagen ,
		success: function(data){
			if(data !='NOk'){ 
				$('#f_imagen1').hide(500);
				$('.new').hide('slow').empty();
				$('.new').append('<img src='+imagen+' />').slideDown('slow');
			}
			else{ 
				alert('Imagen demasiado grande. Dimension maxima 800x500.');
			}
		}
	});
	return false;
});    
// IMAGEN 2
/////////////////////*******Works!!!
$('a[title=img2]').click(function(){
	$('#f_imagen2').toggle(function(){
		$(this).css("visibility","show");
		$('#imagen2').wrap('<div class="new" />').hide(1000);
	});	
});	
$('#img2_form').submit(function(){
	var Cuestion_id  =  $('.Numero').attr('id');
	Cuestion_id=jQuery.trim(Cuestion_id);
	var imagen = 'img/' + $('#img2').attr('value');
	$.ajax({
		type: "POST",
		url: "insert_imagen2.php",
		data: "Cuestion_id="+ Cuestion_id +"& imagen="+ imagen ,
		success: function(data){
			if(data !='NOk'){ 
				$('#f_imagen2').hide(500);
				$('.new').hide('slow').empty();
				$('.new').append('<img src='+imagen+' />').slideDown('slow');
			}
			else { 
				alert('Imagen demasiado grande. Dimension maxima 300x300.');
			}
		}
	});
	return false;
});    

//Botones de RESPUESTAS (CrUD)
//    CREAR RESPUESTA
// Formulario que introduce las posibles respuestas a una cuestion
//MENU:: INSERTAR RESPUESTA	
$('a[title=Answer]').click(function(){
	$('#f_respuestas').toggle(function(){
		$(this).css("visibility","show");
		$('#respuestas').wrap('<div class="new_respuestas" />');
		$('#respuestas').remove();					
	});	
});	
$('#respuestas_form').submit(function(){
	var Cuestion_id  =  $('.Numero').attr('id');
	var answer = $('#answer').attr('value');
	var its = $('#its:checked').attr('value');
	$.ajax({
		type: "POST",
		url: "respuesta.php",
		data: "Cuestion_id="+ Cuestion_id +"& answer="+ answer + "& correcta="+ its,
		success: function(data){
			$('#f_respuestas').hide(1000);
			$('.new_respuestas').wrap('<div id="respuestas" />').remove();
			$('#respuestas').load('mostrar_respuestas_editable.php?QR='+ Cuestion_id);
		}
	});
	return false;
});    
//ELIMINAR RESPUESTA
$('a[title=borrar]').live('click',(function(){
	var answer_id = $(this).attr('value'); 
	$('.'+answer_id).empty();
	$.ajax({
		type: "POST",
		url: "respuesta_borrar.php",
		data: "Cuestion_id="+ answer_id ,
		success: function(data){
			$('.'+answer_id).append(data);
		}
	});
	return false;
}));    
//EDITAR RESPUESTA Ok
$('a[title=editar]').live('click',(function(){
	var answer_id = $(this).attr('value'); 
	var miglobal = 'global';
	$('.botones'+answer_id).hide();
	var texto= $(this).parent().text();
	$(this).parent().append('<div class="editando"><input type="text" title="editando" value="'+texto+'" /><div class="editando'+answer_id+'" /><a class="css_button" href="#" title="AnswerUpdate">Guardar</a></div>').show();
	$('.editando').show();	
	$('input[title=editando]').keyup(function(){
		var edi = $(this).val();			
		$('.editando'+answer_id).text(edi);				
		miglobal=edi;
	}).keyup();
	var edi2 = $('input[title=editando]').val();
	$('a[title=AnswerUpdate]').click(function(){
		$('.botones'+answer_id).show();
		$.ajax({
			type: "POST",
			url: "respuesta_editar.php",
			data: "Resp_id="+ answer_id + "& Respuesta="+ miglobal , 
			success: function(data){
				$('.'+answer_id).text(data);
			}
		});
	});
	return false;
}));

//Miscelanea
//Checkboxes
/*function countChecked() {
	var n = $("input[type=checkbox]:checked").length;
//	$("#pie").text(n +(n <= 1 ? " concepto" : " conceptos") + (n <= 1 ? " es" : " son") + (n <= 1 ? " seleccionado" : " seleccionados"));
	$('#pie').html($("input[type=checkbox]:checked").val());
}
//countChecked();
$(":checkbox").click(countChecked);
*/
//CONCEPTOS en la CUESTION
var packet=new Array();
function updateTextArea() {         
	var allVals = [];  
  $('input[type=checkbox]:checked').each(function() {
		allVals.push($(this).val());
	});
//     $('#pie').add(allVals);
//	console.log(allVals);
   packet=allVals;
  }
 //  updateTextArea();
   $(':checkbox').click(updateTextArea);
$('button.setConcept').click(function(){
		var Cuestion_id  =  $('.Numero').attr('id');
	Cuestion_id=jQuery.trim(Cuestion_id);
		$.ajax({
		 traditional: true,
			type: "POST",
			url: "Qset_Concepts.php",
			data: "idQ="+ Cuestion_id+"& Ccs="+packet,
			success: function(data){
				$('#pie').html(data)
		}
	});
	return false;
});



//Requiere TIMER
//Hora
$('#hora').everyTime(1000,function() {
	var pubDate = new Date();
	var pubMinute = pubDate.getUTCMinutes();
	var pubHour = pubDate.getUTCHours()+2;
	var pubSecond = pubDate.getSeconds();
	if(pubHour < 10) pubHour = '0' + pubHour;
	if(pubMinute < 10) pubMinute = '0' + pubMinute;
	if(pubSecond < 10) pubSecond = '0' + pubSecond;
	$(this).text(pubHour + ':' + pubMinute + ':' + pubSecond);
	$(this).css("text-font","20px");
},0);


//Fin de READY
});
