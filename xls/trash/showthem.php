<?php
// Muestra imagenes de las ecuaciones
	require_once('includes/misfunciones.php');
	$conn = Conectar();
	$new_name = htmlspecialchars(trim($_POST['Img_name']));
	$eq_exp = htmlspecialchars(trim($_POST['Img_exp']));

Conectar();
	$query="SELECT * FROM Ecuaciones ";
	$result =mysql_query($query);
	$Ecuaciones=mysql_fetch_array($result);
	while($Ecuaciones= mysql_fetch_array($result))
		{
			echo $Ecuaciones['eq_path'];
		}

?>
