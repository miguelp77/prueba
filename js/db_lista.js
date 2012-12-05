//Cambiar de base de datos
$('input[name=cambia]').click(function(){
	var base_nueva=$('option:selected').val();
	$.ajax({
		type: 'POST',
		data:'base_nueva='+base_nueva,
		url: 'asignatura_cambiar.php',
		success: function (){
			$('#contenido').load('main_asg.php');
		}
	});	
//	console.log(base_nueva);
});
