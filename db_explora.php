<?php
require_once('includes/db_tools.inc');
require_once('includes/cuestiones.inc');	

conectar('asg_admin');//	require_once('checkuser.php');
echo "<?php\n";
$nombre = 'asg_admin';
echo '$conn=mysql_connect('.DB_SERVER.','.DB_USER.','.DB_PASS. ');';
echo "\n";
echo '$create="CREATE DATABASE '.$nombre.' DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci";';
echo "\n";
echo '$query = mysql_query($create) or die(mysql_error());';
echo "\n";
echo 'mysql_query("SET NAMES utf8");';
echo "\n";
echo '$db_selected=mysql_select_db("'.$nombre.'");';
echo "\n";

function todas_las_tablas($db){
		$qq="SHOW TABLES FROM ".$db;
		$sql=mysql_query($qq);
	// while($row = mysql_fetch_row($sql)){
		// var_dump($row[0]);
		// }

		while ( $row = mysql_fetch_row($sql)) {
		 	$rows[]=$row[0];
		 	// echo $row[0];
		# code...
			}
		return $rows;
		}

		$rows=array();
		$rows=todas_las_tablas('asg_admin');
		echo '$sql="";'."\n";
		foreach ($rows as $key => $value) {
		# code...
			$qq="SHOW CREATE TABLE ".$value;
			$sql=mysql_query($qq);
			$row = mysql_fetch_row($sql);

			# code...
			// echo '<hr />';
			// echo $row[0];
			$table_sql = $row[1];
			// $campos=explode(',', $row[1]);
			// $table_sql=implode(';', $campos);
			echo '$sql .= "'.$table_sql.'";';
			echo "\n";
			echo '$query = mysql_query($sql) or die(mysql_error());';
			echo "\n";
			echo '$sql = "";';
			// foreach ($campos as $key => $value) {
			// 	echo '$sql .='.$value.';';
			// 	echo '<br />';
			// }
		}
	
	echo "?>";
?>