var ajax_load = "<img src='img/ajax-loader.gif' alt='loading...' />";
var arr=null;
updateChecks();
$(":checkbox").click(updateChecks);
function updateChecks(){
	var allVals = [];
	$('input:checked').each(function(){
		allVals.push($(this).val());
		radio_on=allVals;
		arr=radio_on.join(",");
		// console.log(arr);
//		  console.log(arr);
//		$('#checkss').html(arr);
/*			$.ajax({
				traditional: true,
				type: "POST",
				data:'selected='+arr,
				url: "ajax/gettin.php",
				success:function(data){
					$('.fld').hide();
					$('.fld.fecha').show();
					$('#checkss').html(data);
					var datos=data.split(",");
					for(x in datos){
	//				console.log("$('."+datos[x]+"').hide();");
						$("'.fld."+datos[x]+"'").show();
					}//Fin del for
				}//Fin de success
			});//Fin de ajax
*/
		return arr;
	});//Fin de la funcion checked
}//Fin de la funcion


$('.css_boton[name=notas_lista]').click(function(){
	var fecha=$('option:selected').val();
	$.ajax({
		type:"POST",
		url: "print_notas.php",
		data: "name_tbl="+fecha +"&grupos="+arr,
		success: function (){
					$('#contenido').html(ajax_load).load('../ajax/notas_pdf.php');
				}
	});
});
