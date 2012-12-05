<?php
 session_start();
	// $var="' *OR \"1=1'";
	// var_dump($var);
	// echo ' <hr />';
//	$ret = filter_var($var, FILTER_SANITIZE_STRING);
	 // $ret = preg_replace('/[\s\'\"*]/','', $var);
	 // $ret = preg_replace('/[\W]/','', $var);	 
// 	 $ret = preg_replace('/[\'\"*]/','', $ret);
//	$ret = htmlentities ( trim ( $var ), ENT_NOQUOTES );
//	$ret = htmlentities(strip_tags($var),ENT_QUOTES,'UTF-8');
//	$ret = addslashes($var);
	// var_dump ($ret);
// $_SESSION['casa']="casa";
// if(isset($_SESSION['casa']))echo $_SESSION['casa'];
// else echo 'none';
ini_set('session.gc_maxlifetime', 60*60);
ini_set('session.name', 'testbrowser');
if (isset($_SESSION['LAST_ACTIVITY'])) {
echo $_SESSION['LAST_ACTIVITY'];
}
$currentTimeoutInSecs = ini_get('session.gc_maxlifetime');
echo $currentTimeoutInSecs;

/* set the session name to WebsiteID */

// $previous_name = session_name("WebID");
echo "The session name is ".session_name()." <br />";
// session_destroy();
?>
