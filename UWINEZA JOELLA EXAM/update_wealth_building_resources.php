<?php
include('database_connection.php');

// Check if ResourceID is set
if(isset($_REQUEST['ResourceID'])) {
    $rid = $_REQUEST['ResourceID'];
    
    $stmt = $connection->prepare("SELECT * FROM wealth_building_resource WHERE ResourceID=?");
    $stmt->bind_param("i", $rid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['ResourceID'];
        $u = $row['Title'];
        $y = $row['Description'];
        $z = $row['Type'];
    } else {
        echo "resources not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update new record in wealth_building_resources</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update wealth_building_resources form -->
    <h2><u>Update Form of wealth_building_resources</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="ttl">Title:</label>
        <input type="number" name="ttl" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for=dpt>Description:</label>
        <input type="text" name="dpt" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="typ">Type:</label>
        <input type="date" name="typ" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $Title = $_POST['ttl'];
    $Description = $_POST['dpt'];
    $Type= $_POST['typ'];
    
    // Update the wealth_building_resources in the database
    $stmt = $connection->prepare("UPDATE wealth_building_resources SET Title=?, Description=?, Type=? WHERE ResourceID=?");
    $stmt->bind_param("issi" $Ttitle, $Title, $Description,$Type, $rid);
    $stmt->execute();
    
    // Redirect to wealth_building_resources.php
    header('Location: wealth_building_resources.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
