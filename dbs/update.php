<!DOCTYPE html>
<html>
<head>
<body>

<?php
require 'globalvars.php';

$id = intval($_GET['id']); // entry id
$lname = strval($_GET['name']); // last name
$fname = strval($_GET['fname']); // first name
$street = strval($_GET['str']);
$zipcode = strval($_GET['zipc']);
$citid = intval($_GET['cid']);
$citname = strval($_GET['cname']);


/*echo 'shit son!!!';
echo 'id=' + $id + "<br>";
echo $fname + ' ' + $lname;
echo 'str ' + $street + ', ' + $citid + ' ' + $citname;
echo $zipcode;*/

// function to run a sql query
function update($connection, $sql_query, $rec, $info)
{
	if ($connection->query($sql_query) === TRUE)
	{
		echo "Record [" . $rec . "] " . $info . "ed successfully!</br>";
	}
	else
	{
		echo "Error " . $info . "ing record [" . $rec . "]!: " . $connection->error;
	}
}

// get old data
$sql = "SELECT * FROM adrBook WHERE id ='" . $id . "'";
$result = $conn->query($sql);

// update da' data, if the case
if ($result->num_rows > 0)
{
	$rowtab = $result->fetch_assoc(); // we should get just one element
	// make sure we don't update data that wasn't updated
	if ($fname != $rowtab["firstName"]) {
		$sql = "UPDATE adrBook SET firstName='$fname' WHERE id=$id";
		update($conn, $sql, 'firstName', 'update'); // update record
	}
	if ($lname != $rowtab["name"]) {
		$sql = "UPDATE adrBook SET name='$lname' WHERE id=$id";
		update($conn, $sql, 'name', 'updat'); // update record
	}
	if ($street != $rowtab["street"]) {
		$sql = "UPDATE adrBook SET street='$street' WHERE id=$id";
		update($conn, $sql, 'street', 'updat'); // update record
	}
	if ($zipcode != $rowtab["zipCode"]) {
		$sql = "UPDATE adrBook SET zipCode='$zipcode' WHERE id=$id";
		update($conn, $sql, 'zipCode', 'updat'); // update record
	}
	if ($citid != $rowtab["cityId"]) {
		$sql = "UPDATE adrBook SET cityid=$citid, cityName='$citname' WHERE id=$id";
		update($conn, $sql, 'cityName', 'updat'); // update record
	}
}

$conn->close();
?>

</body>
</html>
