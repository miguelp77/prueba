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
function db_list(){
$link=connect_to_db();
$db_list = mysql_list_dbs($link);

	echo "Elija una asignatura"."<br />";

//echo "<form action='asignatura_cambiar.php' method='post'>";
echo "<form name='select_form' action='#'>";
echo "<SELECT NAME='dbs' SIZE='1'>";
while ($row = mysql_fetch_object($db_list)){
	//anulo el valor de phpmyadmin
	$nombre=$row->Database;
	$ok=str_begin($nombre,"asg_");
//	echo $nombre;
//	if($row->Database =="phpmyadmin") continue;
  if($ok) echo "<OPTION VALUE='".parse_utf8($row->Database)."' name='db_nueva'>". asg_name($row->Database)."</OPTION>";
}
echo "</SELECT> ";
//echo $row;

echo "<input type=\"button\" name=\"cambia\" value=\"Selecciona\">";
echo "</form>";
}

?> 
<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title></title>
	<script type="text/javascript" src="../js/db_lista.js?v1.1"></script>
</head>
<body>
	<?php db_list(); ?>
<script type="text/javascript" language="JavaScript">
document.forms['select_form'].elements['dbs'].focus();
</script>
</body>
</html>
