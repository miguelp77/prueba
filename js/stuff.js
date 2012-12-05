//Mis Scripts de js
//Requiere TIMER
//Cuenta atras
$('.deadtime').everyTime(1000,function() {

	var $Cuenta=$('span.deadtime').text();
	var $ts=parseInt($Cuenta)-1;
//	console.log($ts);
	$('span.deadtime').text($ts);
	if($ts<5 & $ts!=0){
		setTimeout(function()
		{
		 $('#pregunta').fadeOut(700)
				.fadeIn(900);
				$('.deadtime').css('color','red');
		}, 1000);
	}	
	if($ts<1){ 

		$('#contenedor').fadeTo('slow',0.3);
	//	$('span.deadtime').text(0);
		$('.deadtime').stopTime();
		$('input[id=its]').hide();
	}
	console.log($ts);
},0);
//Fin de cuenta atras
//Requiere TIMER
//HORA
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
//Fin de HORA

//Refrescar con el mismo nombre y arreglo del simbolo +
  $("#ula").delegate("button","click",function(){
//$('input[name=expresion]').click(function() {
	var expresion=$('textarea[name=eq]').val();
	var arreglo;
	var rnd=Math.random();
//	rnd=parseInt(rnd*100);
	imagen="img/imagen.png";
	arreglo=encodeURIComponent(expresion);
//	$('#img_created').empty();
//	console.log(arreglo);
	$.ajax({
		type: "POST",
		url: "ruta/to_png.php",
		data: "expresion="+ arreglo,
		target: '#img_created',
		success: function(data){
			console.log(rnd);
			imagen="img/imagen.png?"+rnd;
			$('#img_created').empty().append('<img src='+imagen+' />').slideDown();	
 		}
	});
});

//FIN de REFRESCAR con el mismo nombre

//Seleccionar checkboxes de golpe y hacerles check
$('span[class=tema]').click(function(){
//	var Cuestion_id  =  $('.Numero').attr('id');
//	Cuestion_id=jQuery.trim(Cuestion_id);
	updateChecks();
	var Tema = $(this).attr('name');
	$.ajax({
		traditional: true,
		type: "POST",
		url: "Qset_Concepts.php",
		data: "Tema="+Tema+"& Ccs="+packet,
		success: function(data){
	//		$('checkbox').html(data)
//			console.log(data);
			var arr=data.split(",");
			while(arr.length !=0){
				var chk=arr.shift();
				console.log(chk);
				$('input[name='+chk+']').attr('checked',true);
//			$(':checkbox]').is(':checked')
			}		
		}
	});
	return false;
});

//Mirar los id de los checks

function updateChecks() {         
	var allVals = [];  
  $('input[type=checkbox]:checked').each(function() {
		allVals.push($(this).val());
	});
//     $('#pie').add(allVals);
//	console.log(allVals);
   packet=allVals;
  }
 //  updateTextArea();
   $(':checkbox').click(updateChecks);


