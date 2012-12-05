<?php
	session_start();
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	require_once('includes/cuestiones.inc');	
	$db="asg_admin";
	$conn=conectar($db);

//	$sentido = $_POST['sentido']; //ASC o DESC
//	$idEq=$_SESSION['imagen'];
function cuantas_img(){
	$sql="SELECT eq_id FROM asg_admin.Ecuaciones";
	$query = mysql_query($sql) or die(mysql_error());
	$count=mysql_num_rows($query);
	return $count;
}	
function numero_de_img($ini=0,$qty=5){
	if($ini>0) echo '<div class="whitie"><< ANT </div><div class="whitie"> 1 </div><div class="whitie dots">...</div>';	
	$sql="SELECT eq_id FROM asg_admin.Ecuaciones LIMIT $ini,$qty";
	$query = mysql_query($sql) or die(mysql_error());
	$count=mysql_num_rows($query);
	//$count.'<br />';
	while($row=mysql_fetch_row($query)){
		echo "<span class='whitie'>$row[0]</span>";
	$last=$row[0];
	}
	return $last;

}
//mysql_close($conn);

?>
<html>
	<head>
<!--	<link rel=stylesheet href="css/main.css" type="text/css"> -->		
	<style>
	.whitie{
		background:#fff;
		border:1px solid #000;
		color:#444444;
		cursor:pointer;	
		display: inline-block;
		float:left;
		font-size:14px;
		margin:2px;
		padding:4px;	
		text-align:center;

		-moz-border-radius: 4px;
		-webkit-border-radius: 4px;
}
.dots{
		background:none;	
		border:none;
}

.whitie:hover{
	background:#555; 
	color:#fff;
}
	
	</style>
	</head>
	<body>
		<div class='whitie'>33</div>
		<div>
		<?php
				$i=0;
				$qty=cuantas_img();
				$n=$qty/5;
					$nn=$i*5;
					$ret=numero_de_img($nn,5);
					if($ret<$qty) echo '<div class="whitie dots"> ... </div><div class="whitie">'.$qty.'</div>';
			?>
		</div>
	</body>
</html>
