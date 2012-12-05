$(document).ready(function(){
	var ajax_load = "<img src='img/ajax-loader.gif' alt='cargando...' />";  
	var arr;
	updateChecks();
//
	$('.rojo').click(function(){
		$('a').toggle();
	});
//	
	$('.ctrl').click(function(){
		$('.ctrlado').toggle('slow');
		$("p.tog").toggle();
	});
//	
	$(":checkbox").click(updateChecks);
//
	function updateChecks(){         
		var allVals = [];		
  	$('input:checked').each(function() {
			allVals.push($(this).val());
			radio_on=allVals;		
			arr=radio_on.join(",");
//		  console.log(arr);
//		$('#checkss').html(arr);
			$.ajax({
				traditional: true,
				type: "POST",
				data:'selected='+arr,
				url: "ajax/gettin.php",
				success:function(data){
					$('.fld').hide();
					$('.fld.fecha').show();
					$('#checkss').html(data);
					var datos=data.split(",");
					for(x in datos){
	//				console.log("$('."+datos[x]+"').hide();");
						$("'.fld."+datos[x]+"'").show();
					}//Fin del for
				}//Fin de success
			});//Fin de ajax
			return arr;
		});//Fin de la funcion checked
	}//Fin de la funcion

	$('.report_head').click(function (){
		var idA=$(this).attr('name');
			$.ajax({
			type: "POST",
			url: "report_ind.php",
			data: "idA=" + idA,
			success: function(data){
				$('#contenido').empty();
				$('#contenido').html(data);
	//				data='';
					//	$('textarea').text(data);
			}
		});
	});
$('span[name=orden]').click(function(){
//		console.log('ooo');
		$.ajax({
			url: "expediente_ordenar.php",
			complete: function(){
	$.ajax({
		url: "ajax/report_convocatoria.php",
		success: function(data){
			$('#contenido').html(ajax_load).html(data);
		}
	});
			}
	});			
}); 
//Completar expedientes
$('span[name=completar]').click(function(){
//		console.log('ooo');
		$.ajax({
			url: "expediente_completar.php",
			complete: function(){
	$.ajax({
		url: "ajax/report_convocatoria.php",
		success: function(data){
			$('#contenido').html(ajax_load).html(data);
		}
	});
			}
	});			
});
$('span[name^=roll]').click(function(){
	var valor=$(this).attr('name');
	$('.'+valor).toggle(2000);
	if($(this).text()=='x')$(this).text('+');
	else $(this).text('x');

});
$('.line').click(function(){	
	var linea=$(this).attr('name');
	console.log(linea);
//	$('.line[name!='+linea+']').css('color','#ddd');
	$('.line[name!='+linea+']').css('color','#ddd');
	$('.line[name='+linea+']').css('color','#444');	
	$('.nota[name='+linea+']').show();	
//	$('.linea[name='+linea+']').show();
});

 
////////////FIN
});
