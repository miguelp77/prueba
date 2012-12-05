<?php
	session_start();

	require_once('includes/cuestiones.inc');
	require_once('includes/db_tools.inc');

	$db=$_SESSION['db_name'];
	conectar($db);
//	if(strlen($db)>1) conectar($db);
//	else redirect_to("index.php");
	$idQ=$_SESSION['idQ'];
	
	$query="SELECT * FROM Respuestas WHERE Cuestion_id=$idQ ORDER BY 'Resp_id' ASC";
	$result =mysql_query($query) or die(mysql_error());

	echo '<ul class="abclist">';

	while($answer_row= mysql_fetch_array($result)){
		if ($answer_row['Correcta']== 1){ 
			echo '<li><div class="'.$answer_row['Resp_id'].' ok">';
			echo $answer_row['Respuesta'];
			echo '<img class="dcha" src="img/tick.png" />';
			echo '<a href="#" class="botones'.$answer_row['Resp_id'].'" title="borrar" value="'.$answer_row['Resp_id'].'" ">
        <img src="./img/cross.png" alt=""/>
         </a>';
			echo '<a href="#" class="botones'.$answer_row['Resp_id'].'" title="editar" value="'.$answer_row['Resp_id'].'">
        <img src="./img/pencil.png" alt=""/>
         </a>';
			echo '</div></li>';
			continue;
		}
		echo '<li><div class="'.$answer_row['Resp_id'].'">';
			echo $answer_row['Respuesta'];
		//	echo '<img class="dcha" src="img/tick.gif" />';
		echo '<a href="#" class="botones'.$answer_row['Resp_id'].'" title="borrar" value="'.$answer_row['Resp_id'].'" ">
        <img src="./img/cross.png" alt=""/>
         </a>';
		echo '<a href="#" class="botones'.$answer_row['Resp_id'].'" title="editar" value="'.$answer_row['Resp_id'].'">
        <img src="./img/pencil.png" alt=""/>
         </a>';

					echo '</div></li>';
	}
	echo "</ul>";
/*	
	$idQ=$_SESSION['idQ'];
	if (!isset($idQ)||empty($idQ))//No hay ID de Cuestion
		echo "Nueva"."<br />";;
	$query="SELECT * FROM Respuestas WHERE Cuestion_id= '$idQ' ORDER BY 'Resp_id' ASC";
	$result =mysql_query($query);
	echo '<ul class="abclist">';

	while($answer_row= mysql_fetch_array($result)){
		if ($answer_row['Correcta']== 1){ 
			echo '<li><div class="'.$answer_row['Resp_id'].' ok">';
			echo '<img class="dcha" src="img/tick.png" />';
			echo $answer_row['Respuesta'];
			echo '<a href="#" class="botones'.$answer_row['Resp_id'].'" title="borrar" value="'.$answer_row['Resp_id'].'" ">';
      echo '<img src="/img/cross.png" alt=""/></a>';
			echo '<a href="#" class="botones'.$answer_row['Resp_id'].'" title="editar" value="'.$answer_row['Resp_id'].'">';
      echo '<img src="/img/pencil.png" alt=""/></a>';
			echo '</div></li>';
//			continue;
		}else{
			echo '<li><div class="'.$answer_row['Resp_id'].'">';
			echo $answer_row['Respuesta'];
			//	echo '<img class="dcha" src="img/tick.gif" />';
			echo '<a href="#" class="botones'.$answer_row['Resp_id'].'" title="borrar" value="'.$answer_row['Resp_id'].'" ">';
		  echo '<img src="/img/cross.png" alt=""/></a>';
			echo '<a href="#" class="botones'.$answer_row['Resp_id'].'" title="editar" value="'.$answer_row['Resp_id'].'">';
		  echo '<img src="/img/pencil.png" alt=""/></a>';
			echo '</div></li>';
		}
	}
	echo "</ul>";
*/
?>
