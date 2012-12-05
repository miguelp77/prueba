<?php
	session_start();
	require_once('../includes/db_config.php');
	require_once('functions.php');
	conectar("asg_admin");//redirect_to('admin_test.php');

	if(isset($_POST['name'])) $var=$_POST['name'];
	else $var=null;
	
//	echo $var;
	
	if($var!=null){
		$sql="SELECT eq_des FROM asg_admin.Ecuaciones WHERE eq_id=$var LIMIT 1";
		$query = mysql_query($sql) or die(mysql_error());	
		$row=mysql_fetch_row($query);
		echo $row[0];
	}
	else return false;
?>
