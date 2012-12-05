$(document).ready(function() {
var vgTema=0;
var idD=0;
//	$('#cbAsig').select(function(){		
/*
	$('#cbAsig').click(function(){	
	//var Materia= $('select').attr('value');
		var asig= $('select').attr('value');
//		var asig = $('#cbAsig :selected').text();
		$('.asig').html(asig);
		vgTema= $('#cbAsig :selected').val();
		$.cookie.set('Galle',vgTema);
		$.ajax({
			type: "POST",
			url: "showAsig.php",
			data: "idAsignatura=" + vgTema,
			success: function(data){
				$('.asig').load('showAsig.php');
			}
		});
	});
*/	
$('span').click(function(){
	var idDesc=$(this).attr('value');
//	$('#intro').append(idDesc);
	idD=idDesc;
//	console.log(idD);
	$.ajax({
		type: "POST",
//		url: "Concepts.php",
		url: "ruta/Concepts.php",
		data: "idDesc=" + idDesc,
		success: function(data){
			if(data)
				$('#formDesc').show('slow');
			$('textarea').val(data);		
			}
	});
});

$('input[id=Grabar]').click(function(){
	$('#formDesc').hide('fast');
	var NewDesc=$('textarea').val();
//	$('#intro').append(NewDesc);
	$.ajax({
		type: "POST",
		url: "ruta/newConcepts.php",
		data: "idDesc=" + idD + "& newDesc="+ NewDesc,
		success: function(data){
//			console.log(data);
			if(data)$('#formDesc').hide('fast');
		//	$('#intro').html(vgTema);
			$('#contenido').empty();
			$('#contenido').load('ruta/concepto.php');
//				data='';
				//	$('textarea').text(data);
		}
	});		
});	

	$('input[id=SelectAsig]').click(function(){
//	Hay que fijar la COOKIE 'Galle'
			$('.asig').fadeOut(700).delay(1200);	
	//		location.href="QCreator.php?QQ=1";
//No necesito borrar el menu para listar los temas y conceptos
//		$('#menu').hide();	
	//Si quisiera ir a QCreator y editar haria esto	
//		$('#contenedor').load('ruta/cuestiones_by_asig.php?QQ=1');
	//Pero realmente solo quiero poder editar los nombres de los temas y conceptos de la asignatura creada
		var Asg=$.cookie.get('Galle');
		$.ajax({
			type:"POST",
			url:"ruta/listTh.php",
			data: "Asignatura="+Asg,
			success:function(data){
				$('#contenido').empty();			
				$('#contenido').html(data);
			}
		});
	});
//	var Cook=$.cookie.get('Galle');
//	$('.intro').append(Cook);	
//	$.cookie.unset('Galle');
	 // NO ESCRIBIR FUERA
});
