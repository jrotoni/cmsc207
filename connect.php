<?php


// Define required connection parameters
$hostname = 'localhost';
$username = 'id4947395_cmsc207teamc';
$password = 'teamc.cmsc207';
$db_name = 'id4947395_login';

// Create a connection to database
$conn = mysqli_connect($hostname, $username, $password, $db_name);

if (!$conn)
	die('Connection failed: ' . mysqli_error($conn));


