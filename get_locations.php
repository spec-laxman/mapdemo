<?php

header('Content-Type: application/json');

// Assume you have a database connection
$pdo = new PDO("mysql:host=localhost;dbname=test", "root", "");

// Get the latest vehicle locations from the database
$stmt = $pdo->query("SELECT * FROM vehicles ORDER BY timestamp DESC LIMIT 10"); // Limit to the latest 10 locations for simplicity
$locations = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($locations);
