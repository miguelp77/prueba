<?php
require_once('includes/misfunciones.php');
	$conn = Conectar();
	$user = htmlspecialchars(trim($_POST['User']));
	$psw = htmlspecialchars(trim($_POST['Psw']));
	$query="SELECT Psw FROM Admin WHERE Alias= '$user'";
          $result =mysql_query($query) or die(mysql_error());
	echo $result;
?>
