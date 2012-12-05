var strGlobal1="";
var strGlobal2="";
var L_img1=1;
var L_img2=1;
var L_ok=0;
//Guardar Cuestion
$('.btt[name=saveQ]').live('click',(function() {
	var enunciado = $('#enunciado').text();
	var imagen1 = strGlobal1;
	var imagen2 = strGlobal2; 
	$.ajax({
		type: "POST",
		url: "insert_Q.php",
		data: "Enunciado="+ enunciado +"& imagen1="+ imagen1+"& imagen2="+ imagen2 ,
		success: function(data){
//	console.log(data);
			$('#contenido1').wrap("<div id='contenido1' />");
			$('#contenido1').empty();				
			$('#contenido1').show().text(data);
			//	$('#img1').append(data);
			window.self.location.href='QCreator.php?QQ='+data;
		}
	});
return false;
}));
//MOSTRAR ENUNCIADO
//$('.btt[title=Enunciado]').live('click',(function() {
//			$('.barra').addClass('highlight');
//	var NewEnun =$('textarea[name=Newenun]').attr('value');		
//	console.log(NewEnun.length);
	console.log("hola");
//		if(NewEnun==undefined)
//	console.log(NewEnun);	
//	if(NewEnun.length==0)
//	{
//		$('.vacio').queue(function () {
//			$('.vacio').fadeIn();	
//			$('.vacio').text("¡Está vacio!");
//			$('.vacio').fadeOut('slow');
//		$(this).dequeue();
//		});		
//	}

//	if(NewEnun.length>0)
//	{
//		$('#enunciado').text(NewEnun).show();
//$('.Numero').append("<span class='css_button btt' title='Guardar Cuestion' name='saveQ'>Guardar cuestion</span>");			L_ok=1;
//	}
//}));

$('.btt[name=Enun1]').live('click',(function() {
	$('.showit').text('hola');
	console.log("Hola");
}));

//Recoger ENUNCIADO
//$('.btt[name=Enun1]').live('click',(function() {
//		$('#enun').toggle('slow');
//}));
//Mostrar ENUNCIADO
//$('.btt[name=SEnun1]').live('click',(function() {
//		$('#enun').toggle('slow');
//}));
//Recoger IMAGEN 1
$('.btt[name=Rimg1]').live('click',(function() {
		$('#f_img1').hide('slow');
}));
//Mostrar IMAGEN 1
$('.btt[name=SRimg1]').live('click',(function() {
		$('#f_img1').toggle('slow');
}));
//Ver IMAGEN 1
$('.btt[title=VImagen1]').live('click',(function() {
	$(document).attr('title','Ver Imagen');  
		var img=$('input[name=Simg1]').attr('value');
		$('#showit').text("");	
		imagen= 'img/'+img;
		strGlobal1=imagen;		
		$('#showit').append('<img src='+imagen+' />').slideDown('fast');
		L_img1=1;
}));
//Guardar IMAGEN 1
$('.btt[title=GImagen1]').live('click',(function() {
		var img=$('input[name=Simg1]').attr('value');
		$('#showit').text("");	
		imagen= 'img/'+img;
		$('#imagen1').append('<img src='+imagen+' />').slideDown('slow');
if(L_img1==1){
		$('#imagen1').wrap('<div class="new" />').hide(1000).wrap('<div id="imagen1" />');
		$('#imagen1').empty();
		$('#imagen1').append('<img src='+imagen+' />').slideDown('fast');
	 	
		L_img2=2;
		L_ok=2;
		}
}));

//Recoger IMAGEN 2
$('.btt[name=Rimg2]').live('click',(function() {
		$('#f_img2').hide('slow');
}));
//Mostrar IMAGEN 2
$('.btt[name=SRimg2]').live('click',(function() {
		$('#f_img2').toggle('slow');
}));
//Ver IMAGEN 2
$('.btt[title=VImagen2]').live('click',(function() {
	$(document).attr('title','Ver Imagen 2');  
		var img=$('input[name=Simg2]').attr('value');
		$('#showit').text("");	
		imagen= 'img/'+img;
		strGlobal2=imagen;		
		$('#showit').append('<img src='+imagen+' />').slideDown('fast');
		L_img2=1;
}));
//Guardar IMAGEN 2
$('.btt[title=GImagen2]').live('click',(function() {
	$(document).attr('status','Imagen 2 Seleccionada');  
		var img=$('input[name=Simg2]').attr('value');
		$('#showit').text("");	
		imagen= 'img/'+img;
if(L_img2==1){
		$('#imagen2').wrap('<div class="new" />').wrap('<div id="imagen2" />');
		$('#imagen2').empty();
		$('#imagen2').append('<img src='+imagen+' />').slideDown('fast');

		L_img2=2;
		L_ok=3;
		}

}));

$('.btt[title=SaveEnun]').live('click', function(){
	newwindow=window.open($(this).attr('href'),'','height=600,width=800,status=0,location=false');
	if (window.focus) {newwindow.focus()}
	return false;
});

