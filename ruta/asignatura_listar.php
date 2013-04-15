<?php
session_start();
//Next_Q Siguiente cuestion en orden
// Funciona a partir de PHP 4.3.0
// echo get_include_path();	
// echo "<hr />";
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
//	$idQ=$_SESSION['idQ'];
//	$db=$_SESSION['db_name'];
//	conectar("asg_padre");

?> 
<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title></title>
	<script type="text/javascript" src="../js/db_lista.js?v1.1"></script>
</head>
<body>
	<div> Elija una asignatura </div>
		<?php db_list(); ?>
	<input type='button' name='cambia' value='Selecciona' />

<script type="text/javascript" language="JavaScript">
	document.forms['select_form'].elements['dbs'].focus();
</script>
</body>
</html>
