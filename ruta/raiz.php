<?php
//ruta
	defined('FOLDER')   ? null : define("FOLDER", $_SERVER['DOCUMENT_ROOT']."/myapp/");
// Funciona a partir de PHP 4.3.0
	$ruta = FOLDER;
	ini_set('include_path', get_include_path() . PATH_SEPARATOR . $ruta);

?>
