<?php
	session_start();
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	if(isset($_SESSION['db_name'])){
		$db=$_SESSION['db_name'];
		$conn=conectar($db);
	}else redirect_to('admin_test.php');

?>
<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title></title>
	<script type="text/javascript" src="../js/jquery-ui/js/jquery-ui-1.8.1.custom.min.js"></script>
	<script type="text/javascript" src="../js/grupo.js?v1.0"></script>
</head>
<body>
	<span class="small dcha">Gestión de grupos</span>
	<div id="btt_grupos">
		<div class="css_btt" name="nuevo" title="nuevo alumno">Nuevo</div>		
	</div>
	<hr />
	<div id="newGroup">
			Nombre <input type='text' name='nombre'/> 
			<div class="css_btt" name="saveName" title="Guardar grupo">Guardar</div>
	</div>
	<?php viewGroup(); ?>
<!-- 	<div class="scroll-panel">
	<?php
		// Groups();
	?>
	</div> -->
	 <script type="text/javascript">
	//js
	</script>
</body>
</html>