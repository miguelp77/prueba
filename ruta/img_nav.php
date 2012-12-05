<?php
	session_start();
	require_once('../includes/basics.php');
	require_once('../includes/db_tools.inc');
	require_once('../includes/cuestiones.inc');	
//	$db="asg_admin";
//	$conn=conectar($db);
	connect_to_db();
	$sentido='DESC';
	$sentido = $_POST['sentido']; //ASC o DESC

//	echo $sentido;
	if($sentido!='DESC' AND $sentido!='ASC'){
//		echo $sentido;
		$query="SELECT * FROM asg_admin.Ecuaciones WHERE eq_id = $sentido ";
		$result = mysql_query($query) or die(mysql_error());
		$Yorch = mysql_fetch_row($result);
		$_SESSION['imagen']=(int)$Yorch[0];
		if(empty($Yorch[3]))$Yorch[3]='Sin descripción';
		$Yorch=join("~",$Yorch);
		echo $Yorch;
	}
if($sentido=='DESC' OR $sentido=='ASC'){	
	$idEq=$_SESSION['imagen'];
//	echo '--'.$idEq.'>>';
	if($idEq==null){
		$query="SELECT eq_id FROM asg_admin.Ecuaciones LIMIT 1";
		$result = mysql_query($query) or die(mysql_error());
		$Yorch = mysql_fetch_row($result);
		$_SESSION['imagen']=$row[0];	
		$idEq=$_SESSION['imagen'];
	}

	if($sentido=='ASC'){$s='>';$end='(SELECT MIN(eq_id) FROM asg_admin.Ecuaciones)';}
	if($sentido!='ASC'){$s='<';$end='(SELECT MAX(eq_id) FROM asg_admin.Ecuaciones)';}
//	echo '>>'.$idEq.'|'.$s.'|';	
	$query="SELECT * FROM asg_admin.Ecuaciones WHERE eq_id $s '$idEq' ORDER BY eq_id $sentido LIMIT 1";
	$result = mysql_query($query) or die(mysql_error());
	$Yorch = mysql_fetch_row($result);
	if($Yorch[0]) $_SESSION['imagen']=(int)$Yorch[0];
//	echo $Yorch[0];
	else{
		$query="SELECT * FROM asg_admin.Ecuaciones WHERE eq_id = $end ";
		$result = mysql_query($query) or die(mysql_error());
		$Yorch = mysql_fetch_row($result);
		$_SESSION['imagen']=(int)$Yorch[0];

	}
		
	if(empty($Yorch[3]))$Yorch[3]='Sin descripción';
	$Yorch=join("~",$Yorch);
	echo $Yorch;
}	
//mysql_close($conn);

?>
