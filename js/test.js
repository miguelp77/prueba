//$(document).ready(function(){
//Varialbles GLOBALES	
	var minuto=5; //Numero de segundos en un minuto
	var radio_on;
	var all_radio;
//	var d=new Date();
//	var start_time=parseInt(d.getTime()/1000);
	var t_default=1*minuto;
	
//Fija la COOKIE comienzo
function cookieme(){	
	var d=new Date();
	var start_time=parseInt(d.getTime()/1000);
	if (!$.cookie.get('comienzo')){ //Depuracion
		$.cookie.set('comienzo',start_time,{expires: ((70*60)/(24*60*60))});
	}//else console.log($.cookie.get('comienzo'));
}
 

//Desactivacion del boton dcho
$(document).bind("contextmenu",function(e){
  return false;
});
//Refrescar & retroceder
window.onbeforeunload = function() {
	setTimeout(userDidNotLeave,10);
	return "";
}
//No hace nada, pero porsiaca
function userDidNotLeave() {
	//Idle
}
//Anulacion del F5
$(document.documentElement).keypress(function (event) {
  if (event.keyCode == 116)
		event.preventDefault();
});
//
function get_duration(){
	$.ajax({
		traditional: true,
		url: "duracion_get.php",
		success: function(data){
//			console.log(data);
			inc=parseInt(data)*minuto;
			if(inc<=0) inc=t_default;
			timetolife=duracion(inc);		
			$('#info').countdown({until: timetolife, compact: true, timeSeparator: ':',onTick: ticks ,onExpiry: FIN}); 
		}
	});
}
function duracion(inc){
		if($.cookie.get('comienzo')){
////Existe la cookie comienzo
////comienzo <- comienzo de la cuenta atras
			var comienzo=parseInt($.cookie.get('comienzo'));
		//			var inc=parseInt("<?php echo $_SESSION['duracion'];?>")*2;
		//	console.log("Lerele le le"); console.log("timeto= "+timetolife); console.log("inc= "+inc);
//// fin =comienzo + incremento FIN de la cuenta atras	
			var fin=comienzo+inc;//1h=60*60s
////ahora <= Tiempo actual
			var d=new Date();
			var ahora=parseInt(d.getTime()/1000);
//// lerele <= tiempo restante			
			var lerele=fin-ahora;
//// timetolife	<=tiemporestante		
			timetolife=lerele;
///Si ahora es mayor a fin UNSET de comienzo
			if(ahora>(fin))	
				$.cookie.unset('comienzo');
//// timetolife <0 borro la cookie
			if(lerele<0)
				$.cookie.unset('comienzo');
		return parseInt(lerele); 
	}
}



//var timetolife=duracion(inc);
/* Esto lo hace en la funcion get_duration
if (typeof inc != "undefined"){
	$('#info').countdown({until: timetolife, compact: true, timeSeparator: ':',onTick: Galleta ,onExpiry: FIN}); 
}
*/
function ticks(periods){
//get_duration();
	//	$.cookie.set('comienzo',(periods[5]*60+periods[6]));
}
function FIN(){
	if(!$.cookie.get('comienzo')) return ""; //Si no hay cookie, es que ya se finalizo
//	$('#contenido').fadeTo('slow',0.4);
	$('input[id=its]').hide();
//	$('#info').append('<br /><button>Finalizado</button>');
//	$.cookie.set('comienzo',null);
//	$.cookie.set('examen',null);
//	console.log($.cookie.set('examen',null));
	$('#info').toggle(500);
	$('#Calificacion').show(1000);

	$.ajax({
		traditional: true,
		type: "POST",
		url: "examen_corregir.php",
		success: function(data){
			$('#Calificacion').empty();
			$('#Calificacion').append(data);
				//	$.ajax({
				//		traditional: true,
				//		url: "get_ob.php"
				//	});
		}
	});
	show_correctas();
//enero	
	$.cookie.unset('comienzo');
	$('button[name=boton]').hide();
}


function show_correctas(){
	$('#Calificacion').html('Su nota es <img src="../img/ajax-loader.gif" />');
	$.ajax({
		traditional: true,
		type: "POST",
		url: "examen_correctas.php",
		success: function(data){
			var correcta=data.split(",");
			for (x in correcta){				
				$("input[value="+correcta[x]+"]").parent().css('background','#91C661');		
				$('input[type=radio]:checked').each(function() {
					$(this).parent().addClass('answered');
				});
			}
		}
	});
}


//Para que no comience la cuenta-atras 
//
//Muestra las respuestas correctas. AJAX:: examen_correctas.php

$(document).ready(function(){
//Colorea las respuestas seleccionas y las no seleccionadas
function color_me() {         
	$('input[type=radio]').parent().css('background','#F5F5DC').removeClass('answered');
	$('input[type=radio]:checked').each(function() {
		$(this).parent().addClass('answered');
	});
}
//Toma los radiobox seleccionados
function updateChecks() {         
	var allVals = [];		
  $('input[type=radio]:checked').each(function() {
		allVals.push($(this).val());
		radio_on=allVals;		
		color_me();
	});
}
//Toma todos los radiobox
function getRadiobox() {         
	var allRadios = [];		
  $('input[type=radio]').each(function() {
		allRadios.push($(this).val());
		all_radio=allRadios;
		var arr=all_radio.join(",");
		$.cookie.set("orden",arr,{expires: ((70*60)/(24*60*60))});		
	});
}
$('button[name=boton]').click(function(){
	var sr;
	var arr_sr=[];
//	FIN();
	$('.rojo').hide();
	$('.total_info').empty();
	updateChecks();
	if (typeof radio_on == "undefined")
		radio_on=['0'];
	var arr=radio_on.join(",");
	if(arr.search(/sr/i)==0)
			$('.total_info').append("<hr />Preguntas sin constestar:<br />");
	for (x in radio_on){
		if(radio_on[x].search(/sr/i)==0){
			sr=radio_on[x];
			sr=sr.slice(2);
			arr_sr.push(sr);
			$('.num[name='+sr+']').append("<div class='rojo'> Sin contestar</div>");
			$('.total_info').append("<a class='marco' href='#"+sr+"'>"+sr+"</a> ");
		}
	}	
////	if(arr.search(/sr/i)==0)
//	if(arr_sr.toString().search(/sr/i)==0){
	if(typeof(sr)!=="undefined"){
//		console.log(sr);
		confirm("No has repondido a: "+ arr_sr.toString()+". Marca la opcion 'No Responder'");
	}else{
//		console.log('fin?');
		var finalizar=confirm("¿Está seguro de finalizar la prueba?");
		if(finalizar) FIN();
//		$('.rojo').hide();

	}
});
//Fija la COOKIE answers
$(':radio').click(function(){
	updateChecks();
//	getRadiobox();
	var arr=radio_on.join(",");
	$.cookie.set("answers",arr,{expires: ((70*60)/(24*60*60))});
});

//Recupera COOKIE answers y la interpreta
function radio_state(){
	if($.cookie.get("answers")){
		var radios=$.cookie.get("answers");
		radios_arr=radios.split(",");
		for (x in radios_arr){
			$(':radio[value='+radios_arr[x]+']').attr('checked',true);
		}
	}		
}

	radio_state(); //Estado de los radiobox
//	cookieme();	 //Fijar comienzo
//	get_duration(); //Duracion
	getRadiobox(); //Todas los radioboxes

////////////FIN

});


