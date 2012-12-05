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
<!--	<script src="../jquery/jquery-1.4.2.js"></script> -->
<!--	<script src="jquery/jquery-shuffle.js"></script> -->
	<script src="../js/draft.js"></script> 
	<title><?php echo $_SESSION['user'];?></title>
</head>
<body>
<div class="right2"><?php
	if($db!='asg_admin'){
//		echo "<u>Examenes apilados</u> <br />";
//		alumno_listar();
		$sql="SELECT examenes FROM Alumnos";
		$query=mysql_query($sql);
		$row=mysql_fetch_assoc($query);
		$examenes=get_examenes($row['examenes']);
		if(strlen($examenes[0])>=1){
			echo '<u>Proximos examenes</u><br />';
			foreach($examenes as $val){
				$source_name=source_name($val);
				echo '<span class="marco2" title="'.$source_name.'">'.$val.'</span>';
			}	
		}
		//echo n_examenes_max();
		//echo str_examenes(1);
	}
	?></div>

<?php
if(isset($db)){
if($db=="asg_admin") echo "Conecte a una asignatura";
else{
//	listar_n(3);	
//	echo "Las cuestiones con fondo naranja no tienen ninguna opcion marcada como correcta"."<br />";
//	id_explorer("Cuestiones");
	echo "Conceptos de la asignatura"."<br />";
	temas_conceptos();


echo '<br />
Nombre <input type="text" name="nombre" id="nombre" maxlength="40" size="40" /><br /> 
<button name="seleccion">Seleccion</button>
<button name="todos">Todas</button><input type="checkbox" name="rand" id="rand" checked/>Aleatorias<br />
Numero de cuestiones<input type="text" name="numero" id="numero" maxlength="2" size="2" value="5"/>
Tiempo limite <input type="text" name="duracion" id="duracion" maxlength="2" size="2" value="30"/> minutos

<div class="total_info"></div>
';

}
if($db!="asg_admin"){

	echo "<hr />";
	echo "<h3>Contenido de los examenes creados</h3>";
//	source_minified();
//	source_maximise();

//	source_balance();
	examen_listar();
}
}
//examenes_show(1);
//check_correcta();
//ALTER TABLE table_name
//ADD column_name datatype
//$sql="ALTER TABLE Fuentes ADD numero TINYINT NULL";
//$query=mysql_query($sql) or die(mysql_error());

//	$sql="alter table Alumnos change fk_idAsignatura status varchar (10)";
//	$query=mysql_query($sql) or die(mysql_error());
//delete_table("Fuentes");
//create_fuente_table();

?>

</body>
</html>


