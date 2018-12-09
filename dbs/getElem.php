<?php
// get just one entry from 'adrBook' table
require 'globalvars.php';
include 'getCity.php';

// the id of the entry we'll use
$recid = 1;
if (isset($_GET['elem'])) { $recid = intval($_GET['elem']); }
// check if data from the 'cities' tables should be included
$useCity = 0; // false
if (isset($_GET['useCity'])) { $useCity = $_GET['useCity']; }

// get data from the db
$sql = "SELECT * FROM adrBook WHERE id ='" . $recid . "'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$rowtab = $result->fetch_assoc(); // we should get just one element
	echo "<table>";
	echo "<tr><td><p>First name: </p></td><td><input type='text' id='frm2fname' value={$rowtab["firstName"]} /></td></tr>";
	echo "<tr><td><p>Last name: </p></td><td><input type='text' id='frm2lname' value={$rowtab["name"]} /></td></tr>";
	echo "<tr><td><p>Street: </p></td><td><input type='text' id='frm2str' value='{$rowtab["street"]}' /></td></tr>";
	echo "<tr><td><p>Zip code: </p></td><td><input type='text' id='frm2zipc' value={$rowtab["zipCode"]} /></td></tr>";
	echo "<tr><td><input type='hidden' id='frm2cid' value={$rowtab["cityId"]} /></td>";
	echo "<td><input type='hidden' id='frm2id' value={$rowtab["id"]} /></td></tr>";
	if ($useCity > 0) {
		echo "<tr><td><small>Select the city:</small></td><td>";
		getCities($conn, $rowtab["cityId"]);
		echo "</td></tr>";
	}
	echo "</table>";
}
else { echo "0 results retrieved"; }

if ($useCity == 0) $conn->close();
?>
