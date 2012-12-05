<?php
	session_start();
//Next_Q Siguiente cuestion en orden	
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	$idQ=$_SESSION['idQ'];
	$db=$_SESSION['db_name'];
	conectar($db);
	$res=array();
	if(isset($_POST['Ccs']))
	$Ccs=htmlspecialchars(trim($_POST['Ccs']));
//	echo "recibo= ".$Ccs;
	if(isset($_POST['Tema'])){
		$tema=$_POST['Tema'];
		$res=explode(",",$Ccs);
		$sql="SELECT idConcepto FROM Conceptos WHERE fk_idTema='$tema'";
		$query=mysql_query($sql) or die(mysql_error());
		while($qry=mysql_fetch_row($query)){
			if(!in_array($qry[0],$res))
				array_push($res,$qry[0]);
		}
		$Ccs=join(",",$res);	
	}

//	echo "grabo= ".$Ccs;
	// 	$Ccs=serialize($Ccs);
	
//var_dump($Ccs);
	$query="UPDATE Cuestiones SET Conceptos='$Ccs' WHERE Cuestion_id='$idQ'";
	$result = mysql_query($query) or die(mysql_error());
	echo $Ccs;
?>
