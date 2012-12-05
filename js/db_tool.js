$(document).ready(function() {
$('input[name=vaciar]').click(function(){
	var tabla=$(this).attr('class');
	$.ajax({
		type: "POST",
		url: 'ruta/db_tabla_vaciar.php',
		data: "tabla= "+ tabla,	
		success: function(data){
			$('#contenido').load('inicializar_bbdd.php');
		}
	});	
});
//explorar
$('input[name=explorar]').click(function(){
	var tabla_elegida=$(this).attr('class');
//	console.log(tabla);
	$.ajax({
		traditional: true,
		type: "POST",
		url: 'ruta/db_tabla_explorar.php',
		data: "tabla= "+ tabla_elegida,	
		success: function(data){
			$('#contenido').html(data);
		}
	});	
});

//reset
$('input[name=db_reset]').click(function(){
	var borrar= confirm('¿Restablecer todas las tablas?');
	if(borrar)	
	$.ajax({
		url: 'ruta/db_reset.php',
		success: function(data){
			$('#contenido').load('inicializar_bbdd.php');
		}
	});	
});
//delete
$('input[name=db_delete]').click(function(){
	var borrar= confirm('¿Eliminar permanentemente?');
	if(borrar)	
	$.ajax({
		url: 'ruta/db_delete.php',
		success: function(data){
			$('#contenido').load('main_asg.php');
		}
	});	
});
//backup
$('input[name=db_backup]').click(function(){

	$.ajax({
		url: 'ruta/db_backup.php',
		success: function(data){
			$('#contenido').load('main_asg.php');
		}
	});	
});


});
