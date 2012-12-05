<?php
	session_start();
//	require_once('includes/db_config.php');
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
//	$conn=mysql_connect(DB_SERVER,DB_USER,DB_PASS);

//////////
	$db=$_SESSION['db_name'];
	conectar($db);	
		
//		$tabla=$_POST['tabla'];
//		echo $tabla;

function ver_tabla($tabla){
//		$result = mysql_list_tables($db);
		//	$num_rows = mysql_num_rows($tabla);
			$sql = "SELECT * FROM $tabla";
			$query=mysql_query($sql) or die(mysql_error());
			$columns = mysql_num_fields($query);
			$names=array();
			$j=0;
			while($j<$columns){
				$name=mysql_field_name($query,$j);
				array_push($names,$name);
				$j++;
			}
			echo "<b><u>$tabla</u></b>"."<br />";
			echo "<table border='0' cellspacing='0' cellpadding='3'>";
			echo '<tr>';
			foreach ($names as $key => $value){
					echo "<td><b>$value</b></td>";	
			} 
			echo '</tr>';
	
			while($row=mysql_fetch_row($query)){
				$j=0;
				echo '<tr>';
				while($j<$columns){
					echo "<td>$row[$j]</td>";				
					$j++;
				}	
				echo '</tr>';	
			}
			echo '</table>';
}

?>
<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title>Checking</title>
	<script src="jquery/jquery-1.4.2.js" type="text/javascript"></script>

	<link rel="stylesheet" href="css/main.css" />
</head>
<body>
<!-- <div id="contenedor"> -->
<div id="cabecera"><h2>Valores de la tabla.</h2></div>
<?php
	ver_tabla($_POST['tabla']);
//	$tabla=$_POST['tabla_ver'];
//	echo $tabla;
//	estado();
//	inicializar_bbdd();
?>
<script src="js/db_tool.js" type="text/javascript"></script>
	<!-- </div> 
	<script>$("tr:odd").css("border-style", "solid").css("background-color", "#ffffff").css("border-color", "#000000"); -->
	</script>
</body>
</html>
