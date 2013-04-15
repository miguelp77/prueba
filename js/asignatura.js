//Crear Asignatura
$('.css_btt[name=new_asg]').click(function(){
	$('#contenido').empty();
	$('#contenido').load('materia.php');
});
//Deseleccionar
$('.css_btt[name=unset_asg]').click(function(){
	$.ajax({
		url: 'asignatura_unset.php',
		success: function(){
			window.location.replace('admin_test.php');
		}
	});
});
//Explorar la base de datos
$('.css_btt[name=explore_asg]').click(function(){
	$('#contenido').load('cuestion_create.php');
});
//Importar 
$('.css_btt[name=import_asg]').click(function(){
	$('#archivo').show();
	$('#import').show();
});

