<?php
	// Carga imagenes de las ecuaciones TEX
	require_once('includes/misfunciones.php');
	$conn = Conectar();
	$n_pag = htmlspecialchars(trim($_POST['N_pag']));
	$inicio=0+($n_pag*5);
	
	$query= "SELECT * FROM Ecuaciones ORDER BY eq_id ASC LIMIT $inicio,5";// LIMIT 0," .$pag."'";
	$result =mysql_query($query);

	$i=$inicio-1;
	while($Ecuaciones= mysql_fetch_array($result))
		{
			$i++;
			echo "<div class='imgtext'>";//.$Ecuaciones['eq_exp']." -- -- ".$i."</div>";
			
			
			echo"<div class='pngs'>"."<input type='radio' name='oo'>"."<img class='redondear ".$i."' src=".$Ecuaciones['eq_path']." title=".$Ecuaciones['eq_path']."/>"."</div>";
			echo "<div class='imginfo'>"." Expresion: ".$Ecuaciones['eq_exp']. "<br/>";
			echo "  Archivo: ".$Ecuaciones['eq_path'];
			echo "</div></div>";
			if(($i%1)==0) echo "<br/>";
			
		//	if(($i%5)==0) echo "</div>";//<div class='img2'><br />";
//			echo $Ecuaciones['eq_path'];
		}

?>
