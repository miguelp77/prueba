$(document).ready(function(){
	var packet=new Array();
	var rnd;
	var pregs;
	$('#rand').click(function(){
		rnd=$(this).is(':checked');
	});
	
	if (typeof rnd == "undefined")
		rnd=false;		

	
	function updateChecks() {         
		var allVals = [];  
		$('input[name=respuesta]:checked').each(function() {
			allVals.push($(this).val());
		});
		rnd=$('#rand').is(':checked');
		 packet=allVals;
		}

	$(':checkbox').click(updateChecks);
		 
	$('button[name=seleccion]').click(function(){
//		console.log("selec");
		var numero=$('input[name=numero]').attr('value');
		var duracion=$('input[name=duracion]').attr('value');
		var nombre=$('input[name=nombre]').attr('value');				
		$.ajax({
			traditional: true,
			type: "POST",
			url: "preguntas_match.php",
			data: "conceptos="+packet+"& numero="+numero +"& rnd="+rnd+"& duracion="+duracion+"& nombre="+nombre,
			success: function(data){
				$('#contenido').load('examen_draft.php');				
//	console.log(data);
			}
		});
		return false;
	});

	$('button[name=todos]').click(function(){
		var todos="todos";
		var numero=$('input[name=numero]').attr('value');
		var duracion=$('input[name=duracion]').attr('value');		
		var nombre=$('input[name=nombre]').attr('value');		
//		console.log("todo");
		$.ajax({
			traditional: true,
			type: "POST",
			url: "preguntas_match.php",
			data: "conceptos="+todos+"& numero="+numero +"& rnd="+rnd+"& duracion="+duracion+"& nombre="+nombre,
			success: function(data){
				$('#contenido').load('examen_draft.php');
//				$('.total_info').html(data);
//	console.log(data);
			}
		});
		return false;
	});

		$('button[name=set_examen]').click(function(){
		var idExamen=$(this).attr('value');
//		console.log(idExamen);
		$.ajax({
			traditional: true,
			type: "POST",
			url: "examen_push.php",
			data: "idExamen="+idExamen,
			success: function(data){
				$('#contenido').load('examen_draft.php');	
			}
		});
		return false;
	});
//Pop Fuente de los examenes de los alumnos	
	$('button[name=del_examen]').click(function(){
		var idExamen=$(this).attr('value');
//		console.log(idExamen);
		$.ajax({
			traditional: true,
			type: "POST",
			url: "examen_delete.php",
			data: "idExamen="+idExamen,
			success: function(data){
				$('#contenido').load('examen_draft.php');				
//				$('.total_info').html(data);
//	console.log(data);
			}
		});
		return false;
	});
//Eliminar Fuente
	$('button[name=vanish_examen]').click(function(){
		var idFuente=$(this).attr('value');
//		console.log(idFuente);
		$.ajax({
			traditional: true,
			type: "POST",
			url: "fuente_del.php",
			data: "idFuente="+idFuente,
			success: function(data){
				$('#contenido').load('examen_draft.php');
//				$('.total_info').html(data);
//	console.log(data);
			}
		});
		return false;
	});
// Ir a las cuestiones
$("a[title^='cuestion']").click(function(){
	var otra = $(this).attr('name');
//	console.log('otra '+otra);
//	$('#ula_main').toggle('slow');			
	$.ajax({
//		type: "POST",
		type: "GET",		
		url:"cuestion_otra.php",
		data: "id_otra="+ otra,
//		data: "idQ="+ otra, 
		success: function(){ 
			$('#ula_main').empty();		
			$('#contenido').load('cuestion_create.php');
//			$('#ula_main').toggle();			
		}
	});				
});
$(".resumen").click(function(){
	var seleccion=$(this).attr('name');
	var texto='.'+seleccion;
	$(texto).toggle().addClass("fuente_resaltada");

//	console.log(texto);
});
//

/*
$(window).unload( function () { confirm("Finalizar"); });
 $(document).bind("contextmenu",function(e){
        return false;
    });
*/
/*
window.onbeforeunload = function() {
    setTimeout(userDidNotLeave,10);
    return "Are you sure you want to leave? changes will be lost";
}
 
function userDidNotLeave() {
    $("#content").css("background", "#df34ef");
}
*/
//$('button[name=set_examen]').click(function(){
//		
//});


});

