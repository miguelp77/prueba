<?php
	
	require_once('includes/misfunciones.php');
	$conn = Conectar();
	$new_name = htmlspecialchars(trim($_POST['Img_name']));
	$eq_exp = htmlspecialchars(trim($_POST['Img_exp']));
	
	$query="SELECT * FROM Ecuaciones";
	$result =mysql_query("SELECT * FROM Ecuaciones LIMIT 0,30");
//	$answer_row= mysql_fetch_array($result);
	$nograbar=0;
	while($answer= mysql_fetch_array($result))
	{	
//			echo $answer['eq_path'].' --- ';
		if ($answer['eq_path'] == $new_name)
			{
				echo 'No grabada';
				$nograbar=1;
				exit;
			}
	}
	if ($nograbar != 1)
		{	
			$op = copy("img/imagen.png", $new_name);
			if($op) echo ' OK ';
			$query="INSERT INTO Ecuaciones (eq_exp, eq_path) VALUES ('$eq_exp','$new_name')";
				$result =mysql_query($query);
			echo ':Imagen guardada como '.$new_name;
	}	
/*	if ($answer['eq_path'] == $new_name)
		{	
			echo "Archivo existente";
			break;
		}
		if ($answer['eq_path'] != $new_name)
		{	
			$op = copy("img/imagen.png", $new_name);
			if($op) echo $op . ' error';
			$query="INSERT INTO Ecuaciones (eq_exp, eq_path) VALUES ('$eq_exp','$new_name')";
				$result =mysql_query($query);
			}
	}*/
	//echo $new_name;
?>
