<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$jsonData = file_get_contents('php://input');
// Decode the JSON data into a PHP associative array
$data = json_decode($jsonData, true);
$latitude = $data['latitude'];
$longitude = ($data['longitude'])+(0.10001);

$date = date('H:i:s-Y:m:d');
$sql = "INSERT INTO `location` (`locationname`, `latitude`, `longitude`, `status`, `datetime`) VALUES ('".$date."', '".$latitude."', '".$longitude."', '0', 'now()')";
$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    die("Error executing the query: " . $conn->error);
}

// Close connection
$conn->close();