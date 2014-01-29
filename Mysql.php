<?php
// Mysql settings
$user   = "zatika";
$password = "Zatika_123";
$database = "zatika";
$host   = "localhost";
$con= mysql_connect($host,$user,$password);
mysql_select_db($database,$con) or die( "Unable to select database");
?>