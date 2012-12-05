<?php
	
	function start($word){
	
		return substr($word, 0,-strlen($word)+1);	
	}
	
	$lista=array('zapato','arbol','almacen','casa','banco','barco','pan','torero','mozo','loco','retro','otro');

	foreach($lista as $w){
		$first=start($w);
		if(!in_array($first,$alpha))$alpha[]=$first;
	}
	foreach($alpha as $l) echo $l;
?>
<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<style type="text/css">
	.alphabox{
		padding: 5px 10px;
    margin: 2px 2px 2px 2px;
    display: inline;
    
    background: #7F7C48;
    border: none;
    color: #eee;
    cursor: pointer;
    font-weight: bold;
    border-radius: 5px;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    text-shadow: 1px 1px #666;	
	}
	.alphabox.disable{
		color:#999;
	}
	body{
		color:#444;
		background-color:#eee;
	}
	a{
	color:#eee;
	}
	</style>
	<meta charset="UTF-8">
	<title>alpha</title>
</head>
<body>
	Hola
	<?php 
		foreach(range('a','z') as $i){
			if(in_array($i,$alpha)) echo '<div class="alphabox"><a href="#'.$i.'">'.$i.'</a></div>'; 
			else echo '<div class="alphabox disable">'.$i.'</div>';
		}
		echo '<hr />';
		asort($lista);
		$current='0';
		foreach($lista as $word){
			$st=start($word);

			if($st!=$current){
			echo '<br />';
				$current=$st;
				echo '<div class="alphabox" id="'.$current.'">'.$current.'</div><hr />';
			}
			
			echo $word.'<br />';
		}
		
	?>

</body>
</html>
