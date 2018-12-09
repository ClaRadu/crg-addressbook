<!DOCTYPE html>
<html>
<head>
<title>CRG Address Book - Create DB</title>
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
<div style="color:white; background-color:teal; border-radius:6px; padding:5px 10px 5px;">
<form action="create.php" method="post">
<?php
require 'dbs/globalvars.php';


// create database and table(s) and populate the table(s)
if (isset($_POST["create_db"])) { // check if db needs to be created
	if ($_POST["create_db"] == 'ok') {
		createDb($conn, $db_name);
		echo '<li>Database created!</li>';
	}
} else { // check tables
	if (isset($_POST["create_t1"]) && $_POST["create_t1"] == 'ok') { // create 
		createTable($conn, 1);
		echo '<li>Table `adrBook` created!</li>';
	}
	if (isset($_POST["upd_t1"]) && $_POST["upd_t1"] == 'ok') { // update
		updateTable($conn, 1);
		echo '<li>Test data added in table `adrBook`!</li>';
	}
	if (isset($_POST["create_t2"]) && $_POST["create_t2"] == 'ok') {
		createTable($conn, 2);
		echo '<li>Table `cities` created!</li>';
	}
	if (isset($_POST["upd_t2"]) && $_POST["upd_t2"] == 'ok') {
		updateTable($conn, 2);
		echo '<li>Test data added in table `cities`!</li>';
	}
}

// the content of the form
echo "Database status: <br>";
if (isDb($conn, $db_name)) // check if db exists
{
	echo '> Db `' .  $db_name  . '` found';
	// if yes, check tables
	echo '<br>Table(s) status: ';
	if (isTable($conn, 'adrBook')) { // check if 1st table exists
		echo '<br> > Table `adrBook` found';
		// if yes, check if it's empty
		if (isEmpty($conn, 'adrBook')) {
			// if empty, prompt user to add data
			echo '<br>Table is empty. Do you want to add data to it? ( test data will be added ) ';
			echo "<input type='text' name='upd_t1' value='' placeholder='write ok to accept'> ";
			echo "<input class='w3-button w3-green w3-round' type='submit' name='upt1' value='Update table'>";
		}
	} else {
		echo'<br>Table `adrBook` not found! Do you want to create it? ';
		echo "<input type='text' name='create_t1' value='' placeholder='write ok to accept'> ";
		echo "<input class='w3-button w3-black w3-round' type='submit' name='crt1' value='Create table'>";
	}
	if (isTable($conn, 'cities')) { // check if 2nd table exists
		echo '<br> > Table `cities` found';
		// if yes, check if it's empty
		if (isEmpty($conn, 'cities')) {
			// if empty, prompt user to add data
			echo '<br>Table is empty. Do you want to add data to it? ( test data will be added ) ';
			echo "<input type='text' name='upd_t2' value='' placeholder='write ok to accept'> ";
			echo "<input class='w3-button w3-green w3-round' type='submit' name='upt2' value='Update table'>";
		}
	} else {
		echo'<br>Table `cities` not found! Do you want to create it? ';
		echo "<input type='text' name='create_t2' value='' placeholder='write ok to accept'> ";
		echo "<input class='w3-button w3-black w3-round' type='submit' name='crt2' value='Create table'>";
	}
}
else
{
	echo'Database not found! Do you want to create it? ';
	echo "<input type='text' name='create_db' value='' placeholder='write ok to accept'> ";
	echo "<input class='w3-button w3-black w3-round' type='submit' name='crdb' value='Create Db'>";
}


// procedures...

// run any mysql query
function runQuery($connection, $sqlq, $message)
{
	if ($connection->query($sqlq) === TRUE)
	{
		echo "<br/> {$message} -> success!!";
	}
	else
	{
		echo "<br/> {$message} -> Error: " . $connection->error;
	}
}

// check if database exist
function isDb($con, $dbname) {
	$sql = "show databases like '" . $dbname . "'";
	$ret = false;
	
	$res = $con->query($sql);
	if ($res->num_rows > 0) { $ret = true; }
	
	return $ret;
}

// create the database
function createDb($con, $dbname) {
	$sql = "CREATE DATABASE {$dbname}";
	$message = "create database";
	runQuery($con, $sql, $message);
}

// check if table exists
function isTable($con, $tname) {
	$sql = "show tables like '" . $tname . "'";
	$ret = false;
	
	$res = $con->query($sql);
	if ($res && $res->num_rows > 0) { $ret = true; }
	
	return $ret;
}

// create table
// ntable = table's number
function createTable($conn, $ntable) {
	$sql = '';
	if ($ntable == 1) {
		$sql = "CREATE TABLE adrBook (
					id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
					name VARCHAR(30) NOT NULL,
					firstName VARCHAR(30),
					street VARCHAR(50),
					zipCode VARCHAR(6),
					cityId INT(6),
					cityName VARCHAR(40))";
	} else {
		$sql = "CREATE TABLE cities (
					id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
					city VARCHAR(40) NOT NULL,
					country VARCHAR(40) NOT NULL)";
	}
	
	$msg = 'create table';
	
	runQuery($conn, $sql, $msg);
}

// check if table is populated
function isEmpty($conn, $tname) {
	$sql = 'select * from ' . $tname;
	$ret = true;
	
	$res = $conn->query($sql);
	if ($res->num_rows > 0) { $ret = false; }
	
	return $ret;
}

// populate table
// ntable = table's number
function updateTable($con, $ntable) {
	$sqli = array();
	// sql command to insert data into the correct table
	if ($ntable == 1) { // 1st table selected
		$sqli[] = "INSERT INTO adrBook (name, firstName, street, zipCode, cityId, cityName) VALUES ('Radu', 'Cla', 'Santa Monica Blvd, 6600', '90038', '2', 'Los Angeles')";
		$sqli[] = "INSERT INTO adrBook (name, firstName, street, zipCode, cityId, cityName) VALUES ('Li', 'Jet', 'Fusuijing Residential District', '100035', '1', 'Beijing')";
		$sqli[] = "INSERT INTO adrBook (name, firstName, street, zipCode, cityId, cityName) VALUES ('Ronaldo', 'Cristiano', 'Via Giuseppe Mazzini, 9', '10123', '3', 'Torino')";
	} else { // 2nd table selected
		$sqli[] = "INSERT INTO cities (id, city, country) VALUES (1, 'Beijing', 'China')";
		$sqli[] = "INSERT INTO cities (id, city, country) VALUES (2, 'Los Angeles', 'USA')";
		$sqli[] = "INSERT INTO cities (id, city, country) VALUES (3, 'Torino', 'Italy')";
		$sqli[] = "INSERT INTO cities (id, city, country) VALUES (4, 'Troy', 'USA')";
		$sqli[] = "INSERT INTO cities (id, city, country) VALUES (5, 'Singapore', 'Singapore Rep.')";
		$sqli[] = "INSERT INTO cities (id, city, country) VALUES (6, 'Sydney', 'Australia')";
	}
	
	$msg = 'table updated';

	foreach ($sqli as $x) {
		runQuery($con, $x, $msg); // insert data into the table
	}
}

$conn->close();
?>
</form>
</div>
</body>
</html>
