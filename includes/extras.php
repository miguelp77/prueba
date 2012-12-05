<?php

	require_once('includes/basics.php');
//EXTRAS!!!!
//topdf()
//tex_to_png
//Paginas
//GetEq


function topdf($fuente='final.php',$destino=null){
	$ruta="http://localhost/home/";
	$fuente=$ruta.$fuente;
	if($destino!=null){
		$destino .=".pdf";
		passthru("~/pfc/./wkhtmltopdf-i386 --javascript-delay 10000 ".$fuente." pdfs/$destino");
		echo "Done!";
	}else return false;
	//Retrasamos para que le de tiempo a js a terminar
	//./wkhtmltopdf-i386 --javascript-delay 20000 http://www.mathjax.org/demos/tex-samples/ miguel.pdf 
}

// ./wkhtmltopdf-i386 --cookie-jar /home/ --javascript-delay 8000 http://localhost/home/final.php pdfs/test_pdf.pdf
function tex_to_png($my_eq='-- imagen',$eq_name){
	$my_file = "img/test.tex";
//	$img_path= "~/pfc/img/";
	$img_path= "img/";
	$img_path= $img_path . $eq_name . ".png";
//	if(strlen($my_eq) == 0) 
//		$my_eq='-- imagen';
//	passthru('cd img');

//	echo passthru('cat '.$my_file);

//		$my_eq = "f(x) = \sqrt{1+x} \quad (x \ge -1 )";
	$FileHandle = fopen($my_file, 'w')
		or die("fopen: No se puede Abrir el archivo $my_file");
	fwrite($FileHandle, $my_eq)
			or die("fwrite: No se puede Escribir el archivo $my_eq");
	fclose($FileHandle);
	$ok =	passthru("../tex2im/./tex2im -o $img_path -z=1 $my_file");
//		$ok =	passthru("~/pfc/tex2im/./tex2im -o $img_path -z=1 ~/pfc/test.tex");
	echo $ok;
//	return $img_path . $ok;
}

function Paginas(){
//	$conn = conectar($bbdd);
	$i=0;
	//Conectar($bbdd);
	$query='SELECT * FROM Ecuaciones';

	$result =mysql_query($query);
	$number=mysql_num_rows($result);
	$pag=$number/5;
	//$inicio=0+($num*5);
	//$fin=5+($num*5);
	if (($number%5)==0) $pag=$pag-1;
	for($j=0;$j<=$pag;$j++)
		{
			if($j==0)
				echo "<span class='paginaa'>".$j."</span>";
			if($j!=0)
				echo "<span class='pagina'>".$j."</span>";
		}
}
//Muestra las IMAGENES de las Ecuaciones de manera paginada
function GetEq($num=1){
	$query='SELECT * FROM Ecuaciones';
	$result =mysql_query($query);
	$number=mysql_num_rows($result);
	$pag=$number/5;

	$inicio=0+($num*5);
	$fin=5+($num*5);
//	echo $inicio."-".$fin;
	$query= "SELECT * FROM Ecuaciones ORDER BY eq_id ASC LIMIT $inicio,5";// LIMIT 0," .$pag."'";
	$result =mysql_query($query);
	//echo mysql_num_rows($result);
//	$Ecuaciones=mysql_fetch_array($result);
//	echo "<div id='imagenes'>";
	$i=$inicio-1;
	while($Ecuaciones= mysql_fetch_array($result))
		{
			$i++;
			echo "<div class='imgtext'>";//.$Ecuaciones['eq_exp']." -- -- ".$i."</div>";
			
			
			echo"<div class='pngs'>"."<input type='radio' name='oo'>"."<img class='redondear ".$i."' src=".$Ecuaciones['eq_path']." title=".$Ecuaciones['eq_path']."/>"."</div>";
			echo "<div class='imginfo'>"." Expresion: ".$Ecuaciones['eq_exp']. "<br/>";
			echo "  Archivo: ".$Ecuaciones['eq_path'];
			echo "</div></div>";
			if(($i%1)==0) echo "<br/>";
		}

/*	echo "<br />".$number. " imagenes en ".intval($pag)." paginas";
	echo "<br />".$inicio;
	echo "<br />".$fin;
*/	
}
//Arrays necesarios
	$sort = array(
		array('key'=>'lname',   'sort'=>'asc'), // ... this sets the initial sort "column" and order ...
		array('key'=>'size',   'sort'=>'asc') // ... for items with the same initial sort value, sort this way.
);



    // Get this folder and files name.

function give_files($dir=null){
	$this_script = basename(__FILE__);
	$this_folder = str_replace('/'.$this_script, '', $_SERVER['SCRIPT_NAME']);
  // Declare vars used beyond this point.
	$file_list = array();
	$folder_list = array();
  $total_size = 0;
		//Change directory
	chdir("$dir".DIRECTORY_SEPARATOR);
  $camino=$dir;
    // Open the current directory...
    
	if ($handle = opendir('.')){
		// ...start scanning through it.
		while (false !== ($file = readdir($handle))){
		// Make sure we don't list this folder, file or their links.
			if ($file != "." && $file != ".." && $file != $this_script){
			// Get file info.
				$stat = stat($file); // ... slow, but faster than using filemtime() & filesize() instead.
				$info = pathinfo($file);
        // Organize file info.
				$item['path'] = 'img';
				$item['name'] =$item['path'].DIRECTORY_SEPARATOR.$info['filename'];
//             $item['name']      =$info['filename'];             
				$item['lname'] = strtolower($info['filename']);
				$item['ext'] = $info['extension'];
				if($info['extension'] == '') $item['ext'] = '.';
					$item['bytes'] = $stat['size'];
        $item['size'] = bytes_to_string($stat['size'], 2);
 				$item['mtime'] = $stat['mtime'];
				// Add files to the file list...
				if($info['extension'] != ''){
					array_push($file_list, $item);
         }
             // ...and folders to the folder list.
         else{
					array_push($folder_list, $item);
         }
		// Clear stat() cache to free up memory (not really needed).
				clearstatcache();
		// Add this items file size to this folders total size
				$total_size += $item['bytes'];
			}
     }
// Close the directory when finished.
	closedir($handle);
	}
    // Sort folder list.
	if($folder_list)
		$folder_list = php_multisort($folder_list, $GLOBALS['sort']);
    // Sort file list.
	if($file_list)
		$file_list = php_multisort($file_list, $GLOBALS['sort']);
    // Calculate the total folder size
	if($file_list && $folder_list)
		$total_size = bytes_to_string($total_size, 2);
//Devuelvo el array
	return $file_list;

}

function php_multisort($data,$keys){
	foreach ($data as $key => $row){
		foreach ($keys as $k){
			$cols[$k['key']][$key] = $row[$k['key']];
		}
	}
	$idkeys = array_keys($data);
	$i=0;
	foreach ($keys as $k){
		if($i>0){$GLOBALS['sort'].=',';}
		$GLOBALS['sort'].='$cols['.$k['key'].']';
		if($k['sort']){$GLOBALS['sort'].=',SORT_'.strtoupper($k['sort']);}
//		if($k['type']){$GLOBALS['sort'].=',SORT_'.strtoupper($k['type']);}
		$i++;
	}
	$GLOBALS['sort'] .= ',$idkeys';
	$GLOBALS['sort'] = 'array_multisort('.$GLOBALS['sort'].');';
//	eval($GLOBALS['sort']);
	foreach($idkeys as $idkey){
		$result[$idkey]=$data[$idkey];
	}
	return $result;
}

function bytes_to_string($size, $precision = 0) {
	$sizes = array(' YB', ' ZB', ' EB', ' PB', ' TB', ' GB', ' MB', ' KB', ' Bytes');
	$total = count($sizes);
	while($total-- && $size > 1024) $size /= 1024;
	$return['num'] = round($size, $precision);
	$return['str'] = $sizes[$total];
	return $return;
}

?>
