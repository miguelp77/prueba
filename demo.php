<?php
	session_start();
//	require_once('includes/db_tools.inc');
//	require_once('includes/cuestiones.inc');
//	if(isset($_SESSION['db_name'])){
//		$db=$_SESSION['db_name'];
//		conectar($db);
//	}else echo "Sin base."."<br />";//redirect_to("main_asg.php");
	
	error_reporting(E_ALL);
	ini_set('display_errors','On');	

?>

<!DOCTYPE HTML>

<html lang="es-ES">

<head>

	<meta charset="UTF-8">

	<title></title>

</head>

<body>
<p>
	<?php
	function domingo_santo(){
	    $timestamp = strtotime('03/21/2011'); 
			$easter = easter_days(2011);	
	  	$seg=1;
	  	$min=60*$seg;
	  	$hour=60*$min;
	  	$day=24*$hour;
	  	
	  
	    $aa = idate('w',$timestamp);
	    echo $aa.' - '.$timestamp.'<br />';
	    $timestamp =  $timestamp+($easter*$day);
	    $aa = idate('w',$timestamp);
	    echo $aa.' - '.$timestamp.'<br />';
	    $aa = idate('d',$timestamp);
	    echo $aa.' - '.$timestamp.'<br />';
	    $aa = idate('m',$timestamp);
	    echo $aa.' - '.$timestamp.'<br />';	
	    $aa = idate('y',$timestamp);
	    echo $aa.' - '.$timestamp.'<br />';	
	}
	
	
$images = 'pdfs/';
//this folder must be writeable by the server
$backup = 'pdfs';
/* creates a compressed zip file */
//if(create_zip('pdfs/mio.txt','backup.zip')) echo 'ok';
//else echo 'nok';
passthru('tar -cvzf filename.tar.gz /pdfs');
function create_zip($files = array(),$destination = '',$overwrite = false) {
	//if the zip file already exists and overwrite is false, return false
	if(file_exists($destination) && !$overwrite) { return false; }
	//vars
	$valid_files = array();
	//if files were passed in...
	if(is_array($files)) {
		//cycle through each file
		foreach($files as $file) {
			//make sure the file exists
			if(file_exists($file)) {
				$valid_files[] = $file;
			}
		}
	}
	//if we have good files...
	if(count($valid_files)) {
		//create the archive
		$zip = new ZipArchive();
		if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
			return false;
		}
		//add the files
		foreach($valid_files as $file) {
			$zip->addFile($file,$file);
		}
		//debug
		//echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
		
		//close the zip -- done!
		$zip->close();
		
		//check to make sure the file exists
		return file_exists($destination);
	}
	else
	{
		return false;
	}
}



	?>
</p>
</body>
</html>
