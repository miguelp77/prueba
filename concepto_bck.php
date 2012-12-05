<?php
	session_start();
	require_once('includes/db_tools.inc');
//	require_once('includes/misfunciones.php');
	$db=$_SESSION['db_name'];
	conectar($db);
//	$Nombre = htmlspecialchars(trim($_POST['Nombre']));//Nombre del Tema
// Another way to debug/test is to view all cookies
//	setcookie('Galle', "", time()-3600);
//	$Asig=($_COOKIE['Galle']);
?>
<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title>Conceptos</title>
	<link rel="stylesheet" href="css/intro.css" type="text/css">
	<link rel="stylesheet" href="css/main.css" type="text/css">	
<!--	<link rel="shortcut icon" href="http://www.uah.es/imagenes/uah.ico" /> -->
	<script type="text/javascript" src="jquery/jquery-1.4.2.js" ></script>
	<script type="text/javascript" src="jquery/jquery.cookie.js" ></script>
</head>
<body>
<div id="intro">
	<h2>Gestion Asignaturas</h2>

</div>
<div id="contenido2">
<!-- 
	<p>Elija una asginatura del menu para definir los conceptos.<br /></p>
	<p>Puede definirlos pulsando sobre los nombres de los <b>conceptos</b> en negrita<br /></p>
	<p>Una vez terminado pulse el <b>boton Seleciona</b>.</p> 
-->
	<div id="cb">
		<?php
	//		$sql="SELECT Nombre FROM Materias WHERE idAsignatura=$Asig";
	//		$query = mysql_query($sql);
	//		$row = mysql_fetch_object($query);
//				$idAsignatura=($_COOKIE['Galle']);
	//		echo "Asignatura creada: <b>".$row->Nombre."</b>";
			$sql="SELECT * FROM Temas";// WHERE fk_idAsignatura='$Asig'";
			$result1=mysql_query($sql);
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
		
	</div>
	<hr />
	<input type="button" value="Siguiente" id="SelectAsig">
	<hr />
	<div class="asig"></div>
	<div id="zona">
		<div id="formDesc">
			<textarea name="descripcion" id="" cols="38" rows="10"></textarea>
			<input type="button" id="Grabar" value="Grabar"/>
		</div>
	</div>	
</div>

	
	<script src="js/Asig.js" type="text/javascript"></script>
</body>
</html>
