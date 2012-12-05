<?php
	session_start();
	require_once('includes/db_tools.inc');
	
	
	if(isset($_SESSION['db_name'])){ 
		$db=$_SESSION['db_name'];
		conectar($db);
		$admin = ($db=="asg_admin") ? true : false;
	}else {
		redirect_to("index.php");
	}	

function temas_conceptos(){

	echo "<div class='clear'></div>";		
	$sql="SELECT * FROM Temas";// WHERE fk_idAsignatura='$Asig'";
	$result1=mysql_query($sql) or die(mysql_error());
	while($row1= mysql_fetch_object($result1)){
		$idTema=$row1->idTema;
		$nmTema=$row1->Nombre;
		echo '<hr /><b>'.$nmTema.'</b>';
		echo "<span class='small underl' name='tema_editar' value='".$idTema."'><a title='".$nmTema."' href='#tema_form'>editar</a></span>";
		echo "<span class='small underl' name='tema_añadir' value='".$idTema."'><a title='add'>añadir</a></span>";
		echo "<span class='small underl' name='tema_borrar' value='".$idTema."'><a>borrar</a></span>";
		echo "<div class='clear'></div>";
		echo "<div class='con' name='$idTema'>";
		echo "<input type='text' class='appending".$idTema."'/><input type='button' value='Nuevo' name='addC'/><br />";
		echo "</div>";	
		$sql="SELECT * FROM Conceptos WHERE fk_idTema='$idTema'";
		$result=mysql_query($sql);
		echo "<table border='0' cellspacing='0' cellpadding='3'>";
		while ($row= mysql_fetch_object($result)){
			$idConcepto=$row->idConcepto;
			$nmConcepto=$row->Nombre;
			$dsConcepto=$row->Descripcion;

			echo '<tr><td width="90%">'.$nmConcepto." : ".$dsConcepto.'</td>';
		echo "<a  href='#concepto_edit' title='editar concepto'><span class='small underl dcha' name='concepto_editar' value='".$idConcepto."'>editar</span></a>";
//			echo "<a href='#concepto_edit'><span class='small underl dcha' name='concepto_editar' value='".$idConcepto."'>editar</span></a>";
//			echo "<a href='#concepto_edit'><span class='small underl dcha' name='concepto_editar' value='".$idConcepto."'>editar</span></a>";
			echo "<span class='small underl dcha' name='concepto_borrar' value='".$idConcepto."'>borrar</span><br/></tr>";
		//	echo "<div class='clear'></div>";
					
		}
		
	}
	echo '</table>';
}
?>
<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title>Conceptos</title>

	<link rel="stylesheet" href="css/main.css" type="text/css">	

<!--	
	<script type="text/javascript" src="jquery/jquery-1.4.2.js" ></script>
-->

</head>
<body>
<!--<div id="contenido">-->
<div id="ula">
	<h2>Edicion de la asignatura</h2>
	<h4>
	<?php 
		$asig=asg_name($db);
		echo "> ".strtoupper($asig); 
	?>
	</h4>
	<div id="cb">
		<?php temas_conceptos(); ?>
	</div>
	<hr />
		<div class="ready"></div>	
	<div id="tema_form">
		<form>
			Tema<br />
			<input type="text" name="tema_nombre" />
			<input type="button" id="update_tema" value="Actualizar"/><br />
		</form>
	</div>

	<div id="concepto_form">
		<form>
			Concepto<br />
			<input type="text" name="concepto_nombre" />
			<input type="button" id="update_nombre" value="Actualizar"/><br /> 
			Descripcion<br />
			<textarea name="concepto_descripcion" id="" cols="23" rows="3"></textarea>
			<input type="button" id="update_descripcion" value="Actualizar"/><br /> 
		</form>
	</div>
	
	<div id="concepto_edit">
		<form>
			Concepto<br />
			<input type="text" name="concepto_edit" />
			<input type="button" id="concepto_actualizar" value="Actualizar"/><br /> 
			Descripcion<br />
			<textarea name="descripcion_edit" id="descripcion_edit" cols="23" rows="3"></textarea>
			<input type="button" id="descripcion_actualizar" value="Actualizar"/><br /> 
		</form>
	</div>
	
	<div id="add_tema">
		<div class="tem">
			Nuevo tema<br />
			<input type="text" id="Tema"/>
			<input type="button" value="Nuevo" id="newTh"/><br />
		</div>
		<div class="Ot">
			Concepto<br />
			<input type="text" id="Concepto"/>
			<input type="button" value="Nuevo" id="newConcept"/><br />
			<input type="button" value="Fin" id="bEnd"/><br />
		</div>
	</div>

	<span class='small underl' name='tema_nuevo' value='tema_nuevo'>Añadir Tema</span>
	<span class="small dcha">Pulse Cuestiones para la gestión de las cuestiones.<input class="dcha" type="button" value="Cuestiones" name="create"></span>
	
	<hr />


</div>
<!--</div>-->

<!--	<script src="js/concepto.js" type="text/javascript"></script>	
-->
</body>
</html>
