$(document).ready(function() {
	var id_tema;
	var id_concepto;
	var ajax_load = "<img src='img/ajax-loader.gif' alt='loading...' />";  
//Nuevo Tema
$('.small[name=tema_nuevo]').click(function(){
	$('#add_tema').toggle();
	$('.ready').css('padding','0.2em')
		.css('border','0.1em solid black')
		.append("<h4><ol></ol></h4>");
});
//
$('input[id=newTh]').click(function(){
	var Tema= $('input[id=Tema]').attr('value');
	$('ol:last').append("<li>"+Tema+"</li>");
	$.ajax({
		type: "POST",
		url: "ruta/newTema.php",
		data: "Nombre="+ Tema,
		success: function(data){
			id_tema=data;
			$('input[id=Tema]').val('');
		}
	});
});
//Nuevo concepto
	$('input[id=newConcept]').click(function(){
		var qIndex=0;
		var Concepto= $('input[id=Concepto]').attr('value');
		$('li:last').append("<dd>"+Concepto+"</dd>");
  	qIndex=$('dd:last').index('dd'	);
		$.ajax({
				type: "POST",
				url: "ruta/newConcepto.php",
				data: "Nombre="+ Concepto + "& idTema=" + id_tema,
				success: function(data){
					$('input[id=Concepto]').val('');				
				}
		});
	});			
	
//	$('input[id=bEnd]').click(function(){
//		$('#ula').empty();				
//		$('#ula').html(ajax_load).load('concepto_no_js.php');
//	});			

////EDITAR TEMA
$('.small[name=tema_editar]').click(function(){
	id_tema= $(this).attr('value');
	var txt_tema=$(this).children('a').attr('title');
	$('#tema_form:hidden').toggle();
	$('#concepto_edit:visible').toggle();
	$('input[name=tema_nombre]').val(txt_tema);		
});
//Actualizar el Tema	
$('#update_tema').click(function(){
	var txt_tema=$('input[name=tema_nombre]').attr('value');
	$.ajax({
		type:"POST",
		url: "ruta/editTh.php",
		data: "Tema="+ id_tema+"& NewTema="+ txt_tema,
		success: function (data){
			$('#tema_form').toggle();
			$('#ula').empty();				
			$('#ula').html(ajax_load).load('ruta/concepto.php');
 		}
	});
});
//Editar CONCEPTO
$('.underl[name=concepto_editar]').click(function(){
	id_concepto= $(this).attr('value');
	$('#concepto_edit:hidden').toggle();
	$('#tema_form:visible').toggle();
	$.ajax({
		type:"POST",
		url: "ruta/getCc.php",
		data: "idConcepto="+ id_concepto,
		success: function (data){
			var arr =	data.split(",");
			$('input[name=concepto_edit]').val(arr[0]);
			$('#descripcion_edit').val(arr[1]);
		}
	});
});
//Actualizar el Concepto	
$('#concepto_actualizar').click(function(){
	var concepto_update=$('input[name=concepto_edit]').attr('value');
	$.ajax({
		type:"POST",
		url: "ruta/editCc.php",
		data: "idConcepto="+ id_concepto+"& NewConcepto="+ concepto_update,
		success: function (data){
			$('#concepto_edit').toggle();
			$('#ula').empty();				
				$('#ula').html(ajax_load).load('ruta/concepto.php');
 		}
	});
});

$('#descripcion_actualizar').click(function(){
	var descripcion_update=$('#descripcion_edit').attr('value');
	$.ajax({
		type:"POST",
		url: "ruta/edit_descripcion.php",
		data: "idConcepto="+ id_concepto+"& NewDescripcion="+ descripcion_update,
		success: function (data){
			$('#concepto_edit').toggle();
			$('#ula').empty();				
			$('#ula').html(ajax_load).load('ruta/concepto.php');
		}
	});
});

//BORRAR TEMA y CONCEPTOS		
$('.small[name=tema_borrar]').click(function(){
	var idTh= $(this).attr('value');
//			console.log('click '+ idTh);				
	var borrar= confirm('Eliminar permanentemente?');
//	console.log(borrar);
//	$('#accion').text("Borrado "+idTh);
	if(borrar)
		$.ajax({
			type:"POST",
			url: "ruta/deleteTh.php",
			data: "idTema="+ idTh,
			success: function (data){
				$('#ula').html(ajax_load).load('ruta/concepto.php');
  		}
	});
});

//Tema nuevo
$('.small[name=tema_añadir]').click(function(){
	id_tema= $(this).attr('value');
//		console.log('click add '+ id_tema);	
	$('.con[name='+id_tema+']').toggle();
});
//Nombre del concepto	
$('input[name=addC]').click(function(){
	var concepto=$('input[class=appending'+id_tema+']').attr('value');
	$.ajax({
		type: "POST",
		url: "ruta/newConcepto.php",
		data: "Nombre="+ concepto + "& idTema=" + id_tema,
		success: function(data){
			$('#ula').empty();				
			$('#ula').html(ajax_load).load('ruta/concepto.php');
		}
	});	
});		
//
$('input[id=bEnd]').click(function(){
	$('#ula').empty();				
	$('#ula').html(ajax_load).load('ruta/concepto.php');
});		
//Crear
$('input[name=create]').click(function(){
	$('#contenido').html(ajax_load).load('ruta/cuestion_create.php');
});			
//Borrar
$('.small[name=concepto_borrar]').click(function(){
	id_concepto= $(this).attr('value');
	$.ajax({
			type:"POST",
			url: "ruta/deleteCc.php",
			data: "idConcepto="+ id_concepto,
			success: function (data){
 				$('#ula').empty();				
 				$('#ula').html(ajax_load).load('ruta/concepto.php');
	 		}
		});
});
//FIN
})
