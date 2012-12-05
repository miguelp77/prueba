$(document).ready(function() {
	$('.barra').addClass('highlight');
   $('#identifier').hoverAccordion();
	if ($('span.pagina').text()==0) {
		$('span.pagina 0').css("color","white")		
			.css("font-size","x-large"); 
//			$('.abclist li').shuffle();
//		console.log($('.pagina 0').css());
}	
});



//Ocultar CONTENIDO
	$('span a[title=Show]').click(function() {
	//		$('.barra').addClass('highlight');
		var $link = $(this);
		if ( $link.text() == "Mostrar" ) {
		$link.text('Ocultar');
		} else 
		$link.text('Mostrar');
	//			$('#contenido').animate({"left":"1px"},'2000');
			$('#contenido').animate({opacity: 'toggle'},1000);	
	});		
//Desplegar Columna Menu
	$('p a[title=Show Menu]').click(function() {
			$('#menu').slideDown('fast');
//			$('#contenido').animate({"left":"1px"},'2000');
	});
	$('p a[title=Hide Menu]').click(function() {
	//		$('.barra').removeClass('highlight');
			$(this).text("Ocultar");			
			$('#menu').slideUp('fast');
//			$('#contenido').animate({"right":"350px"},'2000');
		});

//Sector1
$('.css_button[name=Sector1]').click(function() {
	var seleccion = $('input[name=sec1]:checked').val()
//		$('#myForm').animate({opacity: 'toggle'},1000);
	if(seleccion=='img'){
			$('#myForm').slideUp(1000);
			$('#sector1').append("<form><label> Imagen <input type='file' name='img1'/><span class='css_button' name='bt_img1'>Seleccionar</span></label></form>");
	}
	$('.css_button[name=bt_img1]').click(function(){
		var seleccion = $('input[name=img1]').val();			
		$('#sector1').append("<img src='img/"+ seleccion + "'/>"); 
	});
	$(this).css("color","red")	
		.text(seleccion);
});



//Hora
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


//MENU:: CREAR NUEVA CUESTION  -->Qbtts.js

$('a[title=Nueva]').click(function() {
		$('#contenido1').fadeOut(500);
		
	 $('#contenido1').queue(function () {
		$('#contenido1').empty().load('Qnew.php');		
		$('#contenido1').fadeIn(1000);
		$('#contenido1').show();	

	$(this).dequeue();
	});		
});



//MENU:: DESPLEGAR____EDITAR EL ENUNCIADO
 
$('a[title=Edit]').click(function() {
				$('#enun1').toggle(function(){
					$(this).css("visibility","show");
					});	
			//$('#contenido').css("color","red");
		});
//MENU:: INSERTAR RESPUESTA	
	$('a[title=Answer]').click(function() {
				$('#f_respuestas').toggle(function(){
					$(this).css("visibility","show");
					$('#respuestas').wrap('<div class="new_respuestas" />');
					$('#respuestas').remove();					
				});	
			//$('#contenido').css("color","red");
		});	
// INSERTAR ENUNCIADO	
$('#enum1_form').submit(function() {
	// we want to store the values from the form input box, then send via ajax below
	var Cuestion_id     =  $('.Numero').attr('id');;
	var enun1    = $('#enun').attr('value');
		$.ajax({
			type: "POST",
			url: "enunciado1.php",
			data: "Cuestion_id="+ Cuestion_id +"& enun1="+ enun1,
			success: function(){
				$('#enum1_form').hide(function(){$('div.success').fadeIn();});
				
			}
		});
	return false;
	});
	
//    CREAR RESPUESTA
// Formulario que introduce las posibles respuestas a una cuestion
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
//ELIMINAR RESPUESTA
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
//EDITAR RESPUESTA Ok
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
			
   
//EDITAR IMAGEN 1

$('a[title=img1]').click(function() {
				$('#f_imagen1').toggle(function(){
					$(this).css("visibility","show");
					$('#imagen1').wrap('<div class="new" />').hide(1000);
					});	
			//$('#contenido').css("color","red");
		});	

  $('#img1_form').submit(function() {
	// we want to store the values from the form input box, then send via ajax below
	var Cuestion_id  =  $('.Numero').attr('id');;
	var imagen = 'img/' + $('#img1').attr('value');
	console.log(imagen);
			//$('#respuestas').remove();
		$.ajax({
			type: "POST",
			url: "insert_imagen1.php",
			data: "Cuestion_id="+ Cuestion_id +"& imagen="+ imagen ,
			success: function(data){
				if(data !='NOk'){ 
					$('#f_imagen1').hide(500);
					//$('#imagen1').show(500);
					$('.new').hide('slow').empty();
					$('.new').append('<img src='+imagen+' />').slideDown('slow');
				}
				else { 
					alert('Imagen demasiado grande. Dimension maxima 800x500.');
				}
				console.log(data);
				
			}
		});
	return false;
	});    
//IMAGEN 2
//EDITAR IMAGEN 

$('a[title=img2]').click(function() {
				$('#f_imagen2').toggle(function(){
					$(this).css("visibility","show");
					$('#imagen2').wrap('<div class="new" />').hide(1000);
					});	
			//$('#contenido').css("color","red");
		});	

  $('#img2_form').submit(function() {
	// we want to store the values from the form input box, then send via ajax below
	var Cuestion_id  = $('.Numero').attr('id');
	console.log(Cuestion_id);	
	Cuestion_id=jQuery.trim(Cuestion_id);
	console.log(Cuestion_id);	
	var imagen = 'img/' + $('#img2').attr('value');
	
			//$('#respuestas').remove();
		$.ajax({
			type: "POST",
			url: "insert_imagen2.php",
			data: "Cuestion_id="+ Cuestion_id +"& imagen="+ imagen ,
			success: function(data){
				if(data !='NOk'){ 
					$('#f_imagen2').hide(500);
					//$('#imagen1').show(500);
					$('.new').hide('slow').empty();
					$('.new').append('<img src='+imagen+' />').slideDown('slow');
				}
				else { 
					alert('Imagen demasiado grande. Dimension maxima 300x300.');
				}
				console.log(data);
			//	$('#img1').append(data);
				
			}
		});
	return false;
	});    

//FIN DE IMAGEN 2

$('a[title=SaveImg]').click(function() {
	var img_name = $('input[title=ImgSave]').val(); 
	img_name= 'img/'+ img_name+'.png'; 	
	var img_exp = $('cite').text();
	img_exp=jQuery.trim(img_exp);	
	console.log(img_exp);
	console.log(img_name);
//	$('#img_name').append($img_name);
//		$('.'+answer_id).empty();
		$.ajax({
			type: "POST",
			url: "img_renombra.php",
//			data: "Cuestion_id="+ Cuestion_id +"& imagen="+ imagen ,
			data: "Img_exp="+ img_exp +"& Img_name="+ img_name,
			success: function(data){
//		if (data != '--')$('#respuestas').append($('#answer').attr('value')+' NUEVA!!<br />');
//			console.log(data);
//				$('.'+answer_id).append(data);
			$('#img_name').append(data);
				if ((data.length)>11) $('#img_name').prev().hide('1500');
//$('#img_name').hide('1500');
			}
		});
			
	return false;
	});    

//CLICK EN PAGINA de eleccion de imagen from TeX
$('span[class^=pagina]').click(function(){
//$('a:not(:has(>img))')
		
$('span[class^=pagina]')
	.css("font-size","large")
	.css("color","#3F4047");
	$(this)
		.css("color","white")		
		.css("font-size","x-large");
var n_pag=$(this).text();
	$.ajax({
			type: "POST",
			url: "showimg.php",
			data: "N_pag="+ n_pag,
			success: function(data){
				$('.img2').empty();
				$('.img2').fadeIn(700).append(data);		
				}

			});

			
	return false;



}); ///FIN DE CLICK EN PAGINA


//CLICK EN PAGINA de eleccion de CUESTIONES
$('span[class^=PagQ]').click(function(){
//$('a:not(:has(>img))')
	
$('span[class^=PagQ]')
	.css("font-size","large")
	.css("color","#3F4047");
	$(this)
		.css("color","white")		
		.css("font-size","x-large");
var n_pag=$(this).text();
	console.log(n_pag);
	$.ajax({
			type: "POST",
			url: "Qver2.php",
			data: "N_pag="+ n_pag,
			success: function(data){
				$('.img2').empty();
				$('.img2').fadeIn(700).append(data);		
				}

			});

			
	return false;



}); ///FIN DE CLICK EN paginas de CUESTIONES


//FIN DE quitar extensiones a las paginas

//SIGUIENTE CUESTION -->Qbtts.js
$('a[name=Sig]').live('click',(function(){
	var now=$('.redondear').text();
	var ahora=parseInt(now);
	$.ajax({
		type: "POST",
		url: "next_Q.php",
		data: "Ahora="+ ahora ,
		success: function(data){
			var sig=parseInt(data);
			window.self.location.href='QCreator.php?QQ='+sig;
		}
	});
	return false;
}));

//ANTERIOR CUESTION -->Qbtts.js
$('a[name=Pre]').live('click',(function() {
  console.log(ahora);
  var now=$('.redondear').text();
  var ahora=parseInt(now);
  console.log(ahora);
  $.ajax({
    type: "POST",
    url: "pre_Q.php",
    data: "Ahora="+ ahora ,
    success: function(data){
      var sig=parseInt(data);
      window.self.location.href='QCreator.php?QQ='+sig;
      console.log(sig);
    }
  });
return false;
}));
//Boton de LOGIN
$('a[name=loginBtt]').click(function(){
	var user = $('input[name=loginUser]').attr('value');
	var psw = $('input[name=loginPsw]').attr('value');
	$.ajax({
		type: "POST",
    url: "checkuser.php",
    data: "Alias="+ user +"& Psw="+ psw,
    success: function(data){
			if(data){
         $('.campos').wrap("<div class='campo' />").slideDown('slow');
         $('.campos').slideUp();
         $('legend').text(data);
         $('.campo').text('login con exito');
   		}
    }
	});
});

