<? 
include('config.php'); 
echo "<table border=1 >"; 
echo "<tr>"; 
echo "<td><b>Resp Id</b></td>"; 
echo "<td><b>Respuesta</b></td>"; 
echo "<td><b>Cuestion Id</b></td>"; 
echo "<td><b>Correcta</b></td>"; 
echo "</tr>"; 
$result = mysql_query("SELECT * FROM `Respuestas`") or trigger_error(mysql_error()); 
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['Resp_id']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Respuesta']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Cuestion_id']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['Correcta']) . "</td>";  
echo "<td valign='top'><a href=edit.php?Resp_id={$row['Resp_id']}>Edit</a></td><td><a href=delete.php?Resp_id={$row['Resp_id']}>Delete</a></td> "; 
echo "</tr>"; 
} 
echo "</table>"; 
echo "<a href=new.php>New Row</a>"; 
?>