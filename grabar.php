<?php

function escribir($archivo='test.txt',$contenido=null){
		
		$FileHandle = fopen($archivo, 'w')
			or die("No puedo abrir el archivo $FileHandle");
		$contenido = $contenido.'\n';
		fwrite($FileHandle, $contenido);
		fclose($FileHandle);

		echo "Modificado con exito\n";

}

function leer($archivo){
		$handle = fopen($archivo, "r");
		$lectura = fread($handle, filesize($archivo));
		print_r($lectura);

		fclose($handle);	
}


?>


<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title></title>
	<script src="jquery/jquery-1.4.2.js"></script>

</head>
<body>

<?php
//	escribir('test.txt',"hola");
	leer('test.txt');
?>	

</body>
</html>
