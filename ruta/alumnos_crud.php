<?php
session_start();
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
//Conecto a la BBDD
	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		conectar($db);
	}else{
	echo "Sin base."."<br />"; //Aqui habria que redirigir
	}
$era_admin=0; //La base era asg_admin
?>
<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title>Alumnos</title>
	<link rel="stylesheet" href="../css/main.css" />
	<script type="text/javascript" src="../js/alumno.js"></script> 
	<!-- 
		<script src="../js/jquery.tools.min.js"></script> 
	-->
</head>
<body>


<?php
if(isset($db) && $db=='asg_admin'){
	unset($db);
	unset($_SESSION['db_name']);
	$era_admin=1;
	echo 'Conectese a una asignatura.<br />';

	
}

if(isset($db)){
$numero_de_alumnos=cuantos_alumnos();
	if($numero_de_alumnos>0){
	echo "<p>Listado de alumnos "; if(isset($_SESSION['db_name'])) echo " en <b>".asg_name($_SESSION['db_name'])."</b>.";
	echo "<span class='dcha'>Total: $numero_de_alumnos alumnos.</span><br />";
		$sql="SELECT examenes FROM Alumnos";
		
			$query=mysql_query($sql);
			$row=mysql_fetch_assoc($query);
			$examenes=get_examenes($row['examenes']);
		if(count($examenes)>=1){
			echo '<u>Proximos examenes</u><br />';
			if(!isset($examenes)){
				foreach($examenes as $val){
					$source_name=source_name($val);
					echo '<span class="marco2" title="'.$source_name.'">'.$val.'</span>';
				}
			}
		}
	}
if($numero_de_alumnos>0){
	echo "<spam class='small'><br />Apellidos | Nombre |  DNI | Siguiente examen| [Alias] | [Contraseña]</spam></p><hr />";
		$sql="SELECT * FROM Alumnos ORDER BY Apellidos ASC";
		$query=mysql_query($sql);
	//	echo "<pre>";
		echo '<div class="scroll-panel">';
		while($result=mysql_fetch_assoc($query)){
			$nEx=next_source($result['Alumno_id']);
					
		echo '<span class="naranja"> '.$result['Apellidos'].', '.$result['Nombre'].' | '.$result['DNI'].' [ '.$nEx.' ]['.$result['Alias']."] [".$result['Psw']."]".'</span>';
		echo '<span class="tag">'.$result['grupos'].'</span>';
		echo "<div class='css_btt_r' name=".$result['Alumno_id']." title='editar'><a href='#aqui'>editar</a></div>";
		echo "<div class='css_btt_r' name=".$result['Alumno_id']." title='borrar'>borrar</div>";
		echo "<hr />";
	}
	echo '</div>';
}

}
//	echo "</pre>";
?>

<div id="alumno_nuevo">
	<br />
	<form>
	<input type='text' name='nombre'/>Nombre<br />
	<input type='text' name='apellidos'/>Apellidos<br />
	<input type='text' name='dni'/>DNI<br />
	<input type='text' name='alias'/>Alias<br />
	<input type='text' name='pass'/>Contraseña<br />
	</form>
	<div class='css_btt' name='create' title='Nuevo alumno'>Guardar</div>
</div>

<div id="alumno_edit">
	<br /><hr />
	
	<form>
		<input type='text' name='nombre_u'/>Nombre<br />
		<input type='text' name='apellidos_u'/>Apellidos<br />
		<input type='text' name='dni_u'/>DNI<br />
		<input type='text' name='alias_u'/>Alias<br />
		<input type='text' name='pass_u'/>Contraseña<br />
	</form>
	<div class='css_btt' name='update' title='Actualizar la informacion'>Actualizar</div>
	<hr /><br />
</div>
<div id="aqui"></div>
<div id="alumno_file"><hr />

		<form action="get_alumnos_from_xls.php" method="post" enctype="multipart/form-data">
			<input type="file" id="bdp" name="file"/>
			<input type="submit" name="submit" value="Continuar" />
		</form>


<!--
	<input type='file' name='alumno_archivo'/>
	<div class="css_boton" name="alumno_import" title="importacion de alumnos">Continuar</div><br />
-->
<hr /></div>
<?php 
	if(isset($db) && $numero_de_alumnos>0 ){
?>
<div class="info">
	<div id="btt_alumnos">
		<div class="css_btt" name="nuevo" title="nuevo alumno">Nuevo</div>
		<div class="css_btt " name="a_import" title="importacion de alumnos">Importar</div>
		<div class="css_btt" name="a_lista" title="generar lista de alumnos">Lista</div>
		<div class="css_btt" name="regenerate" title="Nuevas contraseñas">Renovar</div>
		<div class="css_btt" name="group" title="Gestionar grupos">Grupos</div>
	</div>
</div>
</div></div>
<?php 
	} 

if($era_admin==0 && isset($db) && $numero_de_alumnos<=0){
	echo '<div class="info">Estas conectado a <b>'.asg_name($db).'</b> y no hay alumnos asignados.<br />';
	echo '¿Crear un nuevo alumno? <br /> 
		<div id="btt_alumnos">
			<div class="css_btt" name="nuevo" title="nuevo">Crear</div>
			</div>';
}


?>
<div id="al_msg">
	<?php
//		echo $_SESSION['mssg'];
	?>
</div>
</body>
<script>
$(function(){
//	$('.scroll-panel').scrollable();
});
</script>
</html>
