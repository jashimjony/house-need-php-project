<?php
	//set server detail in variable
	$server = "localhost";
	$username = "root";
	$password = "";
	$database = "houzneed";

	//connection to database
	$connection = new mysqli("$server","$username","$password","$database");

	//check connection
	if ($connection->connect_error) {
		//return error - connection problem
    	die("Connection failed: " . $connection->connect_error);
	} 
?>