$(document).ready(function(){
////QCreator.php
//	if ($('span.pagina').text()==0) {
//		$('span.pagina 0').css("color","white")		
//			.css("font-size","x-large"); 
//	}	
//Botones QCreator,php
//Opciones de CUESTIONES

//BORRAR CUESTION 
$('a[title=Delete]').click(function(){
//BORRAR
//////////////////////////////////Works!!!!
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
/////////////////////
//***************OJO!!!!********************Carga Qnew.php********
/////No funciona vista preliminar del ENUNCIADO para despues incluirlo
//// en la cuestion 

//	$('#contenido1').fadeOut(500);
//	$('#contenido1').queue(function(){
//		$('#contenido1').empty().load('Qnew.php');		
		$('#contenido1').fadeIn(1000);
		$('#contenido1').show();	
//		$(this).dequeue();
//	});		
});
$('a[title=Separacion]').click(function(){
//Split de la base de 
//////////////////////////////////In Progress!!!!
//	var idA = $.cookie.get('idAsig')
//	console.log(idAsig);
		$.ajax({
		type: "POST",
		url: "Split.php",
//		data: "idA="+ idA,
		success: function(data){
			$('#contenido1').html(data)
		}
	});
	return false;
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
$('.css_btt_l[name=edit]').click(function(){
//Desplegar Enunciado form
	var idQ =  $('.Numero').attr('id');
	console.log(idQ);
		$('#enun1').toggle(function(){
//		$(this).toggle();
	});	//$('#contenido').css("color","red");

});

$('#enum1_form').submit(function(){
// ACTUALIZAR ENUNCIADO en DDBB
//cuestion_create.php 
/////////////////////*******Works!!!
//Pulsando el boton Enviar del formulario 
	var Cuestion_id =  $('.Numero').attr('id');
	var enun1 = $('#enun').attr('value');
//	var tabla=
	console.log(enun1);
	$.ajax({
		type: "POST",
		url: "enunciado1.php",
//
		data: "enun= "+ enun1,
		success: function(){
				$('#contenido').load('cuestion_create.php');
//			$('#contenido').load('cuestion_create.php');
//			$('#enum1_form').hide(function(){$('div.success').fadeIn();});
		}
	});
	return false;
});

//IMAGEN 1
/////////////////////*******Works!!!
$('.css_btt_l[name=img1]').click(function(){
	$('#f_imagen1').toggle();
});	

$('#img1_form').submit(function(){
	var Cuestion_id =  $('.Numero').attr('id');
	var imagen = 'img/' + $('#img1').attr('value');
	$.ajax({
		type: "POST",
		url: "insert_imagen1.php",
		data: "imagen="+ imagen ,
		success: function(data){
			if(data !='NOk'){ 
//				$('#f_imagen1').hide(500);
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
// IMAGEN 2
/////////////////////*******Works!!!

/*$('a[title=img2]').click(function(){
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
*/
$('.css_btt_l[name=img2]').click(function(){
	$('#f_imagen2').toggle();
});	

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


//Botones de RESPUESTAS (CrUD)
//    CREAR RESPUESTA
// Formulario que introduce las posibles respuestas a una cuestion
//MENU:: INSERTAR RESPUESTA	---------Crud
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
//ELIMINAR RESPUESTA-----cruD
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
//EDITAR RESPUESTA Ok------crUd
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


//Fin de READY
});
