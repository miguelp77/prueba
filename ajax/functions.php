<?php
function conectar($database=NULL){
	if ($database != NULL) {
		$conn=mysql_connect(DB_SERVER,DB_USER,DB_PASS);
		mysql_select_db($database);
		return $conn;  
  }
}

?>
