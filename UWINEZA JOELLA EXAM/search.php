<?php
// Check if the 'query' GET parameter is set
if (isset($_GET['query']) && !empty($_GET['query'])) {
include('database_connection.php');


    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Queries for different tables
    $queries = [
        'feedback' => "SELECT comments FROM feedback WHERE comments LIKE '%$searchTerm%'",
        'instuctor' => "SELECT Bio FROM instuctor WHERE Bio LIKE '%$searchTerm%'",
        'attendees' => "SELECT Occupation FROM attendees WHERE Occupation LIKE '%$searchTerm%'",
        'certificates' => "SELECT DateOfCompletion FROM certificates WHERE DateOfCompletion LIKE '%$searchTerm%'",
        'attendance_tracking' => "SELECT Duration FROM attendance_tracking WHERE Duration LIKE '%$searchTerm%'",
        'payments' => "SELECT Amount FROM payments WHERE Amount LIKE '%$searchTerm%'",
        'worshops' => "SELECT Title FROM worshops WHERE Title LIKE '%$searchTerm%'",
        'worshop_material' => "SELECT MaterialType FROM worshop_material WHERE MaterialType LIKE '%$searchTerm%'",
        'wealth_building_resources' => "SELECT Description FROM wealth_building_resources WHERE Description LIKE '%$searchTerm%'",
    ];

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";

    foreach ($queries as $table => $sql) {
        $result = $connection->query($sql);
        echo "<h3>Table of $table:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row[array_keys($row)[0]] . "</p>"; // Dynamic field extraction from result
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    // Close the connection
    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>
