<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once 'excel_reader2.php';
//$data = new Spreadsheet_Excel_Reader("example.xls");
$data = new Spreadsheet_Excel_Reader("xls/Alumnos.xls",false,"UTF-8");
?>
<html>
<head>
<style>
table.excel {
	border-style:ridge;
	border-width:1;
	border-collapse:collapse;
	font-family:sans-serif;
	font-size:12px;
}
table.excel thead th, table.excel tbody th {
	background:#CCCCCC;
	border-style:ridge;
	border-width:1;
	text-align: center;
	vertical-align:bottom;
}
table.excel tbody th {
	text-align:center;
	width:20px;
}
table.excel tbody td {
	vertical-align:bottom;
}
table.excel tbody td {
    padding: 0 3px;
	border: 1px solid #EEEEEE;
}
</style>
</head>

<body>
<?php // echo $data->dump(true,true); 
	$col_nombre='G';
	$col_dni='F';
	$fila=8;
	while($data->val($fila,$col_nombre)){
		$nombre=(string)htmlentities($data->val($fila,$col_nombre));
		$dni=(string)htmlentities($data->val($fila,$col_dni));
		$fila++;
	//echo gettype($dato); //devuelve double
		echo $nombre.", ".$dni."<br />";
	}
//		echo $data->dump(true,true);
//	echo gettype($dato);
?>
</body>
</html>
