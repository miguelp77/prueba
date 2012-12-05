<?php
//	session_start();
	require_once('includes/basics.php');
	require_once('includes/db_tools.inc');
	require_once('includes/cuestiones.inc');	

	connect_to_db();
	if(!isset($_SESSION['imagen'])){
		$_SESSION['imagen']=primera_img();
	}

	if(!isset($_POST['img']))
		$idEq=primera_img();
	else $idEq=$_POST['img'];

function cuantas_img(){ 
	$sql="SELECT eq_id FROM asg_admin.Ecuaciones";
	$query = mysql_query($sql) or die(mysql_error());
	$count=mysql_num_rows($query);
	return $count;
}	
function numero_de_img($ini=0,$qty=5,$total){
	$last=0;
	if($ini<=0) $ini=1;
	if($ini>=$total) $ini=$total;
	if ($ini>4) echo '<div class="whitie" name="menos5"><< ANT </div>';
	else echo '<div class="whitie">LaTeX</div>';
	if ($ini>3) echo '<div class="whitie" name="?page=1"> 1 </div>';
	if ($ini>($qty-1)) echo '<div class="dots" >...</div>';	
	$dosmenos=$ini-3;
	if($dosmenos<=0)$dosmenos=0;
	
	$sql="SELECT eq_id FROM asg_admin.Ecuaciones LIMIT $dosmenos,$qty";
	$query = mysql_query($sql) or die(mysql_error());

	while($row=mysql_fetch_row($query)){
		if($row[0]==$ini) echo "<span class='whitie current' name='?page=".$row[0]."'>$row[0]</span>";
		else echo "<span class='whitie' name='?page=".$row[0]."'>$row[0]</span>";
		$last=$row[0];
	}
	if($last<($total-1)) echo '<div class="dots"> ... </div><div class="whitie" name="'.$total.'">'.$total.'</div><div class="whitie" name="mas5">SIG >></div>';
	return $last;
}
function primera_img(){
		$query="SELECT eq_id FROM asg_admin.Ecuaciones LIMIT 1";
		$result = mysql_query($query) or die(mysql_error());
		$Yorch = mysql_fetch_row($result);
		return $Yorch[0];	
}
	
function update_desc($idEq,$desc){
	//	echo $idEq;
	//	echo $desc;
	//	$query="SELECT eq_des FROM asg_admin.Ecuaciones WHERE eq_id=$idEq LIMIT 1";
	//	$result = mysql_query($query) or die(mysql_error());
	//	$Yorch = mysql_fetch_row($result);
	//	return $Yorch[0];

	if($idEq!="undefined "){ 
		$accion="UPDATE asg_admin.Ecuaciones SET eq_des = '$desc' WHERE eq_id= $idEq";
		$query=mysql_query($accion) or die(mysql_error());
		return 'Actualizado!';
	} else return 'Sin id';
}

function get_img_info(){
	$img_list = array();
	$sql="SELECT eq_id,eq_path,eq_des FROM asg_admin.Ecuaciones";
	$query = mysql_query($sql) or die(mysql_error());	
	while($row=mysql_fetch_row($query)){
		$item['id']=$row[0];
		$item['path']=$row[1];
		if(strlen($row[2])>0)$item['desc']=$row[2];
		else $item['desc']=$row[0].' sin descripción';
		array_push($img_list, $item);
	}
//	foreach($img_list as $img){
//		echo $img['desc'].'<br />';
//	}
	return $img_list;
}

function createidEq(){
	$sql="SELECT eq_id FROM asg_admin.Ecuaciones WHERE eq_id=$idEq LIMIT 1";
	$query = mysql_query($sql) or die(mysql_error());	
	return $query;
}

?>
