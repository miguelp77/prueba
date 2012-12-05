<?php
function listme(){	
	require_once('includes/misfunciones.php');
	$conn=Conectar();
//Funciones en js/listMaterias.js	
	$query="SELECT * FROM Materias";
	$result=mysql_query($query);
//	echo "<form method=\"post\" action='#'>";
	echo "<select name='Materia' id='Materia' SIZE='1' >";
	while ($row = mysql_fetch_object( $result ))
		{
	//anulo el valor de phpmyadmin
	//if($row->Database =="phpmyadmin") continue;
	   echo "<OPTION VALUE='$row->Nombre' ID='$row->idAsignatura'> $row->Nombre</OPTION>";
		}
	echo "</select> ";
	echo $row;
	echo "<input type='button' name='SelMateria' value='Seleccionar'/>";
}
?>
<!DOCTYPE HTML>

<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title>Exploracion de Asignaturas</title>
	<link rel="stylesheet" href="css/listados.css" />	
	<script src="jquery/jquery-1.4.2.js" ></script>
</head>

<body>
<div id="menu">
<?php
	listme();
?>
</div>
<div id="accion"></div>
<div id="info"></div>
	

</body>
	<script src="js/listMaterias.js" ></script>
</html>
