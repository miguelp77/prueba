$('.css_btt_l[name=new_asg]').live('click',(function(){
	$('#contenido').load('materia.php');
		console.log('nueva');	
/*	var Eleccion=$(this).attr('name');
	console.log(Eleccion);
	$.ajax({
		type: 'POST',
		data:'tabla='+Eleccion,
//		url: 'showAsg.php',
		url: 'get_all_qs.php',
//		url: 'mio.php',
		success: function(data){
//			$('#contenido').html("<iframe id='localscene' name='localscene' src='get_all_qs.php' width='780px' height='600px' framespacing='0' border='0'></iframe>");// framespacing="0" scrolling="auto" border="0" style="position:absolute; left:726px; top:231px; width:216; height:250; z-index:5">
		
			$('#contenido').html(data);
//	location.href ="mio.php";
		}
	});	
*/
}));

$('.css_btt_l[name=unset_asg]').live('click',(function(){
//	$('#contenido').load('asignatura_unset.php');
	$.ajax({
//		type: 'POST',
//		data:'tabla='+Eleccion,
		url: 'asignatura_unset.php',
		success: function(){
//			href.location('http://localhost/pfc/pfc/admin_test.php');
window.location.replace('http://localhost/pfc/pfc/admin_test.php');
//	$('#contenido').load('materia.php');
			console.log('deseleccionada');	
		}
	});
}));


$('.css_btt_l[name=read_asg]').live('click',(function(){
	$('#contenido').load('asignatura_listar.php');
		console.log('elegir');	
}));
$('.css_btt_l[name=explore_asg]').live('click',(function(){
	$('#contenido').load('cuestion_create.php');
		console.log('elegir');	
}));
$('.css_btt_l[name=import_asg]').live('click',(function(){
//	$('#contenido').load('cuestion_create.php');
	$('#archivo').toggle();
	$('#import').toggle();
		console.log('importar');	
}));
	$('input[id=Importar]').live('click',(function(){		
		console.log("importando");
		var Archivo= $('input[id=bdp]').attr('value');
		//Le quito la extension
		var Archivo2=Archivo.replace(/\bbdp/,'*');
		var len1=Archivo.length;
		var len2=Archivo2.length;
		console.log("importando");
		
		if(len2<len1){
			$.ajax({
				type:"POST",
				url: "Get_file_bdp.php",
				data: "Archivo="+Archivo,//+"& Asignatura="+ Asig_global,
				success: function (){
  		//		$('#datos').html(data);
  		//		$('#archivo').hide();
				$('#contenido').load('cuestion_create.php');
  				}
				});
			}
			
		else $('#archivo').append("<br />"+Archivo+" Archivo no valido");		
	}));



$('input[name=cambia]').live('click',(function(){
	var base_nueva=$('option:selected').val();
		$.ajax({
			type: 'POST',
			data:'base_nueva='+base_nueva,
			url: 'asignatura_cambiar.php',
		});	
	console.log(base_nueva);
	
}));
