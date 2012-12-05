<html>
<body>


<?php
  // query1.php
	$conectar=@mysql_connect("localhost", "root", "p89er");
	$result = mysql_list_dbs( $conectar );
	//while( $row = mysql_fetch_object( $result ) ):
	/*
If ($res=send_sql($db,$sql))
{
  echo "Consulta: <br> $sql";
}*/
echo "<form method=\"post\" action=\"db_show.php\">";
echo "<SELECT NAME='claves' SIZE='1'>";
while ($row = mysql_fetch_object( $result ))
{
	//anulo el valor de phpmyadmin
	if($row->Database =="phpmyadmin") continue;
   echo "<OPTION VALUE='$row->Database'>$row->Database</OPTION>";
}
echo "</SELECT> ";
echo $row;

echo "<input type=\"submit\" value=\"Selecciona\">";
echo "</form>";
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

</body>
</html>
