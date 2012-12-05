<?php //Borrar MATERIAS enteras, incluido TEMAS y CONCEPTOS
	require_once('includes/misfunciones.php');
	$conexion = Conectar();

	$idAsig=htmlspecialchars(trim($_POST['Asig']));;
//Obtengo los id(fk_idAsignatura) de los TEMAS que forman la MATERIA 

//Elimino las CUESTIONES de los TEMAS

//Elimino CONCEPTOS de los TEMAS


//Elimino los TEMAS


//Elimino la MATERIA
	$query="DELETE FROM Materias WHERE idAsignatura='$idAsig'";
	mysql_query($query) or die(mysql_error());
	
?>
