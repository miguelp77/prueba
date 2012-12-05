<?php
	session_start();
function listado(){
	require_once('includes/db_tools.inc');
//	require_once('includes/misfunciones.php');
	$db=$_SESSION['db_name'];
	conectar($db);
//	$Asignatura=htmlspecialchars(trim($_POST['Asignatura']));;
//Funciones en js/listMaterias.js	
//	$Asignatura=$_COOKIE['Galle']; //Cojo la cookie
//	$query="SELECT * FROM Temas WHERE  fk_idAsignatura='$Asignatura'";
//	$result=mysql_query($query);
//	echo "<form method=\"post\" action='#'>";
/*
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
*/
//Modificacion
	$query="SELECT * FROM Temas";// WHERE  fk_idAsignatura='$Asignatura'";
	$result=mysql_query($query);
	echo "<div class='margen_l'>";
	while ($row = mysql_fetch_object($result)){
		$query2="SELECT * FROM Conceptos WHERE  fk_idTema='$row->idTema'";
		$result2=mysql_query($query2);
		echo "<h4>$row->Nombre <a href='#' class='deleteTH' value='$row->idTema'><img src='./img/cross.png' alt=''/></a>";
		echo "<a href='#' class='updateTH' value='$row->idTema'><img src='./img/pencil.png' alt=''/></a></h4>";
		while ($row2 = mysql_fetch_object( $result2 )){
			echo "<li>$row2->Nombre <a href='#' class='deleteCC' value='$row2->idConcepto'><img src='./img/cross.png' alt=''/></a>"; 				echo "<a href='#' class='updateCC' value='$row2->idConcepto'><img src='./img/pencil.png' alt=''/></a></li>";
		}
	}
	echo "<input type='button' value='Fin' name='Fin' />";
	echo "</div>";
}
?>

<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="css/main.css" />	
	<script type="text/javascript" src="jquery/jquery-1.4.2.js" ></script>
		<script src="js/listmaterias.js" ></script>
</head>
<body>
	<div id="uld">
	<?php listado(); ?>
	</div>
		
</body>
</html>
