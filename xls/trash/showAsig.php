<?php
	session_start();
//	header ('Content-type: text/html; charset=utf-8');
	require_once('includes/misfunciones.php');
	$conexion = Conectar();
	$idAsignatura=($_COOKIE['Galle']);
	$query1="SELECT * FROM Temas WHERE fk_idAsignatura='$idAsignatura'";
	$result1=mysql_query($query1);
	while($row1= mysql_fetch_object($result1)){
		$idTema=$row1->idTema;
		echo '<h3>'.$row1->Nombre.'</h3>';
		$query="SELECT * FROM Conceptos WHERE fk_idTema='$idTema'";
		$result=mysql_query($query);
		while ($row= mysql_fetch_object($result)){
			echo '<span title="'.$row->Descripcion.'" value="'.$row->idConcepto.'"><b>'.$row->Nombre.'</b></span> : '.$row->Descripcion.'</span><br />';
		}
	}

?>
