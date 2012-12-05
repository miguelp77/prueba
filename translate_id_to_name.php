<?php
//Translate Concepts_id Array to Concepts_name Array
	header ('Content-type: text/html; charset=utf-8');
	require_once('includes/misfunciones.php');
	$connect=@mysql_connect("localhost","root","p89er");
	$to = mysql_list_tables("Asignatura");
	$pos=array();
	$nombres=array();
	$claves=array();
	$id=9;	
		
	$sql= "SELECT * FROM Conceptos WHERE fk_idTema={$id}";// LIMIT $inicio,5";// LIMIT 0," .$pag."'";	 
	$query =mysql_query($sql)or $error_sql=mysql_error();
	echo $error_sql;
	while($result=mysql_fetch_array($query)){
		//foreach($result['idConcepto'] as $key => $value){
		//	echo "($key)::::$value <br/ >";
		//}
	echo $result['idConcepto']." == ".$result['Nombre']."<br />";
	array_unshift($pos,$result['idConcepto']);
	array_unshift($nombres,$result['Nombre']);
	$claves=array_combine($pos,$nombres);
	}
	$des=mysql_close();
print_r($pos);
echo "<br />";
print_r($nombres);
echo "<br />";
print_r($claves);
?>
