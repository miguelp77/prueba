<?php
session_start();
//Next_Q Siguiente cuestion en orden	
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
//	$idQ=$_SESSION['idQ'];
//	$db=$_SESSION['db_name'];
//	conectar("asg_padre");
$link=connect_to_db();
$db_list = mysql_list_dbs($link);
	echo "Elija una asignatura"."<br />";

//echo "<form action='asignatura_cambiar.php' method='post'>";
echo "<form action='#'>";
echo "<SELECT NAME='claves' SIZE='1'>";
while ($row = mysql_fetch_object($db_list)){
	//anulo el valor de phpmyadmin
	$nombre=$row->Database;
	$ok=str_begin($nombre,"asg_");
	echo $nombre."<br />";
//	if($row->Database =="phpmyadmin") continue;
  if(true) echo "<OPTION VALUE='$row->Database' name='db_nueva'>$row->Database</OPTION>";
}
echo "</SELECT> ";
echo $row;

//echo "<input type=\"submit\" name=\"cambia\" value=\"Selecciona\">";
echo "</form>";
if(isset($_SESSION['db_name'])){
	
	$base=$_SESSION['db_name'];
	
	echo "Ver asignatura $base";
//conectar("asg_mike44");
	show_tables($base);
	lista("Admin");
}else echo "sin base";

?> 

<?/*
If ($res=send_sql($db,$sql))
{
 tab_out($res);
}
*/
//$obt = $_POST['claves'];
//echo $obt;
?>

