<?php
require 'fix_mysql.inc.php';
include(ROOT_DIR . "common/lib/adodb.inc.php");

function connectDB()
{
	$conn = ADONewConnection(DB_TYPE);
	$conn->PConnect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
	
	return $conn;
}
?>
