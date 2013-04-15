$(document).ready(function() {
	var vgAsig=0;
	var vgTema=0;	
//Nueva Asignatura
	$('input[id=newAsig]').click(function(){
		var AsigName= $('input[id=Asig]').attr('value');
		$('.ready').css('padding','0.2em').css('border','0.1em solid black')
			.append("<h4><ol>"+AsigName+"</ol></h4>");
		$.ajax({
			type: "POST",
			url: "newAsig.php",
			data: "Nombre="+ AsigName ,
			success: function(data){
				vgAsig=data;
				//$.cookie.set('Galle',vgAsig,0);
				//console.log(vgAsig);
			}
		});
		$('.temas').show();
		$('.Materia').hide(1000);
	});
// Recorro los checkboxed
var selected = new Array();
var origen;
	function updateChecks() {         
		var allVals = [];  
		$('input[type=checkbox]:checked').each(function() {
			allVals.push($(this).attr('name'));
		// origen = $(this).attr('name');
		});
		selected=allVals;
	}
 $(':checkbox').click(updateChecks);
updateChecks();
//Clonar Asignatura
	$('input[id=clonAsig]').click(function(){
		var destino= $('input[id=Asig]').attr('value');
		var origen=$('option:selected').val();
		if(destino.length<1){
			alert('Asignatura sin nombre');
      document.getElementById("Asig").focus();
			return false;
		} 
		var comienzo=destino.indexOf("asg_");
		if(comienzo!=0) destino='asg_'+destino;
		if(destino=='asg_admin'){
			alert('Nombre de asignatura reservado');
      document.getElementById("Asig").focus();
			return false;
		} 
		// Opciones
		selected=selected.join(',');
	
		$.ajax({
			type: "GET",
			url: "db_clon.php",
			data: "destino="+ destino + "&origen=" + origen+ "&opciones=" + selected,
			success: function(data){
				// console.log(data);
				alert("La asignatura "+ origen + " ha sido clonada como " + destino);
			}
		});
		// selected.length=0;
	});	
//Nuevo tema
	$('input[id=newTh]').click(function(){
		var Tema= $('input[id=Tema]').attr('value');
		$('ol:last').append("<li>"+Tema+"</li>");
		//	console.log(vgAsig);
		$.ajax({
			type: "POST",
			url: "newTema.php",
			data: "Nombre="+ Tema,// + "& idAsig=" + vgAsig,
			success: function(data){
				vgTema=data;
			}
		});
	});
		
				
//Nuevo concepto
	$('input[id=newConcept]').click(function(){
		var qIndex=0;
//    qIndex = $("dd").prevUntil().length;
		var Concepto= $('input[id=Concepto]').attr('value');
//		$('li:last').wrapInner('<div class="conceptos" />').append("<ul>"+Concepto+"</ul>");
		$('li:last').append("<dd>"+Concepto+"</dd>");
  	qIndex=$('dd:last').index('dd'	);
//		qIndex = $('dd').index(this);
//		console.log(qIndex);
		$.ajax({
			type: "POST",
			url: "newConcepto.php",
			data: "Nombre="+ Concepto + "& idTema=" + vgTema,
			success: function(data){
			//vgTema=data;
				}
			});
	});			
	$('input[id=bEnd]').click(function(){
		$('#contenido').load('ruta/concepto.php');
		//		console.log("jjj");
	});			
//////////////////////////////////	location.href="conceptos.php";
	 // NO ESCRIBIR FUERA
});
