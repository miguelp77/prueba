$(document).ready(function() {
 var exp_got;
 var id_img;
//Subir imagenes. Formulario
$('#up_img').click(function(){
	$('#archivo').show();
	$('#eq').hide();	

});
$('#crear_img').click(function(){
	$('#archivo').hide();
	$('#eq').show();	

});
//Subir imagenes. Subir

  // $("#ula").delegate("button[id=c_img]","click",function(){
  $("button[id=c_img]").click(function(){
		var expresion=$('textarea[name=eq]').val();
		var arreglo;
		var rnd=Math.random();
		imagen="../img/imagen.png";
//Arreglo para el simbolo +
		arreglo=encodeURIComponent(expresion);
		arreglo2=expresion;
//ajax
		$.ajax({
			type: "POST",
			url: "to_png.php",
			data: "expresion="+ arreglo,
			target: '#img_created',
			success: function(data){
				imagen="img/imagen.png?"+rnd;
				$('#img_created').empty().append('<img src="'+imagen+'" title="'+expresion+'" />').slideDown();	
 				$('#img_name_form').show();
				$('#res_name').empty();
 			}
		});
	});

$('a[title=SaveImg]').click(function() {
	var img_name = $('input[title=ImgSave]').val(); 
	img_name= 'img/'+ img_name+'.png'; 	
	var img_exp=$('img').attr('title');
	img_exp=encodeURIComponent(img_exp);
//		console.log(img_exp);
		$.ajax({
			type: "POST",
			url: "img_renombra.php",
			data: "Img_exp="+ img_exp +"& Img_name="+ img_name,
			success: function(data){
				$('#res_name').html(data);
				if ((data.length)>11) $('#img_name').prev().hide('1500');
				$('#img_name_form').hide();
				$('input[title=ImgSave]').val('');
			}
		});
	return false;
	});
	
//Menu Navegacion
	$('.black[name=show]').click(function(){
		$('#img_name').toggle('slow');
	});
	//Menu descripcion	
	$('.css_btt[name=descripcion]').click(function(){
		$('#eq_desc').toggle('slow');
	});		
	//Grabar Descripcion
	
//Avance/retroceso	    
	$('.css_btt[name=prev]').click(function(){
		var sentido ="DESC";
		nav(sentido);
		paginas(id_img);
	});
//Avance/retroceso	    
	$('.css_btt[name=sig]').click(function(){
		var sentido ="ASC";
		nav(sentido);
		paginas(id_img);
	});
//Expresion
//$('textarea[name=eq]')
	$('.css_btt[name=expresion]').click(function(){
			//console.log('Expresion pulsado');
			$('textarea[name=eq]').val(exp_got);
	});
//Paginacion
	$('.whitie').bind('click',aClick);
//  $("#theone").die("click", aClick)

//Mas 5
	$('.whitie[name=mas5]').bind('click',(function(){
		pag=parseInt(id_img)+5;
		nav(pag);
		paginas(pag);
	}));
//Menos 5
	$('.whitie[name=menos5]').bind('click',(function(){
		pag=parseInt(id_img)-5;
		nav(pag);
		paginas(pag);
$('textarea[name=desc_area]').val(pag);
	}));

//Grabar Descripcion
	$('.css_btt_cont').click(function(){
	var expresion=$('textarea[name=desc_area]').val();
	var id_img=$(this).attr('title');	
		$.ajax({
			type: "POST",
			url:"exp_desc.php",
			data:"imagen="+id_img+" &desc="+expresion,
			success: function(data){
				$('textarea[name=desc_area]').val(data);
			}
		});
	});


function paginas(from){
	$.ajax({
		type: "POST",
		url:"ruta/get_pages.php",
		data:"imagen="+from,
		success: function(data){
			$('.whitie').unbind('click');
			$('#img_paginacion').empty().html(data);			
			$('.whitie').bind('click',aClick);

		}
	});
}
function nav(sentido){

	$.ajax({
		type: "POST",
		url: "ruta/img_nav.php",
		data: "sentido="+ sentido,
		success: function(data){
			var arr=data.split("~");
			$('textarea[name=desc_area]').val(arr[3]);
			$('#img_ruta').html('Ruta de la imagen: '+arr[2]);
			$('#eq_img_img').html("<img src='"+arr[2]+"' title='"+arr[3]+"'/>");
			$('#img_expr').html("Expresion: "+arr[1]);
//				console.log(arr[1]);
			exp_got=arr[1];
			id_img=parseInt(arr[0]);
		}
	});
}
///
function aClick(){
		var pag_name =$(this).attr('name');
		var pag=pag_name.replace("?page=", "");
		if(pag_name=='mas5') pag=parseInt(id_img)+5;
		if(pag_name=='menos5') pag=parseInt(id_img)-5;		

		nav(pag);
		paginas(pag);
}
//Nuevo modo
$("select[name=im1]").change(function () {
	var str = "";
	$(".im_sel1 option:selected").each(function () {
		str = $(this).text() + " ";
	});
	$('.im1_wrap').empty().html('<img src="'+str+'" alt="Imagen" /><br>'+str);
		var id_img=$('select').attr('value');
		$.post('../ajax/get_description.php',{ name: id_img}, function(data) {
			$('textarea[name=desc_area]').val(data);
		});
		$.post('../ajax/get_expresion.php',{ name: id_img}, function(data) {
//			$('#exp').html(data);
			exp_got=data;
		});		
		$('.css_btt_cont').attr('title',id_img);
}).change();
///
});
