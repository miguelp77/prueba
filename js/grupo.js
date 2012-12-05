$(document).ready(function() {

var ajax_load = "<img src='img/ajax-loader.gif' alt='Cargando...' />";  
var id=0;
	$('.css_btt_r[title=Cambiar]').click(function(){
		id=$(this).attr('name');
		console.log(id);
		$(this).html(id);
	});//Fin Grupos
//Mover a los alumnos
		$('.css_btt[name=mover]').click(function(){
//		id=$(this).attr('name');
			var grupo=$('option:selected').val();
			// console.log(grupo);
			$.ajax({
				type:"POST",
				url: "set_grupo.php",
				data: "packet="+packet+"&grupo="+grupo,
				success: function (){
					$('#contenido').html(ajax_load).load('mgmt_groups.php');
				}
			});	
	});
//Fin de mover a los alumnos

//Checkboxes
	var packet=new Array();
	
	function updateChecks() {         
		var allVals = [];  
		$('input[type=checkbox]:checked').each(function() {
			allVals.push($(this).val());
		});
		console.log(allVals);
		packet=allVals;
	}
	 $(':checkbox').click(updateChecks);
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


});
