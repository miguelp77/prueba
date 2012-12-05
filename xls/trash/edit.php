<? 
include('config.php'); 
if (isset($_GET['Resp_id']) ) { 
$Resp_id = (int) $_GET['Resp_id']; 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `Respuestas` SET  `Respuesta` =  '{$_POST['Respuesta']}' ,  `Cuestion_id` =  '{$_POST['Cuestion_id']}' ,  `Correcta` =  '{$_POST['Correcta']}'   WHERE `Resp_id` = '$Resp_id' "; 
mysql_query($sql) or die(mysql_error()); 
echo (mysql_affected_rows()) ? "Edited row.<br />" : "Nothing changed. <br />"; 
echo "<a href='list.php'>Back To Listing</a>"; 
} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `Respuestas` WHERE `Resp_id` = '$Resp_id' ")); 
?>

<form action='' method='POST'> 
<p><b>Respuesta:</b><br /><textarea name='Respuesta'><?= stripslashes($row['Respuesta']) ?></textarea> 
<p><b>Cuestion Id:</b><br /><input type='text' name='Cuestion_id' value='<?= stripslashes($row['Cuestion_id']) ?>' /> 
<p><b>Correcta:</b><br /><input type='text' name='Correcta' value='<?= stripslashes($row['Correcta']) ?>' /> 
<p><input type='submit' value='Edit Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
<? } ?> 
