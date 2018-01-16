<?php
	$servername = "localhost";
	$serverusername = "root";
	$serverpassword = "";
	$databasename = "blood donors network";

	$conn = new mysqli($servername, $serverusername, $serverpassword, $databasename);

	if(!$conn){
		die("Connection failed: " . mysqli_connect_error());
	}
?>