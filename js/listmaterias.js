$(document).ready(function() {
//Apoyando listMaterias.php // misfunciones.php // Get_file_bdp.php
//listTh.php
	var Asig_global=0;
	$('input[name=SelMateria]').click(function(){	
		var Materia= $('select').attr('value');
		Asig_global= $('option:selected').attr('id');				
	//	$('#bbdd').hide('slow');
		$('#info').html("Asignatura: <b>"+Materia+"</b>");
		$.ajax({
			type:"POST",
			url: "ruta/listTh.php",
			data: "Asignatura="+ Asig_global,
			success: function (data){
  			$('#info').html(data);
  			//	$('#archivo').hide();
  		}
		});
	});
//Update TEMA	
// Creo en el DOM un campo de texto
// Donde editar el nombre del tema
// Y un boton con anchor para guarda el
// nuevo valor del tema
$('.updateTH').click(function(){
		var idTh= $(this).attr('value');
		var texto=$(this).parent().text();
		console.log("editando tema");
		$('#accion').text(idTh);
		$(this).parent().after('<div class="editando"><input type="text" title="editar" value="'+texto+'" /><a class="css_button Th" href="#" title="'+idTh+'">Guardar</a>').show();
		$(this).hide();
});
// boton guardar el nuevo nombre
// del tema
$('.Th').live('click',(function(){
	var idTh=$(this).attr('title');
	newTh=$(this).prev().val();
	//	$('#accion').text(newTh);
	$.ajax({
		type:"POST",
		url: "ruta/editTh.php",
		data: "Tema="+ idTh+"& NewTema="+ newTh,
		success: function (data){
  			//$('#info').append(data);
 		//	$('#accion').text(data);
			$('#uld').load('ruta/listTh.php');
 		}
	});
}));			
//Eliminar TEMA y sus CONCEPTOS
$('a.deleteTH').click(function(){
	var idTh= $(this).attr('value');
	$('#accion').text("Borrado "+idTh);
	$.ajax({
		type:"POST",
		url: "ruta/deleteTh.php",
		data: "idTema="+ idTh,
		success: function (data){
			$('#uld').load('ruta/listTh.php');
  	}
	});
});
//Fin de eliminar TEMA y sus CONCEPTOS


//Update Conceptos	

/*	$('a.updateCC').live('click',function(){
		var idCc= $(this).attr('value');
		var txt=$(this).parent().text();
		$('#accion').text(idCc);
		$(this).after('<div class="editando"><input type="text" title="editando" value="'+txt+'" /><a class="css_button Cc" href="#" title="'+idCc+'">Guardar</a>');
		$(this).hide();
});
*/	
$('.updateCC').click(function(){
		var idCc= $(this).attr('value');
		var texto=$(this).parent().text();
//		console.log("editando concepto");
		$('#accion').text(idCc);
		$(this).parent().after('<div class="editando"><input type="text" title="editar" value="'+texto+'" /><a class="css_btt_l Cc" href="#" title="'+idCc+'">Guardar</a>').show();
		$(this).hide();
});

// Boton guardar cambios
/*
	$('.Cc').live('click',function(){
		var idCc=$(this).attr('title');
		newCc=$(this).prev().val();
	//	$('#accion').text(newTh);
		$.ajax({
			type:"POST",
			url: "editCc.php",
			data: "idConcepto="+ idCc+"& NewConcepto="+ newCc,
			success: function (data){
  			//$('#info').append(data);
  			$('#accion').text(data);
  		}
		});
		$.ajax({
			type:"POST",
			url: "listTh.php",
			data: "Asignatura="+ Asig_global,
			success: function (data){
  			$('#info').html(data);
  			//	$('#archivo').hide();
  		}
		});						
	});
*/			
$('.Cc').live('click',function(){
	var idCc=$(this).attr('title');
	newCc=$(this).prev().val();
	//	$('#accion').text(newTh);
	$.ajax({
		type:"POST",
		url: "ruta/editCc.php",
		data: "idConcepto="+ idCc+"& NewConcepto="+ newCc,
		success: function (data){
			$('#uld').load('ruta/listTh.php');
 		}
	});
});			

//Fin de Editar Concepto
//Eliminar CONCEPTO
/*
	$('a.deleteCC').live('click',function(){
		var idCc= $(this).attr('value');
		var txt=$(this).parent().text();
		$('#accion').text("Borrado "+idCc);
		$.ajax({
			type:"POST",
			url: "deleteCc.php",
			data: "idConcepto="+ idCc,
			success: function (data){
  			//$('#info').append(data);
//  			$('#accion').text(data);
  		}
		});
		$.ajax({
			type:"POST",
			url: "listTh.php",
			data: "Asignatura="+ Asig_global,
			success: function (data){
  				$('#contenido').html(data);
  			
  			
  			//$('#info').html(data);
  			//	$('#archivo').hide();
  		}
		});						
	});
	*/	
$('a.deleteCC').click(function(){
		var idCc= $(this).attr('value');
//		var txt=$(this).parent().text();
//	$('#accion').text("Borrado "+idTh);
	$.ajax({
		type:"POST",
		url: "ruta/deleteCc.php",
		data: "idConcepto="+ idCc,
		success: function (data){
			$('#uld').load('ruta/listTh.php');
  	}
	});
});

//Fin de la Eliminacion de CONCEPTO
$('input[name=Fin]').click(function(){
//	console.log("FIN");
	$('#contenido').load('ruta/cuestion_create.php');
});
//Fin del javascript
});		
/*	
	$('input[id=Importar]').click(function(){		
		var Archivo= $('input[id=bdp]').attr('value');
		var Archivo2=Archivo.replace(/\bbdp/,'*');
		var len1=Archivo.length;
		var len2=Archivo2.length;
		if(len2<len1){
//			$('#archivo').append("<br />"+Asig_global+" Importando...");
			$.ajax({
				type:"POST",
				url: "Get_file_bdp.php",
				data: "Archivo="+Archivo+"& Asignatura="+ Asig_global,
				success: function (data){
  				$('#datos').html(data);
  				$('#archivo').hide();
  				}
				});
			}
			
		else $('#archivo').append("<br />"+Archivo+" Archivo no valido");		
	});		
	$('input[id=Listados]').click(function(){		
		location.href='listMaterias.php';	
	});
	*/

