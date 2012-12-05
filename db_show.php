<?php
session_start();
//Next_Q Siguiente cuestion en orden	
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
//	$idQ=$_SESSION['idQ'];
//	$db=$_SESSION['db_name'];
//	conectar();
	echo "hola"."<br />";
	$resources = Array();
	$list = Array();
	for ($i = 0; $i < count($resources); $i++) {
		$dbs = @mysql_list_dbs($resources[$i]);
	
		while ($row = @mysql_fetch_object($dbs)) {
			if ($row->Database != 'information_schema') { 
			echo $row->Database."<br />";
			$list[] = $row->Database; }
		}
	}
	
	return $list;
/*	
echo "<form method=\"post\" action=\"db_show.php\">";
echo "<SELECT NAME='claves' SIZE='1'>";
while ($row = mysql_fetch_object( $result )){
	//anulo el valor de phpmyadmin
	$nombre=$row->Database
	$nombre=str_begin($nombre,"asg_")
	if($row->Database =="phpmyadmin") continue;
   echo "<OPTION VALUE='$row->Database'>$row->Database</OPTION>";
}
echo "</SELECT> ";
echo $row;

echo "<input type=\"submit\" value=\"Selecciona\">";
echo "</form>";
*/
?> 

<?/*
If ($res=send_sql($db,$sql))
{
 tab_out($res);
}
*/
$obt = $_POST['claves'];
echo $obt;
?>

