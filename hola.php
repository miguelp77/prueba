<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
		<link rel="stylesheet" href="css/test.css" type="text/css">	
	<script src="jquery/jquery-1.4.2.js"></script>
	<title>Alba</title>
</head>
<body>
<hr />
<?php  
ob_start();  

echo '	<p><b><div class="red">Alba</div></b> Ramirez</p>
<p style="display: none">Carla</p>
<hr />';
$buffer = ob_get_contents();  
ob_end_clean();  
?>
<hr />
<?php  
echo "<p>hola</p>";

echo $buffer;  
?>
</body>
<script type="text/javascript">
$('p').click(function(){
$("p").toggle();
	});
</script>
</html>
