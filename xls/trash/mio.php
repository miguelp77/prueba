<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<tistle></title>

</head>
<body>
	<p>\[
		\omega=\frac{3\pi}{2}
		\]</p>
<?php		
		//	require_once('includes/misfunciones.php');
	$conn=@mysql_connect("localhost","root","p89er");
//Listado de las TABLAS que hay en las BBDD 'Asgs'
	$result = mysql_list_tables("Asgs");
//Selecciona la tabla de BBDD
	$base=$_POST['tabla'];
	$base="Asg_materia";
//TODA la informacion de la tabla seleccionada
//	$query="SELECT * FROM $base";
//	$result =mysql_query($query)or $error_sql=mysql_error();
//	echo $error_sql;
//Selecciono TODA la informacion de manera ORDENADA
	$query= "SELECT * FROM $base WHERE 'Cuestion_id'=0 limit 1";// ORDER BY 'Q_id' ASC";// LIMIT $inicio,5";// LIMIT 0," .$pag."'";
//	$result =mysql_query($query);
//Puedo ver la clase de error
	$result =mysql_query($query)or $error_sql=mysql_error();
	echo $error_sql;
//	$i=$inicio-1; //Utilizado anteriormente para la paginacion
	$i=0;
	$cuestiones= mysql_fetch_array($result);
	$cad=$cuestiones['Enunciado']; 
	echo "$$ \frac{-b\pm\sqrt{b^2-4ac}}{2a}$$"."<br />";
	echo "xxx ".$cad."<br />";
	echo (string)("\[\omega =\frac{b}{2a}\]");
?>
</body>
	<SCRIPT SRC="mathjax/MathJax.js"></SCRIPT>
</html>
