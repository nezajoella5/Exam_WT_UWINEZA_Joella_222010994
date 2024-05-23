<?php
// Connection details
$host = "localhost";
$user = "Joella";
$pass = "uwineza123";
$database = "wealth_building_workshops";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>