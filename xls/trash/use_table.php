<?php
	session_start();
	header ('Content-type: text/html; charset=utf-8');
	$conn=@mysql_connect("localhost","root","p89er");

//  return $conn;
	
	$result = mysql_list_tables("Asgs");
	$num_rows = mysql_num_rows($result);
	
	for ($i = 0; $i < $num_rows; $i++) {
		if(substr(mysql_tablename($result, $i),0,3)=='Asg'){
			$info=mysql_tablename($result, $i);
  	  echo "<br /><a href='#' name=$info>", mysql_tablename($result, $i), "</a>";
		}
	}

	
?>
