$(document).ready(function() {
$('button[name=import_db]').click(function(){
	$.ajax({
		url: 'ruta/show_tables.php',
		success: function(data){
			$('#contenido').html(data);
		}
	});	
});
$('button[name=show_db]').click(function(){
	$.ajax({
		url: 'ruta/use_table.php',
		success: function(data){
			$('#contenido').html(data);
		}
	});	
});

$('button[name=exp]').live('click',(function(){
	var tabla=$(this).attr('value');
//	console.log(tabla);
	$.ajax({
		type: 'POST',
		data:'tabla='+tabla,
		url: 'ruta/table_move.php',
		success: function(data){
			$('#contenido').html(data);
		}
	});	
}));

$('a').live('click',(function(){
	var Eleccion=$(this).attr('name');
//	console.log(Eleccion);
	$.ajax({
		type: 'POST',
		data:'tabla='+Eleccion,
		url: 'ruta/showAsg.php',
		success: function(data){
			$('#datos').html(data);
		}
	});	
}));
/*No escribir mas abajo*/
});
