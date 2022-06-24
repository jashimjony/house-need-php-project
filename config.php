<?php
	//set server detail in variable
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "houzneed";

	//create connection to database
	$connection = new mysqli("$servername","$username","$password","$database");

	//check connection
	if ($connection->connect_error) {
		//return error - connection problem
    	die("Connection failed: " . $connection->connect_error);
	} 
?>