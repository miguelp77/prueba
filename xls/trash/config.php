<?php
// connect to db
$link = mysql_connect("localhost", "root", "p89er");
if (!$link) {
    die('Not connected : ' . mysql_error());
}

if (! mysql_select_db('Asignatura') ) {
    die ('Can\'t use foo : ' . mysql_error());
}
?>
