<?php
	session_start();
	require_once('includes/db_tools.inc');
	require_once('includes/cuestiones.inc');
	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		conectar($db);
	}else echo "Sin base."."<br />";//redirect_to("main_asg.php");
	
	error_reporting(E_ALL);
	ini_set('display_errors','On');	

?>

<!DOCTYPE HTML>

<html lang="es-ES">

<head>

	<meta charset="UTF-8">

	<title></title>

</head>

<body>
<p>
	<?php

		$json_res=get_n_answers(25);
//		$arr=json_decode($json_res);
		$arr=$json_res;
		$total=count($arr);
		$fallo=round(-100 / ($total-1),2);
		echo '<hr />';		
//		echo '<br />';		

		foreach($arr as $k=>$v){
			echo $k.' => '.$v;
			echo '<br />';
		}

		echo '<hr />';		
		echo 'Posibles respuestas => '.$total.'<br />';
		echo 'valor positivo => 100%<br />';		
		echo 'valor negativo => '. $fallo.'%<br />';
		echo '<hr />';
		echo 'Quedaria como:';
		echo '<br />';
		foreach($arr as $k=>$v){
			if($v<0) echo $k.' => '.$fallo;
			else echo $k.' => '.$v;
			echo '<br />';
		}			
	?>
</p>
</body>
</html>
