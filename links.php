<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel=stylesheet href="css/main.css" type="text/css">
</head>
<body>
<?php
		session_start();

	require_once('includes/cuestiones.inc');
	require_once('includes/db_tools.inc');

	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		conectar($db);
	}else{
		conectar("asg_admin");//redirect_to('admin_test.php');
		$_SESSION['db_name']="asg_admin";
	}
	

 id_links('Cuestiones'); 
 ?>	
</body>
</html>

