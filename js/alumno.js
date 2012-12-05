$(document).ready(function() {

var ajax_load = "<img src='img/ajax-loader.gif' alt='loading...' />";
var id=0;
//Delete alumno
$('.css_btt_r[title=borrar]').click(function(){
	var id=$(this).attr('name');
//	console.log(id);
	var borrar= confirm('Eliminar permanentemente?');
//	console.log(borrar);
//	$('#accion').text("Borrado "+idTh);
	if(borrar)
	$.ajax({
		type: "POST",
		url: "alumno_delete.php",
		data: "id=" + id,
		success: function(data){
			$('#contenido').html(ajax_load).load('alumnos_crud.php');
		}
	});
});

//Update
$('.css_btt_r[title=editar]').click(function(){
	id=$(this).attr('name');
	$.ajax({
		type: "POST",
		url: "alumno_get.php",
		data: "id= "+ id,
		success: function(data){
			var arr=data.split(",");

			var Nombre=arr[0];
			var Apellidos=arr[1];
			var DNI=arr[2];
			var Alias=arr[3];
			var Psw=arr[4];

			$('input[name=nombre_u]').val(Nombre);
			$('input[name=apellidos_u]').val(Apellidos);
			$('input[name=dni_u]').val(DNI);
			$('input[name=alias_u]').val(Alias);
			$('input[name=pass_u]').val(Psw);
	
			$('#alumno_edit:hidden').toggle();
		}
	});
});


$('.css_btt[name=update]').click(function(){
//	var id=$(this).attr('value');
	var nombre=$('input[name=nombre_u]').val();
	var apellidos=$('input[name=apellidos_u]').val();
	var dni=$('input[name=dni_u]').val();
	var alias=$('input[name=alias_u]').val();
	var pass=$('input[name=pass_u]').val();
//	console.log(nombre,apellidos,dni);
//	console.log(pass,alias);	
//	$('form').remove();
//	$('.css_btt[name=update]').remove();
//	$('#contenido').load('alumnos_crud.php');
//	console.log($(this).text());
//	$(this).parent().hide('slow');
	$.ajax({
		type: "POST",
		url: "alumno_update.php",
		data: "id= " + id+" &nombre= " + nombre+" &apellidos= " + apellidos+" &dni= " + dni+" &alias= " + alias+" &pass= " + pass,
		success: function(data){
			if(data=="ok")
				$('#contenido').html(ajax_load).load('alumnos_crud.php');
			if(data!="ok"){
				$('#al_msg').html("<b style='color:red;' >Combinacion usuario/contraseña</b>").fadeOut(2000);
				$('input[name=alias]').css('color','#2e2');
			}
		}
	});
});
//Create
$('.css_btt[name=nuevo]').click(function(){
	$('#alumno_nuevo').toggle('slow');
	$('#alumno_file').hide();
		$('.info').hide();
});

$('.css_btt[name=create]').click(function(){
//	var id=$(this).attr('value');
	var nombre=$('input[name=nombre]').val();
	var apellidos=$('input[name=apellidos]').val();  
	var dni=$('input[name=dni]').val();
	var alias=$('input[name=alias]').val();
	var pass=$('input[name=pass]').val();
//	console.log(nombre,apellidos,dni);
//	console.log(pass,alias);	
//	$('form').remove();
//	$('.css_btt[name=update]').remove();
//	$('#contenido').load('alumnos_crud.php');
//	console.log($(this).text());
//	$(this).parent().hide('slow');
	$.ajax({
		type: "POST",
		url: "alumno_create.php",
		data: "nombre= " + nombre+" &apellidos= " + apellidos+" &dni= " + dni+" &alias= " + alias+" &pass= " + pass,
		success: function(data){
			if(data=="ok")
				$('#contenido').html(ajax_load).load('alumnos_crud.php');
			if(data!="ok"){
				$('#al_msg').html("<b>Combinacion usuario/contraseña</b>").fadeOut(2000);
				$('input[name=alias]').css('color','red');
			}
		}
	});
});

$('.css_btt[name=a_lista]').click(function(){
	$.ajax({
		url: "print_alumno.php",
		success: function (){
					$('#contenido').html(ajax_load).load('ajax/alumnos_pdf.php');
				}
	});
});
$('.css_btt[name=a_import]').click(function(){
 $('#alumno_file').toggle();
});
$('.css_boton[name=alumno_import]').click(function(){
//	console.log("importando");
//		console.log("lll");
		var Archivo= $('input[name=alumno_archivo]').attr('value');
		//Le quito la extension
		var Archivo2=Archivo.replace(/\bxls/,'*');
		var len1=Archivo.length;
		var len2=Archivo2.length;
//		console.log("importando");
		if(len2<len1){
			$.ajax({
				type:"POST",
				url: "get_alumnos_from_xls.php",
				data: "Archivo="+Archivo,
				success: function (){
					$('#contenido').html(ajax_load).load('alumnos_crud.php');
				}
			});
		}else $('#archivo').append("<br />"+Archivo+" Archivo no valido");
});
////
$('.black[name=pop]').click(function(){
	$.ajax({
		url: "ajax/pop.php",
		success: function (){
			$('#contenido').html(ajax_load).load('alumnos_crud.php');
		}
	});
});
$('.black[name=reverse]').click(function(){
	$.ajax({
		url: "ajax/reverse.php",
		success: function (){
			$('#contenido').html(ajax_load).load('alumnos_crud.php');
		}
	});
});
$('.css_boton[name=regenerate]').click(function(){
	var renovar= confirm('Renovar contraseñas?');
	if(renovar){
		$.ajax({
			url: "regenerate.php",
			success: function (){
				$('#contenido').html(ajax_load).load('alumnos_crud.php');
			}
		});
	}
});//Fin Renovar
$('.css_btt[name=group]').click(function(){
	$('#contenido').html(ajax_load).load('mgmt_groups.php');
});//Fin Grupos

//$('.scroll-panel').scrollable();

////

});
