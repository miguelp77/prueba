$(document).ready(function() {
	//Apoyandose en newAsig.php // misfunciones.php // Get_file_bdp.php
	var Asig_global=0;
	$('input[name=newAsig]').click(function(){
		var AsigName= $('input[id=Asig]').attr('value');
		$('.ready').css('padding','0.2em').css('border','0.1em solid black')
				.append("<h4><ol>"+AsigName+"</ol></h4>");
		
		$.ajax({
			type: "POST",
			url: "ruta/newAsig_th.php",
			data: "Nombre="+ AsigName ,
			success: function(data){
				vgAsig=data;
			}
		});
	});
	
	$('input[name=SelMateria]').click(function(){	
		var Materia= $('select').attr('value');
		Asig_global= $('option:selected').attr('id');				
	//	$('#bbdd').hide('slow');
		$('#bbdd').html("La importación se hara a la siguiente base de datos: <h4>"+Materia+"</h4>");
	});		
	
	$('input[id=Importar]').click(function(){		
		var Archivo= $('input[id=bdp]').attr('value');
		//Le quito la extension
		var Archivo2=Archivo.replace(/\bbdp/,'*');
		var len1=Archivo.length;
		var len2=Archivo2.length;
		if(len2<len1){
//			$('#archivo').append("<br />"+Asig_global+" Importando...");
			$.ajax({
				type:"POST",
				url: "ruta/Get_file_bdp.php",
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
		location.href='ruta/listMaterias.php';	
	});
});
