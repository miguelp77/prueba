<?php
if ($_FILES["file"]["error"] > 0)
  {
  echo "Error: " . $_FILES["file"]["error"] . "<br />";
  }
else
  {
//  echo "Upload: " . $_FILES["file"]["name"] . "<br />";
 // echo "Type: " . $_FILES["file"]["type"] . "<br />";
 // echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
 // echo "Stored in: " . $_FILES["file"]["tmp_name"];
  }
if (file_exists("bdp/" . $_FILES["file"]["name"])){
	echo $_FILES["file"]["name"] . " ya existe. Consulte con el administrador. ";
}else{
	move_uploaded_file($_FILES["file"]["tmp_name"],"bdp/" . $_FILES["file"]["name"]);
	echo $_FILES["file"]["name"];
}
?> 
