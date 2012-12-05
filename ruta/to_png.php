<?php 	//	tex_to_png("(a+b)^2 == f(x) = \frac {\sqrt{\frac {(s+1)}{(s-1)(s+2)}}}{2}");
	header ('Content-type: text/html; charset=utf-8');
	require_once('includes/extras.php');
	if(isset($_POST['expresion'])){
	
		$my_eq= $_POST['expresion'];		
		tex_to_png($my_eq,"imagen");
//		<img src="img/imagen.png" /> 
		echo "<img src=\"img/imagen.png\" title=\"$my_eq\"/>";
	}
?>
