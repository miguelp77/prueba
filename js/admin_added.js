$(document).ready(function() {
	var ajax_load = "<img src='img/ajax-loader.gif' alt='loading...' />";  

$('#show_admin_form').click(function(){
	$('#add_admin_form').show();
	$('#update_admin_form').hide();
	
	$('#admin_form').toggle('fast');
	$('#admin_list').toggle('slow');
	if($('#show_admin_form').text()==='Volver') $('#show_admin_form').text('Añadir')
	else $('#show_admin_form').text('Volver');
});
//Borrar Administrador
$('.small[name=admin_delete]').click(function(){
	var idAdmin= $(this).attr('value');
	var borrar= confirm('Eliminar permanentemente?');
	if(borrar){
		$('#contenido').html(ajax_load);
		$.ajax({
			type:"POST",
			url: "ruta/admin_delete.php",
			data: "idAdmin="+ idAdmin,
			success: function (data){
				$('#contenido').html(ajax_load).load('ruta/admin_form.php');
  		}
		});
	}
});
//Editar un Admin
$('.small[name=admin_edit]').click(function(){
	var idAdmin= $(this).attr('value');
//	var borrar= confirm('Eliminar permanentemente?');
//	if(borrar){
//		$('#contenido').html(ajax_load);
		$.ajax({
			type:"POST",
			url: "ruta/admin_edit.php",
			data: "idAdmin="+ idAdmin,
			success: function (data){
				var obj=jQuery.parseJSON(data);
	//			$('#contenido').html(ajax_load);
				$('input[name=Nombre]').val(obj.Nombre);
				$('input[name=Apellidos]').val(obj.Apellidos);
				$('input[name=Alias]').val(obj.Alias);
				$('input[name=Psw]').val(obj.Psw);
  		}
	});//Fin AJAX
//Animacion del formulario
	$('#show_admin_form').toggle();
	$('#add_admin_form').hide();
	$('#update_admin_form').show();
	$('#admin_form').toggle('fast');
	$('#admin_list').toggle('slow');
//	}
});

$('#add_admin_form').click(function(){
	var features = {};    // Create empty javascript object
	$("#admin_form :input").each(function() {           // Iterate over inputs
    features[$(this).attr('name')] = $(this).val();  // Add each to features object
	});
	var json = JSON.stringify(features); // Stringify to create json object (requires json2 library)
	$.ajax({
		type:"POST",
		url: "ruta/admin_add.php",
		data: "json="+ json,
		success: function (data){
			//	var obj=jQuery.parseJSON(data);
			//	$('#contenido').html(data);	
			$('#contenido').html(ajax_load).load('ruta/admin_form.php');
		}
	});
//	console.log(json);
});
$('#update_admin_form').click(function(){
	var features = {};    // Create empty javascript object
	$("#admin_form :input").each(function() {           // Iterate over inputs
    features[$(this).attr('name')] = $(this).val();  // Add each to features object
	});
	var json = JSON.stringify(features); // Stringify to create json object (requires json2 library)
	// console.log(json);
	$.ajax({
		type:"POST",
		url: "ruta/admin_update.php",
		data: "json="+ json,
		success: function (data){
			//	var obj=jQuery.parseJSON(data);
			$('#contenido').html(ajax_load).load('ruta/admin_form.php');
		}
	});
	//	console.log(json);
});

//Fin
});
