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
<?	$conn = Conectar();
	$n_pag = htmlspecialchars(trim($_POST['N_pag']));
//	$inicio=0+($n_pag*5);
	$inicio=1;
	$query= "SELECT * FROM Cuestiones ORDER BY Q_id ASC LIMIT $inicio,5";// LIMIT 0," .$pag."'";
	$result =mysql_query($query);

	$i=$inicio-1;
	while($Cuestion= mysql_fetch_array($result))
		{
			$i++;
echo "<div id="contenedor">
				<div id="pregunta">
					<span class="redondear"># <?php GetNCuestion(5); ?></span><br/>
			<span class='deadtime'>Time</span>
		</div>	

		<div id='imagen1'>
			<?php 
			$ima=GetImage(2);
			//echo $ima;
	//		echo "kkk";
			if ($ima!=""){
				 echo '<img src="';
				 echo $ima;
				 echo '"/>';
				}
			?> 
		</div>
<div class='clear'></div>
	<div id="contenido">
		<div id='imagen2'>
			<?php //if (GetImage2(32)) echo "<img src='".GetImage(32);."'/>"
			?> 
		</div>
	<div id='enunciado'>
		<?php GetEnunciado(32); ?>
	</div>		
		<div id='respuestas'>
			<?php GetAnswers(1); ?>
			</div>

	</div>

</div>";


			if(($i%1)==0) echo "<br/>";
			
		//	if(($i%5)==0) echo "</div>";//<div class='img2'><br />";
//			echo $Ecuaciones['eq_path'];
		}



</body>
</html>
