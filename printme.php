<?php
	session_start();		
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	require_once('includes/cuestiones.inc');	
	require_once('examen_mostrar.php');	
	
//	if(!isset($_SESSION['user'])) redirect_to("index.php");
//	if(!isset($_SESSION['idAlumno'])) redirect_to("index.php");	
	
	$db=$_SESSION['db_name'];
	conectar($db);
//	$exa_t=array(1290105228,1290124121,1290124132,1290105278,1290124112);
//	$examen=array_rand($exa_t);
	$id=2;
//	$id=examen_pop();
	$sql="SELECT identificado FROM Fuentes WHERE idFuente=\"$id\"";
	$query=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_row($query);	
	$examen=strtotime($row[0]);
	
	$seg=1;
	$min=60*$seg;
	$hour=60*$min;
	$begin=time();
//function examen_mostrar($examen){
//if(get_cookie("examen")) $examen=get_cookie("examen");
//else set_cookie("examen", $examen);

//Dura una hora la cookie
if(get_cookie("comienzo")) $begin=get_cookie("comienzo");
//else set_cookie("comienzo", $begin);

//del_cookie("comienzo");
$ahora=time();
$fin=$begin+60*$min;
//Comentada para poder acceder
//if($fin<$ahora) redirect_to("index.php");	
function check_me(){
	if(get_cookie("idA")){
		$yo=get_cookie("idA");
		if($yo!=$_SESSION['idAlumno']){
			del_cookie("idA");
			del_cookie("examen");
			del_cookie("comienzo");				
			redirect_to("index.php");
		}
		
	}else set_cookie("idA",$_SESSION['idAlumno']);	
}	

?>
<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/test.css" type="text/css">	
	<script src="jquery/jquery-1.4.2.js"></script>
	<script type="text/javascript" SRC="mathjax/MathJax.js">
	
	MathJax.Hub.Config({
		extensions: ["tex2jax.js"],
  	styleSheets: ["math.css"],
  	 jax: ["input/TeX","output/HTML-CSS"],
  	displayAlign: "left",
  	 delayStartupUntil: "onload",
  	 messageStyle: "none",
    tex2jax: {
    	inlineMath: [["$","$"],["$$(","$$)"]],
    	displayMath: [['$$','$$'],['\\[','\\]'] ]
    }
  });
	</script>
	<script src="jquery/jquery-shuffle.js"></script>
	<script src="jquery/jquery.cookie.js"></script>
	<script src="jquery/jquery.countdown.js"></script>
	
	<script src="js/test.js"></script>
	<title><?php echo $_SESSION['user']." - ".$_SESSION['DNI'];?></title>
</head>
<body>
<div id="contenedor">
	<div id="contenido">
<?php
//echo "CABECERA"."<br />";//echo "Comienzo de la prueba".date('[H:i:s]', $begin).". Finalizacion ".date('[H:i:s]', $fin)."<br />";	//$begin_str=strtotime($begin);//echo "Son ".date('[H:i:s]', time())."<br />";	//echo "Examen <b>".$examen."</b> creado el ".date('[d-m-Y H:i]', $examen)."<hr />";
check_me();
examen_mostrar($id);
//correccion();
?>
<button name="boton">boton</button>
<div class="total_info"></div>

	</div>
</div>
<div id="info"></div>
<div id="info2"><?php echo $_SESSION['user']."<br />".$_SESSION['DNI']; ?></div>
<div id="Calificacion"></div>
</body>
</html>


