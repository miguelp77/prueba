<?php
	session_start();
//	require_once('../includes/basics.php');
	require_once('functions.php');
	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		$conn=conectar($db);
	}else redirect_to('admin_test.php');

?>
<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title></title>

</head>
<body>

<?php
		$arr=array();
		$sql='SELECT grupos FROM Alumnos';
		$query = mysql_query($sql) or die(mysql_error());	
		while($row=mysql_fetch_row($query)){
			if($row[0]==null) $row[0]='-';
			if(!in_array($row[0],$arr)) array_push($arr,$row[0]);
		}
			print_r($arr);
//	else return false;
?>
