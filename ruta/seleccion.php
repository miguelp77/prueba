<?php
require_once('includes/db_tools.inc');
require_once('includes/cuestiones.inc');	
//	require_once('includes/misfunciones.php');
conectar('asg_dummy');//	require_once('checkuser.php');
?>
<html>
<head>
	<script type="text/javascript" src="../js/jquery-1.4.3.min.js"></script>
	<title>Demo</title>
</head>
<body>
	<?php
		$pepe = new Alumnos;
		$pepe->set_alumno(1);
		// var_dump($pepe->fueInicializado());
		// $pepe->fueInicializado();
		$pepe->start_from_db();
		// echo $pepe->get_alumno();
		$pepe -> init_progreso();
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
class Alumnos{
	var $alumno; // este es el ID
	var $nombre; // Nombre + Apellidos
	var $examenes;
	var $progreso;
	var $tentaivas;
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
	function set_alumno($nombre){
		$this->alumno=$nombre;
	}
	function get_alumno(){
		return utf8_decode($this-> nombre);
	}

	function fueInicializado(){
		//Si fue inicializado devuelve true
		// si no lo fue devuelve false
		$retorno = false;
		if($this->alumno == 1) $retorno = true;
		return $retorno;
	}
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
				// var_dump($arrProgreso);
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
	function update_examenes(){
		$ex = $this -> examenes;
		$query = "UPDATE Alumnos SET examenes = '$ex' WHERE Alumno_id='$this->alumno'";
		$sql = mysql_query($query) or die(mysql_error());
		return true;
	}
	function update_progreso(){
		$progreso = $this -> progreso;
		
		// var_dump($progreso);
		$query = "UPDATE Alumnos SET progreso = '$progreso' WHERE Alumno_id='$this->alumno'";
		$sql = mysql_query($query) or die(mysql_error());
		return true;
	}
	function get_progreso(){
		$query = "SELECT progreso FROM Alumnos WHERE Alumno_id='$this->alumno'";
		$sql = mysql_query($query) or die(mysql_error());
		$row=mysql_fetch_row($sql);
		return $this -> progreso = json_decode($row[0],true);
		// Devuelve un array
	}
	function get_examenInfo($id_examen){
		$query = "SELECT intentos FROM Fuentes WHERE idFuente='$id_examen'";
		$sql = mysql_query($query) or die(mysql_error());
		$row=mysql_fetch_row($sql);
		return $this -> tentativas = $row[0];
	}
	function get_examenNombre($id_examen){
		$query = "SELECT nombre FROM Fuentes WHERE idFuente='$id_examen'";
		$sql = mysql_query($query) or die(mysql_error());
		$row=mysql_fetch_row($sql);
		return $this -> tentativas = $row[0];
	}
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