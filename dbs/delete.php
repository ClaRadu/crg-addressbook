<?php
// delete a record from 'adrBook' table
require 'globalvars.php';

$delid = 0;
if (isset($_GET['Delid'])) { $delid = intval($_GET['Delid']); }

if ($delid > 0)
{
	$sql = "delete from adrBook where id ='" . $delid . "'";
	if ($conn->query($sql) === TRUE) {
		echo "Record deleted";
	} else {
		echo "Error deleting record [id=" . $delid . "]:" . $conn->error;
	}
}	
?>
