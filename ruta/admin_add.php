<?php
	require_once('includes/db_tools.inc');
	require_once('includes/cuestiones.inc');	
//	error_reporting(E_ALL);
//	ini_set('display_errors','On');
function save_form(){
	$link=conectar('asg_admin');
	$table='Admin';
	foreach($_GET as $key=>$val){
		$val=sanear($val);
		$$key=$val;
		$vals[]="'".$val."'";
		$ks[]=$key;
	}
	$keys=implode(",",$ks);
	$values=implode(",",$vals);

	$sentencia="INSERT INTO $table ($keys) VALUES ($values)";
	$sql=mysql_query($sentencia) or die(mysql_error());
//	close($link);
	return true;
}
function save_form2($json){
	$link=conectar('asg_admin');
	$table='Admin';
	foreach($json as $key=>$val){
		$val=sanear($val);
		$$key=$val;
		$vals[]="'".$val."'";
		$ks[]=$key;
	}
	$keys=implode(",",$ks);
	$values=implode(",",$vals);

	$sentencia="INSERT INTO $table ($keys) VALUES ($values)";
	$sql=mysql_query($sentencia) or die(mysql_error());
//	close($link);
	return true;
}
// Experimento OK, sustituyo por json
//	save_form();

	$json2=json_decode($_POST['json']);
//	echo $json2->{'Nombre'};
	save_form2($json2);
//	foreach($json2 as $key => $value) {
//    echo "$key => $value";
//}

?>

