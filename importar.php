<?php
	if($argc <= 1)
		return false;
	$commands = array_slice($argv, 1);
	$lineas=file($commands[0]); // muestra el contenido de cada parte del array
	//	print_r($lineas);
	foreach($lineas as $linea){
//echo $linea;
//$cadena=implode($linea);
//echo $linea[0];
	;
$pattern = '/[0-9]/';
		if(preg_match($pattern, $linea, $matches))
			echo($linea);
	//	if($linea[0]=='/')echo $linea;	
		}
	$cadena=implode($lineas);
	//echo $cadena[0];
	echo "\n";
?>


