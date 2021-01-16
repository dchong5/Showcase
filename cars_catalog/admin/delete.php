<?php 

	include("../includes/mysql_connect.php"); //Must first connect to the DB to be able to delete, DO NOT want the UI

	$charID = $_GET['id'];
	//echo "<h1>$charID</h1>"; //test

	if (is_numeric($charID)) {
		//SQL delete
		mysqli_query($con, "DELETE FROM cars WHERE id = '$charID'")or die (mysqli_error($con));
		header("Location:edit.php");
	}


?>