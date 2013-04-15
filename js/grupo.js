$(document).ready(function() {

var ajax_load = "<img src='img/ajax-loader.gif' alt='Cargando...' />";  
var id=0;
var packet=new Array();
var origen;
$('.css_btt_r[title=Cambiar]').click(function(){
		id=$(this).attr('name');
		// console.log(id);
		$(this).html(id);
	});//Fin Grupos
//Copiar alumnos a otro grupo
$('.css_btt[name=copiar]').click(function(){
//		id=$(this).attr('name');
	var grupo=$('option:selected').val();
	var operacion = 'copiar';
	// console.log(packet);

	$.ajax({
		type:"POST",
		url: "set_grupo.php",
		data: "packet="+packet+"&operacion="+operacion+"&origen="+origen+"&grupo="+grupo,
		success: function (){
			$('#contenido').html(ajax_load).load('mgmt_groups.php');
		}
	});	
});
//Mover a los alumnos
$('.css_btt[name=mover]').click(function(){
//		id=$(this).attr('name');
	var grupo=$('option:selected').val();
	var operacion='mover';
	// console.log(packet);
	$.ajax({
		type:"POST",
		url: "set_grupo.php",
		data: "packet="+packet+"&operacion="+operacion+"&origen="+origen+"&grupo="+grupo,
		success: function (){
			$('#contenido').html(ajax_load).load('mgmt_groups.php');
		}
	});	
});
//Fin de mover a los alumnos
//Copiar a los alumnos
$('.css_btt[name=copiar]').click(function(){
//		id=$(this).attr('name');
	var grupo=$('option:selected').val();
		// console.log(grupo);
	// $.ajax({
	// 	type:"POST",
	// 	url: "set_grupo.php",
	// 	data: "packet="+packet+"&grupo="+grupo,
	// 	success: function (){
	// 		$('#contenido').html(ajax_load).load('mgmt_groups.php');
	// 	}
	// });	
});
//Fin de copiar a los alumnos

//Checkboxes
	var gr=0;
	var ultimo_gr;
	var origen;
	function updateChecks() {         
		var check;
		var last_id;
		var allVals = [];
		$('input[type=checkbox]:checked').each(function() {
			check = $(this).val();
			// allVals.push(check);
			origen = $(this).attr('name'); //grupo
			 // $('input:checkbox').removeAttr('checked');
			if(gr != ultimo_gr){
				// console.log('cambio de grupo'+gr);
			// if(ultimo_gr != origen){
				descheck(gr);
				gr = origen;
				allVals=[];				
				// packet = allVals;
			}
			if(gr == origen )
				allVals.push(check);
			// else{
			// 	allVals = [];
			// 	$('input:checkbox').attr('name').removeAttr('checked');
			// 	packet = allVals;
			// 	gr = origen;
			// }
		});
		packet = allVals;
		// console.log(allVals);
	}
	// function deselectChecks(elemento, indice, array)
	 // $(':checkbox').click(updateChecks);
	$(':checkbox').click(ultimo);
	$(':checkbox').click(function (){
		updateChecks();
	});
	function descheck(gr){
		$('input[name='+gr+']:checked').each(function(){
			// console.log(this.name)
			if(gr != ultimo_gr){	
				$(this).removeAttr('checked');
				// console.log('borrando '+ gr);
			}
		});
	}
	function ultimo(){
		ultimo_gr = $(this).attr('name');
		// console.log('ultimo check es de '+ultimo_gr)
	}
	//Fin checkboxes
	//Drag and drop
	$(function() {
		$("div[id^='sorttable-'] ul").sortable({ 
				opacity: 0.6, 
				cursor: 'move',
				start: function(event, ui){
					item =ui.item;
					newZone = oldZone = ui.item.parent().parent();
				},
				stop: function(event, ui){
//          alert("Moved " + item.attr('id') + " from " + oldZone.attr('zona') + " to " + newZone.attr('zona'));					
				}, 
				update: function(){
					var ide=$(this).parent();//.attr("zona");
		//			var order = $(this).sortable("serialize") + '&action='+ide;
		//			console.log(order);
					var nuevazona = newZone.attr('zona');
					var alumno = item.attr('id');
					// var zona=ide.attr('zona');
					var order = 'alumno=' + alumno + '&grupo=' + nuevazona;
					// console.log('zona '+ nuevazona + ' alumno '+alumno);
					// $.ajax({
						// type:"POST",
						// url: "update_grupo.php",
						// data: "alumno="+alumno+"&grupo="+grupo,
						// success: function (){
							// $('#contenido').html(ajax_load).load('mgmt_groups.php');
						// }
					// });
				 	$.post("update_grupo.php", order, function(theResponse){
						// $("div[id^='sorttable-']").html(theResponse);
						$('#contenido').html(ajax_load).load('mgmt_groups.php')
					});
			//});
				},change: function(event, ui) {  
                if(ui.sender) newZone = ui.placeholder.parent().parent();
            },connectWith: ".sortable"
		}).disableSelection();
		
	});
//Las listas		
		var zonas=new Array();
				$("div[id^='sorttable-']").each(function() {
			zonas.push($(this).attr("zona"));
//			$('.sortable').css('border','red 1px solid').css('margin','2px');
		});

$('.css_btt[name=nuevo]').click(function(){
//		id=$(this).attr('name');
	// var grupo=$('option:selected').val();
	$('#newGroup').toggle('slow');
	// console.log(grupo);
});
$('.css_btt[name=saveName]').click(function(){
	var nombre = $('input:text[name:nombre]').val();
	if(nombre.length > 1){
		$.ajax({
			type:"POST",
			url: "newGroup.php",
			data: "nombre="+nombre,
				success: function (){
				$('#contenido').html(ajax_load).load('mgmt_groups.php');
			}
		});	
	}
});


//FIN
});
