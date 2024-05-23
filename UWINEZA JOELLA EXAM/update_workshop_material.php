<?php
include('database_connection.php');

// Check if MaterialID is set
if(isset($_REQUEST['MaterialID'])) {
    $mid = $_REQUEST['MaterialID'];
    
    $stmt = $connection->prepare("SELECT * FROM workshop_material WHERE MaterialID=?");
    $stmt->bind_param("i", $mid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['MaterialID'];
        $u = $row['WorkshopID'];
        $y = $row['MaterialType'];
    } else {
        echo " no workshop material found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update new record in workshop_material</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update workshop_material form -->
    <h2><u>Update Form of workshop_material</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">

        <label for="wid">WorkshopID:</label>
        <input type="text" name="wid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for=mty>MaterialType:</label>
        <input type="text" name="mty" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $WorkshopID = $_POST['wid'];
    $MaterialType = $_POST['mty'];
    
    // Update the workshop_material in the database
    $stmt = $connection->prepare("UPDATE workshop_material SET WorkshopID=?, MaterialType=? WHERE MaterialID=?");
    $stmt->bind_param("ssd" $WorkshopID, $MaterialType $mid);
    $stmt->execute();
    
    // Redirect to workshop_material.php
    header('Location: workshop_material.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
s