<!DOCTYPE html>
<html>
<head>
<body>

<?php
require 'globalvars.php';

$lname = strval($_GET['name']); // last name
$fname = strval($_GET['fname']); // first name
$street = strval($_GET['str']);
$zipcode = strval($_GET['zipc']);
$citid = intval($_GET['cid']);
$citname = strval($_GET['cname']);


/*echo 'shit son!!!';
echo $fname + ' ' + $lname;
echo 'str ' + $street + ', ' + $citid + ' ' + $citname;
echo $zipcode;*/

// function to insert data to the db
function save($connection, $sql_query, $info)
{
	if ($connection->query($sql_query) === TRUE)
	{
		echo "Record " . $info . "ed successfully!</br>";
	}
	else
	{
		echo "Error " . $info . "ing record!: " . $connection->error;
	}
}

// update da' data
if ($fname != "") // fisrt name not empty
{
	$sql = "INSERT INTO adrBook (name, firstName, street, zipCode, cityId, cityName) VALUES ('$lname', '$fname', '$street', '$zipcode', $citid, '$citname')";
	save($conn, $sql, 'insert'); // add record
}

$conn->close();
?>

</body>
</html>
