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
			url: "ruta/newAsig.php",
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
//Nuevo tema
	$('input[id=newTh]').click(function(){
		var Tema= $('input[id=Tema]').attr('value');
		$('ol:last').append("<li>"+Tema+"</li>");
		//	console.log(vgAsig);
		$.ajax({
			type: "POST",
			url: "ruta/newTema.php",
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
			url: ".ruta/newConcepto.php",
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
