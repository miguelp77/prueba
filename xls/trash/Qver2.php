<?php
	require_once('includes/misfunciones.php');
	$conn = Conectar();
	$n_pag = htmlspecialchars(trim($_POST['N_pag']));
	$inicio=0+($n_pag*5);

$query= "SELECT * FROM Cuestiones ORDER BY Q_id ASC LIMIT $inicio,5";// LIMIT 0," .$pag."'";
	$result =mysql_query($query);

	$i=$inicio-1;

	while($Cuestiones= mysql_fetch_array($result))
		{
echo "<div id='contenido'>";
			$i++;
echo "<div class='ficha'>
				<div id='pregunta'>
					<span class='redondear'>#".$Cuestiones['Q_id']."</span><br/>
				<!--	<span class='deadtime'>20</span> 
				</div>	-->

		<div id='imagen1'>";
			if ($Cuestiones['Imagen']!=""){
				 echo '<img src="';
				 echo $Cuestiones['Imagen'];
				 echo '"/>';
				}
			 
echo "</div>
	<div class='clear'></div>
	<div id='imagen2'>";
	if ($Cuestiones['Imagen_aux']!=""){
				 echo '<img src="';
				 echo $Cuestiones['Imagen_aux'];
				 echo '"/>';
				}
echo" </div>
	<div id='enunciado'>";
	echo	$Cuestiones['Enunciado'];
	GetAnswers($Cuestiones['Cuestion_id']); 
echo "</div>		
		<div id='respuestas'>";

echo "</div></div></div></div><br/>";

				
		}

/*	echo "<br />".$number. " imagenes en ".intval($pag)." paginas";
	echo "<br />".$inicio;
	echo "<br />".$fin;
*/	
?>
