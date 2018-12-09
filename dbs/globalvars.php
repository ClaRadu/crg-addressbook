<?php
// this variables are required by all php files on this app
$debug = 1;
$db_name = "";

if ($debug == 1)
{
	$srv = "localhost";
	$user = "root";
	$pass = ""; // no password needed in debug mode
	$db_name = "addressbook";
}
else
{
	// host
	$srv = "";
	$user = "";
	$pass = "";
	$db_name = "";
}

// create connection
$conn = new mysqli($srv, $user, $pass);
// check the connection
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}

mysqli_select_db($conn, $db_name); // select the correct database

?>
