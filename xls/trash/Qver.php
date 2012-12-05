<?php
require_once('includes/misfunciones.php');
	require_once('funciones_de_administracion.php');
	require_once('funciones_de_administracion.tfc');
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Visor de Cuestiones</title>
	<link rel="stylesheet" type="text/css" href="estilos/basic.css">
</head>
<body>
<?php	
	echo Cuestiones();
	$conn = Conectar();
	$n_pag = htmlspecialchars(trim($_POST['N_PagQ']));
	$inicio=0+($n_pag*5);
//	$inicio=0;
	$query= "SELECT * FROM Cuestiones ORDER BY Q_id ASC LIMIT $inicio,5";// LIMIT 0," .$pag."'";
	$result =mysql_query($query);

	$i=$inicio-1;
	while($Cuestion= mysql_fetch_array($result))
		{
			$i++;
echo "<div id='contenedor'>
				<div id='pregunta'>
					<span class='redondear'>#".$Cuestion[5]."</span><br/>
					<span class='deadtime'>Time</span>
				</div>	

		<div id='imagen1'>";
//			$ima=$Cuestion[5];
			//echo $ima;
	//		echo "kkk";
			if ($Cuestion[3]!=""){
				 echo '<img src="';
				 echo $Cuestion[3];
				 echo '"/>';
				}
			 
echo "</div>
	<div class='clear'></div>
		<div id='contenido'>
		<div id='imagen2'>
			<img src='".$Cuestion[4]."'/>
 		</div>
	<div id='enunciado'>
		$Cuestion[4]
	</div>		
		<div id='respuestas'>";
			GetAnswers($Cuestion[1]); 
echo "</div>
	</div>
</div>";

			if(($i%1)==0) echo "<br/>";
			
		//	if(($i%5)==0) echo "</div>";//<div class='img2'><br />";
//			echo $Ecuaciones['eq_path'];
}?>
</body>
</html>


