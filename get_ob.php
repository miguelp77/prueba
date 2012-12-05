<?php
session_start();
//echo $_SESSION['out2'];

$_SESSION['out2'] = ob_get_contents();  
ob_end_clean();  
echo "OOOOO".$_SESSION['out2'];
?>

