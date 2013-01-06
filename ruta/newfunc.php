<?php
	session_start();
	require_once('includes/db_tools.inc');
	require_once('includes/cuestiones.inc');	
	if(isset($_SESSION['db_name'])){
		$base=$_SESSION['db_name'];
		// echo "Base seleccionada:<b> ".asg_name($base)."</b>";
	}
	$db=$base;
	$db=utf8_decode($db);	
?>
<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>WorkAround</title>
</head>
<body>

<?php

class foo_mysqli extends mysqli {
	private $db;
	public function __construct($bd) {
		$host = 'localhost';
		$usuario = 'miguel';
		$contraseña = 'Prima2';
		parent::__construct($host, $usuario, $contraseña, $bd);
		if (mysqli_connect_error()) {
			die('Error de Conexión (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
		}
	}
}
class alumno{
	protected $nombre;
	protected $apellidos;
	protected $dni;
	protected $alias;
	private $pass;
	public $status;
	protected $examenes;
	protected $grupos;
//Setters
	// Nombre
	public function setNombre($nombre){
		if(trim($nombre) != ""){
			$this->nombre =$nombre;
			return true;
		}
		else{
			return false;
		}
	}
	// Apellidos
	public function setNombre($apellidos){
		if(trim($apellidos != ""){
			$this->apellidos=$apellidos
			return true;
		}
		else{
			return false;
		}
	}
	// DNI
	public function setNombre($dni){
		if(trim($dni != ""){
			$this->dni=$dni
			return true;
		}
		else{
			return false;
		}
	}




	
}
class alumnos{
	private $db;
	private $link;
	public $nombre;
	public $ids=array();
	public $nombres=array();
	public $apellidos=array();
	public $dnis=array();
	private $aliass=array();
	public $pass=array();
	public $status=array();
	protected $exameness=array();
	private $gruposs=array();

	public function __construct($db){
		// $this->nombre=$nombre;
		$this->db = $db;
		$this->todos_la_tabla($db);
	}
	public function conexion(){
		$db=$this->db;
		$this->link= new foo_mysqli($db);
		return $this;
		// echo "conectado";
	}
	public function set_db($db){
		$this->db = $db;
		// echo "la base es ".utf8_encode($db);
	}
	public function todos_la_tabla(){
		// Conectamos a la base
		// Extraemos los valores de la tabla Alumnos
		$link = $this->conexion();
		$link=$this->link;
		$sql = "SELECT * FROM Alumnos ";
		$query=$link->query($sql);
		while ($row=$query->fetch_object()) {
			$this->ids[$row->Alumno_id]=$row->Alumno_id;
			$this->nombres[$row->Alumno_id]=$row->Nombre;
			$this->apellidos[$row->Alumno_id]=$row->Apellidos;
			$this->dnis[$row->Alumno_id]=$row->DNI;
			$this->aliass[$row->Alumno_id]=$row->Alias;
			$this->pass[$row->Alumno_id]=$row->Psw;
			$this->status[$row->Alumno_id]=$row->status;
			$this->exameness[$row->Alumno_id]=$row->examenes;
			$this->gruposs[$row->Alumno_id]=$row->grupos;
			// echo $row->Alumno_id.'<br />';
		}
	}
	public function grupos_del_alumno($id){
		$cadena=array();
		// $cadena=split(',', $this->gruposs[$id]);
		$cadena=explode(',', $this->gruposs[$id]); 
		return $cadena;
	}
	public function alumno($id){
		$map = array( 'nombre'  => $this->nombres[$id],
              'apellidos'   => $this->apellidos[$id],
              'alias'       => $this->aliass[$id],
              'examenes' 		=> $this->exameness[$id]
            );
		return $map;
	}
	public function examenes_del_alumno($id){
		$cadena=array();
		// $cadena=split(',', $this->gruposs[$id]);
		$cadena=explode(',', $this->exameness[$id]); 
		return $cadena;
	}	
}

//USO del objeto alumnos
$alumnos=new alumnos($db);
// echo $alumno->nombre;
// $alumno->todos_la_tabla();
// echo $alumnos->gruposs[14].'<br>';
$valores= $alumnos->grupos_del_alumno(16);
echo "Grupos de alumno 16<br>";
foreach ($valores as $key => $value) {
	echo $value.'<br>';
	# code...
}

foreach ($alumnos->ids as $key => $value) {
	echo 'id de los alumnos '.$value.'<br>';
}
echo 'Nombre del alumno 16 '.$alumnos->nombres[16].'<br>';
$a16 = $alumnos->alumno(16);
foreach ($a16 as $key => $value) {
	echo $key.': '.$value.'<br>';
}
echo 'Examenes del alumno 16 <br>';
$ex=$alumnos->examenes_del_alumno(16);
foreach ($ex as $key => $value) {
	echo $key .': '.$value.'<br>';
}
// $alumno=new alumnos("Miguel");
// $alumno->set_db($db); 


unset($alumno);
// $link= new foo_mysqli($db);
// $link->close();


function connect_to($db){
	$mysqli = new mysqli("localhost", "miguel", "Prima2", $db);
	if ($mysqli->connect_error) {
    die('Error de Conexión (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
	}
	if (mysqli_connect_error()) {	
    die('Error de Conexión (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
	}
	return $mysqli;
}	
function desconnect($mysqli){
		$mysqli->close();
}


function pdfqueue(){
// devuelve el numero de registros listos para imprimir por pdfprinter
	$link=conectar('asg_admin');
	$sql = "SELECT idPDF FROM pdfprinter WHERE status = 'ready'";
	$query = mysql_query($sql);
	$numero_filas = mysql_num_rows($query);
	return $numero_filas;
	mysql_close($link);
}
function grupos_nombre($db){
	// $mysqli=connect_to($db);
}
// grupos_nombre($db);

//echo pdfqueue();
function pdfprinter(){
	$status='processing';
	$estado='ready';
	$marca=marca();
	$link=conectar('asg_admin');
		$sql="SELECT BBDD,idPDF,opciones,valores,rmks ";
		$sql .= "FROM pdfprinter ";
		// $sql .= "WHERE status='$estado' ";
		// $sql .= "LIMIT 1";
		$query=mysql_query($sql) or die(mysql_error());
		while($row=mysql_fetch_row($query)){
			  print_r($row);
        echo '<br />';
		 $sql="UPDATE asg_admin.pdfprinter SET status='$status',marca='$marca' WHERE idPDF= '$row[1]' LIMIT 1";
		 // $query=mysql_query($sql) or die(mysql_error());
		}	
	mysql_close($link);
	return $row;	
}

 // pdfprinter();

function list_notas($db=null,$fecha=null,$rmks=null)
{
	$p_num=0; //numero de alumnos presentados	
	if($db!=null){
		$link=conectar($db);
		echo '<br /><b>Alumnos presentados.</b><br />';	
		echo '<hr />';		
		echo '<span class="c15">Apellidos,Nombre</span>';
		echo '<span class="c15">DNI</span>';
		echo '<span class="campo"></span>';
		echo '<span class="c15">Nota</span>';		
		echo '<br /><hr />';
// Comienza el loop
		$i=0;
		$presentados_ids=Array(); // IDs de los presentados
		// $miembros= Array();	// A que grupo pertenece cada ID
	//	$np_ids=Array();
	//	$np_total=Array();
		if($fecha!=null){
			// $al=walk_idA_alumnos();//de Alumnos

//Inicio de grupo
		$grupos=array();
		// var_dump($rmks);		
		if($rmks!=null){
			$grupos=explode(',',$rmks);
		}
		// var_dump($grupos);		
//Fin de grupo
		//Relleno los grupos
	// var_dump($al);
	// $ggg= give_their_data("2");
	// echo $ggg[3];
		// foreach ($al as $id) {
		// 	if($id[3] == )
		// }
	// foreach($grupos as $grupo){
	// 	echo '<br>'.$grupo.' -> ';
	// 	print_r(group_members($grupo));
	// }
	echo "<br>";


		foreach($grupos as $grupo){
			echo '<span class="c15"><br />GRUPO: '.$grupo.'</span><br />';
			$mem_string = group_members($grupo);
			$al=explode(",", $mem_string);
			foreach($al as $k=>$v){
				$datos=give_their_data($v);
				$al_fcha=get_fechas($v);
				$al_ntas=get_notas($v);
				// echo 'depura ';
				// var_dump($v);
				// echo '<br>';
				// if($al_fcha!=null) //Linea de depuracion
				foreach($al_fcha as $kf => $fcha){
					if($fcha==$fecha && $datos[3]==$grupo){
						$nota[]=$al_ntas[$kf];
//					echo 'alumno '.$datos[0].' nota '.$al_ntas[$kf].'<br />';
						$i++;
//						$presentados_ids[]=$datos[2];
//						$presentados_ids[]=$v;
						if($i%2) echo "<div class=\"clear colorme\">";
						else echo "<div class=\"clear colorme odd\">";
						echo '<span class="c15">'.$datos[0].','.$datos[1].'</span>';
						echo '<span class="c15">'.$datos[2].'</span>';
						echo '<span class="campo"> </span>';
						echo '<span class="c15">'.$al_ntas[$kf].'</span>';
						echo '</div>';
						if(!in_array($v,$presentados_ids))$presentados_ids[]=$v;
						$p_num++;
					}
				}
			}
			}			
			$np_num=0;
		if(isset($nota)){	
			foreach($nota as $valor){
				if($valor=='np') $np_num++;
			}
		}
			$np_ids=array_diff($al,$presentados_ids);
//			echo '<b><br />Alumnos sin presentar<br /></b>';
			if($i>100)
			foreach($np_ids as $k=>$v){
		//				if(!in_array($datos[2],$np_ids))$np_ids[]=$datos[2];
		//				else continue;
						$datos=give_their_data($v);
						$i++;
						if($i%2) echo "<div class=\"clear colorme\">";
						else echo "<div class=\"clear colorme odd\">";
						echo '<span class="c15">'.$datos[0].','.$datos[1].'</span>';
						echo '<span class="c15">'.$datos[2].'</span>';
						echo '<span class="campo"> </span>';
						echo '<span class="c15">'.'---'.'</span>';
						echo '</div>';
						$p_num++;						
						$np_num++;
			}
		}

// RESUMEN
		echo '<br /><hr /><br />';
//		echo '<b>Alumnos presentados</b>: '.(count($presentados_ids)-$np_num).'<br />';
		echo '<b>Alumnos presentados</b>: '.($p_num-$np_num).'<br />';
		echo '<b>Alumnos no presentados</b>: '.$np_num.'<br />';
		echo '<b>Total</b>: '.(count($presentados_ids)).'<br />';
		mysql_close($link);
	}else return false;
		unset($al);
		unset($nota);
		unset($al_fcha);
		unset($al_ntas);
		unset($datos);
}


		// $dba=pdfprinter();
		// var_dump($dba);
		// foreach ($dba as $clave => $value) {
			// echo 'clave = '.$clave.' valor = '.$value.'<br />';	
		// }
	
		// list_notas('asg_mike_10','10-03-2011','dummy,qqqqqqqq,test');

// list_notas($db,$opciones,)



















?>

</body>
</html>