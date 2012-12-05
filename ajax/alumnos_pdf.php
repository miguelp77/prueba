<?php
	$archivo='listado.pdf';
	$opt="#toolbar=1&navpanes=1&scrollbar=1";
	$file='pdfs/'.$archivo.$opt;
	echo '<embed src="'. $file.'" width="650" height="550" href="'.$file.'"></embed>';
?>
