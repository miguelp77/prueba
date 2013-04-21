<?php
 	/**
  * Demo.
  *
  * Utilizo esta pagina para desarrollar scripts que seran añadidos a la aplicación
  * 
  * @author  Miguel Paniagua 
  *
  * @since 1.0
  *
  * @param int    $example  This is an example function/method parameter description.
  * @param string $example2 This is a second example.
  */
 	namespace ns;

require_once('includes/db_tools.inc');
require_once('includes/cuestiones.inc');	
//	require_once('includes/misfunciones.php');
conectar('asg_dummy');//	require_once('checkuser.php');
?>

<html>
<head>
	<!-- 
		<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script> 
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
	-->
 	<script src="js/jquery-1.4.2.min.js"></script>
	<script src="js/jquery-ui/js/jquery-ui-1.8.1.custom.min.js"></script>
  
  <link rel="stylesheet" href="js/jquery-ui/css/ui-lightness/jquery-ui-1.8.1.custom.css" />


	<title>Demo</title>
	 <script>
  $(function() {
  	$("#datepicker2").datepicker({
	  	  // beforeShowDay: $.datepicker.noWeekends,
	  	  dateFormat: "dd-mm-yy",
		  	onSelect: function(endDate){
    			console.log(endDate);
		  	},
	  	  // minDate: startDate,
	  	    // showOn: 'button',
	    // buttonImage: 'js/jquery-ui/css/ui-lightness/images/ui-icons_ffffff_256x240.png',
	  	  firstDay: 1,
	 	    dayNames: [ "Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado" ],
	 	    dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
	 	    monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ]
			});
  	$("#datepicker1").datepicker({
  	  // beforeShowDay: $.datepicker.noWeekends,
  	  dateFormat: "dd-mm-yy",
  	  firstDay: 1,
 	    dayNames: [ "Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado" ],
 	    dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
 	    monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
			
			onSelect: function(startDate){
				var newDate= $(this).datepicker('getDate');
				newDate.setDate(newDate.getDate() + 0);
	      $('#datepicker2').datepicker('setDate', newDate).datepicker('option', 'minDate', newDate); 
    		console.log(startDate);
			}

		});

    $("#datepicker1").datepicker();
    $("#datepicker2").datepicker();
  });
  </script>
</head>
<body>

	<p>Inicio: <input type="text" id="datepicker1" /> Fin: <input type="text" id="datepicker2" /></p>

	<ul name="grupo1"> checks 1
		<li><input type="checkbox" name="1" id="1">1-1</li>
		<li><input type="checkbox" name="2" id="1">1-2</li>
		<li><input type="checkbox" name="3" id="1">1-3</li>
	</ul>
	<ul name="grupo2"> checks 2
		<li><input type="checkbox" name="1" id="2">2-1</li>
		<li><input type="checkbox" name="2" id="2">2-2</li>
		<li><input type="checkbox" name="3" id="2">2-3</li>
	</ul>		
	<hr />
<?php
		// $qq="SHOW TABLES asg_dummy";
		// $sql=mysql_query($qq);
		// $row = mysql_fetch_row($sql);
//		var_dump($row);
	// $link=connect_to_db();
	// $db_list = mysql_list_dbs($link);

// 	while ($row = mysql_fetch_object($db_list)){
// 	//anulo el valor de phpmyadmin
// 		$nombre=$row->Database;
// 		$ok=str_begin($nombre,"asg_");
// //	echo $nombre;
// 			if($row->Database =="asg_admin") continue;
// 		  if($ok) {
// 		  	echo parse_utf8($row->Database)." > " .'<br />';
// 				}
// 		  }
	function todas_las_tablas($db){
		$qq="SHOW TABLES FROM ".$db;
		$sql=mysql_query($qq);
	// while($row = mysql_fetch_row($sql)){
		// var_dump($row[0]);
		// }

		while ( $row = mysql_fetch_row($sql)) {
		 	$rows[]=$row[0];
		 	// echo $row[0];
		# code...
			}
		return $rows;
		}

		$rows=array();
		$rows=todas_las_tablas('asg_dummy');
		foreach ($rows as $key => $value) {
		# code...
			$qq="SHOW CREATE TABLE ".$value;
			$sql=mysql_query($qq);
			$row = mysql_fetch_row($sql);

			# code...
			echo '<hr />';
			echo $row[0];
			echo '<hr />';
			$campos=explode(',', $row[1]);
			foreach ($campos as $key => $value) {
				echo $value;
				echo '<br />';
			}
		}
		
?>
	<hr />
	Compruebo fechas
	<hr />
	<?php
		$date1=time();
		$date2 = strtotime('2013-04-20');
		$date3 = strtotime('2013-04-19');
		$date4 = strtotime('2013-04-21');
		echo 'ahora === '.$date1;
		echo '<br />';
		echo 'hoy ===== '.$date2;
		echo '<br />';
		echo 'ayer ==== '.$date3;		
		echo '<br />';
		echo 'mana ==== '.$date4;
		echo '<br />';
		echo $date2-$date3;
		echo '<br />';
		if($date1 < $date4) echo 'Ahora es menor que '.date('d-m-Y',$date4+86400);
		echo '<br />';
		if($date1 > $date4) echo 'Ahora es mayor que '.date('d-m-Y',$date4)+86400;
		echo '<br />';
		if($date1 > $date3) echo 'Ahora es mayor que '.date('d-m-Y',$date3);
		echo '<br />';
	
	?>

	<hr />
	<?php
		$examenes = "1,2,3,4";
		$arr=explode(',', $examenes);
		print_r($arr);
		echo '<br />';
		$veces = array (1);
		print_r($veces);
		echo '<br />';
		while (count($arr)>count($veces)) {
			$veces[]=0;
		}
		$progreso=array_combine($arr, $veces);
		echo $examenes;
		echo '<br />';
		$json= json_encode($progreso);
		echo $json;
		echo '<br />';
		print_r($progreso);
		echo '<br />';
		$deco=json_decode($json,true);
		switch ($deco[1]) {
			case '0':
				# code...
				break;
			
			case '99':
				break;
			default:
				$deco[1]=$deco[1]+2;
				# code...
				break;
		}
		print_r($deco);
	?>
	<hr/ >
	<?php
		$pepe = new Alumnos;
		$pepe->set_alumno(1);
		var_dump($pepe->fueInicializado());
		$pepe->start_from_db();
		// echo $pepe->get_alumno();
		echo $pepe -> init_progreso();
		$pepe -> down_atemp(1);

		$xx = $pepe -> get_progreso();
		echo '<br />';
		if(count($xx)>1) echo 'Por favor, elija uno de estas pruebas.';
		if(count($xx)==1) echo 'Por favor, elija la prueba.';
		echo '<br />';
		echo '<form>';
		foreach ($xx as $key => $value) {
			$examen_name = $pepe -> get_examenNombre($key);
			
			echo '<input type="radio" value="'.$key.'" name="examen">'.' '.$examen_name;

			if($value == 0) echo utf8_decode(' ¡Esta prueba se evaluará!.')	;//.'<input type="button" value="Examen">';
			if($value == 1) echo '  '.$value. ' prueba practica.'; 
			if($value > 1) echo '  '.$value.' pruebas practicas.';
			echo '<br />';			
		}


	?>
	</form>
	<input type="button" value="Siguiente">
	<div id="msg"></div>
</body>
<script>
$(document).ready(function() {
	var gr=0;
	var grupoAnterior;
	var ultimo_gr = 0;
	var allVals = [];
	$('input:button').click(function(){
    var radios = $('input:radio[name=examen]:checked').val();
		console.log(radios);
		// $('#msg').html(radios);
	});
	function updateChecks() {         
		var origen;
		var check;
		$('input[type=checkbox]:checked').each(function() {
			check = $(this).attr('name');
			// origen = $(this).attr('id');
			origen = this.id;
			if(gr != origen){
				console.log('cambio de grupo de '+gr+' a '+origen);
				descheck(gr);
				gr = origen;
				allVals=[];
			} 
			if(gr == origen )
				allVals.push(check);
		});
		console.log(allVals);
	}

	$(':checkbox').click(ultimo);
	$(':checkbox').click(function (){
		updateChecks();
		// console.log("grupoAnterior = "+ gr +" ultimo_gr = " + ultimo_gr);
	});
	function ultimo(){
		ultimo_gr = this.id;
	}
	function descheck(gr){
		$('input[id='+gr+']').each(function(){
			if(gr != ultimo_gr){	
				$(this).removeAttr('checked');
			}
		});
	}

	 
});
</script>
</html>

<?php
	/**
	*
	* Clase Alumnos
	* 
	* La clase alumnos nos permite manejar los examenes que tiene asginados un alumno
	*
	*@package 		classAlumno 
	*@param string $nombre ID del alumno en la DB 
	*@param string $examenes IDs de los examenes asociados al grupo del alumno 
	*@param string $progreso Cadena que relaciona los examenes con el numero de tentativas
	*@param string $tentativas Numero de tentativas de los examenes
	*
	*
	*/
class Alumnos{
	/**
	*
	* Variable $alumno
	* Este parametro contiene el ID del alumno con el que se trabaja
	* @access private
	* @var int 
	*
	*/
	var $alumno = 0; // este es el ID
	/**
	*
	* Variable $nombre
	* Este parametro contiene el nombre + apellidos
	* @access private
	* @var string
	*
	*/
	var $nombre; // Nombre + Apellidos
	/**
	*
	* Variable $examenes
	* Este parametro contiene los examenes que tiene asignados el alumno
	* @access private
	* @var string
	*
	*/
	var $examenes;
	/**
	*
	* Variable $progreso
	* Este parametro contiene la relacion entre examenes y tentativas
	* @access private
	* @var string
	*
	*/	
	var $progreso;
	/**
	*
	* Variable $tentativas
	* Este parametro contiene las veces que ha realizado acceso un alumno para realizar pruebas
	* @access private
	* @var string 
	*
	*/
	var $tentaivas;
	/**
	*
	* Inicializa alumno
	* Inicializa al Alumno con los datos almacenados en la base de datos
	*
	*/
	function start_from_db(){
		$alumno_id = $this->alumno;
		//Recojo los datos de la base de datos	
		$query = "SELECT DNI,Nombre,Apellidos,examenes,progreso FROM Alumnos WHERE Alumno_id='$alumno_id'";
		$sql = mysql_query($query) or die(mysql_error());
		$result =mysql_fetch_assoc($sql);
		$this -> examenes = $result['examenes'];
		$this -> progreso = $result['progreso'];
		$this -> nombre = $result['Apellidos']. ', '. $result['Nombre'];
	}
	/**
	*
	* Setter Alumno
	* Asigna al alumno un ID 
	* @access private
	* @param $id
	* @var int
	*
	*/	
	

	function set_alumno($id){
		$this->alumno=$id;
	}
	/**
	*
	* Getter Nombre
	* devuelve el nombre y apellidos del alumno 
	*
	*/	
	function get_alumno(){
		return utf8_decode($this-> nombre);
	}
	/**
	*
	* Checker fueInicializado
	* El alumno esta relacionado con un ID 
	*
	*/	
	function fueInicializado(){
		//Si fue inicializado devuelve true
		// si no lo fue devuelve false
		$retorno = false;
		if($this->alumno > 0) $retorno = true;
		return $retorno;
	}
	/**
	*
	* Action init_progreso
	* Si el valor no esta completado esto lo completara 
	* consultando las caracteristicas de las fuentes de examenes 
	* que tenga el alumno 
	*
	*/	
	function init_progreso(){
		// decodifico desde lo almacenado
		$arrProgreso = json_decode($this -> progreso,true);
		// $arrProgreso = explode(',', $this -> progreso);
		// Transformo el string a array
		$arrExamen = explode(',', $this -> examenes);
		// Solamente puede haber un modelo de examen para trabajar con json
		$arrExamen=array_values(array_unique($arrExamen));
		// ÇSe actualiza la base de datos
		$this -> examenes = implode(',', $arrExamen);
		$this -> update_examenes();
		// Inicializa el progreso si esta vacio
		if(count($arrProgreso) != count($arrExamen)){
			// Arreglo

			if(!is_array($arrProgreso)){
				$x = $arrProgreso;
				unset($arrProgreso);
				$arrProgreso[]=$x;
				array_pop($arrProgreso);
				var_dump($arrProgreso);
			} 

			if($arrProgreso =='' AND !empty($arrProgreso)) $arrProgreso= array_pop($arrProgreso);
			// Construyo el array del mismo tamaño que el numero de examenes
			while (count($arrExamen)>count($arrProgreso)) {
				$arrProgreso[] = 100;
			}
			// Lo completo con los valores por defecto segun el tipo de examenes
			foreach ($arrExamen as $key => $id_examen) {
				if($arrProgreso[$key]==100){
					$arrProgreso[$key] = $this->get_examenInfo($id_examen);
				}
			}
		
			// Formo la cadena json
			$progress=array_combine($arrExamen, $arrProgreso);
			echo '<br />-';
			$json= json_encode($progress);
			$this -> progreso = $json;
			$this -> update_progreso();
		} 
	}
	/**
	*
	* Action update_examenes
	* actualiza el valor del campo examenes del alumno
	*
	*/
	function update_examenes(){
		$ex = $this -> examenes;
		$query = "UPDATE Alumnos SET examenes = '$ex' WHERE Alumno_id='$this->alumno'";
		$sql = mysql_query($query) or die(mysql_error());
		return true;
	}
		/**
	*
	* Action update_progreso
	* actualiza el valor del campo progreso del alumno
	*
	*/
	function update_progreso(){
		$progreso = $this -> progreso;
		
		// var_dump($progreso);
		$query = "UPDATE Alumnos SET progreso = '$progreso' WHERE Alumno_id='$this->alumno'";
		$sql = mysql_query($query) or die(mysql_error());
		return true;
	}
		/**
	*
	* Getter progreso
	* obtiene el valor del campo progreso del alumno
	* Devuelve un ARRAY
	*
	*/
	function get_progreso(){
		$query = "SELECT progreso FROM Alumnos WHERE Alumno_id='$this->alumno'";
		$sql = mysql_query($query) or die(mysql_error());
		$row=mysql_fetch_row($sql);
		return $this -> progreso = json_decode($row[0],true);
		// Devuelve un array
	}
		/**
	*
	* Getter get_examenInfo
	* Devuelve el numero de tentativas con el que esta configurado la fuente del examen
	* @access private
	* @param $id_examen
	* @var int
	*
	*/
	function get_examenInfo($id_examen){
		$query = "SELECT intentos FROM Fuentes WHERE idFuente='$id_examen'";
		$sql = mysql_query($query) or die(mysql_error());
		$row=mysql_fetch_row($sql);
		return $this -> tentativas = $row[0];
	}
		/**
	*
	* Getter get_examenNombre
	* Devuelve el nombre que tiene el examen 
	* @access private
	* @param $id_examen
	* @var int
	*
	*/
	function get_examenNombre($id_examen){
		$query = "SELECT nombre FROM Fuentes WHERE idFuente='$id_examen'";
		$sql = mysql_query($query) or die(mysql_error());
		$row=mysql_fetch_row($sql);
		return $this -> tentativas = $row[0];
	}
	/**
	*
	* Action up_atemp
	* incrementa el valor del numero de tentativas
	* @access private
	* @param $examen
	* @var int
	*
	*/
	function up_atemp($examen){
		$progress = $this -> get_progreso();
		if(array_key_exists($examen, $progress) AND $progress[$examen] != 0 AND $progress[$examen] != 99){
			$progress[$examen] = $progress[$examen]+1;
			if ($progress[$examen] == 99) $progress[$examen] = 98;
			$json = json_encode($progress);
			$this -> progreso = $json;
			$this -> update_progreso();
		}
	}	
	/**
	*
	* Action down_atemp
	* disminuye el valor del numero de tentativas
	* @access private
	* @param $examen
	* @var int
	*
	*/	
	function down_atemp($examen){
		$progress = $this -> get_progreso();
		if(array_key_exists($examen, $progress) AND $progress[$examen] != 99 AND $progress[$examen] != 0){
			$progress[$examen] = $progress[$examen]-1;
			if ($progress[$examen] == 0) $progress[$examen] = 1;
			$json = json_encode($progress);
			$this -> progreso = $json;
			$this -> update_progreso();
		}
	}
}


?>