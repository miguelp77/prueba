<?php
	session_start();
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	require_once('includes/cuestiones.inc');	
	$db="asg_admin";
	conectar($db);

	$new_name = $_POST['Img_name'];
	$eq_exp = $_POST['Img_exp'];
	// Expresion DEMO
	//  $$x = {-b \pm \sqrt{b^2-4ac} \over 2a}.$$
	$query="SELECT * FROM asg_admin.Ecuaciones";
	$result =mysql_query("SELECT * FROM Ecuaciones");
//	$answer_row= mysql_fetch_array($result);
	$nograbar=0;
	while($answer= mysql_fetch_assoc($result))
	{	
//			echo $answer['eq_path'].' --- ';
		if ($answer['eq_path'] == $new_name)
			{
				echo 'No grabada. Nombre de archivo ya existente.<br />';
				$nograbar=1;
				exit;
			}
	}
	if ($nograbar != 1)
		{	
			$op = copy("img/imagen.png", $new_name);
			$eq_exp = str_replace("\\","\\\\",$eq_exp); 
			if($op) echo 'Expresion: '.$eq_exp.'<br />';
			$query="INSERT INTO Ecuaciones (eq_exp, eq_path) VALUES ('$eq_exp','$new_name')";
				$result =mysql_query($query);
			echo 'Imagen guardada como '.$new_name.'<br />';
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
