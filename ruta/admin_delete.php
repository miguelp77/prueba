<?php
	require_once('includes/db_tools.inc');
	require_once('includes/cuestiones.inc');	
//	error_reporting(E_ALL);
//	ini_set('display_errors','On');
function delete_admin(){
	$link=conectar('asg_admin');

	$idAdmin = htmlspecialchars(trim($_POST['idAdmin']));  
//	$Nombre= htmlspecialchars(trim($_POST['NewConcepto']));  
	
	$query="DELETE FROM asg_admin.Admin WHERE Admin_id= '$idAdmin'";
	$result =mysql_query($query) or die(mysql_error());
	return true;
}
	delete_admin();
//	if(save_form()) redirect_to('admin_form.php');
//	else redirect_to('index.php');
?>

