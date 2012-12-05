<? 
include('config.php'); 
$Resp_id = (int) $_GET['Resp_id']; 
mysql_query("DELETE FROM `Respuestas` WHERE `Resp_id` = '$Resp_id' ") ; 
echo (mysql_affected_rows()) ? "Row deleted.<br /> " : "Nothing deleted.<br /> "; 
?> 

<a href='list.php'>Back To Listing</a>