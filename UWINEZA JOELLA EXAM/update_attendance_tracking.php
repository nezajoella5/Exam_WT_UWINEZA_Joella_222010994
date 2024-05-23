<?php
include('database_connection.php');

// Check if AttendanceID is set
if(isset($_REQUEST['AttendanceID'])) {
    $aid = $_REQUEST['AttendanceID'];
    
    $stmt = $connection->prepare("SELECT * FROM attendance_tracking WHERE AttendanceID=?");
    $stmt->bind_param("i", $aid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['AttendanceID'];
        $u = $row['WorkshopID'];
        $y = $row['AttendeeID'];
        $y = $row['Duration'];
    } else {
        echo "attendance_tracking not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update new record in attendance_tracking</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update attendance_tracking form -->
    <h2><u>Update Form of attendance_tracking</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        
        <label for="wid">WorkshopID:</label>
        <input type="number" name="bname" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="atid">AttendeeID:</label>
        <input type="number" name="bname" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="dn">Duration:</label>
        <input type="text" name="loc" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $WorkshopID= $_POST['wid'];
    $AttendeeID = $_POST['atid'];
    $Duration = $_POST['dn'];
    
    
    // Update the attendance_tracking in the database
    $stmt = $connection->prepare("UPDATE attendance_tracking SET WorkshopID=?,AttendeeID=?,Duration=? WHERE AttendanceID=?");
    $stmt->bind_param("ssii" $WorkshopID,$AttendeeID,$Duration $aid);
    $stmt->execute();
    
    // Redirect to attendance_tracking.php
    header('Location: attendance_tracking.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
