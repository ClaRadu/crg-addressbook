<?php
// get all data from 'cities' table
require 'globalvars.php';

if (isset($_GET['run'])) {
	$run = intval($_GET['run']);
	$id = 1; // default
	if ($run > 0) getCities($conn, $id);
}

function getCities($conn, $did) {
	$sql = "SELECT * FROM cities";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		echo "<select id='selcit' name='cit'>";
		while($rowtab = $result->fetch_assoc()) {
			if ($rowtab["id"] == $did) {
				echo "<option value=" . $rowtab["id"] . " selected>";
			} else {
				echo "<option value=" . $rowtab["id"] . ">";
			}
			echo $rowtab["city"] . "</option>";
		}
		echo "</select>";
	} else { echo "0 results retrieved"; }
	// close connection
	$conn->close();
}
?>
