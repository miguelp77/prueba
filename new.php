<? 
include('config.php'); 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "INSERT INTO `Respuestas` ( `Respuesta` ,  `Cuestion_id` ,  `Correcta`  ) VALUES(  '{$_POST['Respuesta']}' ,  '{$_POST['Cuestion_id']}' ,  '{$_POST['Correcta']}'  ) "; 
mysql_query($sql) or die(mysql_error()); 
echo "Added row.<br />"; 
echo "<a href='list.php'>Back To Listing</a>"; 
} 
?>

<form action='' method='POST'> 
<p><b>Respuesta:</b><br /><textarea name='Respuesta'></textarea> 
<p><b>Cuestion Id:</b><br /><input type='text' name='Cuestion_id'/> 
<p><b>Correcta:</b><br /><input type='text' name='Correcta'/> 
<p><input type='submit' value='Add Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
