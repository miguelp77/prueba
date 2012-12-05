$(document).ready(function() {
//Apoyando listMaterias.php // misfunciones.php // Get_file_bdp.php
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
	$('.updateTH').live('click',function(){
		var idTh= $(this).attr('value');
		var texto=$(this).parent().text();
		$('#accion').text(idTh);
		$(this).parent().after('<div class="editando"><input type="text" title="editar" value="'+texto+'" /><a class="css_button Th" href="#" title="'+idTh+'">Guardar</a>').show();
		$(this).hide();
	});
	$('.Th').live('click',function(){
		var idTh=$(this).attr('title');
		newTh=$(this).prev().val();
	//	$('#accion').text(newTh);
		$.ajax({
			type:"POST",
			url: "ruta/editTh.php",
			data: "Tema="+ idTh+"& NewTema="+ newTh,
			success: function (data){
  			//$('#info').append(data);
  			$('#accion').text(data);
  		}
		});
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
//Eliminar TEMA
	$('a.deleteTH').live('click',function(){
		var idTh= $(this).attr('value');
		$('#accion').text("Borrado "+idTh);
		$.ajax({
			type:"POST",
			url: "ruta/deleteTh.php",
			data: "idTema="+ idTh,
			success: function (data){
  			//$('#info').append(data);
//  			$('#accion').text(data);
  		}
		});
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
//Fin de eliminar TEMA y sus CONCEPTOS

//Update Conceptos	
	$('a.updateCC').live('click',function(){
		var idCc= $(this).attr('value');
		var txt=$(this).parent().text();
		$('#accion').text(idCc);
		$(this).after('<div class="editando"><input type="text" title="editando" value="'+txt+'" /><a class="css_button Cc" href="#" title="'+idCc+'">Guardar</a>');
		$(this).hide();
	});	
	$('.Cc').live('click',function(){
		var idCc=$(this).attr('title');
		newCc=$(this).prev().val();
	//	$('#accion').text(newTh);
		$.ajax({
			type:"POST",
			url: "ruta/editCc.php",
			data: "idConcepto="+ idCc+"& NewConcepto="+ newCc,
			success: function (data){
  			//$('#info').append(data);
  			$('#accion').text(data);
  		}
		});
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
//Fin de Editar Concepto
//Eliminar CONCEPTO
	$('a.deleteCC').live('click',function(){
		var idCc= $(this).attr('value');
		var txt=$(this).parent().text();
		$('#accion').text("Borrado "+idCc);
		$.ajax({
			type:"POST",
			url: "ruta/deleteCc.php",
			data: "idConcepto="+ idCc,
			success: function (data){
  			//$('#info').append(data);
//  			$('#accion').text(data);
  		}
		});
		$.ajax({
			type:"POST",
			url: "ruta/listTh.php",
			data: "Asignatura="+ Asig_global,
			success: function (data){
  				$('#contenido').html(data);
  			
  			
  			//$('#info').html(data);
  			//	$('#archivo').hide();
  		}
		});						
	});	
//Fin de la Eliminacion de CONCEPTO
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

