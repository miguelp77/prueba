<?php
function show_temas_conceptos(){	
	$sql="SELECT idTema,Nombre FROM Temas";
	$query=mysql_query($sql) or die(mysql_error());
	while($tema = mysql_fetch_row($query)){		
		$idTema=$tema[0];
		$nombreTema=$tema[1];
		$sql2="SELECT Nombre,Descripcion FROM Conceptos WHERE fk_idTema='$idTema'";
		$query2=mysql_query($sql2) or die(mysql_error());
		echo '<span style="background-color:#ddd;" >Tema: '.$nombreTema.'</span><br />';
		while($concepto = mysql_fetch_row($query2)){
			echo 'Concepto: '.$concepto[0].'<br />';
			echo 'Descripcion: '.$concepto[1];
		}
		echo '<hr />';
	}
}
function show_cuestiones(){
	$acentos=array("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","Ñ");
	$acentex=array("'a","'e","'i","'o","'u","'A","'E","'I","'O","'U","'n","'N");
	$sql="SELECT Cuestion_id,Enunciado FROM Cuestiones";
	$query=mysql_query($sql) or die(mysql_error());
	while($cuestion = mysql_fetch_row($query)){		
		$idCuestion=$cuestion[0];
		$enunciado=$cuestion[1];
		$sql2="SELECT Respuesta FROM Respuestas WHERE Cuestion_id='$idCuestion'";
		$query2=mysql_query($sql2) or die(mysql_error());
		
	//	echo '<span style="background-color:#ddd;" >Cuestion: '.$idCuestion.'</span><br />';
		$enunciado=str_replace($acentos,$acentex,$enunciado);
		echo $enunciado.'<br /><ol>';
		
		while($respuesta = mysql_fetch_row($query2)){
			echo '<li>'.$respuesta[0].'</li>';
		}
		echo '</ol><hr />';
	}		
}
?>
