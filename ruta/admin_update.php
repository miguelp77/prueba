<?php
	session_start();
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');

	require_once('includes/cuestiones.inc');	
	error_reporting(E_ALL);
	ini_set('display_errors','On');

//	$link=conectar('asg_admin');
//	$table='Admin';
	$link=conectar('asg_admin');
	$table='Admin';
function updateMe($json){

	if(!isset($_SESSION['idAdmin'])) return false;
	$idAdmin=$_SESSION['idAdmin'];

 	foreach($json as $key=>$val){
//		$val=sanear($val);
		$val=sanear($val);
		$item[]=$key."='".$val."'";
	}
		$items=implode(",",$item);
	$b=checkChanges($json);
	$login=0;
	if($b!=0) $login=check_admin($json->Alias,$json->Psw);
	if(!$login){
//	echo $items;
		$query="UPDATE Admin SET $items WHERE Admin_id='$idAdmin'";
		$result = mysql_query($query) or die(mysql_error());;
	}
}
function checkChanges($json){
	$idAdmin=$_SESSION['idAdmin'];
	$sql="SELECT Nombre,Apellidos,Alias,Psw FROM asg_admin.Admin WHERE Admin_id = $idAdmin";
	$query=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_object($query);
	$alias=strcmp($row->Alias,$json->Alias);
	$pass=strcmp($row->Psw,$json->Psw);

	$b=$alias OR $pass;
	return $b;
	
}
// Experimento OK, sustituyo por json
//	save_form();

	$json2=json_decode($_POST['json']);
	updateMe($json2);
//	checkChanges($json2);

//	echo $json2->{'Nombre'};

//	save_form2($json2);
//	foreach($json2 as $key => $value) {
//    echo "$key => $value";
//}

?>

