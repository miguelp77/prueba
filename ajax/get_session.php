<?php
	session_start();
	if(isset($_POST['name'])) $var=$_POST['name'];
	else $var=null;

	if($var!=null){
		return $_SESSION["$var"]=$value;
	}
	else return false;
?>
