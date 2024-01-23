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

// SQL query to select data
$sql = "SELECT id, locationname,latitude, longitude FROM location where status = 0 order by id asc limit 1";
$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    die("Error executing the query: " . $conn->error);
}
$returnarray = array();
// Check if there are rows in the result set
if ($result->num_rows > 0) {
    // Loop through each row of data
        $row = $result->fetch_assoc();
      //  echo "<pre>";print_r($row);die;
        // Access individual columns using $row['column_name']
        $returnarray = array('locationname' => $row['locationname'], 'latitude' => $row['latitude'], 'longitude' => $row['longitude']);
        $sql2 = "update location set status = 1 where id = '".$row['id']."'";
        $result2 = $conn->query($sql2);
   
}echo json_encode($returnarray);
// Close connection
$conn->close();
?>


<?php
// Assume you have a function to get the live location from your database
// function getLiveLocation() {
//     // Replace this with your logic to fetch the live location
//     $latitude = 37.7749;  // Example latitude
//     $longitude = -122.4194;  // Example longitude

//     $latitude = 23.0293504;  // Example latitude
//     $longitude = 72.5581824;  // Example longitude
    
//     return array('latitude' => $latitude, 'longitude' => $longitude);
// }

// // Provide the live location as JSON
// echo json_encode(getLiveLocation());
?>
