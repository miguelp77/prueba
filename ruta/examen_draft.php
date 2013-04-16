<?php
	session_start();
//Librerias

	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	require_once('includes/cuestiones.inc');	
	require_once('includes/examenes.inc');

//Conexion a la base de datos
	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		conectar($db);
	}else echo "Sin base"."<br />"; 

?>

<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<link rel=stylesheet href="../css/main.css" type="text/css">
	<script src="../js/jquery-ui/js/jquery-ui-1.8.1.custom.min.js"></script>
  <link rel="stylesheet" href="../js/jquery-ui/css/ui-lightness/jquery-ui-1.8.1.custom.css" />
<!--	<script src="../jquery/jquery-1.4.2.js"></script> -->
<!--	<script src="jquery/jquery-shuffle.js"></script> -->
	<title><?php echo $_SESSION['user'];?></title>
</head>
<body>
<div class="right2">
	<?php
		if($db!='asg_admin'){
			//Lateral superior derecho
			examenesAsignados();
		}
	?>
</div>

<?php
if(isset($db)){
	// Si la asignatura es la de administracion NO se muestran examenes
	if($db=="asg_admin") echo "Conecte a una asignatura";
	else{
		echo "Conceptos de la asignatura<br />";
		// Se listan los conceptos que se han definido en la asignatura
		temas_conceptos();
?>
<br />
Nombre <input type="text" name="nombre" id="nombre" maxlength="40" size="40" placeholder="Nombre de la prueba"/><br /> 
<button name="seleccion">Seleccion</button>
<button name="todos">Todas</button>
<input type="checkbox" name="rand" id="rand" checked/> Aleatorias<br />
Numero de cuestiones <input type="number" name="numero" id="numero" maxlength="2" size="2" placeholder="5"/>
<!-- Numero de cuestiones <input type="text" name="numero" id="numero" maxlength="2" size="2" value="5"/> -->
Tiempo limite <input type="number" name="duracion" id="duracion" maxlength="2" size="2" placeholder="Duración"/> minutos<br />
Número de intentos <input type="number" name="intentos" id="intentos" maxlength="2" size="2" placeholder="Intentos"/> (0: Examen; 99: Ilimitados)
<!-- Tiempo limite <input type="text" name="duracion" id="duracion" maxlength="2" size="2" value="30"/> minutos -->

<div class="total_info"></div>


<?php
	}//Fin del else
//Si la DB no es la de Administracion
	if($db!="asg_admin"){
		echo "<hr />";
		echo "<h3>Contenido de los examenes creados</h3>";
//	source_minified();
//	source_maximise();

//	source_balance();
		examen_listar();
	}
}
?>

</body>
	<script src="../js/draft.js"></script> 
	<script>
  $(function() {
  	$(".datepicker2").datepicker({
	  	  // beforeShowDay: $.datepicker.noWeekends,
	  	  dateFormat: "dd-mm-yy",
		  	onSelect: function(endDate){
    			// console.log(endDate);
		  	},
	  	  firstDay: 1,
	 	    dayNames: [ "Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado" ],
	 	    dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
	 	    monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ]
			});
  	$(".datepicker1").datepicker({

  	  dateFormat: "dd-mm-yy",
  	  firstDay: 1,
 	    dayNames: [ "Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado" ],
 	    dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
 	    monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
			
			onSelect: function(startDate){
				var getID = $(this).attr('id');
				var ID = getID.split("start")[1];
				var endID='#end'+ID;
				
				var newDate= $(this).datepicker('getDate');
				newDate.setDate(newDate.getDate() + 0);

	      $(endID).datepicker('setDate', newDate).datepicker('option', 'minDate', newDate); 
    		// console.log(endID);
			}

		});

    $(".datepicker1").datepicker();
    $(".datepicker2").datepicker();

    $('.unlocked').click(function(){
    	var esto = $(this).attr('src');
			var getID = $(this).attr('id');
			var ID = getID.split("unlock")[1];
			var startID='#start'+ID;    	
			var endID='#end'+ID;    	
    	
    	var start_date=$(startID).val();
    	var end_date=$(endID).val();

    	var show_nota='input[name=show_nota'+ID+']';
    	var show_nota_val = $(show_nota+':checked').val();
    	
    	var evaluable='input[name=evaluable'+ID+']';
    	var evaluable_val = $(evaluable+':checked').val();

    	if(esto=="../img/lock-unlock.png"){
    		$(this).data('prev_src', $(this).attr('src')).attr("src","../img/lock.png");
        $(startID).attr('disabled','disabled');
        $(endID).attr('disabled','disabled');
        $(show_nota).attr('disabled','disabled');
        $(evaluable).attr('disabled','disabled');
  			$.ajax({
					type: "POST",
					url: "set_fuentes_date.php",
					data: "examen="+ ID + "&start_date=" + start_date+ "&end_date=" + end_date+ "&evaluable=" + evaluable_val+ "&show_nota=" + show_nota_val
					// success: function(data){
						// alert("La asignatura "+ origen + " ha sido clonada como " + destino);
				});
    	}else{
 	   		$(this).data('prev_src', $(this).attr('src')).attr("src","../img/lock-unlock.png");
    		$(startID).removeAttr('disabled');
    		$(endID).removeAttr('disabled');
    		$(show_nota).removeAttr('disabled');
    		$(evaluable).removeAttr('disabled');
    	}
    	// if($(this).hasClass('unlocked')){
     //  	if($(this).attr('src')=="../img/lock.png")
     //  	$(this).data('prev_src', $(this).attr('src')).attr("src","../img/lock.png");
	    // 	$(this).removeClass('unlocked');
	    // 	$(this).addClass('locked');
    	
    })
  
  });
  </script>
</html>