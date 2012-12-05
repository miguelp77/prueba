<?php
	require_once('includes/misfunciones.php');
	$conn = Conectar();	
	
		$q_id=$_GET['QR'];
	if (!isset($q_id)||empty($q_id))//Usuario vacio
	{
		$_SESSION["mensaje"]="<h1>Sin nuemero de cuestion.QR</h1>";
			echo $_SESSION["mensaje"];
		$q_id=0;
	}	
	

		$query="SELECT * FROM Respuestas WHERE Cuestion_id= '$q_id' ORDER BY 'Resp_id' ASC";
	$result =mysql_query($query);
	echo '<ul class="abclist">';
	while($answer_row= mysql_fetch_array($result)){
		
		if ($answer_row['Correcta']== 1)
			{ 
	echo '<li><div class="'.$answer_row['Resp_id'].' ok">';
	echo '<img class="dcha" src="img/tick.png" />';
	echo $answer_row['Respuesta'];
		
		echo '<a href="#" class="botones'.$answer_row['Resp_id'].'" title="borrar" value="'.$answer_row['Resp_id'].'" ">
        <img src="/img/cross.png" alt=""/>
         </a>';
		echo '<a href="#" class="botones'.$answer_row['Resp_id'].'" title="editar" value="'.$answer_row['Resp_id'].'">
        <img src="/img/pencil.png" alt=""/>
         </a>';

					echo '</div></li>';
			continue;
		}
		echo '<li><div class="'.$answer_row['Resp_id'].'">';
			echo $answer_row['Respuesta'];
		//	echo '<img class="dcha" src="img/tick.gif" />';
		echo '<a href="#" class="botones'.$answer_row['Resp_id'].'" title="borrar" value="'.$answer_row['Resp_id'].'" ">
        <img src="/img/cross.png" alt=""/>
         </a>';
		echo '<a href="#" class="botones'.$answer_row['Resp_id'].'" title="editar" value="'.$answer_row['Resp_id'].'">
        <img src="/img/pencil.png" alt=""/>
         </a>';

					echo '</div></li>';
	}
	echo "</ul>";
	//$cuestion=mysql_fetch_array($cuestiones);
	//echo $cuestion['Imagen'];
	

?>
	
