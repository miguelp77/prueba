<html>
<head>
	<title>Gallery</title>
	<style type="text/css">
		.box{
			/*border: 1px solid #000;*/
			display: inline-block;
		  min-width: 400px;
		  border-top: 1px dashed #ddd;
		}
		.mainimage {
		  max-width: 400px;
		  max-height: 160px;
		  width: expression(this.width > 400 ? "400px" : true);
		  height: expression(this.height > 160 ? "160px" : true);
		  border-left: 1px solid #ddd;
		  margin: 4px 0 26px 10px;
			vertical-align: text-top;
			padding: 0 4px;
		}
		.checkbox{
			margin: 0 -6px 0 0;
		}
	</style>
</head>
<?php
	session_start();
	require_once('includes/basics.php');
	require_once('includes/cuestiones.inc');
	require_once('includes/db_tools.inc');
	require_once('includes/extras.php');
	
	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		conectar($db);
	}else{
		conectar("asg_admin");//redirect_to('admin_test.php');
		$_SESSION['db_name']="asg_admin";
	}
//	if(isset($_SESSION['idQ']))	$idQ=$_SESSION['idQ'];
	if(isset($_GET['id_otra'])){
		$idQ=$_GET['id_otra'];
		$_SESSION['idQ']=$idQ;
	//echo $idQ;
	}if(isset($_SESSION['idQ'])){ 
		$idQ=$_SESSION['idQ'];
	}
function get_jpgs($dir=null){

$this_script = basename(__FILE__);
	$this_folder = str_replace('/'.$this_script, '', $_SERVER['SCRIPT_NAME']);
	chdir("$dir".DIRECTORY_SEPARATOR);
	chdir("$dir".DIRECTORY_SEPARATOR);
}

 
$directory = "../img/";
//get all files in specified directory
$files = glob($directory . "*");
// var_dump($files); 
//print each file name
foreach($files as $file)
{
 //check to see if the file is a folder/directory
 if(!is_dir($file))
 {
  // echo $file;
  $ext = pathinfo($file, PATHINFO_EXTENSION);
  // echo ' - '.$file;
  // echo $directory;
  if($ext=='png'){
		echo "<span class='box'>";
		echo 	'<input class="checkbox" type="checkbox" />';
			echo '<img class="mainimage" src="'.$file.'">';
	  echo '</span>';
	  $str=explode('/', $file);
		echo $str[2];
		echo '<br />';	  
   }

 }
}
?>
<body>
</body>
</html>
