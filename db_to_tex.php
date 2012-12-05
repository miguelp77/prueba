<?php
session_start();
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	require_once('includes/tex_functions.inc');	
//Errores 
error_reporting(E_ALL);
ini_set('display_errors','On');

//Conecto a la BBDD
concon();


show_cuestiones();
?>
