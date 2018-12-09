<!DOCTYPE html>
<html>
<head>
<body>

<?php
// get all data from 'adrBook' table and save it to xml format
require 'globalvars.php';

// create xml file to store data
$xmlfile = fopen("../down/adrBook.xml", "w") or die("Unable to open file!");
$txt = "<?xml version='1.0' encoding='utf-8'?>\n";
fwrite($xmlfile, $txt);
$txt = "<addressBook>\n";
fwrite($xmlfile, $txt);

$sql = "SELECT * FROM adrBook";
$result = $conn->query($sql);

if ($result->num_rows > 0)
{
    // output data of each row in a table
	echo "<table><tr><th>First Name</th><th>Last Name</th><th>Street</th><th>City</th>
		<th>Zip Code</th><th>Modify entry</th><th>Delete entry</th></tr>";
	while($row = $result->fetch_assoc())
	{
		echo "<tr><td>" . $row["firstName"] . "</td>";
		echo "<td>" . $row["name"] . "</td>";
		echo "<td>" . $row["street"] . "</td>";
		echo "<td>" . $row["cityName"] . "</td>";
		echo "<td>" . $row["zipCode"] . "</td>";
		echo "<td align='center'><button class='w3-button w3-black w3-section' id='btnUpd' value={$row["id"]}>Update</button></td>";
		echo "<td align='center'><button class='w3-button w3-red w3-section' id='btnDel' value={$row["id"]}>Delete</button></td></tr>";
		
		// add to xml file
		$txt = "\t<address>
			<id>" . $row['id']  . "</id>
			<fname>" . $row['firstName'] . "</fname>
			<name>" . $row['name'] . "</name>
			<street>" . $row['street'] . "</street>
			<zipc>" . $row['zipCode'] . "</zipc>
			<cid>" . $row['cityId'] . "</cid>
			<cname>" . $row['cityName'] . "</cname>\n\t</address>\n";
		fwrite($xmlfile, $txt);
	}
	echo "</table>";
	
	// close xml file
	$txt = "</addressBook>\n";
	fwrite($xmlfile, $txt);
	fclose($xmlfile);
}
else
{
    echo "0 results";
}

$conn->close();
?>

</body>
</html>
